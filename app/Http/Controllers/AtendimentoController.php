<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Atendimento;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AtendimentoController extends Controller
{
    public function index()
    {
        $atendimentos = Atendimento::with(['animal', 'veterinario'])
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereHas('animal', fn ($animal) => $animal->where('id_usuario', Auth::id()));
            })
            ->latest()
            ->get();

        return view('atendimentos.index', compact('atendimentos'));
    }

    public function create()
    {
        $animais = Animal::where('id_usuario', Auth::id())->orderBy('nome')->get();

        return view('atendimentos.create', compact('animais'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id' => [
                'required',
                Rule::exists('animais', 'id')->where('id_usuario', Auth::id()),
            ],
            'modo' => ['required', Rule::in(['chat', 'video'])],
            'descricao' => ['required', 'string', 'max:2000'],
            'observacoes' => ['nullable', 'string', 'max:2000'],
        ]);

        $atendimento = Atendimento::create($data + [
            'user_id' => Auth::id(),
            'data' => now()->toDateString(),
            'valor' => 0,
            'status' => 'aguardando',
            'recusado_por' => [],
        ]);

        return redirect()->route('atendimentos.show', $atendimento)
            ->with('success', 'Atendimento solicitado. Voce entrou na fila.');
    }

    public function show(Atendimento $atendimento)
    {
        $this->authorizeParticipant($atendimento);

        $atendimento->load(['animal.usuario', 'veterinario', 'messages.user']);

        return view('atendimentos.show', compact('atendimento'));
    }

    public function accept(Atendimento $atendimento)
    {
        $this->ensureVet();

        $updated = Atendimento::whereKey($atendimento->id)
            ->where('status', 'aguardando')
            ->update([
                'status' => 'em_atendimento',
                'veterinario_id' => Auth::id(),
                'started_at' => now(),
                'updated_at' => now(),
            ]);

        if (!$updated) {
            return redirect()->route('vet.atendimentos.index')
                ->withErrors(['atendimento' => 'Este atendimento ja foi aceito ou nao esta mais disponivel.']);
        }

        return redirect()->route('atendimentos.show', $atendimento)
            ->with('success', 'Atendimento aceito. A sala esta aberta.');
    }

    public function refuse(Atendimento $atendimento)
    {
        $this->ensureVet();

        if ($atendimento->status !== 'aguardando') {
            return redirect()->route('vet.atendimentos.index');
        }

        $recusados = $atendimento->recusado_por ?? [];
        $recusados[] = Auth::id();

        $atendimento->update([
            'recusado_por' => array_values(array_unique($recusados)),
        ]);

        return redirect()->route('vet.atendimentos.index')
            ->with('success', 'Atendimento recusado. Ele continua disponivel para outros veterinarios.');
    }

    public function message(Request $request, Atendimento $atendimento)
    {
        $this->authorizeParticipant($atendimento);

        $data = $request->validate([
            'mensagem' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'atendimento_id' => $atendimento->id,
            'user_id' => Auth::id(),
            'usuario' => Auth::user()->name,
            'mensagem' => $data['mensagem'],
        ]);

        return redirect(route('atendimentos.show', $atendimento) . '#chat');
    }

    public function finish(Request $request, Atendimento $atendimento)
    {
        $this->ensureAssignedVet($atendimento);

        $data = $request->validate([
            'video_url' => ['nullable', 'url', 'max:255'],
            'descricao_observado' => ['required', 'string', 'max:3000'],
            'anotacoes' => ['nullable', 'string', 'max:3000'],
            'receita' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        if ($request->hasFile('receita')) {
            $data['receita_path'] = $request->file('receita')->store('receitas', 'public');
        }

        unset($data['receita']);

        $atendimento->update($data + [
            'status' => 'finalizado',
            'finished_at' => now(),
        ]);

        return redirect()->route('atendimentos.show', $atendimento)
            ->with('success', 'Atendimento finalizado. O tutor ja pode ver as anotacoes e a receita.');
    }

    public function cancel(Atendimento $atendimento)
    {
        $this->ensureTutorOwner($atendimento);

        if (!in_array($atendimento->status, ['aguardando', 'em_atendimento'], true)) {
            return redirect()->route('atendimentos.show', $atendimento);
        }

        $atendimento->update([
            'status' => 'cancelado',
            'finished_at' => now(),
        ]);

        return redirect()->route('atendimentos.index')
            ->with('success', 'Atendimento cancelado.');
    }

    public function destroy($id)
    {
        $atendimento = $this->ownedAtendimento($id);
        $atendimento->delete();

        return redirect()
            ->route('atendimentos.index')
            ->with('success', 'Atendimento excluido com sucesso.');
    }

    public function receiptUrl(Atendimento $atendimento): ?string
    {
        return $atendimento->receita_path ? Storage::disk('public')->url($atendimento->receita_path) : null;
    }

    private function ownedAtendimento(int|string $id): Atendimento
    {
        return Atendimento::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereHas('animal', fn ($animal) => $animal->where('id_usuario', Auth::id()));
        })->findOrFail($id);
    }

    private function authorizeParticipant(Atendimento $atendimento): void
    {
        if (Auth::user()->tipo === 'admin') {
            return;
        }

        if (Auth::user()->tipo === 'vet' && $atendimento->veterinario_id === Auth::id()) {
            return;
        }

        $this->ensureTutorOwner($atendimento);
    }

    private function ensureTutorOwner(Atendimento $atendimento): void
    {
        $atendimento->loadMissing('animal');

        if ($atendimento->user_id !== Auth::id() && optional($atendimento->animal)->id_usuario !== Auth::id()) {
            abort(404);
        }
    }

    private function ensureVet(): void
    {
        if (Auth::user()->tipo !== 'vet') {
            abort(403);
        }
    }

    private function ensureAssignedVet(Atendimento $atendimento): void
    {
        $this->ensureVet();

        if ($atendimento->veterinario_id !== Auth::id()) {
            abort(403);
        }
    }
}
