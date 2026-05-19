<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetTech — Carteirinha Digital</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&family=JetBrains+Mono:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --sidebar-w: 260px;
            --bg1: #060C1A;
            --bg2: #0B1628;
            --accent: #4361EE;
            --accent2: #7B2FBE;
            --cyan: #00D4FF;
            --green: #06D6A0;
            --amber: #FFB703;
            --red: #FF6B9D;
            --glass: rgba(255, 255, 255, 0.06);
            --glass-border: rgba(255, 255, 255, 0.12);
            --glass-hover: rgba(255, 255, 255, 0.1);
            --text: #FFFFFF;
            --text-mid: rgba(255, 255, 255, 0.7);
            --text-soft: rgba(255, 255, 255, 0.4);
            --radius: 24px;
            --radius-sm: 14px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 15px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg1);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* ── ANIMATED BG ── */
        .bg-scene {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            animation: float-orb 12s ease-in-out infinite;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #4361EE, transparent 70%);
            top: -150px;
            left: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #7B2FBE, transparent 70%);
            bottom: -100px;
            right: -80px;
            animation-delay: -4s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #00D4FF, transparent 70%);
            top: 40%;
            left: 40%;
            opacity: 0.18;
            animation-delay: -8s;
        }

        @keyframes float-orb {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -40px) scale(1.05);
            }

            66% {
                transform: translate(-20px, 30px) scale(0.95);
            }
        }

        /* grid pattern */
        .bg-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: rgba(11, 22, 40, 0.9);
            backdrop-filter: blur(24px);
            border-right: 1px solid var(--glass-border);
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 28px 20px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 36px;
            padding: 0 4px;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 0 20px rgba(67, 97, 238, 0.5);
        }

        .logo-text {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: #fff;
        }

        .logo-text span {
            color: var(--accent);
        }

        .nav-section {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.8px;
            color: var(--text-soft);
            text-transform: uppercase;
            padding: 0 4px;
            margin-bottom: 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: var(--radius-sm);
            color: var(--text-soft);
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 2px;
        }

        .nav-item:hover {
            background: var(--glass);
            color: var(--text);
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.2), rgba(123, 47, 190, 0.12));
            color: #fff;
            border: 1px solid rgba(67, 97, 238, 0.3);
            position: relative;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            border-radius: 2px;
            background: linear-gradient(180deg, var(--accent), var(--accent2));
        }

        .nav-icon {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .nav-group {
            margin-bottom: 24px;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid var(--glass-border);
            padding-top: 20px;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            background: var(--glass);
            cursor: pointer;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: #fff;
            flex-shrink: 0;
        }

        .user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #fff;
        }

        .user-role {
            font-size: 0.72rem;
            color: var(--text-soft);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        /* ── HEADER ── */
        .header {
            background: rgba(11, 22, 40, 0.7);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: 0 36px;
            height: 68px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .header-breadcrumb {
            font-size: 0.78rem;
            color: var(--text-soft);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .header-breadcrumb span {
            color: var(--text-mid);
            font-weight: 500;
        }

        .header-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
            background: var(--glass);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            color: var(--text-mid);
            transition: all 0.2s;
        }

        .header-btn:hover {
            background: var(--glass-hover);
            border-color: var(--accent);
            color: var(--accent);
        }

        .header-chip {
            padding: 7px 14px;
            border-radius: 20px;
            border: 1px solid rgba(6, 214, 160, 0.4);
            background: rgba(6, 214, 160, 0.1);
            color: var(--green);
            font-size: 0.78rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .live-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--green);
            animation: blink 1.4s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.3
            }
        }

        /* ── CONTENT ── */
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 32px 36px;
            display: flex;
            gap: 28px;
            align-items: flex-start;
        }

        .content::-webkit-scrollbar {
            width: 6px;
        }

        .content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        /* ── PET SWITCHER ── */
        .switcher-col {
            width: 200px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .switcher-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--text-soft);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 4px;
        }

        .pet-thumb {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            background: var(--glass);
            border: 1px solid var(--glass-border);
            cursor: pointer;
            transition: all 0.25s;
        }

        .pet-thumb:hover {
            background: var(--glass-hover);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .pet-thumb.active {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.2), rgba(123, 47, 190, 0.15));
            border-color: rgba(67, 97, 238, 0.5);
            box-shadow: 0 0 20px rgba(67, 97, 238, 0.15);
        }

        .thumb-emoji {
            font-size: 1.4rem;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .thumb-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            color: #fff;
        }

        .thumb-type {
            font-size: 0.7rem;
            color: var(--text-soft);
            margin-top: 1px;
        }

        .add-pet-btn {
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            border: 1px dashed rgba(255, 255, 255, 0.2);
            background: transparent;
            color: var(--text-soft);
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-pet-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(67, 97, 238, 0.08);
        }

        /* ── CARD WALLET ── */
        .card-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .wallet-card {
            border-radius: 28px;
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, #1a2540 0%, #0f1d35 50%, #1a1535 100%);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow:
                0 40px 80px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
            animation: card-in 0.6s cubic-bezier(0.34, 1.2, 0.64, 1) both;
        }

        @keyframes card-in {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.96) rotateX(4deg);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1) rotateX(0);
            }
        }

        /* card inner layers */
        .card-noise {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            opacity: 0.6;
            pointer-events: none;
        }

        .card-glow {
            position: absolute;
            top: -80px;
            right: -60px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.3) 0%, transparent 65%);
            pointer-events: none;
        }

        .card-glow-2 {
            position: absolute;
            bottom: -60px;
            left: 20px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .card-lines {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .card-lines::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .card-lines::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 1px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.1), transparent, rgba(255, 255, 255, 0.05));
        }

        .card-body-inner {
            position: relative;
            z-index: 2;
            padding: 32px;
        }

        /* card top bar */
        .card-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .card-brand {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-brand-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .card-brand-name {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.95rem;
        }

        .card-brand-name span {
            color: var(--accent);
        }

        .card-id {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.68rem;
            color: var(--text-soft);
            letter-spacing: 1px;
        }

        .valid-badge {
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(6, 214, 160, 0.15);
            border: 1px solid rgba(6, 214, 160, 0.3);
            color: var(--green);
            font-size: 0.7rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* pet info row */
        .pet-info-row {
            display: flex;
            align-items: flex-start;
            gap: 24px;
        }

        .pet-photo-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .pet-photo {
            width: 90px;
            height: 90px;
            border-radius: 20px;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.15);
            background: linear-gradient(135deg, #2a3a5c, #1a2540);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .photo-ring {
            position: absolute;
            inset: -4px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--accent), var(--cyan), var(--accent2));
            z-index: -1;
            opacity: 0.7;
            animation: spin-ring 8s linear infinite;
        }

        @keyframes spin-ring {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .photo-inner {
            position: relative;
            z-index: 1;
        }

        .pet-details {
            flex: 1;
        }

        .pet-name-big {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: -1px;
            line-height: 1;
            margin-bottom: 6px;
            background: linear-gradient(135deg, #fff 40%, rgba(255, 255, 255, 0.7));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .pet-breed {
            font-size: 0.9rem;
            color: var(--text-mid);
            margin-bottom: 12px;
            font-weight: 500;
        }

        .pet-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pet-tag {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            border: 1px solid;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .tag-blue {
            background: rgba(67, 97, 238, 0.15);
            border-color: rgba(67, 97, 238, 0.4);
            color: #8fa8ff;
        }

        .tag-pink {
            background: rgba(255, 107, 157, 0.12);
            border-color: rgba(255, 107, 157, 0.35);
            color: #ff9ebe;
        }

        .tag-amber {
            background: rgba(255, 183, 3, 0.12);
            border-color: rgba(255, 183, 3, 0.35);
            color: #ffd35c;
        }

        .tag-green {
            background: rgba(6, 214, 160, 0.12);
            border-color: rgba(6, 214, 160, 0.35);
            color: #4dedd0;
        }

        .tag-cyan {
            background: rgba(0, 212, 255, 0.12);
            border-color: rgba(0, 212, 255, 0.35);
            color: #5ee0ff;
        }

        /* QR area */
        .card-bottom {
            display: flex;
            gap: 28px;
            align-items: flex-end;
            margin-top: 24px;
        }

        .qr-block {
            flex-shrink: 0;
        }

        .qr-wrap {
            width: 100px;
            height: 100px;
            border-radius: 14px;
            background: #fff;
            padding: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        .qr-canvas {
            width: 84px;
            height: 84px;
            display: block;
        }

        .qr-label {
            font-size: 0.62rem;
            color: var(--text-soft);
            text-align: center;
            margin-top: 6px;
            letter-spacing: 0.5px;
            font-family: 'JetBrains Mono', monospace;
        }

        .info-grid {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .info-item {}

        .info-label {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--text-soft);
            margin-bottom: 4px;
        }

        .info-val {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text);
        }

        .info-val.mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.82rem;
        }

        /* blood type special */
        .blood-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(239, 71, 111, 0.2);
            border: 1.5px solid rgba(239, 71, 111, 0.5);
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.9rem;
            color: #ff6b8a;
        }

        /* plan row */
        .plan-row {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .plan-icon {
            font-size: 1rem;
        }

        .plan-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #fff;
        }

        .plan-exp {
            font-size: 0.7rem;
            color: var(--text-soft);
        }

        .plan-star {
            margin-left: auto;
            color: var(--amber);
            font-size: 0.9rem;
        }

        /* holographic strip */
        .holo-strip {
            height: 6px;
            width: 100%;
            background: linear-gradient(90deg, var(--accent), var(--cyan), var(--green), var(--amber), var(--red), var(--accent));
            background-size: 200% 100%;
            animation: holo-slide 3s linear infinite;
            opacity: 0.8;
        }

        @keyframes holo-slide {
            0% {
                background-position: 0% 0%;
            }

            100% {
                background-position: 200% 0%;
            }
        }

        /* chip decoration */
        .chip-deco {
            position: absolute;
            bottom: 32px;
            right: 32px;
            width: 50px;
            height: 38px;
            border-radius: 8px;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.3), rgba(255, 200, 0, 0.1));
            border: 1px solid rgba(255, 200, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chip-lines {
            width: 30px;
            height: 22px;
            position: relative;
        }

        .chip-lines::before,
        .chip-lines::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(255, 200, 0, 0.5);
        }

        .chip-lines::before {
            top: 6px;
        }

        .chip-lines::after {
            top: 14px;
        }

        .chip-lines-v {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 1px;
            background: rgba(255, 200, 0, 0.5);
            left: 50%;
        }

        /* ── VACINAS PANEL ── */
        .vacc-panel {
            background: var(--glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 24px;
            animation: fadeUp 0.5s 0.15s both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .panel-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.92rem;
            color: #fff;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.68rem;
            font-weight: 700;
            background: rgba(6, 214, 160, 0.15);
            border: 1px solid rgba(6, 214, 160, 0.35);
            color: var(--green);
        }

        .vacc-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .vacc-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            transition: all 0.2s;
            cursor: default;
        }

        .vacc-item:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.14);
        }

        .vacc-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .vacc-dot.ok {
            background: var(--green);
            box-shadow: 0 0 8px rgba(6, 214, 160, 0.5);
        }

        .vacc-dot.due {
            background: var(--amber);
            box-shadow: 0 0 8px rgba(255, 183, 3, 0.5);
        }

        .vacc-dot.exp {
            background: var(--red);
            box-shadow: 0 0 8px rgba(255, 107, 157, 0.5);
        }

        .vacc-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #fff;
            flex: 1;
        }

        .vacc-date {
            font-size: 0.75rem;
            color: var(--text-soft);
            font-family: 'JetBrains Mono', monospace;
        }

        .vacc-status {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .status-ok {
            background: rgba(6, 214, 160, 0.12);
            color: #4dedd0;
            border: 1px solid rgba(6, 214, 160, 0.3);
        }

        .status-due {
            background: rgba(255, 183, 3, 0.12);
            color: #ffd35c;
            border: 1px solid rgba(255, 183, 3, 0.3);
        }

        .status-exp {
            background: rgba(255, 107, 157, 0.12);
            color: #ff9ebe;
            border: 1px solid rgba(255, 107, 157, 0.3);
        }

        /* ── ACTION BTNS ── */
        .actions-panel {
            display: flex;
            gap: 12px;
        }

        .action-btn {
            flex: 1;
            padding: 14px 20px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--glass-border);
            background: var(--glass);
            color: var(--text-mid);
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.06));
            opacity: 0;
            transition: opacity 0.2s;
        }

        .action-btn:hover {
            border-color: rgba(255, 255, 255, 0.25);
            color: #fff;
            background: var(--glass-hover);
            transform: translateY(-2px);
        }

        .action-btn:hover::before {
            opacity: 1;
        }

        .action-btn:active {
            transform: translateY(0);
        }

        .action-btn.primary {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-color: transparent;
            color: #fff;
            box-shadow: 0 8px 24px rgba(67, 97, 238, 0.4);
        }

        .action-btn.primary:hover {
            box-shadow: 0 12px 32px rgba(67, 97, 238, 0.55);
        }

        /* ── STATS ROW ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            animation: fadeUp 0.5s 0.25s both;
        }

        .stat-card {
            background: var(--glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-sm);
            padding: 18px;
            position: relative;
            overflow: hidden;
            cursor: default;
            transition: all 0.2s;
        }

        .stat-card:hover {
            background: var(--glass-hover);
            border-color: rgba(255, 255, 255, 0.18);
            transform: translateY(-2px);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            border-radius: 2px 2px 0 0;
        }

        .stat-card.blue::after {
            background: linear-gradient(90deg, var(--accent), var(--cyan));
        }

        .stat-card.green::after {
            background: linear-gradient(90deg, var(--green), #04e8b5);
        }

        .stat-card.amber::after {
            background: linear-gradient(90deg, var(--amber), #ff9500);
        }

        .stat-icon {
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .stat-val {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: #fff;
        }

        .stat-label {
            font-size: 0.72rem;
            color: var(--text-soft);
            margin-top: 4px;
            font-weight: 500;
        }

        .stat-sub {
            font-size: 0.7rem;
            color: var(--text-soft);
            margin-top: 2px;
        }

        /* ── TOAST ── */
        .toast {
            position: fixed;
            bottom: 32px;
            right: 32px;
            z-index: 300;
            background: rgba(11, 22, 40, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            color: #fff;
            padding: 14px 20px;
            border-radius: 14px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            font-size: 0.88rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateX(120%);
            transition: transform 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        }

        .toast.show {
            transform: translateX(0);
        }

        /* scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }
    </style>
</head>

<body>

    <div class="bg-scene">
        <div class="bg-grid"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <div class="logo-icon">🐾</div>
            <div class="logo-text">Vet<span>Tech</span></div>
        </div>
        <div class="nav-group">
            <div class="nav-section">Principal</div>
            <div class="nav-item"><span class="nav-icon">⊞</span> Dashboard</div>
            <div class="nav-item"><span class="nav-icon">📅</span> Agendamentos <span class="nav-badge">3</span></div>
            <div class="nav-item"><span class="nav-icon">🐶</span> Pacientes</div>
            <div class="nav-item active"><span class="nav-icon">🪪</span> Carteirinha</div>
            <div class="nav-item"><span class="nav-icon">👩‍⚕️</span> Veterinários</div>
            <div class="nav-item"><span class="nav-icon">📋</span> Prontuários</div>
        </div>
        <div class="nav-group">
            <div class="nav-section">Operações</div>
            <div class="nav-item"><span class="nav-icon">💊</span> Estoque</div>
            <div class="nav-item"><span class="nav-icon">💰</span> Financeiro</div>
            <div class="nav-item"><span class="nav-icon">📊</span> Relatórios</div>
            <div class="nav-item"><span class="nav-icon">🔔</span> Notificações <span class="nav-badge">5</span></div>
        </div>
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">MA</div>
                <div>
                    <div class="user-name">Maria Alves</div>
                    <div class="user-role">Recepcionista</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <header class="header">
            <div>
                <div class="header-breadcrumb">Home › Pacientes › <span>Carteirinha</span></div>
                <div class="header-title" style="font-family:'Syne',sans-serif;font-weight:700">Carteirinha Digital
                </div>
            </div>
            <div class="header-right">
                <div class="header-chip">
                    <div class="live-dot"></div> Verificado
                </div>
                <button class="header-btn" title="Buscar">🔍</button>
                <button class="header-btn" title="Notificações">🔔</button>
                <button class="header-btn" title="Configurações">⚙️</button>
            </div>
        </header>

        <div class="content">

            <!-- PET SWITCHER -->
            <div class="switcher-col">
                <div class="switcher-title">Meus Pets</div>
                <div class="pet-thumb active" onclick="switchPet(this,'thor')">
                    <div class="thumb-emoji" style="background:rgba(255,165,0,0.15)">🐶</div>
                    <div>
                        <div class="thumb-name">Thor</div>
                        <div class="thumb-type">Golden · Macho</div>
                    </div>
                </div>
                <div class="pet-thumb" onclick="switchPet(this,'luna')">
                    <div class="thumb-emoji" style="background:rgba(147,112,219,0.15)">🐱</div>
                    <div>
                        <div class="thumb-name">Luna</div>
                        <div class="thumb-type">Siamês · Fêmea</div>
                    </div>
                </div>
                <div class="pet-thumb" onclick="switchPet(this,'bolinha')">
                    <div class="thumb-emoji" style="background:rgba(100,200,100,0.15)">🐇</div>
                    <div>
                        <div class="thumb-name">Bolinha</div>
                        <div class="thumb-type">Coelho · Macho</div>
                    </div>
                </div>
                <button class="add-pet-btn">➕ Adicionar Pet</button>
            </div>

            <!-- MAIN CARD COL -->
            <div class="card-col">

                <!-- WALLET CARD -->
                <div class="wallet-card" id="wallet-card">
                    <div class="holo-strip"></div>
                    <div class="card-noise"></div>
                    <div class="card-glow"></div>
                    <div class="card-glow-2"></div>
                    <div class="card-lines"></div>

                    <div class="card-body-inner">
                        <!-- Top Bar -->
                        <div class="card-topbar">
                            <div class="card-brand">
                                <div class="card-brand-icon">🐾</div>
                                <div class="card-brand-name">Vet<span>Tech</span></div>
                                <div style="width:1px;height:16px;background:rgba(255,255,255,0.15);margin:0 8px">
                                </div>
                                <div class="card-id" id="card-id">ID · VT-2026-00847</div>
                            </div>
                            <div class="valid-badge">
                                <div class="live-dot"></div> Ativo
                            </div>
                        </div>

                        <!-- Pet Info -->
                        <div class="pet-info-row">
                            <div class="pet-photo-wrap">
                                <div class="photo-ring"></div>
                                <div class="photo-inner">
                                    <div class="pet-photo" id="pet-photo">🐶</div>
                                </div>
                            </div>
                            <div class="pet-details">
                                <div class="pet-name-big" id="pet-name">Thor</div>
                                <div class="pet-breed" id="pet-breed">Golden Retriever · Macho · Castrado</div>
                                <div class="pet-tags" id="pet-tags">
                                    <div class="pet-tag tag-blue">🎂 3 anos</div>
                                    <div class="pet-tag tag-amber">⚖️ 32 kg</div>
                                    <div class="pet-tag tag-pink">🩸 DEA 1.1+</div>
                                    <div class="pet-tag tag-green">💎 Plano Gold</div>
                                    <div class="pet-tag tag-cyan">🔖 Microchip</div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom: QR + Info -->
                        <div class="card-bottom">
                            <div class="qr-block">
                                <div class="qr-wrap">
                                    <canvas class="qr-canvas" id="qr-canvas" width="84" height="84"></canvas>
                                </div>
                                <div class="qr-label">ESCANEAR CARTEIRINHA</div>
                            </div>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Tutor</div>
                                    <div class="info-val" id="tutor-name">Carlos Almeida</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Tipo Sanguíneo</div>
                                    <div class="info-val"><span class="blood-badge" id="blood">DEA</span></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Nascimento</div>
                                    <div class="info-val mono" id="pet-birth">12/03/2023</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Microchip</div>
                                    <div class="info-val mono" style="font-size:0.75rem" id="chip-id">985 141 000
                                        478 291</div>
                                </div>
                                <div class="info-item" style="grid-column:1/-1">
                                    <div class="info-label">Plano Veterinário</div>
                                    <div class="plan-row">
                                        <span class="plan-icon">💎</span>
                                        <div>
                                            <div class="plan-name" id="plan-name">VetTech Gold</div>
                                            <div class="plan-exp" id="plan-exp">Válido até Dez/2026</div>
                                        </div>
                                        <div class="plan-star">★★★★★</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- chip deco -->
                    <div class="chip-deco">
                        <div class="chip-lines">
                            <div class="chip-lines-v"></div>
                        </div>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="actions-panel">
                    <button class="action-btn primary" onclick="doAction('download')">
                        ⬇️ Baixar PDF
                    </button>
                    <button class="action-btn" onclick="doAction('share')">
                        🔗 Compartilhar
                    </button>
                    <button class="action-btn" onclick="doAction('print')">
                        🖨️ Imprimir
                    </button>
                    <button class="action-btn" onclick="doAction('qr')">
                        📲 Ver QR
                    </button>
                </div>

                <!-- STATS -->
                <div class="stats-row">
                    <div class="stat-card blue">
                        <div class="stat-icon">💉</div>
                        <div class="stat-val" id="stat-vacc">6/7</div>
                        <div class="stat-label">Vacinas em Dia</div>
                        <div class="stat-sub">1 renovação pendente</div>
                    </div>
                    <div class="stat-card green">
                        <div class="stat-icon">📅</div>
                        <div class="stat-val" id="stat-consult">12</div>
                        <div class="stat-label">Consultas Realizadas</div>
                        <div class="stat-sub">Última: 03 Mai 2026</div>
                    </div>
                    <div class="stat-card amber">
                        <div class="stat-icon">⭐</div>
                        <div class="stat-val">Gold</div>
                        <div class="stat-label">Plano Atual</div>
                        <div class="stat-sub" id="stat-plan-exp">Válido até Dez/2026</div>
                    </div>
                </div>

                <!-- VACINAS -->
                <div class="vacc-panel">
                    <div class="panel-title">
                        💉 Histórico de Vacinas
                        <span class="panel-badge">6 em dia</span>
                        <span
                            style="margin-left:4px;padding:3px 10px;border-radius:20px;font-size:0.68rem;font-weight:700;background:rgba(255,183,3,0.12);border:1px solid rgba(255,183,3,0.3);color:#ffd35c;">1
                            pendente</span>
                    </div>
                    <div class="vacc-list" id="vacc-list">
                        <!-- filled by JS -->
                    </div>
                </div>

            </div><!-- /card-col -->
        </div><!-- /content -->
    </div><!-- /main -->

    <!-- TOAST -->
    <div class="toast" id="toast">
        <span id="toast-icon">🐾</span>
        <span id="toast-msg">Ação realizada!</span>
    </div>

    <script>
        // ── QR CODE (pure canvas) ──
        function drawQR(canvas, text) {
            const ctx = canvas.getContext('2d');
            const size = 84;
            const cells = 21;
            const cell = size / cells;
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, size, size);
            // Simple deterministic pattern based on text hash
            let hash = 0;
            for (let i = 0; i < text.length; i++) hash = ((hash << 5) - hash) + text.charCodeAt(i);
            const finder = (x, y) => {
                ctx.fillStyle = '#000';
                ctx.fillRect(x * cell, y * cell, 7 * cell, 7 * cell);
                ctx.fillStyle = '#fff';
                ctx.fillRect((x + 1) * cell, (y + 1) * cell, 5 * cell, 5 * cell);
                ctx.fillStyle = '#000';
                ctx.fillRect((x + 2) * cell, (y + 2) * cell, 3 * cell, 3 * cell);
            };
            finder(0, 0);
            finder(14, 0);
            finder(0, 14);
            // timing
            ctx.fillStyle = '#000';
            for (let i = 8; i < 13; i++) {
                if (i % 2 === 0) {
                    ctx.fillRect(i * cell, 6 * cell, cell, cell);
                    ctx.fillRect(6 * cell, i * cell, cell, cell);
                }
            }
            // data
            ctx.fillStyle = '#000';
            for (let r = 0; r < cells; r++)
                for (let c = 0; c < cells; c++) {
                    if (r < 9 && c < 9 || r < 9 && c > 12 || r > 12 && c < 9) continue;
                    const bit = (hash ^ (r * 37 + c * 13) ^ (r + c)) & 1;
                    if (bit) ctx.fillRect(c * cell, r * cell, cell, cell);
                }
        }

        const canvas = document.getElementById('qr-canvas');
        drawQR(canvas, 'VETTECH-THOR-VT2026-00847');

        // ── VACCINAS DATA ──
        const vaccsData = {
            thor: [{
                    name: 'Antirrábica',
                    date: '12/01/2026',
                    next: '12/01/2027',
                    status: 'ok'
                },
                {
                    name: 'V10 (Polivalente)',
                    date: '03/03/2026',
                    next: '03/03/2027',
                    status: 'ok'
                },
                {
                    name: 'Giardia',
                    date: '15/11/2025',
                    next: '15/11/2026',
                    status: 'ok'
                },
                {
                    name: 'Gripe Canina',
                    date: '20/06/2025',
                    next: '20/06/2026',
                    status: 'due'
                },
                {
                    name: 'Leishmaniose',
                    date: '08/04/2026',
                    next: '08/04/2027',
                    status: 'ok'
                },
                {
                    name: 'Leptospirose',
                    date: '14/02/2026',
                    next: '14/02/2027',
                    status: 'ok'
                },
                {
                    name: 'Coronavírus Canino',
                    date: '10/09/2025',
                    next: '10/09/2026',
                    status: 'ok'
                },
            ],
            luna: [{
                    name: 'Antirrábica',
                    date: '05/02/2026',
                    next: '05/02/2027',
                    status: 'ok'
                },
                {
                    name: 'Quadrivalente Felina',
                    date: '18/01/2026',
                    next: '18/01/2027',
                    status: 'ok'
                },
                {
                    name: 'FeLV (Leucemia)',
                    date: '22/07/2025',
                    next: '22/07/2026',
                    status: 'due'
                },
                {
                    name: 'FIV/FeLV',
                    date: '30/10/2025',
                    next: '30/10/2026',
                    status: 'ok'
                },
            ],
            bolinha: [{
                    name: 'Calicivirose',
                    date: '11/03/2026',
                    next: '11/03/2027',
                    status: 'ok'
                },
                {
                    name: 'Mixomatose',
                    date: '25/08/2025',
                    next: '25/08/2026',
                    status: 'due'
                },
            ],
        };

        const petData = {
            thor: {
                emoji: '🐶',
                name: 'Thor',
                breed: 'Golden Retriever · Macho · Castrado',
                tags: '<div class="pet-tag tag-blue">🎂 3 anos</div><div class="pet-tag tag-amber">⚖️ 32 kg</div><div class="pet-tag tag-pink">🩸 DEA 1.1+</div><div class="pet-tag tag-green">💎 Plano Gold</div><div class="pet-tag tag-cyan">🔖 Microchip</div>',
                tutor: 'Carlos Almeida',
                blood: 'DEA',
                birth: '12/03/2023',
                chip: '985 141 000 478 291',
                plan: 'VetTech Gold',
                planExp: 'Válido até Dez/2026',
                id: 'VT-2026-00847',
                statVacc: '6/7',
                statConsult: '12',
            },
            luna: {
                emoji: '🐱',
                name: 'Luna',
                breed: 'Siamês · Fêmea · Castrada',
                tags: '<div class="pet-tag tag-blue">🎂 2 anos</div><div class="pet-tag tag-amber">⚖️ 4 kg</div><div class="pet-tag tag-pink">🩸 B</div><div class="pet-tag tag-green">⭐ Plano Silver</div><div class="pet-tag tag-cyan">🔖 Microchip</div>',
                tutor: 'Carlos Almeida',
                blood: 'B',
                birth: '07/08/2023',
                chip: '985 141 000 312 447',
                plan: 'VetTech Silver',
                planExp: 'Válido até Jun/2026',
                id: 'VT-2026-00912',
                statVacc: '3/4',
                statConsult: '7',
            },
            bolinha: {
                emoji: '🐇',
                name: 'Bolinha',
                breed: 'Coelho Angorá · Macho',
                tags: '<div class="pet-tag tag-blue">🎂 1 ano</div><div class="pet-tag tag-amber">⚖️ 2.1 kg</div><div class="pet-tag tag-green">🌿 Plano Basic</div>',
                tutor: 'Carlos Almeida',
                blood: '—',
                birth: '20/11/2024',
                chip: '985 141 000 521 883',
                plan: 'VetTech Basic',
                planExp: 'Válido até Mar/2027',
                id: 'VT-2025-01138',
                statVacc: '1/2',
                statConsult: '3',
            },
        };

        function renderVaccs(pet) {
            const list = vaccsData[pet];
            const labels = {
                ok: 'Em dia',
                due: 'Renovar',
                exp: 'Vencida'
            };
            const cls = {
                ok: 'status-ok',
                due: 'status-due',
                exp: 'status-exp'
            };
            document.getElementById('vacc-list').innerHTML = list.map(v => `
    <div class="vacc-item">
      <div class="vacc-dot ${v.status}"></div>
      <div class="vacc-name">${v.name}</div>
      <div class="vacc-date">${v.date}</div>
      <div class="vacc-status ${cls[v.status]}">${labels[v.status]}</div>
    </div>
  `).join('');
        }

        function switchPet(el, pet) {
            document.querySelectorAll('.pet-thumb').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            const d = petData[pet];

            // animate card
            const card = document.getElementById('wallet-card');
            card.style.transition = 'opacity 0.2s, transform 0.2s';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.97)';
            setTimeout(() => {
                document.getElementById('pet-photo').textContent = d.emoji;
                document.getElementById('pet-name').textContent = d.name;
                document.getElementById('pet-breed').textContent = d.breed;
                document.getElementById('pet-tags').innerHTML = d.tags;
                document.getElementById('tutor-name').textContent = d.tutor;
                document.getElementById('blood').textContent = d.blood;
                document.getElementById('pet-birth').textContent = d.birth;
                document.getElementById('chip-id').textContent = d.chip;
                document.getElementById('plan-name').textContent = d.plan;
                document.getElementById('plan-exp').textContent = d.planExp;
                document.getElementById('card-id').textContent = `ID · ${d.id}`;
                document.getElementById('stat-vacc').textContent = d.statVacc;
                document.getElementById('stat-consult').textContent = d.statConsult;
                document.getElementById('stat-plan-exp').textContent = d.planExp;
                drawQR(document.getElementById('qr-canvas'), `VETTECH-${d.name.toUpperCase()}-${d.id}`);
                renderVaccs(pet);
                card.style.opacity = '1';
                card.style.transform = 'scale(1)';
            }, 220);
        }

        renderVaccs('thor');

        // ── ACTIONS ──
        const actionMsgs = {
            download: ['⬇️', 'PDF gerado! Download iniciado...'],
            share: ['🔗', 'Link de compartilhamento copiado!'],
            print: ['🖨️', 'Enviado para impressora...'],
            qr: ['📲', 'QR Code pronto para scan!'],
        };

        function doAction(type) {
            const [icon, msg] = actionMsgs[type];
            const t = document.getElementById('toast');
            document.getElementById('toast-icon').textContent = icon;
            document.getElementById('toast-msg').textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3000);
        }
    </script>
</body>

</html>
