<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetTech — Agendamentos</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #F0F2F8;
            --sidebar: #0D1B2A;
            --sidebar-w: 260px;
            --card: #FFFFFF;
            --accent: #4361EE;
            --accent2: #7B2FBE;
            --accent-soft: #EEF1FD;
            --green: #06D6A0;
            --green-soft: #E6FBF6;
            --amber: #FFB703;
            --amber-soft: #FFF8E1;
            --red: #EF476F;
            --text: #0D1B2A;
            --text-mid: #4A5568;
            --text-soft: #8896A6;
            --border: #E4E8F0;
            --radius: 20px;
            --radius-sm: 12px;
            --shadow: 0 4px 24px rgba(13, 27, 42, 0.07);
            --shadow-lg: 0 12px 48px rgba(13, 27, 42, 0.12);
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
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar);
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 28px 20px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -60px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.25) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            bottom: 40px;
            left: -40px;
            width: 160px;
            height: 160px;
            background: radial-gradient(circle, rgba(123, 47, 190, 0.18) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
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
            box-shadow: 0 4px 16px rgba(67, 97, 238, 0.4);
        }

        .logo-text {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .logo-text span {
            color: var(--accent);
        }

        .nav-section {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: rgba(255, 255, 255, 0.3);
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
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 2px;
            text-decoration: none;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.25), rgba(123, 47, 190, 0.15));
            color: #fff;
            border: 1px solid rgba(67, 97, 238, 0.3);
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
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: #fff;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .nav-group {
            margin-bottom: 24px;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 20px;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            background: rgba(255, 255, 255, 0.06);
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
            color: rgba(255, 255, 255, 0.4);
        }

        .user-more {
            margin-left: auto;
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.8rem;
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* ── HEADER ── */
        .header {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 68px;
            display: flex;
            align-items: center;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 0 var(--border);
        }

        .header-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--text);
            letter-spacing: -0.4px;
        }

        .header-breadcrumb {
            font-size: 0.8rem;
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
            gap: 12px;
        }

        .header-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            color: var(--text-mid);
            transition: all 0.2s;
            position: relative;
        }

        .header-btn:hover {
            background: var(--accent-soft);
            border-color: var(--accent);
            color: var(--accent);
        }

        .header-btn .dot {
            width: 8px;
            height: 8px;
            background: var(--red);
            border-radius: 50%;
            position: absolute;
            top: 6px;
            right: 6px;
            border: 2px solid #fff;
        }

        .new-btn {
            padding: 9px 18px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 16px rgba(67, 97, 238, 0.3);
            transition: all 0.2s;
        }

        .new-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 22px rgba(67, 97, 238, 0.4);
        }

        /* ── CONTENT ── */
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 28px 32px;
            display: flex;
            gap: 24px;
        }

        .content::-webkit-scrollbar {
            width: 6px;
        }

        .content::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px;
        }

        /* ── STEPS ── */
        .steps-panel {
            width: 260px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .steps-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 24px 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .steps-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text);
            margin-bottom: 20px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 6px;
            padding: 10px;
            border-radius: var(--radius-sm);
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 22px;
            top: 46px;
            width: 2px;
            height: 20px;
            background: linear-gradient(180deg, var(--border), transparent);
        }

        .step-item.done::after {
            background: linear-gradient(180deg, var(--green), var(--border));
        }

        .step-item.active {
            background: var(--accent-soft);
        }

        .step-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
            border: 2px solid var(--border);
            color: var(--text-soft);
            background: #fff;
            transition: all 0.3s;
        }

        .step-item.done .step-num {
            background: var(--green);
            border-color: var(--green);
            color: #fff;
        }

        .step-item.active .step-num {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.35);
            animation: pulse-step 2s infinite;
        }

        @keyframes pulse-step {

            0%,
            100% {
                box-shadow: 0 4px 12px rgba(67, 97, 238, 0.35);
            }

            50% {
                box-shadow: 0 4px 20px rgba(67, 97, 238, 0.6);
            }
        }

        .step-info {
            flex: 1;
        }

        .step-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
        }

        .step-item.done .step-label {
            color: var(--green);
        }

        .step-item.active .step-label {
            color: var(--accent);
        }

        .step-desc {
            font-size: 0.75rem;
            color: var(--text-soft);
            margin-top: 2px;
        }

        /* summary card */
        .summary-card {
            background: linear-gradient(135deg, var(--sidebar) 0%, #1a2d45 100%);
            border-radius: var(--radius);
            padding: 22px 20px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.3) 0%, transparent 70%);
            border-radius: 50%;
        }

        .summary-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.82rem;
        }

        .summary-row .label {
            color: rgba(255, 255, 255, 0.5);
        }

        .summary-row .val {
            color: #fff;
            font-weight: 600;
        }

        .summary-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 14px 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-total .label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
        }

        .summary-total .val {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            color: #fff;
        }

        .summary-total .val sup {
            font-size: 0.75rem;
            font-weight: 600;
            vertical-align: super;
        }

        /* ── MAIN PANEL ── */
        .booking-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            overflow: hidden;
            animation: fadeUp 0.4s both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card:nth-child(1) {
            animation-delay: 0.0s;
        }

        .card:nth-child(2) {
            animation-delay: 0.08s;
        }

        .card:nth-child(3) {
            animation-delay: 0.16s;
        }

        .card:nth-child(4) {
            animation-delay: 0.24s;
        }

        .card-header {
            padding: 20px 24px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .card-icon.blue {
            background: var(--accent-soft);
        }

        .card-icon.green {
            background: var(--green-soft);
        }

        .card-icon.amber {
            background: var(--amber-soft);
        }

        .card-icon.purple {
            background: #F3EEFA;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text);
        }

        .card-sub {
            font-size: 0.78rem;
            color: var(--text-soft);
            margin-top: 1px;
        }

        .card-body {
            padding: 20px 24px 24px;
        }

        /* ── CALENDAR ── */
        .calendar-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .cal-month {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text);
        }

        .cal-arrows {
            display: flex;
            gap: 6px;
        }

        .cal-arrow {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.85rem;
            color: var(--text-mid);
            transition: all 0.2s;
        }

        .cal-arrow:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .cal-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            margin-bottom: 8px;
        }

        .cal-weekday {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-soft);
            padding: 4px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 3px;
        }

        .cal-day {
            aspect-ratio: 1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            position: relative;
            color: var(--text-mid);
        }

        .cal-day:hover:not(.empty):not(.disabled) {
            background: var(--accent-soft);
            color: var(--accent);
        }

        .cal-day.disabled {
            color: var(--border);
            cursor: default;
        }

        .cal-day.has-apt::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            background: var(--accent);
            border-radius: 50%;
        }

        .cal-day.selected {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.35);
        }

        .cal-day.selected::after {
            background: rgba(255, 255, 255, 0.7);
        }

        .cal-day.today:not(.selected) {
            border: 2px solid var(--accent);
            color: var(--accent);
            font-weight: 700;
        }

        .cal-day.empty {
            cursor: default;
        }

        /* ── HORÁRIOS ── */
        .time-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .time-slot {
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border);
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .time-slot:hover:not(.busy) {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .time-slot.selected {
            border-color: var(--accent);
            background: var(--accent);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .time-slot.busy {
            background: var(--bg);
            cursor: not-allowed;
        }

        .time-val {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text);
            transition: all 0.2s;
        }

        .time-slot.selected .time-val {
            color: #fff;
        }

        .time-slot.busy .time-val {
            color: var(--text-soft);
        }

        .time-tag {
            font-size: 0.65rem;
            font-weight: 600;
            margin-top: 2px;
            color: var(--text-soft);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.2s;
        }

        .time-slot.selected .time-tag {
            color: rgba(255, 255, 255, 0.7);
        }

        .time-slot.busy .time-tag {
            color: var(--border);
        }

        .time-tag.avail {
            color: var(--green);
        }

        .time-slot.selected .time-tag.avail {
            color: rgba(255, 255, 255, 0.7);
        }

        /* ── VET SELECTION ── */
        .vet-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .vet-card {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px 14px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .vet-card:hover {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .vet-card.selected {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .vet-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            position: relative;
        }

        .vet-avatar .online-dot {
            width: 10px;
            height: 10px;
            background: var(--green);
            border-radius: 50%;
            position: absolute;
            bottom: 1px;
            right: 1px;
            border: 2px solid #fff;
        }

        .vet-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text);
        }

        .vet-specialty {
            font-size: 0.72rem;
            color: var(--text-soft);
            margin-top: 2px;
        }

        .vet-rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
            margin-top: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--amber);
        }

        /* ── PET SELECTION ── */
        .pet-grid {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pet-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border);
            cursor: pointer;
            transition: all 0.2s;
            min-width: 180px;
        }

        .pet-card:hover {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .pet-card.selected {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .pet-emoji {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .pet-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text);
        }

        .pet-detail {
            font-size: 0.75rem;
            color: var(--text-soft);
            margin-top: 2px;
        }

        .pet-check {
            margin-left: auto;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: transparent;
            transition: all 0.2s;
        }

        .pet-card.selected .pet-check {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .add-pet {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            border: 1.5px dashed var(--border);
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-soft);
            font-size: 0.85rem;
            font-weight: 500;
            min-width: 160px;
        }

        .add-pet:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-soft);
        }

        .add-pet-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        /* ── PAYMENT ── */
        .payment-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .pay-method {
            padding: 14px 12px;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border);
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .pay-method:hover {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .pay-method.selected {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .pay-icon {
            font-size: 1.4rem;
            margin-bottom: 6px;
        }

        .pay-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text);
        }

        .pay-desc {
            font-size: 0.7rem;
            color: var(--text-soft);
            margin-top: 2px;
        }

        /* ── CONFIRM BTN ── */
        .confirm-bar {
            background: var(--card);
            border-top: 1px solid var(--border);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: sticky;
            bottom: 0;
        }

        .confirm-info {
            flex: 1;
        }

        .confirm-label {
            font-size: 0.78rem;
            color: var(--text-soft);
        }

        .confirm-val {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text);
        }

        .btn-confirm {
            padding: 14px 36px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 6px 24px rgba(67, 97, 238, 0.4);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn-confirm::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.1));
            opacity: 0;
            transition: opacity 0.2s;
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(67, 97, 238, 0.5);
        }

        .btn-confirm:hover::before {
            opacity: 1;
        }

        .btn-secondary {
            padding: 14px 24px;
            border-radius: var(--radius-sm);
            background: transparent;
            border: 1.5px solid var(--border);
            color: var(--text-mid);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            border-color: var(--text-mid);
            background: var(--bg);
        }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(13, 27, 42, 0.5);
            backdrop-filter: blur(6px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }

        .modal-overlay.show {
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background: var(--card);
            border-radius: 28px;
            padding: 40px;
            max-width: 460px;
            width: 90%;
            box-shadow: var(--shadow-lg);
            text-align: center;
            transform: scale(0.92) translateY(20px);
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-overlay.show .modal {
            transform: scale(1) translateY(0);
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: var(--green-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.4rem;
            animation: pop-in 0.5s 0.2s both cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes pop-in {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 8px;
        }

        .modal-subtitle {
            font-size: 0.9rem;
            color: var(--text-soft);
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .modal-summary {
            background: var(--bg);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            margin-bottom: 24px;
            text-align: left;
        }

        .modal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            padding: 5px 0;
        }

        .modal-row .lbl {
            color: var(--text-soft);
        }

        .modal-row .vl {
            font-weight: 600;
            color: var(--text);
        }

        .modal-confirm-btn {
            width: 100%;
            padding: 15px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, var(--green), #04b888);
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(6, 214, 160, 0.4);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .modal-confirm-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 28px rgba(6, 214, 160, 0.5);
        }

        .modal-cancel {
            margin-top: 12px;
            width: 100%;
            background: none;
            border: none;
            color: var(--text-soft);
            font-size: 0.85rem;
            cursor: pointer;
            padding: 8px;
            transition: color 0.2s;
        }

        .modal-cancel:hover {
            color: var(--text);
        }

        /* ── TOAST ── */
        .toast {
            position: fixed;
            bottom: 32px;
            right: 32px;
            z-index: 300;
            background: var(--sidebar);
            color: #fff;
            padding: 14px 20px;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-lg);
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

        .toast-icon {
            font-size: 1.1rem;
        }

        /* ── misc ── */
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .chip.green {
            background: var(--green-soft);
            color: #028a68;
        }

        .chip.amber {
            background: var(--amber-soft);
            color: #9a6e00;
        }

        .chip.blue {
            background: var(--accent-soft);
            color: var(--accent);
        }

        .section-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--text-soft);
            margin-bottom: 12px;
        }

        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 16px 0;
        }

        /* service type */
        .service-tabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .service-tab {
            padding: 8px 16px;
            border-radius: 20px;
            border: 1.5px solid var(--border);
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-mid);
            background: #fff;
        }

        .service-tab:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .service-tab.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <div class="logo-icon">🐾</div>
            <div class="logo-text">Vet<span>Tech</span></div>
        </div>

        <div class="nav-group">
            <div class="nav-section">Principal</div>
            <div class="nav-item"><span class="nav-icon">⊞</span> Dashboard</div>
            <div class="nav-item active"><span class="nav-icon">📅</span> Agendamentos <span class="nav-badge">3</span>
            </div>
            <div class="nav-item"><span class="nav-icon">🐶</span> Pacientes</div>
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
                <div class="user-more">⋯</div>
            </div>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- HEADER -->
        <header class="header">
            <div>
                <div class="header-breadcrumb">Home › <span>Agendamentos</span></div>
                <div class="header-title">Novo Agendamento</div>
            </div>
            <div class="header-right">
                <button class="header-btn">🔍</button>
                <button class="header-btn">🔔<div class="dot"></div></button>
                <button class="header-btn">⚙️</button>
                <button class="new-btn">+ Agendar</button>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="content">

            <!-- STEPS PANEL -->
            <div class="steps-panel">

                <div class="steps-card">
                    <div class="steps-title">Progresso</div>

                    <div class="step-item done" onclick="setStep(1)">
                        <div class="step-num">✓</div>
                        <div class="step-info">
                            <div class="step-label">Tipo de Serviço</div>
                            <div class="step-desc">Consulta clínica</div>
                        </div>
                    </div>
                    <div class="step-item done" onclick="setStep(2)">
                        <div class="step-num">✓</div>
                        <div class="step-info">
                            <div class="step-label">Escolha o Pet</div>
                            <div class="step-desc">Thor selecionado</div>
                        </div>
                    </div>
                    <div class="step-item active" onclick="setStep(3)">
                        <div class="step-num">3</div>
                        <div class="step-info">
                            <div class="step-label">Data & Horário</div>
                            <div class="step-desc">Escolha quando</div>
                        </div>
                    </div>
                    <div class="step-item" onclick="setStep(4)">
                        <div class="step-num">4</div>
                        <div class="step-info">
                            <div class="step-label">Veterinário</div>
                            <div class="step-desc">Selecione o médico</div>
                        </div>
                    </div>
                    <div class="step-item" onclick="setStep(5)">
                        <div class="step-num">5</div>
                        <div class="step-info">
                            <div class="step-label">Pagamento</div>
                            <div class="step-desc">Forma de pagamento</div>
                        </div>
                    </div>
                    <div class="step-item" onclick="setStep(6)">
                        <div class="step-num">6</div>
                        <div class="step-info">
                            <div class="step-label">Confirmar</div>
                            <div class="step-desc">Revisar e agendar</div>
                        </div>
                    </div>
                </div>

                <!-- SUMMARY -->
                <div class="summary-card">
                    <div class="summary-title">Resumo</div>
                    <div class="summary-row"><span class="label">Serviço</span><span class="val">Consulta</span>
                    </div>
                    <div class="summary-row"><span class="label">Pet</span><span class="val">Thor 🐶</span></div>
                    <div class="summary-row"><span class="label">Data</span><span class="val"
                            id="sel-date">—</span></div>
                    <div class="summary-row"><span class="label">Horário</span><span class="val"
                            id="sel-time">—</span></div>
                    <div class="summary-row"><span class="label">Médico</span><span class="val"
                            id="sel-vet">—</span></div>
                    <hr class="summary-divider">
                    <div class="summary-total">
                        <span class="label">Total</span>
                        <span class="val"><sup>R$</sup><span id="sel-price">150</span></span>
                    </div>
                </div>

            </div>

            <!-- BOOKING PANEL -->
            <div class="booking-panel">

                <!-- Tipo de serviço -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon blue">🩺</div>
                        <div>
                            <div class="card-title">Tipo de Serviço</div>
                            <div class="card-sub">Selecione o tipo de atendimento</div>
                        </div>
                        <div style="margin-left:auto"><span class="chip green">✓ Selecionado</span></div>
                    </div>
                    <div class="card-body">
                        <div class="service-tabs">
                            <div class="service-tab active" onclick="selectService(this,'150')">🩺 Consulta Clínica
                            </div>
                            <div class="service-tab" onclick="selectService(this,'280')">💉 Vacinação</div>
                            <div class="service-tab" onclick="selectService(this,'450')">🔬 Exame Laboratorial</div>
                            <div class="service-tab" onclick="selectService(this,'800')">🏥 Cirurgia</div>
                            <div class="service-tab" onclick="selectService(this,'120')">✂️ Banho & Tosa</div>
                            <div class="service-tab" onclick="selectService(this,'200')">🦷 Odontologia</div>
                        </div>
                    </div>
                </div>

                <!-- Pet -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon amber">🐾</div>
                        <div>
                            <div class="card-title">Escolha o Pet</div>
                            <div class="card-sub">Selecione qual animal será atendido</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pet-grid">
                            <div class="pet-card selected" onclick="selectPet(this)">
                                <div class="pet-emoji" style="background:#FFF3E0">🐶</div>
                                <div>
                                    <div class="pet-name">Thor</div>
                                    <div class="pet-detail">Golden · 3 anos</div>
                                </div>
                                <div class="pet-check">✓</div>
                            </div>
                            <div class="pet-card" onclick="selectPet(this)">
                                <div class="pet-emoji" style="background:#E8F5E9">🐱</div>
                                <div>
                                    <div class="pet-name">Luna</div>
                                    <div class="pet-detail">Siamês · 2 anos</div>
                                </div>
                                <div class="pet-check">✓</div>
                            </div>
                            <div class="pet-card" onclick="selectPet(this)">
                                <div class="pet-emoji" style="background:#EDE7F6">🐇</div>
                                <div>
                                    <div class="pet-name">Bolinha</div>
                                    <div class="pet-detail">Coelho · 1 ano</div>
                                </div>
                                <div class="pet-check">✓</div>
                            </div>
                            <div class="add-pet">
                                <div class="add-pet-icon">➕</div>
                                <span>Adicionar pet</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendário + Horários lado a lado -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

                    <!-- Calendário -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon blue">📅</div>
                            <div>
                                <div class="card-title">Calendário</div>
                                <div class="card-sub">Escolha a data</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="calendar-nav">
                                <div class="cal-month" id="cal-month-label">Maio 2026</div>
                                <div class="cal-arrows">
                                    <button class="cal-arrow" onclick="changeMonth(-1)">‹</button>
                                    <button class="cal-arrow" onclick="changeMonth(1)">›</button>
                                </div>
                            </div>
                            <div class="cal-weekdays">
                                <div class="cal-weekday">Dom</div>
                                <div class="cal-weekday">Seg</div>
                                <div class="cal-weekday">Ter</div>
                                <div class="cal-weekday">Qua</div>
                                <div class="cal-weekday">Qui</div>
                                <div class="cal-weekday">Sex</div>
                                <div class="cal-weekday">Sáb</div>
                            </div>
                            <div class="cal-grid" id="cal-grid"></div>
                        </div>
                    </div>

                    <!-- Horários -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon green">⏰</div>
                            <div>
                                <div class="card-title">Horários</div>
                                <div class="card-sub" id="time-sub">Selecione uma data primeiro</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="section-label" style="margin-bottom:14px">Manhã</div>
                            <div class="time-grid">
                                <div class="time-slot busy">
                                    <div class="time-val">08:00</div>
                                    <div class="time-tag">Ocupado</div>
                                </div>
                                <div class="time-slot" onclick="selectTime(this,'09:00')">
                                    <div class="time-val">09:00</div>
                                    <div class="time-tag avail">Disponível</div>
                                </div>
                                <div class="time-slot" onclick="selectTime(this,'09:30')">
                                    <div class="time-val">09:30</div>
                                    <div class="time-tag avail">Disponível</div>
                                </div>
                                <div class="time-slot busy">
                                    <div class="time-val">10:00</div>
                                    <div class="time-tag">Ocupado</div>
                                </div>
                                <div class="time-slot" onclick="selectTime(this,'10:30')">
                                    <div class="time-val">10:30</div>
                                    <div class="time-tag avail">Disponível</div>
                                </div>
                                <div class="time-slot" onclick="selectTime(this,'11:00')">
                                    <div class="time-val">11:00</div>
                                    <div class="time-tag avail">Disponível</div>
                                </div>
                                <div class="time-slot busy">
                                    <div class="time-val">11:30</div>
                                    <div class="time-tag">Ocupado</div>
                                </div>
                                <div class="time-slot" onclick="selectTime(this,'12:00')">
                                    <div class="time-val">12:00</div>
                                    <div class="time-tag avail">Disponível</div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="section-label" style="margin-bottom:14px">Tarde</div>
                            <div class="time-grid">
                                <div class="time-slot busy">
                                    <div class="time-val">14:00</div>
                                    <div class="time-tag">Ocupado</div>
                                </div>
                                <div class="time-slot" onclick="selectTime(this,'14:30')">
                                    <div class="time-val">14:30</div>
                                    <div class="time-tag avail">Disponível</div>
                                </div>
                                <div class="time-slot" onclick="selectTime(this,'15:00')">
                                    <div class="time-val">15:00</div>
                                    <div class="time-tag avail">Disponível</div>
                                </div>
                                <div class="time-slot" onclick="selectTime(this,'15:30')">
                                    <div class="time-val">15:30</div>
                                    <div class="time-tag avail">Disponível</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Veterinário -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon purple">👩‍⚕️</div>
                        <div>
                            <div class="card-title">Escolha o Veterinário</div>
                            <div class="card-sub">Selecione o profissional</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="vet-grid">
                            <div class="vet-card" onclick="selectVet(this,'Dra. Ana Costa')">
                                <div class="vet-avatar" style="background:linear-gradient(135deg,#FF6B9D,#C44D8A)">
                                    AC<div class="online-dot"></div>
                                </div>
                                <div class="vet-name">Dra. Ana Costa</div>
                                <div class="vet-specialty">Clínica Geral</div>
                                <div class="vet-rating">★ 4.9 <span
                                        style="color:var(--text-soft);font-weight:400">(128)</span></div>
                            </div>
                            <div class="vet-card selected" onclick="selectVet(this,'Dr. Pedro Lima')">
                                <div class="vet-avatar" style="background:linear-gradient(135deg,#4361EE,#7B2FBE)">
                                    PL<div class="online-dot"></div>
                                </div>
                                <div class="vet-name">Dr. Pedro Lima</div>
                                <div class="vet-specialty">Dermatologia</div>
                                <div class="vet-rating">★ 4.8 <span
                                        style="color:var(--text-soft);font-weight:400">(97)</span></div>
                            </div>
                            <div class="vet-card" onclick="selectVet(this,'Dra. Sofia Ramos')">
                                <div class="vet-avatar" style="background:linear-gradient(135deg,#06D6A0,#047857)">
                                    SR<div class="online-dot"></div>
                                </div>
                                <div class="vet-name">Dra. Sofia Ramos</div>
                                <div class="vet-specialty">Ortopedia</div>
                                <div class="vet-rating">★ 5.0 <span
                                        style="color:var(--text-soft);font-weight:400">(214)</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagamento -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon green">💳</div>
                        <div>
                            <div class="card-title">Forma de Pagamento</div>
                            <div class="card-sub">Como prefere pagar?</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="payment-grid">
                            <div class="pay-method selected" onclick="selectPay(this)">
                                <div class="pay-icon">💳</div>
                                <div class="pay-name">Crédito</div>
                                <div class="pay-desc">Até 12x sem juros</div>
                            </div>
                            <div class="pay-method" onclick="selectPay(this)">
                                <div class="pay-icon">🏧</div>
                                <div class="pay-name">Débito</div>
                                <div class="pay-desc">À vista</div>
                            </div>
                            <div class="pay-method" onclick="selectPay(this)">
                                <div class="pay-icon">⚡</div>
                                <div class="pay-name">Pix</div>
                                <div class="pay-desc">Aprovação imediata</div>
                            </div>
                            <div class="pay-method" onclick="selectPay(this)">
                                <div class="pay-icon">🏦</div>
                                <div class="pay-name">Boleto</div>
                                <div class="pay-desc">Venc. em 3 dias</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /booking-panel -->
        </div><!-- /content -->

        <!-- CONFIRM BAR -->
        <div class="confirm-bar">
            <div class="confirm-info">
                <div class="confirm-label">Total da consulta</div>
                <div class="confirm-val">R$ <span id="bar-price">150,00</span></div>
            </div>
            <button class="btn-secondary">Cancelar</button>
            <button class="btn-confirm" onclick="openModal()">
                Confirmar Agendamento →
            </button>
        </div>

    </div><!-- /main -->

    <!-- MODAL CONFIRMAÇÃO -->
    <div class="modal-overlay" id="modal">
        <div class="modal">
            <div class="modal-icon">🎉</div>
            <div class="modal-title">Confirmar Consulta</div>
            <div class="modal-subtitle">Revise os dados antes de confirmar o agendamento do seu pet.</div>
            <div class="modal-summary">
                <div class="modal-row"><span class="lbl">🐶 Pet</span><span class="vl">Thor · Golden · 3
                        anos</span></div>
                <div class="modal-row"><span class="lbl">🩺 Serviço</span><span class="vl">Consulta
                        Clínica</span></div>
                <div class="modal-row"><span class="lbl">📅 Data</span><span class="vl" id="m-date">19 de
                        Maio, 2026</span></div>
                <div class="modal-row"><span class="lbl">⏰ Horário</span><span class="vl"
                        id="m-time">09:00</span></div>
                <div class="modal-row"><span class="lbl">👩‍⚕️ Médico</span><span class="vl"
                        id="m-vet">Dr. Pedro Lima</span></div>
                <div class="modal-row"><span class="lbl">💳 Pagamento</span><span class="vl">Crédito ·
                        12x</span></div>
                <div style="border-top:1px solid var(--border);margin-top:10px;padding-top:10px">
                    <div class="modal-row">
                        <span class="lbl" style="font-weight:700;color:var(--text)">Total</span>
                        <span class="vl" style="font-size:1.1rem;color:var(--accent)">R$ <span
                                id="m-price">150,00</span></span>
                    </div>
                </div>
            </div>
            <button class="modal-confirm-btn" onclick="confirmBooking()">✓ Confirmar Agendamento</button>
            <button class="modal-cancel" onclick="closeModal()">Voltar e editar</button>
        </div>
    </div>

    <!-- TOAST -->
    <div class="toast" id="toast">
        <span class="toast-icon">🐾</span>
        <span id="toast-msg">Agendamento confirmado com sucesso!</span>
    </div>

    <script>
        // ── CALENDAR ──
        let currentDate = new Date(2026, 4, 1); // May 2026
        let selectedDay = null;
        const monthNames = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];
        const aptDays = [5, 12, 19, 23, 27];

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            document.getElementById('cal-month-label').textContent = `${monthNames[month]} ${year}`;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();
            const isCurrentMonth = year === today.getFullYear() && month === today.getMonth();

            let html = '';
            for (let i = 0; i < firstDay; i++) html += '<div class="cal-day empty"></div>';

            for (let d = 1; d <= daysInMonth; d++) {
                const isPast = new Date(year, month, d) < new Date(today.getFullYear(), today.getMonth(), today.getDate());
                const isToday = isCurrentMonth && d === today.getDate();
                const isSel = d === selectedDay;
                const hasApt = aptDays.includes(d);
                const cls = [
                    'cal-day',
                    isPast ? 'disabled' : '',
                    isToday ? 'today' : '',
                    isSel ? 'selected' : '',
                    hasApt && !isSel ? 'has-apt' : '',
                ].join(' ');
                html += `<div class="${cls}" ${!isPast ? `onclick="selectDay(${d})"` : ''}>${d}</div>`;
            }
            document.getElementById('cal-grid').innerHTML = html;
        }

        function changeMonth(dir) {
            currentDate.setMonth(currentDate.getMonth() + dir);
            renderCalendar();
        }

        function selectDay(d) {
            selectedDay = d;
            renderCalendar();
            const month = currentDate.getMonth();
            const year = currentDate.getFullYear();
            const label = `${d} de ${monthNames[month].slice(0,3)}, ${year}`;
            document.getElementById('sel-date').textContent = label;
            document.getElementById('m-date').textContent = `${d} de ${monthNames[month]}, ${year}`;
            document.getElementById('time-sub').textContent = `${d} de ${monthNames[month]}`;
        }

        renderCalendar();

        // ── TIME ──
        function selectTime(el, t) {
            document.querySelectorAll('.time-slot:not(.busy)').forEach(s => s.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('sel-time').textContent = t;
            document.getElementById('m-time').textContent = t;
        }

        // ── VET ──
        function selectVet(el, name) {
            document.querySelectorAll('.vet-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('sel-vet').textContent = name;
            document.getElementById('m-vet').textContent = name;
        }

        // ── PET ──
        function selectPet(el) {
            document.querySelectorAll('.pet-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
        }

        // ── SERVICE ──
        let currentPrice = 150;

        function selectService(el, price) {
            document.querySelectorAll('.service-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            currentPrice = parseInt(price);
            const fmt = currentPrice.toFixed(2).replace('.', ',');
            document.getElementById('sel-price').textContent = currentPrice;
            document.getElementById('bar-price').textContent = fmt;
            document.getElementById('m-price').textContent = fmt;
        }

        // ── PAYMENT ──
        function selectPay(el) {
            document.querySelectorAll('.pay-method').forEach(p => p.classList.remove('selected'));
            el.classList.add('selected');
        }

        // ── MODAL ──
        function openModal() {
            document.getElementById('modal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('modal').classList.remove('show');
        }

        function confirmBooking() {
            closeModal();
            showToast('🐾 Agendamento confirmado com sucesso!');
        }

        // ── TOAST ──
        function showToast(msg) {
            const t = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3500);
        }

        // ── STEPS ──
        function setStep(n) {}

        // init
        document.getElementById('sel-vet').textContent = 'Dr. Pedro Lima';
        document.getElementById('m-vet').textContent = 'Dr. Pedro Lima';
    </script>
</body>

</html>
