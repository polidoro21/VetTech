<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VetTech — Consultas</title>

    <!-- Fonts: DM Serif Display + DM Sans (coerente com Meus Pets) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet" />

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/index.js" defer></script>

    <style>
        /* ============================================================
       DESIGN TOKENS
       ============================================================ */
        :root {
            --bg: #f5f6fa;
            --surface: #ffffff;
            --surface-alt: #f0f2f8;
            --surface-raised: #ffffff;
            --sidebar-bg: #0d0f1a;
            --sidebar-text: #8a90a8;
            --sidebar-hover: #1a1e30;
            --sidebar-active: #1e2438;
            --accent: #3b6ef8;
            --accent-dim: #2d5ee8;
            --accent-glow: rgba(59, 110, 248, 0.20);
            --accent-light: #eef2ff;
            --green: #16a34a;
            --green-bg: #dcfce7;
            --amber: #d97706;
            --amber-bg: #fef3c7;
            --red: #dc2626;
            --red-bg: #fee2e2;
            --text-primary: #0d0f1a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --border-focus: rgba(59, 110, 248, 0.5);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 26px;
            --shadow-xs: 0 1px 4px rgba(0, 0, 0, 0.05);
            --shadow-card: 0 2px 12px rgba(0, 0, 0, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
            --shadow-hover: 0 10px 36px rgba(59, 110, 248, 0.13), 0 4px 14px rgba(0, 0, 0, 0.07);
            --shadow-modal: 0 24px 80px rgba(0, 0, 0, 0.18);
            --t: 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ============================================================
       RESET
       ============================================================ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 15px;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        /* ============================================================
       SIDEBAR
       ============================================================ */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 28px 24px 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .logo-mark {
            width: 34px;
            height: 34px;
            background: var(--accent);
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 17px;
            box-shadow: 0 0 16px rgba(59, 110, 248, 0.45);
            flex-shrink: 0;
        }

        .logo-text {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            color: #fff;
            letter-spacing: -0.02em;
        }

        .logo-badge {
            margin-left: auto;
            font-size: 0.6rem;
            font-weight: 700;
            background: rgba(59, 110, 248, 0.22);
            color: #8ab4ff;
            padding: 2px 7px;
            border-radius: 99px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .nav-section {
            padding: 20px 0 4px;
        }

        .nav-label {
            font-size: 0.63rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.2);
            padding: 0 24px 8px;
            display: block;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 16px;
            margin: 1px 12px;
            border-radius: var(--radius-sm);
            color: var(--sidebar-text);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background var(--t), color var(--t);
            text-decoration: none;
            position: relative;
        }

        .nav-link i {
            font-size: 17px;
            flex-shrink: 0;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: #c8cedf;
        }

        .nav-link.active {
            background: var(--sidebar-active);
            color: #fff;
            box-shadow: inset 3px 0 0 var(--accent);
        }

        .nav-link .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: #fff;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 99px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background var(--t);
        }

        .sidebar-user:hover {
            background: var(--sidebar-hover);
        }

        .sidebar-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            flex-shrink: 0;
            background: linear-gradient(135deg, #3b6ef8, #7c3aed);
            display: grid;
            place-items: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
        }

        .sidebar-user-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: #d0d5e8;
        }

        .sidebar-user-role {
            font-size: 0.68rem;
            color: var(--sidebar-text);
        }

        /* ============================================================
       MAIN
       ============================================================ */
        .main {
            margin-left: 240px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ============================================================
       TOPBAR
       ============================================================ */
        .topbar {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 20px 32px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.45rem;
            letter-spacing: -0.02em;
            white-space: nowrap;
        }

        .search-wrap {
            flex: 1;
            max-width: 340px;
            position: relative;
        }

        .search-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 15px;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 9px 14px 9px 36px;
            border: 1.5px solid var(--border);
            border-radius: 99px;
            background: var(--surface-alt);
            font-size: 0.84rem;
            color: var(--text-primary);
            outline: none;
            transition: border-color var(--t), box-shadow var(--t), background var(--t);
        }

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .search-input:focus {
            border-color: var(--accent);
            background: var(--surface);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
        }

        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: var(--surface);
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 17px;
            transition: background var(--t), color var(--t), border-color var(--t);
            position: relative;
        }

        .icon-btn:hover {
            background: var(--accent-light);
            color: var(--accent);
            border-color: transparent;
        }

        .icon-btn .dot {
            width: 7px;
            height: 7px;
            background: var(--red);
            border-radius: 50%;
            border: 2px solid #fff;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .user-avatar-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b6ef8, #7c3aed);
            display: grid;
            place-items: center;
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: box-shadow var(--t), border-color var(--t);
        }

        .user-avatar-btn:hover {
            box-shadow: 0 0 0 3px var(--accent-glow);
            border-color: var(--accent);
        }

        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 20px;
            border: none;
            border-radius: 99px;
            background: var(--accent);
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background var(--t), box-shadow var(--t), transform var(--t);
            white-space: nowrap;
        }

        .btn-new:hover {
            background: var(--accent-dim);
            box-shadow: 0 4px 20px rgba(59, 110, 248, 0.4);
            transform: translateY(-1px);
        }

        .btn-new i {
            font-size: 17px;
        }

        /* ============================================================
       CONTENT LAYOUT
       ============================================================ */
        .content {
            flex: 1;
            padding: 28px 32px;
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }

        /* LEFT COLUMN — Calendar + mini stats */
        .left-col {
            width: 290px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        /* RIGHT COLUMN — Timeline list */
        .right-col {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ============================================================
       CALENDAR WIDGET
       ============================================================ */
        .calendar-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .cal-header {
            padding: 18px 20px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        .cal-month {
            font-family: 'DM Serif Display', serif;
            font-size: 1.05rem;
            letter-spacing: -0.01em;
        }

        .cal-nav {
            display: flex;
            gap: 4px;
        }

        .cal-nav-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: none;
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 15px;
            transition: background var(--t), color var(--t), border-color var(--t);
        }

        .cal-nav-btn:hover {
            background: var(--accent-light);
            color: var(--accent);
            border-color: transparent;
        }

        .cal-body {
            padding: 16px 18px 18px;
        }

        .cal-days-header {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            margin-bottom: 8px;
        }

        .cal-days-header span {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 4px 0;
        }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 3px;
        }

        .cal-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 500;
            border-radius: 50%;
            cursor: pointer;
            transition: background var(--t), color var(--t), box-shadow var(--t);
            color: var(--text-primary);
            position: relative;
        }

        .cal-day:hover {
            background: var(--surface-alt);
        }

        .cal-day.other-month {
            color: var(--text-muted);
        }

        .cal-day.today {
            background: var(--accent);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 2px 10px rgba(59, 110, 248, 0.38);
        }

        .cal-day.selected {
            background: var(--accent-light);
            color: var(--accent);
            font-weight: 700;
            box-shadow: 0 0 0 2px var(--accent);
        }

        .cal-day.has-appt::after {
            content: '';
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--green);
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
        }

        .cal-day.today.has-appt::after {
            background: rgba(255, 255, 255, 0.8);
        }

        /* ============================================================
       MINI STATS (below calendar)
       ============================================================ */
        .mini-stats {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .mini-stat {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow-xs);
            transition: box-shadow var(--t), transform var(--t);
        }

        .mini-stat:hover {
            box-shadow: var(--shadow-card);
            transform: translateY(-1px);
        }

        .mini-stat-icon {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            display: grid;
            place-items: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .mini-stat-icon.blue {
            background: var(--accent-light);
            color: var(--accent);
        }

        .mini-stat-icon.green {
            background: var(--green-bg);
            color: var(--green);
        }

        .mini-stat-icon.amber {
            background: var(--amber-bg);
            color: var(--amber);
        }

        .mini-stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            line-height: 1;
        }

        .mini-stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ============================================================
       UPCOMING PETS LIST (sidebar widget)
       ============================================================ */
        .upcoming-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .upcoming-header {
            padding: 16px 18px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        .upcoming-title {
            font-size: 0.85rem;
            font-weight: 700;
        }

        .upcoming-link {
            font-size: 0.72rem;
            color: var(--accent);
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .upcoming-link:hover {
            text-decoration: underline;
        }

        .upcoming-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            border-bottom: 1px solid var(--border);
            transition: background var(--t);
            cursor: pointer;
        }

        .upcoming-item:last-child {
            border-bottom: none;
        }

        .upcoming-item:hover {
            background: var(--surface-alt);
        }

        .upcoming-pet-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .upcoming-pet-name {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .upcoming-pet-time {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .upcoming-status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-left: auto;
            flex-shrink: 0;
        }

        /* ============================================================
       RIGHT COL — HEADER ROW
       ============================================================ */
        .list-header {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .list-heading {
            font-family: 'DM Serif Display', serif;
            font-size: 1.05rem;
            letter-spacing: -0.01em;
        }

        .list-date-badge {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--accent);
            background: var(--accent-light);
            padding: 3px 10px;
            border-radius: 99px;
        }

        .filter-chips {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
            margin-left: auto;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 13px;
            border-radius: 99px;
            border: 1.5px solid var(--border);
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: var(--surface);
            cursor: pointer;
            transition: background var(--t), color var(--t), border-color var(--t), box-shadow var(--t);
        }

        .chip i {
            font-size: 13px;
        }

        .chip:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .chip.active {
            background: var(--accent-light);
            border-color: var(--accent);
            color: var(--accent);
        }

        .chip.green.active {
            background: var(--green-bg);
            border-color: var(--green);
            color: var(--green);
        }

        .chip.amber.active {
            background: var(--amber-bg);
            border-color: var(--amber);
            color: var(--amber);
        }

        .chip.red.active {
            background: var(--red-bg);
            border-color: var(--red);
            color: var(--red);
        }

        /* ============================================================
       TIMELINE
       ============================================================ */
        .timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        /* Time group label */
        .timeline-group {
            margin-bottom: 6px;
        }

        .timeline-time-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .timeline-time-label span {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            white-space: nowrap;
        }

        .timeline-time-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* Appointment card */
        .appt-card {
            display: flex;
            gap: 0;
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            margin-bottom: 12px;
            cursor: pointer;
            transition: transform var(--t), box-shadow var(--t), border-color var(--t);
            animation: fadeUp 0.35s ease both;
        }

        .appt-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(59, 110, 248, 0.3);
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

        /* Colored left accent strip */
        .appt-strip {
            width: 5px;
            flex-shrink: 0;
        }

        .appt-strip.confirmed {
            background: var(--green);
        }

        .appt-strip.pending {
            background: var(--amber);
        }

        .appt-strip.cancelled {
            background: #cbd5e1;
        }

        /* Card content */
        .appt-inner {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
        }

        /* Time block */
        .appt-time {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 54px;
            flex-shrink: 0;
        }

        .appt-hour {
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1;
            color: var(--text-primary);
        }

        .appt-period {
            font-size: 0.68rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 2px;
        }

        .appt-duration {
            font-size: 0.65rem;
            color: var(--text-muted);
            background: var(--surface-alt);
            border: 1px solid var(--border);
            border-radius: 99px;
            padding: 1px 7px;
            margin-top: 6px;
        }

        /* Divider */
        .appt-divider {
            width: 1px;
            height: 50px;
            background: var(--border);
            flex-shrink: 0;
        }

        /* Vet photo */
        .appt-vet-photo {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            border: 2px solid var(--border);
        }

        /* Info */
        .appt-info {
            flex: 1;
            min-width: 0;
        }

        .appt-pet-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .appt-vet-name {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .appt-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .appt-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 9px;
            border-radius: 99px;
            background: var(--surface-alt);
            border: 1px solid var(--border);
            color: var(--text-secondary);
        }

        .appt-tag i {
            font-size: 11px;
        }

        .appt-tag.specialty {
            background: var(--accent-light);
            color: var(--accent);
            border-color: transparent;
        }

        /* Status badge */
        .appt-status {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 99px;
            letter-spacing: 0.02em;
        }

        .status-badge .sdot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
        }

        .status-badge.confirmed {
            background: var(--green-bg);
            color: var(--green);
        }

        .status-badge.confirmed .sdot {
            background: var(--green);
        }

        .status-badge.pending {
            background: var(--amber-bg);
            color: var(--amber);
        }

        .status-badge.pending .sdot {
            background: var(--amber);
        }

        .status-badge.cancelled {
            background: #f1f5f9;
            color: #94a3b8;
        }

        .status-badge.cancelled .sdot {
            background: #94a3b8;
        }

        .appt-action-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: none;
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 15px;
            transition: background var(--t), color var(--t), border-color var(--t);
        }

        .appt-action-btn:hover {
            background: var(--accent-light);
            color: var(--accent);
            border-color: transparent;
        }

        /* Empty state */
        .empty-timeline {
            text-align: center;
            padding: 48px 24px;
            color: var(--text-muted);
        }

        .empty-timeline i {
            font-size: 48px;
            opacity: 0.28;
            display: block;
            margin-bottom: 12px;
        }

        .empty-timeline p {
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* ============================================================
       MODAL — Nova Consulta
       ============================================================ */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            backdrop-filter: blur(6px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.24s ease;
        }

        .overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background: var(--surface);
            border-radius: var(--radius-xl);
            width: 100%;
            max-width: 500px;
            box-shadow: var(--shadow-modal);
            transform: translateY(18px) scale(0.97);
            opacity: 0;
            transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.24s ease;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .overlay.open .modal {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .modal-header {
            padding: 22px 26px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.2rem;
            letter-spacing: -0.02em;
        }

        .modal-sub {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: none;
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 17px;
            transition: background var(--t), color var(--t), border-color var(--t);
        }

        .modal-close:hover {
            background: var(--red-bg);
            color: var(--red);
            border-color: transparent;
        }

        .modal-body {
            padding: 22px 26px;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group.full {
            grid-column: 1/-1;
        }

        .form-label {
            font-size: 0.74rem;
            font-weight: 700;
            color: var(--text-secondary);
            letter-spacing: 0.01em;
        }

        .form-input {
            padding: 9px 12px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            transition: border-color var(--t), box-shadow var(--t);
            appearance: none;
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .form-textarea {
            min-height: 76px;
            resize: vertical;
        }

        .modal-footer {
            padding: 16px 26px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            padding: 9px 20px;
            border-radius: 99px;
            border: 1.5px solid var(--border);
            background: none;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: background var(--t), color var(--t), border-color var(--t);
        }

        .btn-cancel:hover {
            background: var(--surface-alt);
            color: var(--text-primary);
            border-color: #c5cbdb;
        }

        .btn-save {
            padding: 9px 24px;
            border-radius: 99px;
            border: none;
            background: var(--accent);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: background var(--t), box-shadow var(--t), transform var(--t);
        }

        .btn-save:hover {
            background: var(--accent-dim);
            box-shadow: 0 4px 16px rgba(59, 110, 248, 0.4);
            transform: translateY(-1px);
        }

        .btn-save i {
            font-size: 15px;
        }

        /* ============================================================
       CARD ANIMATION DELAYS
       ============================================================ */
        .appt-card:nth-child(1) {
            animation-delay: 0.04s;
        }

        .appt-card:nth-child(2) {
            animation-delay: 0.10s;
        }

        .appt-card:nth-child(3) {
            animation-delay: 0.16s;
        }

        .appt-card:nth-child(4) {
            animation-delay: 0.22s;
        }

        .appt-card:nth-child(5) {
            animation-delay: 0.28s;
        }

        .appt-card:nth-child(6) {
            animation-delay: 0.34s;
        }

        .appt-card:nth-child(7) {
            animation-delay: 0.40s;
        }

        /* ============================================================
       RESPONSIVE
       ============================================================ */
        @media (max-width: 1100px) {
            .left-col {
                width: 250px;
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 60px;
            }

            .logo-text,
            .nav-label,
            .nav-link span,
            .sidebar-user-name,
            .sidebar-user-role,
            .logo-badge {
                display: none;
            }

            .nav-link {
                justify-content: center;
                margin: 2px 6px;
            }

            .sidebar-logo {
                padding: 18px 12px;
                justify-content: center;
            }

            .main {
                margin-left: 60px;
            }

            .sidebar-user {
                justify-content: center;
            }

            .content {
                flex-direction: column;
            }

            .left-col {
                width: 100%;
                flex-direction: row;
                flex-wrap: wrap;
            }

            .calendar-card {
                flex: 1;
                min-width: 260px;
            }

            .mini-stats {
                flex-direction: row;
                flex: 1;
            }
        }

        @media (max-width: 640px) {
            .content {
                padding: 16px;
            }

            .topbar {
                padding: 14px 16px;
                gap: 10px;
            }

            .topbar-title {
                font-size: 1.1rem;
            }

            .appt-inner {
                gap: 10px;
                padding: 12px 14px;
            }

            .appt-divider {
                display: none;
            }

            .appt-time {
                display: none;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- ============================================================
       SIDEBAR
       ============================================================ -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-mark">🐾</div>
            <span class="logo-text">VetTech</span>
            <span class="logo-badge">Pro</span>
        </div>

        <div class="nav-section">
            <span class="nav-label">Principal</span>
            <a class="nav-link" href="#">
                <i class="ph ph-house"></i><span>Dashboard</span>
            </a>
            <a class="nav-link" href="#">
                <i class="ph ph-paw-print"></i><span>Meus Pets</span>
            </a>
            <a class="nav-link active" href="#">
                <i class="ph ph-calendar-check"></i><span>Consultas</span>
                <span class="nav-badge">3</span>
            </a>
            <a class="nav-link" href="#">
                <i class="ph ph-stethoscope"></i><span>Histórico Médico</span>
            </a>
            <a class="nav-link" href="#">
                <i class="ph ph-pill"></i><span>Medicamentos</span>
            </a>
            <a class="nav-link" href="#">
                <i class="ph ph-syringe"></i><span>Vacinação</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-label">Gerenciar</span>
            <a class="nav-link" href="#">
                <i class="ph ph-chart-line"></i><span>Relatórios</span>
            </a>
            <a class="nav-link" href="#">
                <i class="ph ph-bell"></i><span>Notificações</span>
                <span class="nav-badge">5</span>
            </a>
            <a class="nav-link" href="#">
                <i class="ph ph-gear"></i><span>Configurações</span>
            </a>
        </div>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">JS</div>
                <div>
                    <div class="sidebar-user-name">João Silva</div>
                    <div class="sidebar-user-role">Tutor Verificado</div>
                </div>
                <i class="ph ph-caret-up-down" style="color:#8a90a8;font-size:13px;margin-left:auto;"></i>
            </div>
        </div>
    </aside>

    <!-- ============================================================
       MAIN
       ============================================================ -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <h1 class="topbar-title">Consultas</h1>
            <div class="search-wrap">
                <i class="ph ph-magnifying-glass"></i>
                <input class="search-input" type="text" placeholder="Buscar por pet, veterinário, especialidade…"
                    id="searchInput" />
            </div>
            <div class="topbar-right">
                <button class="icon-btn" title="Notificações">
                    <i class="ph ph-bell"></i><span class="dot"></span>
                </button>
                <button class="icon-btn" title="Exportar">
                    <i class="ph ph-export"></i>
                </button>
                <div class="user-avatar-btn">JS</div>
                <button class="btn-new" id="openModalBtn">
                    <i class="ph ph-plus"></i> Nova Consulta
                </button>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="content">

            <!-- ========================= LEFT COLUMN ========================= -->
            <div class="left-col">

                <!-- Calendar -->
                <div class="calendar-card">
                    <div class="cal-header">
                        <span class="cal-month" id="calMonthLabel">Maio 2025</span>
                        <div class="cal-nav">
                            <button class="cal-nav-btn" id="calPrev"><i class="ph ph-caret-left"></i></button>
                            <button class="cal-nav-btn" id="calNext"><i class="ph ph-caret-right"></i></button>
                        </div>
                    </div>
                    <div class="cal-body">
                        <div class="cal-days-header">
                            <span>Dom</span><span>Seg</span><span>Ter</span>
                            <span>Qua</span><span>Qui</span><span>Sex</span><span>Sáb</span>
                        </div>
                        <div class="cal-grid" id="calGrid"></div>
                    </div>
                </div>

                <!-- Mini Stats -->
                <div class="mini-stats">
                    <div class="mini-stat">
                        <div class="mini-stat-icon blue"><i class="ph ph-calendar-check"></i></div>
                        <div>
                            <div class="mini-stat-value" id="statTotal">7</div>
                            <div class="mini-stat-label">Este mês</div>
                        </div>
                    </div>
                    <div class="mini-stat">
                        <div class="mini-stat-icon green"><i class="ph ph-check-circle"></i></div>
                        <div>
                            <div class="mini-stat-value" id="statConfirmed">4</div>
                            <div class="mini-stat-label">Confirmadas</div>
                        </div>
                    </div>
                    <div class="mini-stat">
                        <div class="mini-stat-icon amber"><i class="ph ph-clock"></i></div>
                        <div>
                            <div class="mini-stat-value" id="statPending">2</div>
                            <div class="mini-stat-label">Pendentes</div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming (quick list) -->
                <div class="upcoming-card">
                    <div class="upcoming-header">
                        <span class="upcoming-title">Próximas 48h</span>
                        <a class="upcoming-link" href="#">Ver todas</a>
                    </div>
                    <div id="upcomingList"></div>
                </div>

            </div>

            <!-- ========================= RIGHT COLUMN ========================= -->
            <div class="right-col">

                <!-- List header + filters -->
                <div class="list-header">
                    <span class="list-heading">Agenda do Dia</span>
                    <span class="list-date-badge" id="todayBadge">18 de maio, 2025</span>
                    <div class="filter-chips">
                        <button class="chip active" data-filter="all">
                            <i class="ph ph-list"></i> Todas
                        </button>
                        <button class="chip green" data-filter="confirmed">
                            <i class="ph ph-check-circle"></i> Confirmadas
                        </button>
                        <button class="chip amber" data-filter="pending">
                            <i class="ph ph-clock"></i> Pendentes
                        </button>
                        <button class="chip red" data-filter="cancelled">
                            <i class="ph ph-x-circle"></i> Canceladas
                        </button>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="timeline" id="timeline"></div>

            </div>
        </div>
    </main>

    <!-- ============================================================
       MODAL — Nova Consulta
       ============================================================ -->
    <div class="overlay" id="overlay">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <div class="modal-title">Nova Consulta</div>
                    <div class="modal-sub">Agende uma consulta para seu pet 📅</div>
                </div>
                <button class="modal-close" id="closeModal"><i class="ph ph-x"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Pet *</label>
                        <select class="form-input" id="mPet">
                            <option value="">Selecionar pet…</option>
                            <option>Luna (Gato)</option>
                            <option>Thor (Cão)</option>
                            <option>Mel (Cão)</option>
                            <option>Simba (Gato)</option>
                            <option>Bolt (Cão)</option>
                            <option>Nina (Coelho)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Veterinário *</label>
                        <select class="form-input" id="mVet">
                            <option value="">Selecionar…</option>
                            <option>Dra. Ana Ferreira</option>
                            <option>Dr. Carlos Melo</option>
                            <option>Dra. Luísa Ramos</option>
                            <option>Dr. Paulo Neto</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Especialidade</label>
                        <select class="form-input" id="mSpec">
                            <option value="">Selecionar…</option>
                            <option>Clínica Geral</option>
                            <option>Cardiologia</option>
                            <option>Dermatologia</option>
                            <option>Ortopedia</option>
                            <option>Oftalmologia</option>
                            <option>Odontologia</option>
                            <option>Oncologia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Duração</label>
                        <select class="form-input" id="mDuration">
                            <option>30 min</option>
                            <option>45 min</option>
                            <option selected>1h</option>
                            <option>1h30</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Data *</label>
                        <input class="form-input" type="date" id="mDate" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Horário *</label>
                        <input class="form-input" type="time" id="mTime" />
                    </div>
                </div>
                <div class="form-group full">
                    <label class="form-label">Observações</label>
                    <textarea class="form-input form-textarea" id="mNotes"
                        placeholder="Descreva o motivo da consulta, sintomas ou observações…"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" id="cancelModal">Cancelar</button>
                <button class="btn-save" id="saveModal">
                    <i class="ph ph-calendar-plus"></i> Agendar Consulta
                </button>
            </div>
        </div>
    </div>

    <!-- ============================================================
       JAVASCRIPT
       ============================================================ -->
    <script>
        /* ============================================================
           DATA
           ============================================================ */
        const VET_PHOTOS = [
            "https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=100&q=80",
            "https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=100&q=80",
            "https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=100&q=80",
            "https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=100&q=80",
        ];
        const PET_PHOTOS = [
            "https://images.unsplash.com/photo-1529778873920-4da4926a72c2?w=60&q=80",
            "https://images.unsplash.com/photo-1552053831-71594a27632d?w=60&q=80",
            "https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?w=60&q=80",
            "https://images.unsplash.com/photo-1574158622682-e40e69881006?w=60&q=80",
            "https://images.unsplash.com/photo-1589941013453-ec89f33b5e95?w=60&q=80",
            "https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=60&q=80",
        ];

        let appointments = [{
                id: 1,
                hour: "08:00",
                period: "AM",
                duration: "45 min",
                pet: "Thor",
                vet: "Dr. Carlos Melo",
                vetPhoto: VET_PHOTOS[1],
                petPhoto: PET_PHOTOS[1],
                specialty: "Cardiologia",
                status: "confirmed",
                note: "Retorno cardíaco"
            },
            {
                id: 2,
                hour: "09:30",
                period: "AM",
                duration: "1h",
                pet: "Luna",
                vet: "Dra. Ana Ferreira",
                vetPhoto: VET_PHOTOS[0],
                petPhoto: PET_PHOTOS[0],
                specialty: "Clínica Geral",
                status: "confirmed",
                note: "Check-up anual"
            },
            {
                id: 3,
                hour: "10:00",
                period: "AM",
                duration: "30 min",
                pet: "Mel",
                vet: "Dra. Luísa Ramos",
                vetPhoto: VET_PHOTOS[2],
                petPhoto: PET_PHOTOS[2],
                specialty: "Dermatologia",
                status: "pending",
                note: "Alergia de pele"
            },
            {
                id: 4,
                hour: "11:30",
                period: "AM",
                duration: "1h",
                pet: "Bolt",
                vet: "Dr. Paulo Neto",
                vetPhoto: VET_PHOTOS[3],
                petPhoto: PET_PHOTOS[4],
                specialty: "Ortopedia",
                status: "confirmed",
                note: "Avaliação pós-cirúrgica"
            },
            {
                id: 5,
                hour: "14:00",
                period: "PM",
                duration: "45 min",
                pet: "Simba",
                vet: "Dra. Ana Ferreira",
                vetPhoto: VET_PHOTOS[0],
                petPhoto: PET_PHOTOS[3],
                specialty: "Oftalmologia",
                status: "pending",
                note: "Problema ocular"
            },
            {
                id: 6,
                hour: "15:30",
                period: "PM",
                duration: "30 min",
                pet: "Nina",
                vet: "Dr. Carlos Melo",
                vetPhoto: VET_PHOTOS[1],
                petPhoto: PET_PHOTOS[5],
                specialty: "Clínica Geral",
                status: "cancelled",
                note: "Cancelada pelo tutor"
            },
            {
                id: 7,
                hour: "16:00",
                period: "PM",
                duration: "1h30",
                pet: "Thor",
                vet: "Dra. Luísa Ramos",
                vetPhoto: VET_PHOTOS[2],
                petPhoto: PET_PHOTOS[1],
                specialty: "Odontologia",
                status: "confirmed",
                note: "Limpeza dentária"
            },
        ];

        let activeFilter = "all";

        /* ============================================================
           CALENDAR
           ============================================================ */
        const MONTHS_PT = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro",
            "Outubro", "Novembro", "Dezembro"
        ];
        const today = new Date();
        let calDate = new Date(today.getFullYear(), today.getMonth(), 1);

        // Days that have appointments (of the current view — demo uses current month)
        const apptDays = new Set([5, 7, 12, 15, 18, 20, 23, 27]);

        function renderCalendar() {
            const grid = document.getElementById("calGrid");
            document.getElementById("calMonthLabel").textContent =
                `${MONTHS_PT[calDate.getMonth()]} ${calDate.getFullYear()}`;

            const firstDay = new Date(calDate.getFullYear(), calDate.getMonth(), 1).getDay();
            const daysInMonth = new Date(calDate.getFullYear(), calDate.getMonth() + 1, 0).getDate();
            const daysInPrev = new Date(calDate.getFullYear(), calDate.getMonth(), 0).getDate();

            let html = "";
            let dayCount = 0;

            // Previous month tail
            for (let i = firstDay - 1; i >= 0; i--) {
                html += `<div class="cal-day other-month">${daysInPrev - i}</div>`;
                dayCount++;
            }
            // Current month days
            for (let d = 1; d <= daysInMonth; d++) {
                const isToday =
                    d === today.getDate() &&
                    calDate.getMonth() === today.getMonth() &&
                    calDate.getFullYear() === today.getFullYear();
                const hasAppt = apptDays.has(d);
                const cls = [
                    "cal-day",
                    isToday ? "today" : "",
                    hasAppt ? "has-appt" : "",
                ].filter(Boolean).join(" ");
                html += `<div class="${cls}" data-d="${d}">${d}</div>`;
                dayCount++;
            }
            // Next month fill
            const remaining = 42 - dayCount;
            for (let d = 1; d <= remaining; d++) {
                html += `<div class="cal-day other-month">${d}</div>`;
            }

            grid.innerHTML = html;

            // Click to select
            grid.querySelectorAll(".cal-day:not(.other-month)").forEach(el => {
                el.addEventListener("click", () => {
                    grid.querySelectorAll(".cal-day").forEach(c => c.classList.remove("selected"));
                    el.classList.add("selected");
                });
            });
        }

        document.getElementById("calPrev").addEventListener("click", () => {
            calDate.setMonth(calDate.getMonth() - 1);
            renderCalendar();
        });
        document.getElementById("calNext").addEventListener("click", () => {
            calDate.setMonth(calDate.getMonth() + 1);
            renderCalendar();
        });

        /* ============================================================
           TODAY BADGE
           ============================================================ */
        (function() {
            const opts = {
                day: "numeric",
                month: "long",
                year: "numeric"
            };
            document.getElementById("todayBadge").textContent =
                today.toLocaleDateString("pt-BR", opts);
        })();

        /* ============================================================
           UPCOMING WIDGET
           ============================================================ */
        function renderUpcoming() {
            const confirmed = appointments.filter(a => a.status !== "cancelled").slice(0, 4);
            document.getElementById("upcomingList").innerHTML = confirmed.map(a => `
        <div class="upcoming-item">
          <img class="upcoming-pet-avatar" src="${a.petPhoto}" alt="${a.pet}" />
          <div>
            <div class="upcoming-pet-name">${a.pet}</div>
            <div class="upcoming-pet-time">${a.hour} · ${a.vet.split(" ").slice(-2).join(" ")}</div>
          </div>
          <span class="upcoming-status-dot" style="background:${a.status==="confirmed"?"var(--green)":a.status==="pending"?"var(--amber)":"#94a3b8"}"></span>
        </div>
      `).join("");
        }

        /* ============================================================
           TIMELINE — Render
           ============================================================ */
        function buildCard(a, i) {
            const statusMap = {
                confirmed: {
                    label: "Confirmada",
                    cls: "confirmed"
                },
                pending: {
                    label: "Pendente",
                    cls: "pending"
                },
                cancelled: {
                    label: "Cancelada",
                    cls: "cancelled"
                },
            };
            const s = statusMap[a.status];
            return `
        <article class="appt-card" data-id="${a.id}" data-status="${a.status}" style="animation-delay:${0.04+i*0.06}s">
          <div class="appt-strip ${s.cls}"></div>
          <div class="appt-inner">

            <!-- Time -->
            <div class="appt-time">
              <div class="appt-hour">${a.hour}</div>
              <div class="appt-period">${a.period}</div>
              <div class="appt-duration">${a.duration}</div>
            </div>

            <div class="appt-divider"></div>

            <!-- Vet photo -->
            <img class="appt-vet-photo" src="${a.vetPhoto}" alt="${a.vet}" />

            <!-- Info -->
            <div class="appt-info">
              <div class="appt-pet-name">${a.pet}</div>
              <div class="appt-vet-name">${a.vet}</div>
              <div class="appt-tags">
                <span class="appt-tag specialty"><i class="ph ph-stethoscope"></i> ${a.specialty}</span>
                <span class="appt-tag"><i class="ph ph-note"></i> ${a.note}</span>
              </div>
            </div>

            <!-- Status -->
            <div class="appt-status">
              <span class="status-badge ${s.cls}">
                <span class="sdot"></span>${s.label}
              </span>
              <button class="appt-action-btn" title="Opções"><i class="ph ph-dots-three"></i></button>
            </div>

          </div>
        </article>
      `;
        }

        function groupByPeriod(list) {
            const groups = {
                "Manhã": [],
                "Tarde": [],
                "Noite": []
            };
            list.forEach(a => {
                const h = parseInt(a.hour.split(":")[0]);
                if (h < 12) groups["Manhã"].push(a);
                else if (h < 18) groups["Tarde"].push(a);
                else groups["Noite"].push(a);
            });
            return groups;
        }

        function renderTimeline(filter = "all", query = "") {
            const tl = document.getElementById("timeline");
            let list = appointments;

            if (filter !== "all") list = list.filter(a => a.status === filter);
            if (query) {
                const q = query.toLowerCase();
                list = list.filter(a =>
                    a.pet.toLowerCase().includes(q) ||
                    a.vet.toLowerCase().includes(q) ||
                    a.specialty.toLowerCase().includes(q)
                );
            }

            if (list.length === 0) {
                tl.innerHTML = `
          <div class="empty-timeline">
            <i class="ph ph-calendar-x"></i>
            <p>Nenhuma consulta encontrada.</p>
          </div>`;
                return;
            }

            const groups = groupByPeriod(list);
            let html = "";
            let globalIdx = 0;

            Object.entries(groups).forEach(([period, items]) => {
                if (!items.length) return;
                html += `
          <div class="timeline-group">
            <div class="timeline-time-label"><span>${period}</span></div>
            ${items.map((a, i) => buildCard(a, globalIdx++)).join("")}
          </div>`;
            });

            tl.innerHTML = html;
            updateStats(list);
        }

        /* ============================================================
           STATS UPDATE
           ============================================================ */
        function updateStats(list = appointments) {
            document.getElementById("statTotal").textContent = appointments.length;
            document.getElementById("statConfirmed").textContent = appointments.filter(a => a.status === "confirmed")
            .length;
            document.getElementById("statPending").textContent = appointments.filter(a => a.status === "pending").length;
        }

        /* ============================================================
           FILTER CHIPS
           ============================================================ */
        document.querySelectorAll(".chip").forEach(chip => {
            chip.addEventListener("click", () => {
                document.querySelectorAll(".chip").forEach(c => c.classList.remove("active"));
                chip.classList.add("active");
                activeFilter = chip.dataset.filter;
                renderTimeline(activeFilter, document.getElementById("searchInput").value);
            });
        });

        /* ============================================================
           SEARCH
           ============================================================ */
        document.getElementById("searchInput").addEventListener("input", e => {
            renderTimeline(activeFilter, e.target.value);
        });

        /* ============================================================
           MODAL
           ============================================================ */
        const overlay = document.getElementById("overlay");
        const openBtn = document.getElementById("openModalBtn");
        const closeBtn = document.getElementById("closeModal");
        const cancelBtn = document.getElementById("cancelModal");

        openBtn.addEventListener("click", () => {
            overlay.classList.add("open");
            document.body.style.overflow = "hidden";
        });
        const closeModal = () => {
            overlay.classList.remove("open");
            document.body.style.overflow = "";
        };
        closeBtn.addEventListener("click", closeModal);
        cancelBtn.addEventListener("click", closeModal);
        overlay.addEventListener("click", e => {
            if (e.target === overlay) closeModal();
        });
        document.addEventListener("keydown", e => {
            if (e.key === "Escape") closeModal();
        });

        // Save new appointment
        document.getElementById("saveModal").addEventListener("click", () => {
            const pet = document.getElementById("mPet").value;
            const vet = document.getElementById("mVet").value;
            const spec = document.getElementById("mSpec").value;
            const date = document.getElementById("mDate").value;
            const time = document.getElementById("mTime").value;
            const dur = document.getElementById("mDuration").value;
            const note = document.getElementById("mNotes").value.trim();

            if (!pet || !vet || !date || !time) {
                ["mPet", "mVet", "mDate", "mTime"].forEach(id => {
                    const el = document.getElementById(id);
                    if (!el.value) {
                        el.style.borderColor = "var(--red)";
                        setTimeout(() => el.style.borderColor = "", 1800);
                    }
                });
                return;
            }

            const h = parseInt(time.split(":")[0]);
            const newAppt = {
                id: Date.now(),
                hour: time,
                period: h < 12 ? "AM" : "PM",
                duration: dur,
                pet: pet.split(" ")[0],
                vet,
                vetPhoto: VET_PHOTOS[Math.floor(Math.random() * VET_PHOTOS.length)],
                petPhoto: PET_PHOTOS[Math.floor(Math.random() * PET_PHOTOS.length)],
                specialty: spec || "Clínica Geral",
                status: "pending",
                note: note || "Nova consulta agendada",
            };

            appointments.unshift(newAppt);
            appointments.sort((a, b) => a.hour.localeCompare(b.hour));
            renderTimeline(activeFilter, document.getElementById("searchInput").value);
            renderUpcoming();
            updateStats();
            closeModal();
            resetModal();
        });

        function resetModal() {
            ["mPet", "mVet", "mSpec", "mDate", "mTime", "mNotes"].forEach(id => {
                const el = document.getElementById(id);
                el.value = el.tagName === "SELECT" ? "" : "";
            });
            document.getElementById("mDuration").value = "1h";
        }

        /* ============================================================
           INIT
           ============================================================ */
        // Set today's date as default in modal
        document.getElementById("mDate").value = today.toISOString().split("T")[0];

        renderCalendar();
        renderTimeline();
        renderUpcoming();
        updateStats();
    </script>
</body>

</html>
