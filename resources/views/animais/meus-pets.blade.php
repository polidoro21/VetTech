<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VetTech — Meus Pets</title>

    <!-- Google Fonts: DM Sans + DM Serif Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet" />

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/index.js" defer></script>

    <style>
        /* ============================================================
       DESIGN TOKENS — CSS Custom Properties
       ============================================================ */
        :root {
            /* Palette */
            --bg: #f5f6fa;
            --surface: #ffffff;
            --surface-alt: #f0f2f8;
            --sidebar-bg: #0d0f1a;
            --sidebar-text: #8a90a8;
            --sidebar-hover: #1a1e30;
            --sidebar-active: #1e2438;
            --accent: #3b6ef8;
            --accent-glow: rgba(59, 110, 248, 0.22);
            --accent-light: #eef2ff;
            --green: #22c55e;
            --green-light: #dcfce7;
            --amber: #f59e0b;
            --amber-light: #fef3c7;
            --red: #ef4444;
            --text-primary: #0d0f1a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --border-focus: rgba(59, 110, 248, 0.45);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 28px;
            --shadow-card: 0 2px 12px rgba(0, 0, 0, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
            --shadow-hover: 0 12px 40px rgba(59, 110, 248, 0.14), 0 4px 16px rgba(0, 0, 0, 0.08);
            --shadow-modal: 0 24px 80px rgba(0, 0, 0, 0.18);
            --transition: 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ============================================================
       RESET & BASE
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
            overflow-x: hidden;
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
            z-index: 100;
            padding: 0 0 24px;
        }

        /* Logo */
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 28px 24px 24px;
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
            box-shadow: 0 0 16px rgba(59, 110, 248, 0.4);
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
            font-weight: 600;
            background: rgba(59, 110, 248, 0.25);
            color: #8ab4ff;
            padding: 2px 7px;
            border-radius: 99px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* Nav Section Label */
        .nav-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.2);
            padding: 20px 24px 8px;
        }

        /* Nav Links */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 16px;
            margin: 2px 12px;
            border-radius: var(--radius-sm);
            color: var(--sidebar-text);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background var(--transition), color var(--transition);
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

        .nav-link .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: #fff;
            font-size: 0.625rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 99px;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background var(--transition);
        }

        .sidebar-user:hover {
            background: var(--sidebar-hover);
        }

        .sidebar-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b6ef8, #7c3aed);
            display: grid;
            place-items: center;
            font-size: 13px;
            color: #fff;
            font-weight: 600;
        }

        .sidebar-user-info {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: #d0d5e8;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 0.68rem;
            color: var(--sidebar-text);
        }

        /* ============================================================
       MAIN CONTENT AREA
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
            gap: 16px;
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
            color: var(--text-primary);
            letter-spacing: -0.02em;
            white-space: nowrap;
        }

        /* Search */
        .search-wrap {
            flex: 1;
            max-width: 360px;
            position: relative;
        }

        .search-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 16px;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 9px 14px 9px 38px;
            border: 1.5px solid var(--border);
            border-radius: 99px;
            background: var(--surface-alt);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            color: var(--text-primary);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition), background var(--transition);
        }

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .search-input:focus {
            border-color: var(--accent);
            background: var(--surface);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        /* Topbar right */
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
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
            font-size: 18px;
            transition: background var(--transition), color var(--transition), border-color var(--transition), box-shadow var(--transition);
            position: relative;
        }

        .icon-btn:hover {
            background: var(--accent-light);
            color: var(--accent);
            border-color: transparent;
        }

        .icon-btn .notif-dot {
            width: 7px;
            height: 7px;
            background: var(--red);
            border-radius: 50%;
            border: 2px solid var(--surface);
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
            transition: box-shadow var(--transition), border-color var(--transition);
        }

        .user-avatar-btn:hover {
            box-shadow: 0 0 0 3px var(--accent-glow);
            border-color: var(--accent);
        }

        /* Add Pet Button */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 99px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background var(--transition), box-shadow var(--transition), transform var(--transition);
            white-space: nowrap;
        }

        .btn-add:hover {
            background: #2d5ee8;
            box-shadow: 0 4px 20px rgba(59, 110, 248, 0.4);
            transform: translateY(-1px);
        }

        .btn-add:active {
            transform: translateY(0);
        }

        .btn-add i {
            font-size: 17px;
        }

        /* ============================================================
       PAGE CONTENT
       ============================================================ */
        .content {
            flex: 1;
            padding: 32px;
        }

        /* Stats bar */
        .stats-bar {
            display: flex;
            gap: 16px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .stat-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 99px;
            padding: 7px 16px 7px 10px;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            transition: background var(--transition), border-color var(--transition), color var(--transition), box-shadow var(--transition);
        }

        .stat-chip:hover {
            border-color: var(--accent);
            color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .stat-chip.active {
            background: var(--accent-light);
            border-color: var(--accent);
            color: var(--accent);
            font-weight: 600;
        }

        .stat-chip .chip-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .stat-chip .chip-count {
            margin-left: 4px;
            background: var(--surface-alt);
            border-radius: 99px;
            padding: 1px 7px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .stat-chip.active .chip-count {
            background: rgba(59, 110, 248, 0.15);
        }

        /* ============================================================
       PET GRID
       ============================================================ */
        .pets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 22px;
        }

        /* ============================================================
       PET CARD
       ============================================================ */
        .pet-card {
            background: var(--surface);
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            cursor: pointer;
            transition:
                transform var(--transition),
                box-shadow var(--transition),
                border-color var(--transition);
            display: flex;
            flex-direction: column;
        }

        .pet-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(59, 110, 248, 0.35);
        }

        /* Card Photo */
        .pet-photo-wrap {
            position: relative;
            height: 185px;
            overflow: hidden;
            background: var(--surface-alt);
        }

        .pet-photo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pet-card:hover .pet-photo-wrap img {
            transform: scale(1.05);
        }

        /* Status Badge on photo */
        .pet-status-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 700;
            backdrop-filter: blur(8px);
            letter-spacing: 0.03em;
        }

        .pet-status-badge.healthy {
            background: rgba(220, 252, 231, 0.92);
            color: #15803d;
        }

        .pet-status-badge.attention {
            background: rgba(254, 243, 199, 0.92);
            color: #b45309;
        }

        .pet-status-badge .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .pet-status-badge.healthy .dot {
            background: var(--green);
        }

        .pet-status-badge.attention .dot {
            background: var(--amber);
        }

        /* Species tag on photo */
        .pet-species-tag {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(13, 15, 26, 0.6);
            color: rgba(255, 255, 255, 0.92);
            font-size: 0.68rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 99px;
            backdrop-filter: blur(8px);
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* Card Body */
        .pet-body {
            padding: 18px 18px 0;
        }

        .pet-name {
            font-family: 'DM Serif Display', serif;
            font-size: 1.22rem;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            margin-bottom: 3px;
        }

        .pet-breed {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        /* Pet Stats Row */
        .pet-stats {
            display: flex;
            gap: 6px;
            margin-top: 14px;
            flex-wrap: wrap;
        }

        .pet-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 0.72rem;
            font-weight: 600;
            background: var(--surface-alt);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        .pet-tag i {
            font-size: 13px;
        }

        .pet-tag.accent {
            background: var(--accent-light);
            color: var(--accent);
            border-color: transparent;
        }

        /* Next appointment */
        .pet-appointment {
            margin-top: 14px;
            padding: 10px 12px;
            background: var(--surface-alt);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--border);
        }

        .pet-appointment i {
            font-size: 15px;
            color: var(--accent);
            flex-shrink: 0;
        }

        .appt-label {
            font-size: 0.68rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .appt-date {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Card Actions */
        .pet-actions {
            padding: 14px 18px 18px;
            display: flex;
            gap: 8px;
            margin-top: 14px;
        }

        .btn-outline {
            flex: 1;
            padding: 8px 10px;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--border);
            background: transparent;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: background var(--transition), color var(--transition), border-color var(--transition), box-shadow var(--transition);
        }

        .btn-outline i {
            font-size: 14px;
        }

        .btn-outline:hover {
            background: var(--surface-alt);
            color: var(--text-primary);
            border-color: #c5cbdb;
        }

        .btn-primary-sm {
            flex: 1;
            padding: 8px 10px;
            border-radius: var(--radius-md);
            border: none;
            background: var(--accent);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: background var(--transition), box-shadow var(--transition), transform var(--transition);
        }

        .btn-primary-sm i {
            font-size: 14px;
        }

        .btn-primary-sm:hover {
            background: #2d5ee8;
            box-shadow: 0 4px 14px rgba(59, 110, 248, 0.38);
            transform: translateY(-1px);
        }

        /* ============================================================
       EMPTY STATE (if no pets)
       ============================================================ */
        .empty-state {
            grid-column: 1/-1;
            padding: 64px 32px;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 56px;
            opacity: 0.3;
            margin-bottom: 12px;
            display: block;
        }

        .empty-state h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }

        .empty-state p {
            font-size: 0.85rem;
        }

        /* ============================================================
       MODAL OVERLAY
       ============================================================ */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(6px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        /* Modal Box */
        .modal {
            background: var(--surface);
            border-radius: var(--radius-xl);
            width: 100%;
            max-width: 520px;
            box-shadow: var(--shadow-modal);
            overflow: hidden;
            transform: translateY(20px) scale(0.97);
            transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.25s ease;
            opacity: 0;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .modal-overlay.open .modal {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        /* Modal Header */
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 28px 20px;
            border-bottom: 1px solid var(--border);
        }

        .modal-title-block {}

        .modal-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
        }

        .modal-subtitle {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .modal-close {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: none;
            cursor: pointer;
            display: grid;
            place-items: center;
            color: var(--text-muted);
            font-size: 18px;
            transition: background var(--transition), color var(--transition), border-color var(--transition);
        }

        .modal-close:hover {
            background: #fee2e2;
            color: var(--red);
            border-color: transparent;
        }

        /* Modal Body */
        .modal-body {
            padding: 24px 28px;
            overflow-y: auto;
            flex: 1;
        }

        /* Photo Upload Area */
        .upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--radius-lg);
            padding: 28px 16px;
            text-align: center;
            cursor: pointer;
            transition: border-color var(--transition), background var(--transition), box-shadow var(--transition);
            position: relative;
            overflow: hidden;
            background: var(--surface-alt);
            margin-bottom: 22px;
        }

        .upload-area:hover {
            border-color: var(--accent);
            background: var(--accent-light);
            box-shadow: 0 0 0 4px var(--accent-glow);
        }

        .upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .upload-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 10px;
            display: none;
            border: 3px solid var(--accent);
            box-shadow: 0 0 0 4px var(--accent-glow);
        }

        .upload-area.has-image .upload-preview {
            display: block;
        }

        .upload-area.has-image .upload-placeholder {
            display: none;
        }

        .upload-placeholder i {
            font-size: 36px;
            color: var(--accent);
            opacity: 0.6;
            display: block;
            margin-bottom: 8px;
        }

        .upload-placeholder p {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 3px;
        }

        .upload-placeholder span {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        /* Form Grid */
        .form-grid {
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
            font-size: 0.76rem;
            font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: 0.01em;
        }

        .form-input {
            padding: 10px 13px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
            appearance: none;
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        /* Sex selector */
        .sex-selector {
            display: flex;
            gap: 8px;
        }

        .sex-option {
            flex: 1;
            padding: 9px 8px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: var(--surface);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all var(--transition);
        }

        .sex-option i {
            font-size: 15px;
        }

        .sex-option:hover {
            background: var(--surface-alt);
        }

        .sex-option.selected {
            background: var(--accent-light);
            color: var(--accent);
            border-color: var(--accent);
        }

        /* Modal Footer */
        .modal-footer {
            padding: 18px 28px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            padding: 10px 22px;
            border-radius: 99px;
            border: 1.5px solid var(--border);
            background: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: background var(--transition), color var(--transition), border-color var(--transition);
        }

        .btn-cancel:hover {
            background: var(--surface-alt);
            color: var(--text-primary);
            border-color: #c5cbdb;
        }

        .btn-save {
            padding: 10px 26px;
            border-radius: 99px;
            border: none;
            background: var(--accent);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: background var(--transition), box-shadow var(--transition), transform var(--transition);
        }

        .btn-save:hover {
            background: #2d5ee8;
            box-shadow: 0 4px 16px rgba(59, 110, 248, 0.4);
            transform: translateY(-1px);
        }

        .btn-save i {
            font-size: 16px;
        }

        /* ============================================================
       CARD ENTRANCE ANIMATION
       ============================================================ */
        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pet-card {
            animation: cardIn 0.4s ease both;
        }

        .pet-card:nth-child(1) {
            animation-delay: 0.04s;
        }

        .pet-card:nth-child(2) {
            animation-delay: 0.10s;
        }

        .pet-card:nth-child(3) {
            animation-delay: 0.16s;
        }

        .pet-card:nth-child(4) {
            animation-delay: 0.22s;
        }

        .pet-card:nth-child(5) {
            animation-delay: 0.28s;
        }

        .pet-card:nth-child(6) {
            animation-delay: 0.34s;
        }

        /* ============================================================
       SCROLLBAR
       ============================================================ */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        /* ============================================================
       RESPONSIVE
       ============================================================ */
        @media (max-width: 900px) {
            .sidebar {
                width: 60px;
            }

            .logo-text,
            .nav-label,
            .nav-link span,
            .sidebar-user-info,
            .logo-badge {
                display: none;
            }

            .nav-link {
                padding: 11px;
                justify-content: center;
                margin: 2px 6px;
            }

            .sidebar-logo {
                padding: 20px 12px;
                justify-content: center;
            }

            .main {
                margin-left: 60px;
            }

            .sidebar-user {
                justify-content: center;
            }
        }

        @media (max-width: 640px) {
            .content {
                padding: 20px 16px;
            }

            .topbar {
                padding: 14px 16px;
                gap: 10px;
            }

            .topbar-title {
                font-size: 1.1rem;
            }

            .btn-add span {
                display: none;
            }

            .form-grid {
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

        <!-- Logo -->
        <div class="sidebar-logo">
            <div class="logo-mark">🐾</div>
            <span class="logo-text">VetTech</span>
            <span class="logo-badge">Pro</span>
        </div>

        <!-- Main Navigation -->
        <span class="nav-label">Principal</span>

        <a class="nav-link" href="#">
            <i class="ph ph-house"></i>
            <span>Dashboard</span>
        </a>
        <a class="nav-link active" href="#">
            <i class="ph ph-paw-print"></i>
            <span>Meus Pets</span>
        </a>
        <a class="nav-link" href="#">
            <i class="ph ph-calendar-check"></i>
            <span>Consultas</span>
            <span class="nav-badge">3</span>
        </a>
        <a class="nav-link" href="#">
            <i class="ph ph-stethoscope"></i>
            <span>Histórico Médico</span>
        </a>
        <a class="nav-link" href="#">
            <i class="ph ph-pill"></i>
            <span>Medicamentos</span>
        </a>
        <a class="nav-link" href="#">
            <i class="ph ph-syringe"></i>
            <span>Vacinação</span>
        </a>

        <!-- Secondary -->
        <span class="nav-label">Gerenciar</span>

        <a class="nav-link" href="#">
            <i class="ph ph-chart-line"></i>
            <span>Relatórios</span>
        </a>
        <a class="nav-link" href="#">
            <i class="ph ph-bell"></i>
            <span>Notificações</span>
            <span class="nav-badge">5</span>
        </a>
        <a class="nav-link" href="#">
            <i class="ph ph-gear"></i>
            <span>Configurações</span>
        </a>

        <!-- User -->
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">JS</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">João Silva</div>
                    <div class="sidebar-user-role">Tutor Verificado</div>
                </div>
                <i class="ph ph-caret-up-down" style="color:#8a90a8;font-size:14px;"></i>
            </div>
        </div>

    </aside>

    <!-- ============================================================
       MAIN
       ============================================================ -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <h1 class="topbar-title">Meus Pets</h1>

            <!-- Search -->
            <div class="search-wrap">
                <i class="ph ph-magnifying-glass"></i>
                <input class="search-input" type="text" placeholder="Buscar por nome, raça, espécie…"
                    id="searchInput" />
            </div>

            <!-- Right Actions -->
            <div class="topbar-right">
                <button class="icon-btn" title="Notificações">
                    <i class="ph ph-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <button class="icon-btn" title="Ajuda">
                    <i class="ph ph-question"></i>
                </button>
                <div class="user-avatar-btn" title="Perfil">JS</div>

                <!-- Add Pet CTA -->
                <button class="btn-add" id="openModalBtn">
                    <i class="ph ph-plus"></i>
                    <span>Adicionar Pet</span>
                </button>
            </div>
        </header>

        <!-- CONTENT -->
        <section class="content">

            <!-- Filter chips / stats -->
            <div class="stats-bar">
                <div class="stat-chip active" data-filter="all">
                    <span class="chip-dot" style="background:#94a3b8;"></span>
                    Todos
                    <span class="chip-count" id="countAll">6</span>
                </div>
                <div class="stat-chip" data-filter="healthy">
                    <span class="chip-dot" style="background:var(--green);"></span>
                    Saudável
                    <span class="chip-count" id="countHealthy">4</span>
                </div>
                <div class="stat-chip" data-filter="attention">
                    <span class="chip-dot" style="background:var(--amber);"></span>
                    Atenção
                    <span class="chip-count" id="countAttention">2</span>
                </div>
                <div class="stat-chip" data-filter="dog">
                    <span class="chip-dot" style="background:#8b5cf6;"></span>
                    Cães
                    <span class="chip-count" id="countDog">3</span>
                </div>
                <div class="stat-chip" data-filter="cat">
                    <span class="chip-dot" style="background:#f472b6;"></span>
                    Gatos
                    <span class="chip-count" id="countCat">2</span>
                </div>
            </div>

            <!-- Pet Cards Grid -->
            <div class="pets-grid" id="petsGrid">
                <!-- Cards are injected by JavaScript below -->
            </div>

        </section>
    </main>

    <!-- ============================================================
       MODAL — Cadastrar Pet
       ============================================================ -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">

            <!-- Header -->
            <div class="modal-header">
                <div class="modal-title-block">
                    <div class="modal-title" id="modalTitle">Adicionar Novo Pet</div>
                    <div class="modal-subtitle">Preencha os dados do seu companheiro 🐾</div>
                </div>
                <button class="modal-close" id="closeModalBtn" aria-label="Fechar modal">
                    <i class="ph ph-x"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Photo Upload -->
                <div class="upload-area" id="uploadArea">
                    <input type="file" accept="image/*" id="photoInput" />
                    <img class="upload-preview" id="uploadPreview" alt="Foto do pet" />
                    <div class="upload-placeholder">
                        <i class="ph ph-camera"></i>
                        <p>Clique para adicionar foto</p>
                        <span>PNG, JPG, WEBP • até 5MB</span>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="form-grid">

                    <!-- Nome -->
                    <div class="form-group full">
                        <label class="form-label" for="petName">Nome do Pet *</label>
                        <input class="form-input" type="text" id="petName"
                            placeholder="Ex: Luna, Thor, Mel…" />
                    </div>

                    <!-- Espécie -->
                    <div class="form-group">
                        <label class="form-label" for="petSpecies">Espécie *</label>
                        <select class="form-input" id="petSpecies">
                            <option value="">Selecione…</option>
                            <option value="dog">Cão</option>
                            <option value="cat">Gato</option>
                            <option value="bird">Ave</option>
                            <option value="rabbit">Coelho</option>
                            <option value="other">Outro</option>
                        </select>
                    </div>

                    <!-- Raça -->
                    <div class="form-group">
                        <label class="form-label" for="petBreed">Raça</label>
                        <input class="form-input" type="text" id="petBreed"
                            placeholder="Ex: Golden Retriever" />
                    </div>

                    <!-- Idade -->
                    <div class="form-group">
                        <label class="form-label" for="petAge">Idade</label>
                        <input class="form-input" type="text" id="petAge" placeholder="Ex: 2 anos" />
                    </div>

                    <!-- Peso -->
                    <div class="form-group">
                        <label class="form-label" for="petWeight">Peso (kg)</label>
                        <input class="form-input" type="number" id="petWeight" placeholder="Ex: 8.5"
                            min="0" step="0.1" />
                    </div>

                    <!-- Sexo -->
                    <div class="form-group full">
                        <label class="form-label">Sexo</label>
                        <div class="sex-selector">
                            <button class="sex-option" data-sex="M" id="sexM">
                                <i class="ph ph-gender-male"></i> Macho
                            </button>
                            <button class="sex-option" data-sex="F" id="sexF">
                                <i class="ph ph-gender-female"></i> Fêmea
                            </button>
                            <button class="sex-option" data-sex="N" id="sexN">
                                <i class="ph ph-gender-neuter"></i> Castrado(a)
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button class="btn-cancel" id="cancelBtn">Cancelar</button>
                <button class="btn-save" id="saveBtn">
                    <i class="ph ph-paw-print"></i>
                    Cadastrar Pet
                </button>
            </div>

        </div>
    </div>

    <!-- ============================================================
       JAVASCRIPT — Data, Rendering, Interaction
       ============================================================ -->
    <script>
        /* ----------------------------------------------------------
           DATA — Pet list (mock)
        ---------------------------------------------------------- */
        const pets = [{
                id: 1,
                name: "Luna",
                species: "cat",
                speciesLabel: "Gato",
                breed: "Persa",
                age: "3 anos",
                weight: "4,2 kg",
                status: "healthy",
                statusLabel: "Saudável",
                nextAppointment: "23 mai 2025 — 14h00",
                photo: "https://images.unsplash.com/photo-1529778873920-4da4926a72c2?w=600&q=80",
                sex: "F",
                filter: ["all", "healthy", "cat"]
            },
            {
                id: 2,
                name: "Thor",
                species: "dog",
                speciesLabel: "Cão",
                breed: "Golden Retriever",
                age: "5 anos",
                weight: "32 kg",
                status: "attention",
                statusLabel: "Atenção",
                nextAppointment: "18 mai 2025 — 09h30",
                photo: "https://images.unsplash.com/photo-1552053831-71594a27632d?w=600&q=80",
                sex: "M",
                filter: ["all", "attention", "dog"]
            },
            {
                id: 3,
                name: "Mel",
                species: "dog",
                speciesLabel: "Cão",
                breed: "Beagle",
                age: "2 anos",
                weight: "11 kg",
                status: "healthy",
                statusLabel: "Saudável",
                nextAppointment: "30 mai 2025 — 11h00",
                photo: "https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?w=600&q=80",
                sex: "F",
                filter: ["all", "healthy", "dog"]
            },
            {
                id: 4,
                name: "Simba",
                species: "cat",
                speciesLabel: "Gato",
                breed: "Maine Coon",
                age: "4 anos",
                weight: "7,8 kg",
                status: "healthy",
                statusLabel: "Saudável",
                nextAppointment: "05 jun 2025 — 16h00",
                photo: "https://images.unsplash.com/photo-1574158622682-e40e69881006?w=600&q=80",
                sex: "M",
                filter: ["all", "healthy", "cat"]
            },
            {
                id: 5,
                name: "Bolt",
                species: "dog",
                speciesLabel: "Cão",
                breed: "Husky Siberiano",
                age: "1 ano",
                weight: "18 kg",
                status: "attention",
                statusLabel: "Atenção",
                nextAppointment: "20 mai 2025 — 10h00",
                photo: "https://images.unsplash.com/photo-1589941013453-ec89f33b5e95?w=600&q=80",
                sex: "M",
                filter: ["all", "attention", "dog"]
            },
            {
                id: 6,
                name: "Nina",
                species: "rabbit",
                speciesLabel: "Coelho",
                breed: "Mini Rex",
                age: "1 ano",
                weight: "1,8 kg",
                status: "healthy",
                statusLabel: "Saudável",
                nextAppointment: "12 jun 2025 — 13h30",
                photo: "https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=600&q=80",
                sex: "F",
                filter: ["all", "healthy"]
            }
        ];

        /* ----------------------------------------------------------
            RENDER — Build a pet card HTML string
        ---------------------------------------------------------- */
        function buildCard(pet) {
            const statusClass = pet.status === "healthy" ? "healthy" : "attention";
            const sexIcon = pet.sex === "M" ?
                '<i class="ph ph-gender-male"></i>' :
                pet.sex === "F" ?
                '<i class="ph ph-gender-female"></i>' :
                '<i class="ph ph-gender-neuter"></i>';

            return `
        <article class="pet-card" data-filter="${pet.filter.join(" ")}">

          <!-- Photo -->
          <div class="pet-photo-wrap">
            <img src="${pet.photo}" alt="Foto de ${pet.name}" loading="lazy" />
            <span class="pet-status-badge ${statusClass}">
              <span class="dot"></span>
              ${pet.statusLabel}
            </span>
            <span class="pet-species-tag">${pet.speciesLabel}</span>
          </div>

          <!-- Body -->
          <div class="pet-body">
            <div class="pet-name">${pet.name}</div>
            <div class="pet-breed">${pet.breed}</div>

            <!-- Tags -->
            <div class="pet-stats">
              <span class="pet-tag accent">
                <i class="ph ph-cake"></i> ${pet.age}
              </span>
              <span class="pet-tag">
                <i class="ph ph-scales"></i> ${pet.weight}
              </span>
              <span class="pet-tag">
                ${sexIcon} ${pet.sex === "M" ? "Macho" : pet.sex === "F" ? "Fêmea" : "Castrado(a)"}
              </span>
            </div>

            <!-- Next Appointment -->
            <div class="pet-appointment">
              <i class="ph ph-calendar-check"></i>
              <div>
                <div class="appt-label">Próxima consulta</div>
                <div class="appt-date">${pet.nextAppointment}</div>
              </div>
            </div>
          </div>

          <!-- Actions -->
          <div class="pet-actions">
            <button class="btn-outline">
              <i class="ph ph-user"></i>
              Ver perfil
            </button>
            <button class="btn-primary-sm">
              <i class="ph ph-file-text"></i>
              Histórico
            </button>
          </div>

        </article>
      `;
        }

        /* ----------------------------------------------------------
           RENDER — Paint grid
        ---------------------------------------------------------- */
        function renderGrid(filter = "all") {
            const grid = document.getElementById("petsGrid");
            const filtered = pets.filter(p => p.filter.includes(filter));

            if (filtered.length === 0) {
                grid.innerHTML = `
          <div class="empty-state">
            <i class="ph ph-paw-print"></i>
            <h3>Nenhum pet encontrado</h3>
            <p>Tente outro filtro ou adicione um novo pet.</p>
          </div>`;
                return;
            }

            grid.innerHTML = filtered.map(buildCard).join("");
        }

        /* ----------------------------------------------------------
           FILTER CHIPS
        ---------------------------------------------------------- */
        let activeFilter = "all";

        document.querySelectorAll(".stat-chip").forEach(chip => {
            chip.addEventListener("click", () => {
                document.querySelectorAll(".stat-chip").forEach(c => c.classList.remove("active"));
                chip.classList.add("active");
                activeFilter = chip.dataset.filter;
                applyFilters();
            });
        });

        /* ----------------------------------------------------------
           SEARCH
        ---------------------------------------------------------- */
        document.getElementById("searchInput").addEventListener("input", applyFilters);

        function applyFilters() {
            const query = document.getElementById("searchInput").value.toLowerCase().trim();
            const grid = document.getElementById("petsGrid");

            const filtered = pets.filter(p => {
                const matchFilter = p.filter.includes(activeFilter);
                const matchSearch = !query ||
                    p.name.toLowerCase().includes(query) ||
                    p.breed.toLowerCase().includes(query) ||
                    p.speciesLabel.toLowerCase().includes(query);
                return matchFilter && matchSearch;
            });

            if (filtered.length === 0) {
                grid.innerHTML = `
          <div class="empty-state">
            <i class="ph ph-magnifying-glass"></i>
            <h3>Nenhum resultado encontrado</h3>
            <p>Tente um nome, raça ou espécie diferente.</p>
          </div>`;
                return;
            }

            grid.innerHTML = filtered.map(buildCard).join("");
        }

        /* ----------------------------------------------------------
           MODAL — Open / Close
        ---------------------------------------------------------- */
        const overlay = document.getElementById("modalOverlay");
        const openBtn = document.getElementById("openModalBtn");
        const closeBtn = document.getElementById("closeModalBtn");
        const cancelBtn = document.getElementById("cancelBtn");

        function openModal() {
            overlay.classList.add("open");
            document.body.style.overflow = "hidden";
        }

        function closeModal() {
            overlay.classList.remove("open");
            document.body.style.overflow = "";
        }

        openBtn.addEventListener("click", openModal);
        closeBtn.addEventListener("click", closeModal);
        cancelBtn.addEventListener("click", closeModal);

        /* Close on backdrop click */
        overlay.addEventListener("click", e => {
            if (e.target === overlay) closeModal();
        });

        /* Close on Escape */
        document.addEventListener("keydown", e => {
            if (e.key === "Escape") closeModal();
        });

        /* ----------------------------------------------------------
           MODAL — Photo Upload Preview
        ---------------------------------------------------------- */
        const photoInput = document.getElementById("photoInput");
        const uploadArea = document.getElementById("uploadArea");
        const uploadPreview = document.getElementById("uploadPreview");

        photoInput.addEventListener("change", () => {
            const file = photoInput.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                uploadPreview.src = e.target.result;
                uploadArea.classList.add("has-image");
            };
            reader.readAsDataURL(file);
        });

        /* ----------------------------------------------------------
           MODAL — Sex selector
        ---------------------------------------------------------- */
        let selectedSex = null;

        document.querySelectorAll(".sex-option").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll(".sex-option").forEach(b => b.classList.remove("selected"));
                btn.classList.add("selected");
                selectedSex = btn.dataset.sex;
            });
        });

        /* ----------------------------------------------------------
           MODAL — Save (demo: add card to grid)
        ---------------------------------------------------------- */
        document.getElementById("saveBtn").addEventListener("click", () => {
            const name = document.getElementById("petName").value.trim();
            const species = document.getElementById("petSpecies").value;
            const breed = document.getElementById("petBreed").value.trim();
            const age = document.getElementById("petAge").value.trim();
            const weight = document.getElementById("petWeight").value.trim();

            if (!name || !species) {
                document.getElementById("petName").focus();
                document.getElementById("petName").style.borderColor = "var(--red)";
                setTimeout(() => {
                    document.getElementById("petName").style.borderColor = "";
                }, 1800);
                return;
            }

            const speciesMap = {
                dog: "Cão",
                cat: "Gato",
                bird: "Ave",
                rabbit: "Coelho",
                other: "Outro"
            };

            const newPet = {
                id: Date.now(),
                name,
                species,
                speciesLabel: speciesMap[species] || "Outro",
                breed: breed || "Raça não informada",
                age: age || "—",
                weight: weight ? `${weight} kg` : "—",
                status: "healthy",
                statusLabel: "Saudável",
                nextAppointment: "A agendar",
                photo: uploadPreview.src ||
                    "https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=600&q=80",
                sex: selectedSex || "M",
                filter: ["all", "healthy", species]
            };

            pets.unshift(newPet);
            updateCounts();
            applyFilters();
            closeModal();
            resetModal();
        });

        /* ----------------------------------------------------------
           HELPERS
        ---------------------------------------------------------- */
        function updateCounts() {
            document.getElementById("countAll").textContent = pets.length;
            document.getElementById("countHealthy").textContent = pets.filter(p => p.status === "healthy").length;
            document.getElementById("countAttention").textContent = pets.filter(p => p.status === "attention").length;
            document.getElementById("countDog").textContent = pets.filter(p => p.species === "dog").length;
            document.getElementById("countCat").textContent = pets.filter(p => p.species === "cat").length;
        }

        function resetModal() {
            document.getElementById("petName").value = "";
            document.getElementById("petSpecies").value = "";
            document.getElementById("petBreed").value = "";
            document.getElementById("petAge").value = "";
            document.getElementById("petWeight").value = "";
            uploadPreview.src = "";
            uploadArea.classList.remove("has-image");
            photoInput.value = "";
            document.querySelectorAll(".sex-option").forEach(b => b.classList.remove("selected"));
            selectedSex = null;
        }

        /* ----------------------------------------------------------
           INIT
        ---------------------------------------------------------- */
        renderGrid("all");
        updateCounts();
    </script>
</body>

</html>
