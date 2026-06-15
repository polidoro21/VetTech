<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use Illuminate\Http\Request;

class AdminClinicaController extends Controller
{
    public function index()
    {
        $clinicas = Clinica::with('user')
            ->orderByRaw("CASE WHEN pending_changes IS NOT NULL THEN 0 WHEN status = 'pending' THEN 1 WHEN status = 'rejected' THEN 2 ELSE 3 END")
            ->latest()
            ->get();

        return view('admin.clinicas.index', compact('clinicas'));
    }

    public function approve(Clinica $clinica)
    {
        $changes = $clinica->pending_changes ?: [];

        $clinica->fill($changes);
        $clinica->status = 'approved';
        $clinica->pending_changes = null;
        $clinica->approved_at = now();
        $clinica->rejection_reason = null;
        $clinica->save();

        return redirect()->route('admin.clinicas.index')
            ->with('success', 'Clinica aprovada com sucesso.');
    }

    public function reject(Request $request, Clinica $clinica)
    {
        $data = $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:500'],
        ]);

        $reason = $data['rejection_reason'] ?: 'Cadastro ou alteracao rejeitada pelo administrador.';

        if ($clinica->status === 'approved') {
            $clinica->update([
                'pending_changes' => null,
                'rejection_reason' => $reason,
            ]);
        } else {
            $clinica->update([
                'status' => 'rejected',
                'pending_changes' => null,
                'approved_at' => null,
                'rejection_reason' => $reason,
            ]);
        }

        return redirect()->route('admin.clinicas.index')
            ->with('success', 'Clinica rejeitada com sucesso.');
    }
}
