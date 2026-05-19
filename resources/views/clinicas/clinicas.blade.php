<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VetTech — Clínicas</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=DM+Serif+Display:ital@0;1&display=swap"
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
            --red: #dc2626;
            --red-bg: #fee2e2;
            --amber: #d97706;
            --amber-bg: #fef3c7;
            --text-primary: #0d0f1a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 26px;
            --shadow-xs: 0 1px 4px rgba(0, 0, 0, 0.05);
            --shadow-card: 0 2px 14px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.04);
            --shadow-hover: 0 10px 36px rgba(59, 110, 248, 0.14), 0 4px 14px rgba(0, 0, 0, 0.08);
            --shadow-modal: 0 24px 80px rgba(0, 0, 0, 0.20);
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
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            overflow: hidden;
            /* full-viewport layout */
        }

        button,
        input,
        select {
            font-family: inherit;
        }

        ::-webkit-scrollbar {
            width: 5px;
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
            flex-shrink: 0;
            box-shadow: 0 0 16px rgba(59, 110, 248, 0.45);
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

        .nav-badge {
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
            height: 100vh;
            overflow: hidden;
        }

        /* ============================================================
       TOPBAR
       ============================================================ */
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 28px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        /* Top row */
        .topbar-row1 {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px 0 14px;
        }

        .topbar-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            letter-spacing: -0.02em;
            white-space: nowrap;
        }

        /* Search */
        .search-big {
            flex: 1;
            max-width: 480px;
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border);
            border-radius: 99px;
            background: var(--surface-alt);
            overflow: hidden;
            transition: border-color var(--t), box-shadow var(--t), background var(--t);
        }

        .search-big:focus-within {
            border-color: var(--accent);
            background: var(--surface);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .search-big i {
            padding: 0 12px;
            color: var(--text-muted);
            font-size: 16px;
            flex-shrink: 0;
        }

        .search-big input {
            flex: 1;
            border: none;
            background: transparent;
            font-size: 0.875rem;
            color: var(--text-primary);
            outline: none;
            padding: 9px 4px;
        }

        .search-big input::placeholder {
            color: var(--text-muted);
        }

        .search-big .search-divider {
            width: 1px;
            height: 20px;
            background: var(--border);
            flex-shrink: 0;
        }

        .search-big .location-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 16px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--accent);
            background: none;
            border: none;
            cursor: pointer;
            transition: color var(--t);
            white-space: nowrap;
        }

        .search-big .location-btn:hover {
            color: var(--accent-dim);
        }

        .search-big .location-btn i {
            font-size: 14px;
        }

        /* Topbar right */
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

        /* Filter chips row */
        .topbar-row2 {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 14px;
            overflow-x: auto;
        }

        .topbar-row2::-webkit-scrollbar {
            display: none;
        }

        .filter-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .f-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border: 1.5px solid var(--border);
            border-radius: 99px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: var(--surface);
            cursor: pointer;
            white-space: nowrap;
            transition: all var(--t);
        }

        .f-chip i {
            font-size: 14px;
        }

        .f-chip:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-light);
        }

        .f-chip.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            box-shadow: 0 2px 10px rgba(59, 110, 248, 0.35);
        }

        .f-chip.active.green {
            background: var(--green);
            border-color: var(--green);
            box-shadow: 0 2px 10px rgba(22, 163, 74, 0.3);
        }

        .f-chip.active.red {
            background: var(--red);
            border-color: var(--red);
            box-shadow: 0 2px 10px rgba(220, 38, 38, 0.3);
        }

        .f-chip.active.amber {
            background: var(--amber);
            border-color: var(--amber);
            box-shadow: 0 2px 10px rgba(217, 119, 6, 0.3);
        }

        /* Result count */
        .result-count {
            margin-left: auto;
            white-space: nowrap;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .result-count strong {
            color: var(--accent);
        }

        /* ============================================================
       BODY — MAP + PANEL
       ============================================================ */
        .body-wrap {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        /* ============================================================
       CLINIC PANEL (left)
       ============================================================ */
        .panel {
            width: 400px;
            flex-shrink: 0;
            overflow-y: auto;
            background: var(--bg);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        /* Sort bar */
        .sort-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 14px 16px 10px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .sort-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .sort-select {
            border: 1.5px solid var(--border);
            border-radius: 99px;
            padding: 4px 28px 4px 12px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 256 256'%3E%3Cpath fill='%2394a3b8' d='m213.66 101.66-80 80a8 8 0 0 1-11.32 0l-80-80a8 8 0 0 1 11.32-11.32L128 164.69l74.34-74.35a8 8 0 0 1 11.32 11.32Z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            transition: border-color var(--t);
        }

        .sort-select:focus {
            border-color: var(--accent);
        }

        .view-toggle {
            margin-left: auto;
            display: flex;
            gap: 4px;
        }

        .view-btn {
            width: 28px;
            height: 28px;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border);
            background: none;
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 14px;
            transition: all var(--t);
        }

        .view-btn.active {
            background: var(--accent-light);
            color: var(--accent);
            border-color: transparent;
        }

        /* Clinic list */
        .clinic-list {
            padding: 12px 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* ============================================================
       CLINIC CARD
       ============================================================ */
        .clinic-card {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            cursor: pointer;
            transition: transform var(--t), box-shadow var(--t), border-color var(--t);
            animation: cardIn 0.35s ease both;
            display: flex;
            flex-direction: column;
        }

        .clinic-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(59, 110, 248, 0.30);
        }

        .clinic-card.active-card {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow), var(--shadow-hover);
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Photo strip */
        .clinic-photo {
            width: 100%;
            height: 130px;
            object-fit: cover;
            display: block;
            transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .clinic-card:hover .clinic-photo {
            transform: scale(1.04);
        }

        .clinic-photo-wrap {
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }

        /* Open/closed badge on photo */
        .open-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 99px;
            backdrop-filter: blur(8px);
            letter-spacing: 0.03em;
        }

        .open-badge.open {
            background: rgba(220, 252, 231, 0.92);
            color: var(--green);
        }

        .open-badge.closed {
            background: rgba(254, 226, 226, 0.92);
            color: var(--red);
        }

        /* Distance badge on photo */
        .dist-badge {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 99px;
            background: rgba(13, 15, 26, 0.62);
            color: #fff;
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .dist-badge i {
            font-size: 11px;
        }

        /* Card body */
        .clinic-body {
            padding: 13px 14px 0;
        }

        .clinic-name {
            font-size: 0.92rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .clinic-address {
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .clinic-address i {
            font-size: 12px;
            flex-shrink: 0;
        }

        /* Rating row */
        .clinic-rating-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .stars i {
            font-size: 12px;
            color: #f59e0b;
        }

        .stars i.empty {
            color: var(--border);
        }

        .rating-val {
            font-size: 0.8rem;
            font-weight: 700;
        }

        .rating-count {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        /* Service tags */
        .clinic-tags {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .ctag {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 99px;
            background: var(--surface-alt);
            border: 1px solid var(--border);
            color: var(--text-secondary);
        }

        .ctag i {
            font-size: 10px;
        }

        .ctag.blue {
            background: var(--accent-light);
            color: var(--accent);
            border-color: transparent;
        }

        .ctag.green {
            background: var(--green-bg);
            color: var(--green);
            border-color: transparent;
        }

        .ctag.red {
            background: var(--red-bg);
            color: var(--red);
            border-color: transparent;
        }

        .ctag.amber {
            background: var(--amber-bg);
            color: var(--amber);
            border-color: transparent;
        }

        /* Card footer */
        .clinic-footer {
            display: flex;
            gap: 8px;
            padding: 11px 14px 13px;
            margin-top: 11px;
            border-top: 1px solid var(--border);
        }

        .btn-outline-sm {
            flex: 1;
            padding: 7px 8px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            background: none;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all var(--t);
        }

        .btn-outline-sm i {
            font-size: 13px;
        }

        .btn-outline-sm:hover {
            background: var(--surface-alt);
            color: var(--text-primary);
            border-color: #c5cbdb;
        }

        .btn-primary-sm {
            flex: 1.4;
            padding: 7px 8px;
            border: none;
            border-radius: var(--radius-md);
            background: var(--accent);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: background var(--t), box-shadow var(--t), transform var(--t);
        }

        .btn-primary-sm i {
            font-size: 13px;
        }

        .btn-primary-sm:hover {
            background: var(--accent-dim);
            box-shadow: 0 4px 14px rgba(59, 110, 248, 0.38);
            transform: translateY(-1px);
        }

        /* ============================================================
       MAP AREA (right)
       ============================================================ */
        .map-area {
            flex: 1;
            position: relative;
            overflow: hidden;
            background: #e8ecf0;
        }

        /* SVG-based illustrated map */
        .map-svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        /* Map controls overlay */
        .map-controls {
            position: absolute;
            top: 16px;
            right: 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .map-ctrl-btn {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            background: var(--surface);
            border: 1px solid var(--border);
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 18px;
            box-shadow: var(--shadow-card);
            transition: background var(--t), color var(--t);
        }

        .map-ctrl-btn:hover {
            background: var(--accent-light);
            color: var(--accent);
        }

        .map-ctrl-divider {
            height: 1px;
            background: var(--border);
            margin: 2px 0;
        }

        /* Map style toggle */
        .map-style-pill {
            position: absolute;
            bottom: 20px;
            right: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 99px;
            display: flex;
            overflow: hidden;
            box-shadow: var(--shadow-card);
        }

        .map-style-opt {
            padding: 6px 14px;
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all var(--t);
        }

        .map-style-opt.active {
            background: var(--accent);
            color: #fff;
        }

        /* "You are here" pulse */
        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            100% {
                transform: scale(2.8);
                opacity: 0;
            }
        }

        .map-pulse-ring {
            animation: pulse-ring 2s ease-out infinite;
        }

        /* Pin hover tooltip */
        .map-pin {
            cursor: pointer;
        }

        .map-pin:hover .pin-tooltip {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .pin-tooltip {
            opacity: 0;
            transform: translateY(4px);
            transition: opacity 0.18s ease, transform 0.18s ease;
            pointer-events: none;
        }

        /* Map info card */
        .map-info-card {
            position: absolute;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(120%);
            width: 320px;
            background: var(--surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-modal);
            border: 1.5px solid var(--border);
            padding: 16px 18px;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.25s ease;
            opacity: 0;
            pointer-events: none;
        }

        .map-info-card.visible {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
            pointer-events: all;
        }

        .mic-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .mic-photo {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            flex-shrink: 0;
        }

        .mic-name {
            font-size: 0.9rem;
            font-weight: 700;
        }

        .mic-dist {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .mic-close {
            margin-left: auto;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: none;
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 14px;
            transition: all var(--t);
        }

        .mic-close:hover {
            background: var(--red-bg);
            color: var(--red);
            border-color: transparent;
        }

        .mic-stars {
            display: flex;
            gap: 2px;
            margin-bottom: 10px;
        }

        .mic-stars i {
            font-size: 12px;
            color: #f59e0b;
        }

        .mic-btn {
            width: 100%;
            padding: 9px;
            border: none;
            border-radius: var(--radius-md);
            background: var(--accent);
            color: #fff;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: background var(--t), box-shadow var(--t);
        }

        .mic-btn:hover {
            background: var(--accent-dim);
            box-shadow: 0 4px 14px rgba(59, 110, 248, 0.4);
        }

        /* "Minha localização" badge */
        .my-location-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 99px;
            padding: 7px 14px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 7px;
            box-shadow: var(--shadow-card);
        }

        .my-location-badge i {
            font-size: 15px;
            color: var(--accent);
        }

        /* ============================================================
       MODAL — Agendar
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
            max-width: 460px;
            box-shadow: var(--shadow-modal);
            transform: translateY(18px) scale(0.97);
            opacity: 0;
            transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.24s ease;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .overlay.open .modal {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .modal-header {
            padding: 22px 24px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .modal-clinic-photo {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            flex-shrink: 0;
        }

        .modal-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.1rem;
            letter-spacing: -0.02em;
        }

        .modal-sub {
            font-size: 0.77rem;
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
            transition: all var(--t);
            flex-shrink: 0;
        }

        .modal-close:hover {
            background: var(--red-bg);
            color: var(--red);
            border-color: transparent;
        }

        .modal-body {
            padding: 20px 24px;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-label {
            font-size: 0.73rem;
            font-weight: 700;
            color: var(--text-secondary);
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

        /* Time slot picker */
        .time-slots {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .time-slot {
            padding: 6px 14px;
            border-radius: 99px;
            border: 1.5px solid var(--border);
            background: var(--surface);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all var(--t);
        }

        .time-slot:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .time-slot.selected {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .time-slot.unavailable {
            opacity: 0.35;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        .modal-footer {
            padding: 14px 24px 20px;
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
            transition: all var(--t);
        }

        .btn-cancel:hover {
            background: var(--surface-alt);
            color: var(--text-primary);
        }

        .btn-confirm {
            padding: 9px 24px;
            border-radius: 99px;
            border: none;
            background: var(--accent);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all var(--t);
        }

        .btn-confirm:hover {
            background: var(--accent-dim);
            box-shadow: 0 4px 16px rgba(59, 110, 248, 0.4);
            transform: translateY(-1px);
        }

        .btn-confirm i {
            font-size: 15px;
        }

        /* ============================================================
       ANIMATION DELAYS
       ============================================================ */
        .clinic-card:nth-child(1) {
            animation-delay: 0.04s;
        }

        .clinic-card:nth-child(2) {
            animation-delay: 0.10s;
        }

        .clinic-card:nth-child(3) {
            animation-delay: 0.16s;
        }

        .clinic-card:nth-child(4) {
            animation-delay: 0.22s;
        }

        .clinic-card:nth-child(5) {
            animation-delay: 0.28s;
        }

        .clinic-card:nth-child(6) {
            animation-delay: 0.34s;
        }

        /* ============================================================
       RESPONSIVE
       ============================================================ */
        @media (max-width: 1000px) {
            .panel {
                width: 340px;
            }
        }

        @media (max-width: 860px) {
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
        }

        @media (max-width: 720px) {
            .body-wrap {
                flex-direction: column;
            }

            .panel {
                width: 100%;
                height: 55vh;
                border-right: none;
                border-top: 1px solid var(--border);
                order: 2;
            }

            .map-area {
                height: 45vh;
                order: 1;
            }

            body {
                overflow: auto;
            }

            .main {
                height: auto;
                overflow: auto;
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
            <a class="nav-link" href="#">
                <i class="ph ph-calendar-check"></i><span>Consultas</span>
                <span class="nav-badge">3</span>
            </a>
            <a class="nav-link" href="#">
                <i class="ph ph-stethoscope"></i><span>Histórico Médico</span>
            </a>
            <a class="nav-link active" href="#">
                <i class="ph ph-map-pin"></i><span>Clínicas</span>
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
            <div class="topbar-row1">
                <h1 class="topbar-title">Clínicas</h1>

                <div class="search-big">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Buscar por cidade, bairro ou CEP…" />
                    <div class="search-divider"></div>
                    <button class="location-btn" id="locBtn">
                        <i class="ph ph-navigation-arrow"></i> Usar localização
                    </button>
                </div>

                <div class="topbar-right">
                    <button class="icon-btn"><i class="ph ph-bell"></i><span class="dot"></span></button>
                    <div class="user-avatar-btn">JS</div>
                </div>
            </div>

            <div class="topbar-row2">
                <span class="filter-label">Filtros:</span>
                <button class="f-chip green" data-filter="24h">
                    <i class="ph ph-clock"></i> Aberto 24h
                </button>
                <button class="f-chip red" data-filter="emergency">
                    <i class="ph ph-first-aid-kit"></i> Emergência
                </button>
                <button class="f-chip blue" data-filter="online">
                    <i class="ph ph-video-camera"></i> Atendimento Online
                </button>
                <button class="f-chip amber" data-filter="bath">
                    <i class="ph ph-drop"></i> Banho e Tosa
                </button>
                <button class="f-chip" data-filter="exam">
                    <i class="ph ph-flask"></i> Exames
                </button>
                <button class="f-chip" data-filter="surgery">
                    <i class="ph ph-scissors"></i> Cirurgia
                </button>

                <span class="result-count" id="resultCount"><strong>8</strong> clínicas encontradas</span>
            </div>
        </header>

        <!-- BODY -->
        <div class="body-wrap">

            <!-- ===================== PANEL ===================== -->
            <div class="panel">
                <div class="sort-bar">
                    <span class="sort-label">Ordenar por:</span>
                    <select class="sort-select" id="sortSelect">
                        <option value="dist">Mais próximas</option>
                        <option value="rating">Melhor avaliação</option>
                        <option value="name">Nome A–Z</option>
                    </select>
                    <div class="view-toggle">
                        <button class="view-btn active" title="Lista"><i class="ph ph-list-bullets"></i></button>
                        <button class="view-btn" title="Grade"><i class="ph ph-squares-four"></i></button>
                    </div>
                </div>
                <div class="clinic-list" id="clinicList"></div>
            </div>

            <!-- ===================== MAP ===================== -->
            <div class="map-area" id="mapArea">

                <!-- Illustrated SVG Map -->
                <svg class="map-svg" viewBox="0 0 900 620" xmlns="http://www.w3.org/2000/svg" id="mapSvg">
                    <!-- Base road grid -->
                    <rect width="900" height="620" fill="#e8ecf0" />

                    <!-- Parks / green zones -->
                    <rect x="60" y="40" width="140" height="90" rx="8" fill="#c8e6c9"
                        opacity=".7" />
                    <rect x="620" y="300" width="110" height="80" rx="8" fill="#c8e6c9"
                        opacity=".7" />
                    <rect x="400" y="480" width="160" height="100" rx="8" fill="#c8e6c9"
                        opacity=".7" />
                    <rect x="780" y="60" width="100" height="70" rx="8" fill="#c8e6c9"
                        opacity=".7" />

                    <!-- Water feature -->
                    <ellipse cx="760" cy="480" rx="90" ry="55" fill="#b3d4f5"
                        opacity=".6" />

                    <!-- Main roads (thick) -->
                    <line x1="0" y1="180" x2="900" y2="180" stroke="#fff"
                        stroke-width="14" opacity=".9" />
                    <line x1="0" y1="360" x2="900" y2="360" stroke="#fff"
                        stroke-width="14" opacity=".9" />
                    <line x1="0" y1="520" x2="900" y2="520" stroke="#fff"
                        stroke-width="10" opacity=".8" />
                    <line x1="220" y1="0" x2="220" y2="620" stroke="#fff"
                        stroke-width="14" opacity=".9" />
                    <line x1="500" y1="0" x2="500" y2="620" stroke="#fff"
                        stroke-width="14" opacity=".9" />
                    <line x1="740" y1="0" x2="740" y2="620" stroke="#fff"
                        stroke-width="10" opacity=".8" />

                    <!-- Secondary roads -->
                    <line x1="0" y1="280" x2="900" y2="280" stroke="#fff"
                        stroke-width="6" opacity=".6" />
                    <line x1="0" y1="440" x2="900" y2="440" stroke="#fff"
                        stroke-width="6" opacity=".6" />
                    <line x1="100" y1="0" x2="100" y2="620" stroke="#fff"
                        stroke-width="6" opacity=".6" />
                    <line x1="340" y1="0" x2="340" y2="620" stroke="#fff"
                        stroke-width="6" opacity=".6" />
                    <line x1="620" y1="0" x2="620" y2="620" stroke="#fff"
                        stroke-width="6" opacity=".6" />
                    <line x1="840" y1="0" x2="840" y2="620" stroke="#fff"
                        stroke-width="5" opacity=".5" />

                    <!-- City blocks (subtle fill) -->
                    <rect x="102" y="182" width="116" height="96" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="222" y="182" width="116" height="96" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="342" y="182" width="156" height="96" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="502" y="182" width="116" height="96" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="102" y="282" width="116" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="222" y="282" width="116" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="502" y="282" width="116" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="102" y="362" width="236" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="342" y="362" width="156" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="502" y="362" width="116" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="102" y="442" width="116" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="222" y="442" width="116" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="342" y="442" width="156" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="622" y="182" width="116" height="116" rx="4" fill="#dde3ec"
                        opacity=".5" />
                    <rect x="622" y="442" width="116" height="76" rx="4" fill="#dde3ec"
                        opacity=".5" />

                    <!-- Road labels -->
                    <text x="450" y="174" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9"
                        fill="#94a3b8" font-weight="600" letter-spacing=".05em">AV. PAULISTA</text>
                    <text x="450" y="354" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9"
                        fill="#94a3b8" font-weight="600" letter-spacing=".05em">AV. BRASIL</text>
                    <text x="215" y="100" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9"
                        fill="#94a3b8" font-weight="600" letter-spacing=".05em" transform="rotate(-90,215,100)">R.
                        DAS FLORES</text>
                    <text x="495" y="100" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9"
                        fill="#94a3b8" font-weight="600" letter-spacing=".05em" transform="rotate(-90,495,100)">R.
                        SÃO PEDRO</text>

                    <!-- "Park" label -->
                    <text x="130" y="92" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9"
                        fill="#4caf50" font-weight="700" letter-spacing=".04em">PARQUE</text>

                    <!-- User location dot -->
                    <circle cx="380" cy="310" r="22" fill="#3b6ef8" opacity=".12"
                        class="map-pulse-ring" />
                    <circle cx="380" cy="310" r="10" fill="#3b6ef8" opacity=".22" />
                    <circle cx="380" cy="310" r="6" fill="#3b6ef8" />
                    <circle cx="380" cy="310" r="3" fill="#fff" />

                    <!-- ===== CLINIC PINS (injected by JS) ===== -->
                    <g id="mapPins"></g>
                </svg>

                <!-- My location badge -->
                <div class="my-location-badge">
                    <i class="ph ph-navigation-arrow"></i>
                    Av. Paulista, 1578 — São Paulo
                </div>

                <!-- Map controls -->
                <div class="map-controls">
                    <button class="map-ctrl-btn" title="Zoom in"><i class="ph ph-plus"></i></button>
                    <div class="map-ctrl-divider"></div>
                    <button class="map-ctrl-btn" title="Zoom out"><i class="ph ph-minus"></i></button>
                    <button class="map-ctrl-btn" title="Minha localização" style="margin-top:6px"><i
                            class="ph ph-crosshair"></i></button>
                    <button class="map-ctrl-btn" title="Layers"><i class="ph ph-stack"></i></button>
                </div>

                <!-- Style toggle -->
                <div class="map-style-pill">
                    <div class="map-style-opt active" id="styleMapa">Mapa</div>
                    <div class="map-style-opt" id="styleSat">Satélite</div>
                </div>

                <!-- Floating info card -->
                <div class="map-info-card" id="mapInfoCard">
                    <div class="mic-header">
                        <img class="mic-photo" id="micPhoto" src="" alt="" />
                        <div>
                            <div class="mic-name" id="micName">—</div>
                            <div class="mic-dist" id="micDist">—</div>
                        </div>
                        <button class="mic-close" id="micClose"><i class="ph ph-x"></i></button>
                    </div>
                    <div class="mic-stars" id="micStars"></div>
                    <button class="mic-btn" id="micSchedule">
                        <i class="ph ph-calendar-plus"></i> Agendar Consulta
                    </button>
                </div>

            </div><!-- /map-area -->
        </div><!-- /body-wrap -->
    </main>

    <!-- ============================================================
       MODAL — Agendar
       ============================================================ -->
    <div class="overlay" id="overlay">
        <div class="modal">
            <div class="modal-header">
                <img class="modal-clinic-photo" id="modalPhoto" src="" alt="" />
                <div style="flex:1;min-width:0;">
                    <div class="modal-title" id="modalClinicName">Clínica VetCare</div>
                    <div class="modal-sub" id="modalClinicAddr">Rua das Flores, 123 — São Paulo</div>
                </div>
                <button class="modal-close" id="closeModal"><i class="ph ph-x"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Pet *</label>
                        <select class="form-input" id="mPet">
                            <option value="">Selecionar…</option>
                            <option>Luna (Gato)</option>
                            <option>Thor (Cão)</option>
                            <option>Mel (Cão)</option>
                            <option>Simba (Gato)</option>
                            <option>Bolt (Cão)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Serviço *</label>
                        <select class="form-input" id="mService">
                            <option value="">Selecionar…</option>
                            <option>Consulta Geral</option>
                            <option>Vacinação</option>
                            <option>Banho e Tosa</option>
                            <option>Exames</option>
                            <option>Emergência</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Data *</label>
                    <input class="form-input" type="date" id="mDate" />
                </div>
                <div class="form-group">
                    <label class="form-label">Horário disponível *</label>
                    <div class="time-slots" id="timeSlots"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Observações</label>
                    <input class="form-input" type="text" id="mNotes"
                        placeholder="Ex: pet tem medo de barulho…" />
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" id="cancelModal">Cancelar</button>
                <button class="btn-confirm" id="confirmBtn">
                    <i class="ph ph-calendar-check"></i> Confirmar Agendamento
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
        const clinics = [{
                id: 1,
                name: "VetCare Premium",
                address: "Av. Paulista, 1400 — Bela Vista",
                dist: 0.4,
                rating: 4.9,
                reviews: 312,
                open: true,
                hours: "24h",
                tags: ["24h", "emergency", "online", "exam"],
                photo: "https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=500&q=80",
                pin: {
                    x: 290,
                    y: 160
                },
                color: "#3b6ef8",
            },
            {
                id: 2,
                name: "Clínica PetSalud",
                address: "R. das Flores, 230 — Jardins",
                dist: 0.9,
                rating: 4.7,
                reviews: 218,
                open: true,
                hours: "07h–22h",
                tags: ["bath", "exam", "online"],
                photo: "https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=500&q=80",
                pin: {
                    x: 165,
                    y: 240
                },
                color: "#16a34a",
            },
            {
                id: 3,
                name: "Hospital Veterinário São Paulo",
                address: "Av. Brasil, 540 — Consolação",
                dist: 1.2,
                rating: 4.8,
                reviews: 490,
                open: true,
                hours: "24h",
                tags: ["24h", "emergency", "surgery", "exam"],
                photo: "https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=500&q=80",
                pin: {
                    x: 420,
                    y: 370
                },
                color: "#dc2626",
            },
            {
                id: 4,
                name: "PetHouse Clínica",
                address: "R. São Pedro, 88 — Liberdade",
                dist: 1.5,
                rating: 4.5,
                reviews: 145,
                open: false,
                hours: "Abre às 08h",
                tags: ["bath", "exam"],
                photo: "https://images.unsplash.com/photo-1516兽医室_mock?w=500&q=80",
                photo: "https://images.unsplash.com/photo-1629909615184-74f495363b67?w=500&q=80",
                pin: {
                    x: 560,
                    y: 240
                },
                color: "#d97706",
            },
            {
                id: 5,
                name: "Vet & Cia Online",
                address: "Atendimento 100% digital",
                dist: 0.0,
                rating: 4.6,
                reviews: 88,
                open: true,
                hours: "24h online",
                tags: ["online", "exam"],
                photo: "https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&q=80",
                pin: {
                    x: 670,
                    y: 160
                },
                color: "#7c3aed",
            },
            {
                id: 6,
                name: "Animal Life Clínica",
                address: "Av. Paulista, 2200 — Cerqueira César",
                dist: 1.8,
                rating: 4.4,
                reviews: 201,
                open: true,
                hours: "08h–20h",
                tags: ["bath", "surgery", "exam"],
                photo: "https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=500&q=80",
                pin: {
                    x: 680,
                    y: 370
                },
                color: "#0891b2",
            },
            {
                id: 7,
                name: "Emergência Pet 24h",
                address: "R. Augusta, 1100 — Cerqueira César",
                dist: 2.1,
                rating: 4.7,
                reviews: 376,
                open: true,
                hours: "24h",
                tags: ["24h", "emergency", "surgery"],
                photo: "https://images.unsplash.com/photo-1551076805-e1869033e561?w=500&q=80",
                pin: {
                    x: 300,
                    y: 480
                },
                color: "#dc2626",
            },
            {
                id: 8,
                name: "VetZen Clínica & Spa",
                address: "R. Oscar Freire, 345 — Jardins",
                dist: 2.6,
                rating: 4.3,
                reviews: 102,
                open: false,
                hours: "Abre às 09h",
                tags: ["bath", "exam"],
                photo: "https://images.unsplash.com/photo-1512472563168-0f4dca7b7e5a?w=500&q=80",
                pin: {
                    x: 560,
                    y: 460
                },
                color: "#0891b2",
            },
        ];

        let activeFilters = new Set();
        let activeCardId = null;
        let scheduleTarget = null;

        /* ============================================================
           RENDER STARS
           ============================================================ */
        function starsHTML(rating, size = 12) {
            let html = "";
            for (let i = 1; i <= 5; i++) {
                const cls = i <= Math.round(rating) ? "ph-fill ph-star" : "ph-star empty";
                html +=
                    `<i class="ph ${cls}" style="font-size:${size}px;color:${i<=Math.round(rating)?"#f59e0b":"#e2e8f0"}"></i>`;
            }
            return html;
        }

        /* ============================================================
           RENDER TAGS
           ============================================================ */
        const TAG_META = {
            "24h": {
                label: "24h",
                icon: "ph-clock",
                cls: "green"
            },
            "emergency": {
                label: "Emergência",
                icon: "ph-first-aid-kit",
                cls: "red"
            },
            "online": {
                label: "Online",
                icon: "ph-video-camera",
                cls: "blue"
            },
            "bath": {
                label: "Banho & Tosa",
                icon: "ph-drop",
                cls: "amber"
            },
            "exam": {
                label: "Exames",
                icon: "ph-flask",
                cls: ""
            },
            "surgery": {
                label: "Cirurgia",
                icon: "ph-scissors",
                cls: ""
            },
        };

        function tagsHTML(tags) {
            return tags.map(t => {
                const m = TAG_META[t] || {
                    label: t,
                    icon: "ph-tag",
                    cls: ""
                };
                return `<span class="ctag ${m.cls}"><i class="ph ${m.icon}"></i> ${m.label}</span>`;
            }).join("");
        }

        /* ============================================================
           RENDER CLINIC CARDS
           ============================================================ */
        function renderCards(list) {
            const container = document.getElementById("clinicList");
            document.getElementById("resultCount").innerHTML =
                `<strong>${list.length}</strong> clínica${list.length!==1?"s":""} encontrada${list.length!==1?"s":""}`;

            if (!list.length) {
                container.innerHTML = `
          <div style="text-align:center;padding:48px 16px;color:var(--text-muted);">
            <i class="ph ph-map-pin-slash" style="font-size:40px;opacity:.3;display:block;margin-bottom:10px;"></i>
            <p style="font-size:.85rem;font-weight:600;">Nenhuma clínica encontrada.</p>
            <p style="font-size:.75rem;margin-top:4px;">Tente remover filtros ou outra localização.</p>
          </div>`;
                return;
            }

            container.innerHTML = list.map((c, i) => `
        <div class="clinic-card ${c.id===activeCardId?"active-card":""}"
             data-id="${c.id}"
             style="animation-delay:${0.04+i*0.06}s">

          <div class="clinic-photo-wrap">
            <img class="clinic-photo" src="${c.photo}" alt="${c.name}" loading="lazy" />
            <span class="open-badge ${c.open?"open":"closed"}">
              ${c.open ? "● Aberto · "+c.hours : "● "+c.hours}
            </span>
            ${c.dist > 0 ? `<span class="dist-badge"><i class="ph ph-map-pin"></i> ${c.dist} km</span>` :
              `<span class="dist-badge"><i class="ph ph-video-camera"></i> Online</span>`}
          </div>

          <div class="clinic-body">
            <div class="clinic-name">${c.name}</div>
            <div class="clinic-address"><i class="ph ph-map-pin"></i>${c.address}</div>
            <div class="clinic-rating-row">
              <div class="stars">${starsHTML(c.rating)}</div>
              <span class="rating-val">${c.rating.toFixed(1)}</span>
              <span class="rating-count">(${c.reviews} avaliações)</span>
            </div>
            <div class="clinic-tags">${tagsHTML(c.tags)}</div>
          </div>

          <div class="clinic-footer">
            <button class="btn-outline-sm btn-info" data-id="${c.id}">
              <i class="ph ph-info"></i> Detalhes
            </button>
            <button class="btn-primary-sm btn-schedule" data-id="${c.id}">
              <i class="ph ph-calendar-plus"></i> Agendar
            </button>
          </div>
        </div>
      `).join("");

            // Card click → highlight on map
            container.querySelectorAll(".clinic-card").forEach(el => {
                el.addEventListener("click", e => {
                    if (e.target.closest(".btn-schedule")) return;
                    const id = +el.dataset.id;
                    selectClinic(id);
                });
            });

            // Schedule buttons
            container.querySelectorAll(".btn-schedule").forEach(btn => {
                btn.addEventListener("click", e => {
                    e.stopPropagation();
                    openModal(+btn.dataset.id);
                });
            });
        }

        /* ============================================================
           MAP PINS
           ============================================================ */
        function renderPins(list) {
            const pinsG = document.getElementById("mapPins");
            pinsG.innerHTML = list.map(c => `
        <g class="map-pin" data-id="${c.id}" transform="translate(${c.pin.x},${c.pin.y})">
          <!-- Drop shadow -->
          <ellipse cx="0" cy="32" rx="9" ry="4" fill="rgba(0,0,0,0.18)"/>
          <!-- Pin body -->
          <path d="M0,-32 C-14,-32 -22,-22 -22,-12 C-22,6 0,32 0,32 C0,32 22,6 22,-12 C22,-22 14,-32 0,-32 Z"
                fill="${c.color}" ${c.id===activeCardId ? 'stroke="#fff" stroke-width="2.5"' : ""}/>
          <!-- Paw icon inside pin -->
          <text x="0" y="-8" text-anchor="middle" font-size="14" fill="#fff">🐾</text>
          <!-- Tooltip -->
          <g class="pin-tooltip" transform="translate(0,-52)">
            <rect x="-52" y="-22" width="104" height="24" rx="6"
                  fill="#0d0f1a" opacity=".92"/>
            <text x="0" y="-5" text-anchor="middle"
                  font-family="DM Sans,sans-serif" font-size="9.5"
                  font-weight="600" fill="#fff">${c.name}</text>
            <text x="0" y="7" text-anchor="middle"
                  font-family="DM Sans,sans-serif" font-size="8"
                  fill="#8ab4ff">${c.dist>0?c.dist+" km":"Online"} · ★ ${c.rating}</text>
            <!-- Tail -->
            <polygon points="-5,2 5,2 0,8" fill="#0d0f1a" opacity=".92" transform="translate(0,-22)"/>
          </g>
        </g>
      `).join("");

            pinsG.querySelectorAll(".map-pin").forEach(pin => {
                pin.addEventListener("click", () => selectClinic(+pin.dataset.id));
            });
        }

        /* ============================================================
           SELECT CLINIC
           ============================================================ */
        function selectClinic(id) {
            activeCardId = id;
            const c = clinics.find(x => x.id === id);
            if (!c) return;

            // Scroll card into view
            const card = document.querySelector(`.clinic-card[data-id="${id}"]`);
            if (card) {
                document.querySelectorAll(".clinic-card").forEach(el => el.classList.remove("active-card"));
                card.classList.add("active-card");
                card.scrollIntoView({
                    behavior: "smooth",
                    block: "nearest"
                });
            }

            // Refresh pins to show active state
            const filtered = getFiltered();
            renderPins(filtered);

            // Show map info card
            const infoCard = document.getElementById("mapInfoCard");
            document.getElementById("micPhoto").src = c.photo;
            document.getElementById("micName").textContent = c.name;
            document.getElementById("micDist").textContent = c.dist > 0 ?
                `${c.dist} km de distância · ${c.open?"Aberto agora":"Fechado"}` :
                "Atendimento 100% Online";
            document.getElementById("micStars").innerHTML = starsHTML(c.rating, 13) +
                `<span style="font-size:.78rem;font-weight:700;margin-left:6px;">${c.rating.toFixed(1)}</span>` +
                `<span style="font-size:.72rem;color:var(--text-muted);margin-left:4px;">(${c.reviews})</span>`;

            document.getElementById("micSchedule").onclick = () => openModal(id);
            infoCard.classList.add("visible");
        }

        document.getElementById("micClose").addEventListener("click", () => {
            document.getElementById("mapInfoCard").classList.remove("visible");
            activeCardId = null;
            document.querySelectorAll(".clinic-card").forEach(el => el.classList.remove("active-card"));
            renderPins(getFiltered());
        });

        /* ============================================================
           FILTER LOGIC
           ============================================================ */
        function getFiltered() {
            let list = [...clinics];
            if (activeFilters.size > 0) {
                list = list.filter(c => [...activeFilters].every(f => c.tags.includes(f)));
            }
            const q = document.getElementById("searchInput").value.toLowerCase().trim();
            if (q) {
                list = list.filter(c =>
                    c.name.toLowerCase().includes(q) ||
                    c.address.toLowerCase().includes(q)
                );
            }
            // Sort
            const sort = document.getElementById("sortSelect").value;
            if (sort === "dist") list.sort((a, b) => a.dist - b.dist);
            if (sort === "rating") list.sort((a, b) => b.rating - a.rating);
            if (sort === "name") list.sort((a, b) => a.name.localeCompare(b.name));
            return list;
        }

        function applyFilters() {
            const list = getFiltered();
            renderCards(list);
            renderPins(list);
        }

        // Filter chips
        document.querySelectorAll(".f-chip").forEach(chip => {
            chip.addEventListener("click", () => {
                const f = chip.dataset.filter;
                if (activeFilters.has(f)) {
                    activeFilters.delete(f);
                    chip.classList.remove("active");
                } else {
                    activeFilters.add(f);
                    chip.classList.add("active");
                }
                applyFilters();
            });
        });

        // Search
        document.getElementById("searchInput").addEventListener("input", applyFilters);

        // Sort
        document.getElementById("sortSelect").addEventListener("change", applyFilters);

        // View toggle (cosmetic)
        document.querySelectorAll(".view-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll(".view-btn").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
            });
        });

        // Map style toggle
        document.getElementById("styleMapa").addEventListener("click", function() {
            this.classList.add("active");
            document.getElementById("styleSat").classList.remove("active");
            document.querySelector(".map-svg").style.filter = "";
        });
        document.getElementById("styleSat").addEventListener("click", function() {
            this.classList.add("active");
            document.getElementById("styleMapa").classList.remove("active");
            document.querySelector(".map-svg").style.filter = "saturate(0.4) brightness(0.85)";
        });

        // Location btn (demo)
        document.getElementById("locBtn").addEventListener("click", function() {
            const input = document.getElementById("searchInput");
            input.value = "Av. Paulista, São Paulo — SP";
            input.dispatchEvent(new Event("input"));
        });

        /* ============================================================
           MODAL
           ============================================================ */
        const TIME_SLOTS = ["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "14:00", "14:30", "15:00",
            "15:30", "16:00", "16:30"
        ];
        const UNAVAILABLE = new Set(["09:00", "10:30", "14:00"]);

        function openModal(id) {
            const c = clinics.find(x => x.id === id);
            if (!c) return;
            scheduleTarget = c;
            document.getElementById("modalPhoto").src = c.photo;
            document.getElementById("modalClinicName").textContent = c.name;
            document.getElementById("modalClinicAddr").textContent = c.address;
            document.getElementById("mDate").value = new Date().toISOString().split("T")[0];
            buildTimeSlots();
            document.getElementById("overlay").classList.add("open");
            document.body.style.overflow = "hidden";
        }

        function buildTimeSlots() {
            let selected = null;
            document.getElementById("timeSlots").innerHTML = TIME_SLOTS.map(t => {
                const una = UNAVAILABLE.has(t);
                return `<button class="time-slot ${una?"unavailable":""}" data-t="${t}" ${una?"disabled":""}>${t}</button>`;
            }).join("");

            document.querySelectorAll(".time-slot:not(.unavailable)").forEach(btn => {
                btn.addEventListener("click", () => {
                    document.querySelectorAll(".time-slot").forEach(b => b.classList.remove("selected"));
                    btn.classList.add("selected");
                    selected = btn.dataset.t;
                });
            });
        }

        function closeModal() {
            document.getElementById("overlay").classList.remove("open");
            document.body.style.overflow = "";
        }
        document.getElementById("closeModal").addEventListener("click", closeModal);
        document.getElementById("cancelModal").addEventListener("click", closeModal);
        document.getElementById("overlay").addEventListener("click", e => {
            if (e.target === document.getElementById("overlay")) closeModal();
        });
        document.addEventListener("keydown", e => {
            if (e.key === "Escape") closeModal();
        });

        document.getElementById("confirmBtn").addEventListener("click", () => {
            const pet = document.getElementById("mPet").value;
            const svc = document.getElementById("mService").value;
            const date = document.getElementById("mDate").value;
            const slot = document.querySelector(".time-slot.selected");

            const invalid = [];
            if (!pet) invalid.push("mPet");
            if (!svc) invalid.push("mService");
            if (!date) invalid.push("mDate");

            if (invalid.length || !slot) {
                invalid.forEach(id => {
                    const el = document.getElementById(id);
                    el.style.borderColor = "var(--red)";
                    setTimeout(() => el.style.borderColor = "", 1800);
                });
                if (!slot) {
                    document.getElementById("timeSlots").style.outline = "2px solid var(--red)";
                    document.getElementById("timeSlots").style.borderRadius = "8px";
                    setTimeout(() => {
                        document.getElementById("timeSlots").style.outline = "";
                    }, 1800);
                }
                return;
            }

            // Success toast
            const toast = document.createElement("div");
            toast.style.cssText = `
        position:fixed;bottom:28px;right:28px;z-index:999;
        background:#0d0f1a;color:#fff;
        padding:14px 22px;border-radius:14px;
        font-size:.85rem;font-weight:600;
        display:flex;align-items:center;gap:10px;
        box-shadow:0 8px 32px rgba(0,0,0,0.22);
        animation:cardIn .35s ease both;
      `;
            toast.innerHTML =
                `<i class="ph ph-check-circle" style="font-size:20px;color:#4ade80;"></i> Agendamento confirmado!`;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = "0";
                toast.style.transition = "opacity .4s";
                setTimeout(() => toast.remove(), 400);
            }, 3200);

            closeModal();
        });

        /* ============================================================
           INIT
           ============================================================ */
        applyFilters();
    </script>
</body>

</html>
