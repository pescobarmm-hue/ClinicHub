<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicHub | Gestión Médica Premium</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --blue-primary: #2563eb;
            --blue-secondary: #4f46e5;
            --blue-light: #dbeafe;
            --slate-dark: #0f172a;
        }

        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; }
        [x-cloak] { display: none !important; }

        /* ===== HERO BACKGROUND ===== */
        .hero-section {
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }

        .hero-bg-image {
            position: absolute;
            inset: 0;
            background-image: url('/descarga.jpg');
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            z-index: 0;
        }

        /* Overlay azul premium sobre la imagen */
        .hero-bg-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(219, 234, 254, 0.88) 0%,
                rgba(238, 242, 255, 0.82) 40%,
                rgba(255, 255, 255, 0.75) 70%,
                rgba(219, 234, 254, 0.85) 100%
            );
            z-index: 1;
        }

        /* Overlay blanco abajo para blend con siguiente sección */
        .hero-bg-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to bottom, transparent, rgba(248, 250, 252, 0.95) 80%, #f8fafc);
            z-index: 2;
        }

        /* ===== HEX FLOATING PARTICLES ===== */
        .hex-particles {
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
            overflow: hidden;
        }

        .hex-particle {
            position: absolute;
            opacity: 0;
            animation: hexFloat linear infinite;
        }

        .hex-particle svg polygon {
            fill: none;
            stroke-width: 1.5;
        }

        @keyframes hexFloat {
            0%   { transform: translateY(110vh) rotate(0deg);   opacity: 0; }
            5%   { opacity: 1; }
            90%  { opacity: 0.6; }
            100% { transform: translateY(-20vh) rotate(180deg); opacity: 0; }
        }

        /* ===== GLOW ORBS ===== */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
            z-index: 3;
        }
        .orb-1 { width: 500px; height: 500px; background: rgba(59,130,246,0.18); top: -10%; left: -10%; animation: orbPulse 8s ease-in-out infinite; }
        .orb-2 { width: 400px; height: 400px; background: rgba(99,102,241,0.14); bottom: 10%; right: -5%; animation: orbPulse 10s ease-in-out infinite 2s; }
        .orb-3 { width: 300px; height: 300px; background: rgba(14,165,233,0.12); top: 40%; left: 40%; animation: orbPulse 7s ease-in-out infinite 4s; }
        @keyframes orbPulse { 0%,100%{transform:scale(1);opacity:0.7;} 50%{transform:scale(1.15);opacity:1;} }

        /* ===== HERO CONTENT Z-INDEX ===== */
        .hero-content { position: relative; z-index: 10; }

        /* ===== NAV GLASSMORPHISM ===== */
        .nav-glass {
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 8px 40px rgba(37,99,235,0.08), 0 2px 0 rgba(255,255,255,0.8) inset;
        }

        /* ===== SHINE BUTTON ===== */
        .shine-btn {
            position: relative;
            overflow: hidden;
        }
        .shine-btn::after {
            content: '';
            position: absolute;
            top: -50%; left: -60%;
            width: 200%; height: 200%;
            background: linear-gradient(115deg, transparent 10%, rgba(255,255,255,0.28) 50%, transparent 90%);
            transform: rotate(25deg) translateX(-100%);
            animation: shineSweep 3s infinite;
        }
        @keyframes shineSweep { 0%{transform:rotate(25deg) translateX(-100%);} 20%,100%{transform:rotate(25deg) translateX(100%);} }

        /* ===== FLOAT CARD ===== */
        .float-card { animation: cardFloat 4s ease-in-out infinite; }
        @keyframes cardFloat { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-12px);} }

        /* ===== FEATURES CARDS ===== */
        .feature-card {
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: default;
        }
        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 24px 64px rgba(37,99,235,0.12);
        }

        /* ===== COUNTER ANIMATION ===== */
        .counter { font-variant-numeric: tabular-nums; }

        /* ===== CHATBOT PREMIUM ===== */
        .chat-window {
            background: linear-gradient(170deg, #0d1117 0%, #0f172a 60%, #1a0a2e 100%);
            border: 1px solid rgba(99,102,241,0.3);
            box-shadow: 0 32px 80px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.05) inset;
        }

        .chat-header {
            background: rgba(255,255,255,0.04);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .chat-bubble-ai {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            color: #e2e8f0;
            border-radius: 16px 16px 16px 4px;
        }

        .chat-bubble-user {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            border-radius: 16px 16px 4px 16px;
            margin-left: auto;
        }

        .chat-input-area {
            background: rgba(255,255,255,0.05);
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .chat-input {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            color: white;
            transition: border-color 0.2s;
        }
        .chat-input:focus { outline: none; border-color: rgba(99,102,241,0.6); box-shadow: 0 0 0 3px rgba(99,102,241,0.15); }
        .chat-input::placeholder { color: rgba(255,255,255,0.3); }

        .chat-send-btn {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            border: none;
            transition: all 0.2s;
        }
        .chat-send-btn:hover { transform: scale(1.08); box-shadow: 0 4px 20px rgba(99,102,241,0.5); }
        .chat-send-btn:disabled { opacity: 0.5; transform: none; }

        .typing-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #6366f1;
            animation: typingBounce 1.2s ease-in-out infinite;
        }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes typingBounce { 0%,80%,100%{transform:translateY(0);opacity:0.4;} 40%{transform:translateY(-6px);opacity:1;} }

        .chat-fab {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            box-shadow: 0 8px 32px rgba(37,99,235,0.45), 0 0 0 3px rgba(99,102,241,0.2);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .chat-fab:hover { transform: scale(1.12); box-shadow: 0 12px 40px rgba(37,99,235,0.55); }

        .ai-badge {
            background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(37,99,235,0.3));
            border: 1px solid rgba(99,102,241,0.4);
        }

        /* ===== IMPACT DARK SECTION ===== */
        .impact-section {
            background: linear-gradient(135deg, #0d1117 0%, #0f172a 50%, #1e1b4b 100%);
            position: relative;
            overflow: hidden;
        }
        .impact-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 60%;
            height: 200%;
            background: radial-gradient(ellipse, rgba(37,99,235,0.15) 0%, transparent 60%);
            pointer-events: none;
        }

        .impact-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s ease;
        }
        .impact-card:hover {
            background: rgba(255,255,255,0.09);
            border-color: rgba(99,102,241,0.4);
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(37,99,235,0.2);
        }

        /* ===== MODAL PREMIUM ===== */
        .modal-backdrop { background: rgba(0,0,0,0.75); backdrop-filter: blur(12px); }
        .modal-glass {
            background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
            box-shadow: 0 40px 120px rgba(0,0,0,0.25);
        }

        /* ===== SCROLL REVEAL ===== */
        .reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ===== PING ===== */
        @keyframes ping { 75%,100%{transform:scale(2);opacity:0;} }
        .animate-ping { animation: ping 1.5s cubic-bezier(0,0,0.2,1) infinite; }

        /* ===== STATS SECTION ===== */
        .stats-section { background: #f8fafc; }

        /* ===== FEATURE ICON GLOW ===== */
        .icon-glow-blue  { box-shadow: 0 8px 24px rgba(37,99,235,0.25); }
        .icon-glow-cyan  { box-shadow: 0 8px 24px rgba(6,182,212,0.25); }
        .icon-glow-indigo{ box-shadow: 0 8px 24px rgba(99,102,241,0.25); }
        .icon-glow-purple{ box-shadow: 0 8px 24px rgba(147,51,234,0.25); }
        .icon-glow-emerald{box-shadow: 0 8px 24px rgba(16,185,129,0.25); }
        .icon-glow-amber { box-shadow: 0 8px 24px rgba(245,158,11,0.25); }

        /* ===== SCROLLBAR ===== */
        .chat-messages::-webkit-scrollbar { width: 4px; }
        .chat-messages::-webkit-scrollbar-track { background: transparent; }
        .chat-messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }

        /* ================================================
           MÓDULOS — HEX BG SECTION
        ================================================ */
        .modulos-section { background: #f8fafc; }

        .modulos-bg-hex {
            position: absolute; inset: 0; z-index: 0;
            background-image: url('/1780627397505_image.png');
            background-size: cover; background-position: center;
            background-repeat: no-repeat;
            opacity: 0.35;
        }
        .modulos-bg-overlay {
            position: absolute; inset: 0; z-index: 1;
            background: linear-gradient(160deg,
                rgba(248,250,252,0.88) 0%,
                rgba(239,246,255,0.82) 35%,
                rgba(248,250,252,0.90) 70%,
                rgba(238,242,255,0.85) 100%
            );
        }
        .modulos-bg-overlay::before {
            content:''; position:absolute; bottom:0; left:0; right:0; height:120px;
            background: linear-gradient(to bottom, transparent, #f8fafc);
        }
        .modulos-orb { position:absolute; border-radius:50%; filter:blur(80px); pointer-events:none; z-index:2; }
        .modulos-orb-1 { width:400px;height:400px;background:rgba(37,99,235,0.10);top:-5%;left:-8%;animation:orbPulse 9s ease-in-out infinite; }
        .modulos-orb-2 { width:350px;height:350px;background:rgba(6,182,212,0.09);bottom:5%;right:-6%;animation:orbPulse 11s ease-in-out infinite 3s; }
        .modulos-orb-3 { width:280px;height:280px;background:rgba(99,102,241,0.08);top:45%;left:45%;animation:orbPulse 8s ease-in-out infinite 6s; }

        /* Pills */
        .mod-pill {
            display:inline-flex; align-items:center; gap:5px;
            font-size:10px; font-weight:800; padding:4px 10px;
            border-radius:999px; letter-spacing:0.04em; text-transform:uppercase;
        }

        /* Module Cards */
        .mod-card {
            position:relative; display:block; border-radius:24px;
            border:1px solid rgba(226,232,240,0.7);
            background:rgba(255,255,255,0.85);
            backdrop-filter:blur(16px);
            -webkit-backdrop-filter:blur(16px);
            overflow:hidden;
            text-decoration:none;
            transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1),
                        box-shadow 0.4s ease,
                        border-color 0.3s ease;
        }
        .mod-card:hover {
            transform: translateY(-10px) scale(1.015);
            box-shadow: 0 28px 70px rgba(37,99,235,0.13), 0 8px 24px rgba(0,0,0,0.06);
            border-color: color-mix(in srgb, var(--accent) 40%, white);
        }
        .mod-card-glow {
            position:absolute; inset:-1px; border-radius:24px; z-index:0;
            background:linear-gradient(135deg,
                color-mix(in srgb, var(--accent-light) 60%, transparent),
                transparent 50%
            );
            opacity:0; transition:opacity 0.4s ease;
        }
        .mod-card:hover .mod-card-glow { opacity:1; }
        .mod-card-inner { position:relative; z-index:1; padding:2rem; }
        .mod-icon-wrap {
            width:60px; height:60px; border-radius:18px;
            display:flex; align-items:center; justify-content:center;
            margin-bottom:1.25rem;
            transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow:0 6px 20px rgba(0,0,0,0.08);
        }
        .mod-card:hover .mod-icon-wrap { transform:scale(1.15) rotate(-5deg); }
        .mod-badge {
            display:inline-block; font-size:10px; font-weight:800;
            padding:3px 10px; border-radius:999px; border:1px solid;
            text-transform:uppercase; letter-spacing:0.06em;
            margin-bottom:0.75rem;
        }
        .mod-title { font-size:1.15rem; font-weight:800; color:#0f172a; margin-bottom:0.6rem; }
        .mod-desc { font-size:0.84rem; color:#64748b; line-height:1.65; margin-bottom:1rem; }
        .mod-features { list-style:none; padding:0; margin:0 0 1rem 0; display:flex; flex-direction:column; gap:0.35rem; }
        .mod-features li { display:flex; align-items:center; gap:6px; font-size:0.78rem; font-weight:600; color:#475569; }
        .mod-cta {
            display:inline-flex; align-items:center; gap:6px;
            font-size:0.78rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em;
            opacity:0; transform:translateY(4px);
            transition:opacity 0.3s ease, transform 0.3s ease;
        }
        .mod-card:hover .mod-cta { opacity:1; transform:translateY(0); }

        /* Trust bar */
        .mod-trust-bar {
            display:flex; align-items:center; justify-content:center; flex-wrap:wrap; gap:0;
            background:rgba(255,255,255,0.8); backdrop-filter:blur(12px);
            border:1px solid rgba(226,232,240,0.8); border-radius:16px;
            padding:1rem 2rem; box-shadow:0 4px 20px rgba(0,0,0,0.05);
        }
        .mod-trust-item {
            display:flex; align-items:center; gap:8px;
            font-size:0.8rem; font-weight:700; color:#475569;
            padding:0 1.5rem;
        }
        .mod-trust-divider { width:1px; height:28px; background:#e2e8f0; }

        /* ================================================
           MÉTRICAS — HEX BG SECTION
        ================================================ */
        .metricas-section { background: #f1f5f9; }

        .metricas-bg-hex {
            position:absolute; inset:0; z-index:0;
            background-image: url('/1780627397505_image.png');
            background-size:cover; background-position:center;
            background-repeat:no-repeat;
            opacity:0.28;
        }
        .metricas-bg-overlay {
            position:absolute; inset:0; z-index:1;
            background: linear-gradient(150deg,
                rgba(241,245,249,0.90) 0%,
                rgba(239,246,255,0.84) 40%,
                rgba(241,245,249,0.92) 100%
            );
        }
        .metricas-orb { position:absolute; border-radius:50%; filter:blur(90px); pointer-events:none; z-index:2; }
        .metricas-orb-1 { width:500px;height:500px;background:rgba(37,99,235,0.08);top:-10%;right:-8%;animation:orbPulse 10s ease-in-out infinite 1s; }
        .metricas-orb-2 { width:400px;height:400px;background:rgba(99,102,241,0.07);bottom:5%;left:-6%;animation:orbPulse 12s ease-in-out infinite 4s; }

        /* Counter Cards */
        .met-counter-card {
            background:rgba(255,255,255,0.9); backdrop-filter:blur(12px);
            border:1px solid rgba(226,232,240,0.8); border-radius:20px;
            padding:1.5rem; text-align:center;
            transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease;
            box-shadow:0 2px 12px rgba(0,0,0,0.05);
        }
        .met-counter-card:hover { transform:translateY(-8px); box-shadow:0 20px 50px rgba(37,99,235,0.12); }
        .met-counter-icon {
            width:64px; height:64px; border-radius:18px;
            display:flex; align-items:center; justify-content:center;
            margin:0 auto 1rem; box-shadow:0 6px 20px rgba(0,0,0,0.08);
            transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
        }
        .met-counter-card:hover .met-counter-icon { transform:scale(1.12) rotate(-6deg); }
        .met-counter-number { font-size:2.8rem; font-weight:900; color:#0f172a; font-variant-numeric:tabular-nums; line-height:1; }
        .met-counter-label { font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:0.08em; margin-top:0.4rem; }
        .met-counter-trend { font-size:0.72rem; font-weight:700; margin-top:0.5rem; }
        .met-counter-trend.up { color:#059669; }

        /* KPI Cards */
        .met-kpi-card {
            background:rgba(255,255,255,0.92); backdrop-filter:blur(16px);
            border:1px solid rgba(226,232,240,0.8); border-radius:20px;
            padding:1.5rem; box-shadow:0 2px 12px rgba(0,0,0,0.05);
            transition:transform 0.35s ease, box-shadow 0.35s ease;
        }
        .met-kpi-card:hover { transform:translateY(-6px); box-shadow:0 18px 48px rgba(0,0,0,0.10); }
        .met-kpi-header { display:flex; align-items:center; gap:10px; margin-bottom:1.1rem; }
        .met-kpi-icon-sm { width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:0.9rem; flex-shrink:0; }
        .met-kpi-title { font-size:0.88rem; font-weight:800; color:#1e293b; }
        .met-kpi-sub { font-size:0.72rem; color:#94a3b8; font-weight:600; }
        .met-kpi-badge {
            margin-left:auto; flex-shrink:0;
            font-size:10px; font-weight:800; padding:3px 8px; border-radius:999px;
            text-transform:uppercase; letter-spacing:0.05em;
            display:flex; align-items:center; gap:4px;
        }
        .met-kpi-badge.green { background:#dcfce7; color:#166534; }
        .met-kpi-badge.blue  { background:#dbeafe; color:#1d4ed8; }
        .met-kpi-badge.purple{ background:#f3e8ff; color:#7e22ce; }
        .met-kpi-big-num { font-size:2.6rem; font-weight:900; color:#0f172a; line-height:1; margin-bottom:1rem; }
        .met-kpi-footer { margin-top:0.75rem; }
        .met-kpi-change { font-size:0.75rem; font-weight:700; }
        .met-kpi-change.positive { color:#059669; }

        /* Bar chart */
        .met-chart { margin-bottom:0.5rem; }
        .met-bar-group { display:flex; align-items:flex-end; gap:5px; height:60px; }
        .met-bar { flex:1; border-radius:4px 4px 0 0; transition:opacity 0.2s; cursor:default; }
        .met-bar:hover { opacity:0.75; }
        .met-bar-labels { display:flex; gap:5px; margin-top:4px; }
        .met-bar-labels span { flex:1; text-align:center; font-size:9px; font-weight:700; color:#94a3b8; }

        /* Radial progress */
        .met-radial-wrap { position:relative; width:100px; height:100px; margin:0.5rem auto; }
        .met-radial-svg { width:100%; height:100%; }
        .met-radial-progress { transition:stroke-dashoffset 1.5s ease; }
        .met-radial-label {
            position:absolute; inset:0; display:flex; flex-direction:column;
            align-items:center; justify-content:center;
            font-size:0.9rem; font-weight:900; color:#0891b2; line-height:1;
        }
        .met-radial-label span { font-size:0.6rem; font-weight:600; color:#94a3b8; margin-top:2px; }

        /* NPS bar */
        .met-nps-bar { display:flex; height:8px; border-radius:999px; overflow:hidden; gap:2px; margin:0.5rem 0; }
        .met-nps-seg { border-radius:999px; }
        .met-nps-labels { display:flex; justify-content:space-between; font-size:9px; font-weight:700; }

        /* Progress stack */
        .met-progress-stack { display:flex; flex-direction:column; gap:10px; margin-top:0.5rem; }
        .met-prog-item { display:flex; align-items:center; gap:8px; }
        .met-prog-name { font-size:0.75rem; font-weight:700; color:#64748b; width:90px; flex-shrink:0; }
        .met-prog-bar-wrap { flex:1; height:6px; background:#f1f5f9; border-radius:999px; overflow:hidden; }
        .met-prog-fill { height:100%; border-radius:999px; transition:width 1.5s ease; }
        .met-prog-val { font-size:0.72rem; font-weight:800; color:#475569; width:32px; text-align:right; }

        /* Specialty list */
        .met-specialty-list { display:flex; flex-direction:column; gap:8px; }
        .met-spec-item { display:flex; align-items:center; gap:7px; }
        .met-spec-dot { width:7px; height:7px; border-radius:50%; flex-shrink:0; }
        .met-spec-name { font-size:0.75rem; font-weight:700; color:#475569; width:100px; flex-shrink:0; }
        .met-spec-bar-wrap { flex:1; height:5px; background:#f1f5f9; border-radius:999px; overflow:hidden; }
        .met-spec-bar { height:100%; border-radius:999px; transition:width 1.5s ease; }
        .met-spec-pct { font-size:0.72rem; font-weight:800; color:#64748b; width:28px; text-align:right; }

        /* Status list */
        .met-status-list { display:flex; flex-direction:column; gap:8px; margin-bottom:1rem; }
        .met-status-item { display:flex; align-items:center; gap:8px; }
        .met-status-dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; }
        .met-status-dot.online { background:#10b981; box-shadow:0 0 0 3px rgba(16,185,129,0.2); animation:pulse 2s ease-in-out infinite; }
        .met-status-name { font-size:0.78rem; font-weight:700; color:#475569; flex:1; }
        .met-status-ms { font-size:0.72rem; font-weight:800; color:#64748b; }
        .met-status-ok { color:#10b981; font-size:0.75rem; font-weight:800; }

        /* Uptime bar */
        .met-uptime-bar-wrap { display:flex; flex-direction:column; gap:6px; }
        .met-uptime-bar { display:flex; gap:2px; flex-wrap:wrap; }
        .met-uptime-block { width:6px; height:20px; border-radius:2px; }

        /* Coverage card */
        .met-coverage-card, .met-testimonial-card {
            background:rgba(255,255,255,0.92); backdrop-filter:blur(16px);
            border:1px solid rgba(226,232,240,0.8); border-radius:20px;
            padding:1.75rem; box-shadow:0 2px 12px rgba(0,0,0,0.05);
            transition:transform 0.35s ease, box-shadow 0.35s ease;
        }
        .met-coverage-card:hover, .met-testimonial-card:hover { transform:translateY(-5px); box-shadow:0 16px 44px rgba(0,0,0,0.09); }
        .met-coverage-header {
            display:flex; align-items:center; gap:8px;
            font-size:0.85rem; font-weight:800; color:#1e293b;
            margin-bottom:1.25rem;
        }
        .met-coverage-grid { display:flex; flex-direction:column; gap:10px; }
        .met-country { display:flex; align-items:center; gap:10px; }
        .met-country > span:first-child { font-size:0.8rem; font-weight:700; color:#475569; width:100px; flex-shrink:0; }
        .met-country-bar { flex:1; height:7px; background:#f1f5f9; border-radius:999px; overflow:hidden; }
        .met-country-bar > div { height:100%; border-radius:999px; transition:width 1.5s ease; }
        .met-country-num { font-size:0.75rem; font-weight:800; color:#64748b; width:35px; text-align:right; }

        /* Testimonial card */
        .met-award-badge {
            display:flex; align-items:center; gap:12px;
            background:linear-gradient(135deg,#fffbeb,#fef3c7);
            border:1px solid #fde68a; border-radius:14px;
            padding:12px 16px; margin-bottom:1.25rem;
        }
        .met-quote {
            font-size:0.88rem; color:#475569; line-height:1.7; font-style:italic;
            border-left:3px solid #2563eb; padding-left:1rem; margin:0 0 1.25rem;
        }
        .met-author {
            display:flex; align-items:center; gap:10px; margin-bottom:1.25rem;
        }
        .met-author-avatar {
            width:38px; height:38px; border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            font-size:0.75rem; font-weight:900; color:white; flex-shrink:0;
        }
        .met-mini-stats {
            display:flex; align-items:center; justify-content:center;
            background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px;
            padding:12px;
        }
        .met-mini-stat { flex:1; text-align:center; }
        .met-mini-num { display:block; font-size:1.1rem; font-weight:900; line-height:1; }
        .met-mini-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin-top:2px; }
        .met-mini-divider { width:1px; height:30px; background:#e2e8f0; }

    </style>
</head>
<body class="antialiased text-slate-900 selection:bg-blue-600 selection:text-white"
      x-data="clinicHub()"
      x-init="init()">

    <!-- ===========================
         NAVEGACIÓN PREMIUM
    =========================== -->
    <nav class="fixed top-4 z-50 w-full max-w-7xl mx-auto px-4 lg:px-8 left-1/2 -translate-x-1/2" style="width: calc(100% - 2rem)">
        <div class="nav-glass rounded-2xl px-6 py-3 flex flex-wrap items-center justify-between gap-4">
            <!-- Logo -->
            <div class="flex items-center space-x-3 group cursor-pointer">
                <div class="bg-linear-to-br from-blue-600 to-indigo-600 text-white h-11 w-11 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-heart-pulse text-lg" style="animation: pulse 2s ease-in-out infinite;"></i>
                </div>
                <div>
                    <span class="text-xl font-black tracking-tight bg-linear-to-r from-slate-900 to-blue-800 bg-clip-text text-transparent">Clinic<span class="text-blue-600">Hub</span></span>
                    <p class="text-[9px] font-bold text-slate-400 -mt-0.5 tracking-wider uppercase">Premium Medical OS</p>
                </div>
            </div>

            <!-- Menú -->
            <div class="hidden lg:flex items-center space-x-1 bg-slate-100/60 rounded-full p-1">
                <template x-for="item in navItems" :key="item.id">
                    <a :href="'#' + item.id"
                       @click.prevent="scrollTo(item.id)"
                       class="flex items-center space-x-2 px-4 py-2 rounded-full text-sm font-semibold transition-all"
                       :class="activeSection === item.id ? 'bg-white shadow-md text-blue-600' : 'text-slate-600 hover:bg-white/70'">
                        <i :class="item.icon + ' text-xs'"></i>
                        <span x-text="item.label"></span>
                    </a>
                </template>
            </div>

            <!-- CTAs -->
            <div class="flex items-center space-x-3">
                <a href="/login" class="text-sm font-bold text-slate-700 hover:text-blue-600 transition px-4 py-2 rounded-xl hover:bg-white/60 flex items-center gap-2">
                    <i class="fa-regular fa-circle-user"></i> Iniciar Sesión
                </a>
                <a href="/register" class="shine-btn bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-600/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
                    <i class="fa-solid fa-sparkles text-xs"></i>
                    <span>Comenzar Gratis</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- ===========================
         HERO SECTION - CON FONDO HEX
    =========================== -->
    <section id="inicio" class="hero-section">
        <!-- Imagen de fondo hexagonal -->
        <div class="hero-bg-image"></div>

        <!-- Orbs de color -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <!-- Partículas hexagonales flotantes -->
        <div class="hex-particles" id="hexParticles"></div>

        <!-- Contenido Hero -->
        <div class="hero-content max-w-7xl mx-auto px-6 lg:px-16 pt-36 pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <!-- Izquierda -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-blue-200/60 px-4 py-2 rounded-full shadow-md shadow-blue-100/50 mx-auto lg:mx-0">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs font-black text-blue-700 tracking-wider uppercase">⭐ El Sistema #1 en Gestión Médica 2026</span>
                    </div>

                    <h1 class="text-5xl sm:text-6xl lg:text-[4.25rem] font-black tracking-tight leading-[1.08]">
                        <span class="text-slate-900">La Gestión Médica</span>
                        <br>
                        <span class="bg-linear-to-r from-blue-600 via-indigo-500 to-violet-600 bg-clip-text text-transparent">del Futuro</span>
                    </h1>

                    <p class="text-xl text-slate-600 max-w-xl leading-relaxed font-medium mx-auto lg:mx-0">
                        Transformamos la gestión hospitalaria con tecnología de punta. Pacientes, citas, diagnósticos y tratamientos — todo en una plataforma ultra-moderna.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="/register" class="shine-btn w-full sm:w-auto bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold px-8 py-4 rounded-xl shadow-xl shadow-blue-600/30 hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-gem"></i>
                            <span>Comenzar Ahora</span>
                            <i class="fa-solid fa-arrow-right text-sm"></i>
                        </a>
                        <button @click="showDemo = true" class="w-full sm:w-auto border-2 border-white/70 bg-white/70 backdrop-blur-sm text-slate-700 font-bold px-8 py-4 rounded-xl hover:bg-white hover:border-blue-300 transition-all flex items-center justify-center gap-2 shadow-lg">
                            <i class="fa-solid fa-play-circle text-blue-500 text-lg"></i>
                            <span>Ver Demo</span>
                        </button>
                    </div>

                    <!-- Social proof -->
                    <div class="flex flex-col items-center lg:items-start gap-2 pt-4">
                        <div class="flex items-center gap-2">
                            <div class="flex gap-0.5">
                                <i class="fa-solid fa-star text-amber-400"></i>
                                <i class="fa-solid fa-star text-amber-400"></i>
                                <i class="fa-solid fa-star text-amber-400"></i>
                                <i class="fa-solid fa-star text-amber-400"></i>
                                <i class="fa-solid fa-star text-amber-400"></i>
                            </div>
                            <span class="text-sm font-black text-slate-700">5.0</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500 font-semibold">
                            <span><i class="fa-regular fa-circle-check text-emerald-500 mr-1"></i>2,847+ reseñas verificadas</span>
                            <span class="hidden sm:inline text-slate-300">•</span>
                            <span><i class="fa-regular fa-building text-blue-500 mr-1"></i>500+ clínicas activas</span>
                        </div>
                    </div>
                </div>

                <!-- Derecha - Tarjeta flotante premium -->
                <div class="lg:col-span-5 relative">
                    <div class="absolute -inset-4 rounded-3xl bg-linear-to-r from-blue-500/20 via-indigo-500/20 to-violet-500/20 blur-3xl"></div>
                    <div class="float-card relative bg-white/90 backdrop-blur-xl border border-white/70 rounded-3xl shadow-2xl shadow-blue-500/10 p-6 space-y-5">
                        <!-- Header -->
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 inline-block"></span> En vivo — HOY
                                </span>
                                <h4 class="text-4xl font-extrabold text-slate-900 mt-1">42 <span class="text-xl font-medium text-slate-400">citas</span></h4>
                            </div>
                            <div class="bg-linear-to-br from-cyan-500 to-blue-500 text-white h-14 w-14 rounded-2xl flex items-center justify-center shadow-lg shadow-cyan-500/30">
                                <i class="fa-solid fa-chart-line text-xl"></i>
                            </div>
                        </div>

                        <!-- Métricas -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-linear-to-br from-blue-50 to-indigo-50 border border-blue-100 p-4 rounded-2xl">
                                <i class="fa-solid fa-user-group text-blue-500 text-lg mb-2"></i>
                                <h5 class="text-2xl font-extrabold text-slate-800">324</h5>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Pacientes activos</p>
                                <span class="text-[10px] text-emerald-600 font-bold mt-1 inline-flex items-center gap-0.5"><i class="fa-solid fa-arrow-up text-[8px]"></i> +12%</span>
                            </div>
                            <div class="bg-linear-to-br from-cyan-50 to-teal-50 border border-cyan-100 p-4 rounded-2xl">
                                <i class="fa-solid fa-gauge-high text-cyan-500 text-lg mb-2"></i>
                                <h5 class="text-2xl font-extrabold text-slate-800">98<span class="text-base font-medium">%</span></h5>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Eficiencia</p>
                                <span class="text-[10px] text-emerald-600 font-bold mt-1 inline-flex items-center gap-0.5"><i class="fa-solid fa-arrow-up text-[8px]"></i> +5%</span>
                            </div>
                        </div>

                        <!-- Tiempo espera -->
                        <div class="bg-linear-to-r from-amber-50 to-orange-50 border border-amber-200/60 p-4 rounded-2xl flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-xl bg-amber-100 flex items-center justify-center shadow-sm">
                                    <i class="fa-regular fa-clock text-amber-600"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wide">Tiempo promedio</p>
                                    <p class="text-xl font-extrabold text-slate-800">18 <span class="text-sm font-normal">min</span></p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2.5 py-1.5 rounded-lg border border-emerald-200">
                                <i class="fa-solid fa-arrow-trend-down mr-1"></i>-6%
                            </span>
                        </div>

                        <!-- Progress bar -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-semibold text-slate-500">
                                <span>Ocupación de consultorios</span>
                                <span class="text-blue-600">78%</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-linear-to-r from-blue-500 to-indigo-500 rounded-full" style="width: 78%; animation: progressLoad 1.5s ease-out forwards;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===========================
         SECCIÓN MÓDULOS — PREMIUM HEX BG
    =========================== -->
    <section id="modulos" class="modulos-section py-28 px-6 lg:px-16 relative overflow-hidden">

        <!-- Fondo tech hexagonal -->
        <div class="modulos-bg-hex"></div>
        <div class="modulos-bg-overlay"></div>

        <!-- Orbs suaves -->
        <div class="modulos-orb modulos-orb-1"></div>
        <div class="modulos-orb modulos-orb-2"></div>
        <div class="modulos-orb modulos-orb-3"></div>

        <div class="max-w-7xl mx-auto space-y-16 relative z-10">

            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto space-y-5 reveal">
                <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-blue-200/60 rounded-full px-5 py-2 shadow-sm shadow-blue-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-500 opacity-60"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                    </span>
                    <i class="fa-solid fa-microchip text-blue-500 text-xs"></i>
                    <span class="text-[11px] font-black text-blue-700 uppercase tracking-widest">Ecosistema Médico Avanzado</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
                    Todo lo que Necesitas<br>en un <span class="bg-linear-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Solo Lugar</span>
                </h2>
                <p class="text-lg text-slate-500 font-medium">Funcionalidades de grado profesional que garantizan seguridad, robustez y máxima eficiencia en la gestión clínica.</p>

                <!-- Feature pills -->
                <div class="flex flex-wrap justify-center gap-2 pt-2">
                    <span class="mod-pill bg-blue-50 text-blue-700 border border-blue-200"><i class="fa-solid fa-shield-halved text-[10px]"></i> HIPAA Compliant</span>
                    <span class="mod-pill bg-emerald-50 text-emerald-700 border border-emerald-200"><i class="fa-solid fa-bolt text-[10px]"></i> Tiempo Real</span>
                    <span class="mod-pill bg-indigo-50 text-indigo-700 border border-indigo-200"><i class="fa-solid fa-robot text-[10px]"></i> IA Integrada</span>
                    <span class="mod-pill bg-cyan-50 text-cyan-700 border border-cyan-200"><i class="fa-solid fa-cloud text-[10px]"></i> Cloud Nativo</span>
                </div>
            </div>

            <!-- Grid de tarjetas — 3 columnas premium -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Tarjeta 1 — Pacientes -->
                <a href="/pacientes" class="mod-card group reveal" style="--accent:#2563eb;--accent-light:#dbeafe;--accent-mid:#bfdbfe;">
                    <div class="mod-card-glow"></div>
                    <div class="mod-card-inner">
                        <div class="mod-icon-wrap" style="background:linear-gradient(135deg,#dbeafe,#bfdbfe);">
                            <i class="fa-solid fa-user-injured text-blue-600 text-2xl mod-icon"></i>
                        </div>
                        <div class="mod-badge" style="background:#eff6ff;color:#1d4ed8;border-color:#bfdbfe;">Núcleo</div>
                        <h3 class="mod-title">Gestión de Pacientes</h3>
                        <p class="mod-desc">Administra expedientes completos con historial médico, tipo de sangre, alergias y datos demográficos estructurados en tiempo real.</p>
                        <ul class="mod-features">
                            <li><i class="fa-solid fa-check text-blue-500 text-[10px]"></i> Expediente electrónico completo</li>
                            <li><i class="fa-solid fa-check text-blue-500 text-[10px]"></i> Búsqueda avanzada por filtros</li>
                            <li><i class="fa-solid fa-check text-blue-500 text-[10px]"></i> Historial de visitas y evolución</li>
                        </ul>
                        <div class="mod-cta" style="color:#2563eb;">Acceder al módulo <i class="fa-solid fa-arrow-right text-[10px]"></i></div>
                    </div>
                </a>

                <!-- Tarjeta 2 — Citas -->
                <a href="/citas" class="mod-card group reveal" style="transition-delay:0.08s;--accent:#0891b2;--accent-light:#cffafe;--accent-mid:#a5f3fc;">
                    <div class="mod-card-glow"></div>
                    <div class="mod-card-inner">
                        <div class="mod-icon-wrap" style="background:linear-gradient(135deg,#cffafe,#a5f3fc);">
                            <i class="fa-solid fa-calendar-check text-cyan-600 text-2xl mod-icon"></i>
                        </div>
                        <div class="mod-badge" style="background:#ecfeff;color:#0e7490;border-color:#a5f3fc;">Inteligente</div>
                        <h3 class="mod-title">Citas Inteligentes</h3>
                        <p class="mod-desc">Programación avanzada con detección de conflictos, recordatorios automáticos por SMS/email y asignación inteligente de consultorios.</p>
                        <ul class="mod-features">
                            <li><i class="fa-solid fa-check text-cyan-500 text-[10px]"></i> Calendario multi-médico</li>
                            <li><i class="fa-solid fa-check text-cyan-500 text-[10px]"></i> Estados automatizados</li>
                            <li><i class="fa-solid fa-check text-cyan-500 text-[10px]"></i> Confirmación por WhatsApp</li>
                        </ul>
                        <div class="mod-cta" style="color:#0891b2;">Acceder al módulo <i class="fa-solid fa-arrow-right text-[10px]"></i></div>
                    </div>
                </a>

                <!-- Tarjeta 3 — Diagnósticos -->
                <a href="/diagnosticos" class="mod-card group reveal" style="transition-delay:0.16s;--accent:#4f46e5;--accent-light:#e0e7ff;--accent-mid:#c7d2fe;">
                    <div class="mod-card-glow"></div>
                    <div class="mod-card-inner">
                        <div class="mod-icon-wrap" style="background:linear-gradient(135deg,#e0e7ff,#c7d2fe);">
                            <i class="fa-solid fa-file-medical text-indigo-600 text-2xl mod-icon"></i>
                        </div>
                        <div class="mod-badge" style="background:#eef2ff;color:#3730a3;border-color:#c7d2fe;">Pro</div>
                        <h3 class="mod-title">Diagnósticos Profesionales</h3>
                        <p class="mod-desc">Registro clínico con niveles de gravedad (leve/moderado/crítico), recomendaciones CIE-10 y generación automática de reportes médicos.</p>
                        <ul class="mod-features">
                            <li><i class="fa-solid fa-check text-indigo-500 text-[10px]"></i> Codificación CIE-10</li>
                            <li><i class="fa-solid fa-check text-indigo-500 text-[10px]"></i> Niveles de gravedad visual</li>
                            <li><i class="fa-solid fa-check text-indigo-500 text-[10px]"></i> Reportes exportables PDF</li>
                        </ul>
                        <div class="mod-cta" style="color:#4f46e5;">Acceder al módulo <i class="fa-solid fa-arrow-right text-[10px]"></i></div>
                    </div>
                </a>

                <!-- Tarjeta 4 — Tratamientos -->
                <a href="/tratamientos" class="mod-card group reveal" style="transition-delay:0.24s;--accent:#9333ea;--accent-light:#f3e8ff;--accent-mid:#e9d5ff;">
                    <div class="mod-card-glow"></div>
                    <div class="mod-card-inner">
                        <div class="mod-icon-wrap" style="background:linear-gradient(135deg,#f3e8ff,#e9d5ff);">
                            <i class="fa-solid fa-kit-medical text-purple-600 text-2xl mod-icon"></i>
                        </div>
                        <div class="mod-badge" style="background:#faf5ff;color:#7e22ce;border-color:#e9d5ff;">Seguimiento</div>
                        <h3 class="mod-title">Tratamientos Médicos</h3>
                        <p class="mod-desc">Planes terapéuticos personalizados con seguimiento de evolución, alertas de cumplimiento y vinculación directa a diagnósticos activos.</p>
                        <ul class="mod-features">
                            <li><i class="fa-solid fa-check text-purple-500 text-[10px]"></i> Planes terapéuticos activos</li>
                            <li><i class="fa-solid fa-check text-purple-500 text-[10px]"></i> Alertas de cumplimiento</li>
                            <li><i class="fa-solid fa-check text-purple-500 text-[10px]"></i> Evolución clínica gráfica</li>
                        </ul>
                        <div class="mod-cta" style="color:#9333ea;">Acceder al módulo <i class="fa-solid fa-arrow-right text-[10px]"></i></div>
                    </div>
                </a>

                <!-- Tarjeta 5 — Medicamentos -->
                <a href="/medicamentos" class="mod-card group reveal" style="transition-delay:0.32s;--accent:#059669;--accent-light:#d1fae5;--accent-mid:#a7f3d0;">
                    <div class="mod-card-glow"></div>
                    <div class="mod-card-inner">
                        <div class="mod-icon-wrap" style="background:linear-gradient(135deg,#d1fae5,#a7f3d0);">
                            <i class="fa-solid fa-capsules text-emerald-600 text-2xl mod-icon"></i>
                        </div>
                        <div class="mod-badge" style="background:#ecfdf5;color:#065f46;border-color:#a7f3d0;">Control</div>
                        <h3 class="mod-title">Control de Medicamentos</h3>
                        <p class="mod-desc">Dosificación precisa con frecuencias de consumo, alertas de efectos secundarios, interacciones y control integral de proveedores farmacéuticos.</p>
                        <ul class="mod-features">
                            <li><i class="fa-solid fa-check text-emerald-500 text-[10px]"></i> Alertas de interacciones</li>
                            <li><i class="fa-solid fa-check text-emerald-500 text-[10px]"></i> Stock de farmacia integrado</li>
                            <li><i class="fa-solid fa-check text-emerald-500 text-[10px]"></i> Trazabilidad completa</li>
                        </ul>
                        <div class="mod-cta" style="color:#059669;">Acceder al módulo <i class="fa-solid fa-arrow-right text-[10px]"></i></div>
                    </div>
                </a>

                <!-- Tarjeta 6 — Médicos -->
                <a href="/medicos" class="mod-card group reveal" style="transition-delay:0.40s;--accent:#d97706;--accent-light:#fef3c7;--accent-mid:#fde68a;">
                    <div class="mod-card-glow"></div>
                    <div class="mod-card-inner">
                        <div class="mod-icon-wrap" style="background:linear-gradient(135deg,#fef3c7,#fde68a);">
                            <i class="fa-solid fa-user-doctor text-amber-600 text-2xl mod-icon"></i>
                        </div>
                        <div class="mod-badge" style="background:#fffbeb;color:#92400e;border-color:#fde68a;">Equipo</div>
                        <h3 class="mod-title">Gestión de Médicos</h3>
                        <p class="mod-desc">Administra el equipo médico con especialidades, credenciales, horarios de guardia, consultorios asignados y métricas de rendimiento clínico.</p>
                        <ul class="mod-features">
                            <li><i class="fa-solid fa-check text-amber-500 text-[10px]"></i> Horarios y guardias</li>
                            <li><i class="fa-solid fa-check text-amber-500 text-[10px]"></i> Métricas por especialidad</li>
                            <li><i class="fa-solid fa-check text-amber-500 text-[10px]"></i> Credenciales y certificados</li>
                        </ul>
                        <div class="mod-cta" style="color:#d97706;">Acceder al módulo <i class="fa-solid fa-arrow-right text-[10px]"></i></div>
                    </div>
                </a>

            </div>

            <!-- Bottom trust bar -->
            <div class="mod-trust-bar reveal">
                <div class="mod-trust-item">
                    <i class="fa-solid fa-shield-halved text-blue-500"></i>
                    <span>Cifrado AES-256</span>
                </div>
                <div class="mod-trust-divider"></div>
                <div class="mod-trust-item">
                    <i class="fa-solid fa-server text-indigo-500"></i>
                    <span>Backups automáticos</span>
                </div>
                <div class="mod-trust-divider"></div>
                <div class="mod-trust-item">
                    <i class="fa-solid fa-clock-rotate-left text-cyan-500"></i>
                    <span>99.98% uptime SLA</span>
                </div>
                <div class="mod-trust-divider"></div>
                <div class="mod-trust-item">
                    <i class="fa-solid fa-headset text-emerald-500"></i>
                    <span>Soporte 24/7 en vivo</span>
                </div>
                <div class="mod-trust-divider"></div>
                <div class="mod-trust-item">
                    <i class="fa-solid fa-certificate text-amber-500"></i>
                    <span>Certificado HIPAA</span>
                </div>
            </div>

        </div>
    </section>

    <!-- ===========================
         MÉTRICAS — SECCIÓN COMPLETA PREMIUM
    =========================== -->
    <section id="metricas" class="metricas-section py-28 px-6 lg:px-16 relative overflow-hidden">

        <!-- Fondo tech hexagonal -->
        <div class="metricas-bg-hex"></div>
        <div class="metricas-bg-overlay"></div>
        <div class="metricas-orb metricas-orb-1"></div>
        <div class="metricas-orb metricas-orb-2"></div>

        <div class="max-w-7xl mx-auto relative z-10 space-y-20">

            <!-- Header -->
            <div class="text-center space-y-5 reveal">
                <div class="inline-flex items-center gap-2 bg-white/85 backdrop-blur-sm border border-blue-200/60 rounded-full px-5 py-2 shadow-sm">
                    <i class="fa-solid fa-chart-mixed text-blue-600 text-xs"></i>
                    <span class="text-[11px] font-black text-blue-700 uppercase tracking-widest">Panel de Métricas en Vivo</span>
                    <span class="flex h-2 w-2"><span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-emerald-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span></span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900">
                    Números que<br><span class="bg-linear-to-r from-blue-600 via-indigo-500 to-cyan-500 bg-clip-text text-transparent">Hablan por Sí Solos</span>
                </h2>
                <p class="text-lg text-slate-500 font-medium max-w-2xl mx-auto">Rendimiento clínico verificado en tiempo real. Transparencia total en cada métrica de ClinicHub.</p>
            </div>

            <!-- FILA 1: Counters grandes -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 reveal">

                <div class="met-counter-card">
                    <div class="met-counter-icon" style="background:linear-gradient(135deg,#dbeafe,#bfdbfe);">
                        <i class="fa-solid fa-users text-blue-600 text-2xl"></i>
                    </div>
                    <div class="met-counter-number counter" data-target="50000" data-suffix="K+">0</div>
                    <div class="met-counter-label">Pacientes Atendidos</div>
                    <div class="met-counter-trend up"><i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +18% este trimestre</div>
                </div>

                <div class="met-counter-card" style="transition-delay:0.1s">
                    <div class="met-counter-icon" style="background:linear-gradient(135deg,#cffafe,#a5f3fc);">
                        <i class="fa-solid fa-user-doctor text-cyan-600 text-2xl"></i>
                    </div>
                    <div class="met-counter-number counter" data-target="1200" data-suffix="+">0</div>
                    <div class="met-counter-label">Médicos Activos</div>
                    <div class="met-counter-trend up"><i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +24 nuevos este mes</div>
                </div>

                <div class="met-counter-card" style="transition-delay:0.2s">
                    <div class="met-counter-icon" style="background:linear-gradient(135deg,#d1fae5,#a7f3d0);">
                        <i class="fa-solid fa-star text-emerald-600 text-2xl"></i>
                    </div>
                    <div class="met-counter-number counter" data-target="98" data-suffix="%">0</div>
                    <div class="met-counter-label">Satisfacción Clínica</div>
                    <div class="met-counter-trend up"><i class="fa-solid fa-arrow-trend-up text-[10px]"></i> Récord histórico</div>
                </div>

                <div class="met-counter-card" style="transition-delay:0.3s">
                    <div class="met-counter-icon" style="background:linear-gradient(135deg,#f3e8ff,#e9d5ff);">
                        <i class="fa-solid fa-clock text-purple-600 text-2xl"></i>
                    </div>
                    <div class="met-counter-number" style="color:#9333ea;">24/7</div>
                    <div class="met-counter-label">Disponibilidad SLA</div>
                    <div class="met-counter-trend up"><i class="fa-solid fa-circle-check text-[10px]"></i> 99.98% uptime</div>
                </div>

            </div>

            <!-- FILA 2: KPI Cards detalladas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- KPI 1: Citas por día -->
                <div class="met-kpi-card reveal">
                    <div class="met-kpi-header">
                        <div class="met-kpi-icon-sm" style="background:#eff6ff;color:#2563eb;">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>
                        <div>
                            <div class="met-kpi-title">Citas por Día</div>
                            <div class="met-kpi-sub">Promedio mensual</div>
                        </div>
                        <div class="met-kpi-badge green">En alza</div>
                    </div>
                    <div class="met-kpi-big-num">347</div>
                    <div class="met-kpi-chart">
                        <div class="met-bar-group">
                            <div class="met-bar" style="height:45%;background:#bfdbfe;" title="Lun"></div>
                            <div class="met-bar" style="height:62%;background:#93c5fd;" title="Mar"></div>
                            <div class="met-bar" style="height:80%;background:#60a5fa;" title="Mié"></div>
                            <div class="met-bar" style="height:55%;background:#3b82f6;" title="Jue"></div>
                            <div class="met-bar" style="height:90%;background:#2563eb;" title="Vie"></div>
                            <div class="met-bar" style="height:38%;background:#bfdbfe;" title="Sáb"></div>
                            <div class="met-bar" style="height:22%;background:#dbeafe;" title="Dom"></div>
                        </div>
                        <div class="met-bar-labels">
                            <span>L</span><span>M</span><span>X</span><span>J</span><span>V</span><span>S</span><span>D</span>
                        </div>
                    </div>
                    <div class="met-kpi-footer">
                        <span class="met-kpi-change positive"><i class="fa-solid fa-arrow-up text-[9px]"></i> +12.4% vs mes anterior</span>
                    </div>
                </div>

                <!-- KPI 2: Tiempo de espera -->
                <div class="met-kpi-card reveal" style="transition-delay:0.1s">
                    <div class="met-kpi-header">
                        <div class="met-kpi-icon-sm" style="background:#ecfeff;color:#0891b2;">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <div class="met-kpi-title">Tiempo de Espera</div>
                            <div class="met-kpi-sub">Promedio actual</div>
                        </div>
                        <div class="met-kpi-badge blue">Óptimo</div>
                    </div>
                    <div class="met-kpi-big-num" style="color:#0891b2;">18 <span style="font-size:1.2rem;font-weight:600;color:#64748b;">min</span></div>
                    <!-- Radial progress -->
                    <div class="met-radial-wrap">
                        <svg class="met-radial-svg" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="50" fill="none" stroke="#e2e8f0" stroke-width="10"/>
                            <circle cx="60" cy="60" r="50" fill="none" stroke="url(#gradCyan)" stroke-width="10"
                                    stroke-dasharray="314" stroke-dashoffset="94" stroke-linecap="round"
                                    transform="rotate(-90 60 60)" class="met-radial-progress"/>
                            <defs>
                                <linearGradient id="gradCyan" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#06b6d4"/>
                                    <stop offset="100%" stop-color="#0891b2"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="met-radial-label">70%<br><span>eficiencia</span></div>
                    </div>
                    <div class="met-kpi-footer">
                        <span class="met-kpi-change positive"><i class="fa-solid fa-arrow-down text-[9px]"></i> -6 min vs año pasado</span>
                    </div>
                </div>

                <!-- KPI 3: Satisfacción NPS -->
                <div class="met-kpi-card reveal" style="transition-delay:0.2s">
                    <div class="met-kpi-header">
                        <div class="met-kpi-icon-sm" style="background:#ecfdf5;color:#059669;">
                            <i class="fa-solid fa-face-smile-beam"></i>
                        </div>
                        <div>
                            <div class="met-kpi-title">NPS Pacientes</div>
                            <div class="met-kpi-sub">Net Promoter Score</div>
                        </div>
                        <div class="met-kpi-badge green">Excelente</div>
                    </div>
                    <div class="met-kpi-big-num" style="color:#059669;">+87</div>
                    <div class="met-nps-bar">
                        <div class="met-nps-seg" style="width:7%;background:#ef4444;" title="Detractores"></div>
                        <div class="met-nps-seg" style="width:15%;background:#f97316;" title="Pasivos"></div>
                        <div class="met-nps-seg" style="width:78%;background:linear-gradient(90deg,#10b981,#059669);" title="Promotores"></div>
                    </div>
                    <div class="met-nps-labels">
                        <span style="color:#ef4444;">7% detractores</span>
                        <span style="color:#f97316;">15% pasivos</span>
                        <span style="color:#059669;">78% promotores</span>
                    </div>
                    <div class="met-kpi-footer">
                        <span class="met-kpi-change positive"><i class="fa-solid fa-arrow-up text-[9px]"></i> +9 puntos este año</span>
                    </div>
                </div>

                <!-- KPI 4: Ingresos facturados -->
                <div class="met-kpi-card reveal" style="transition-delay:0.3s">
                    <div class="met-kpi-header">
                        <div class="met-kpi-icon-sm" style="background:#faf5ff;color:#9333ea;">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                        <div>
                            <div class="met-kpi-title">Facturación Total</div>
                            <div class="met-kpi-sub">Acumulado 2026</div>
                        </div>
                        <div class="met-kpi-badge purple">Récord</div>
                    </div>
                    <div class="met-kpi-big-num" style="color:#9333ea;">$4.2M</div>
                    <div class="met-progress-stack">
                        <div class="met-prog-item">
                            <span class="met-prog-name">Consultas</span>
                            <div class="met-prog-bar-wrap"><div class="met-prog-fill" style="width:68%;background:linear-gradient(90deg,#a855f7,#9333ea);"></div></div>
                            <span class="met-prog-val">68%</span>
                        </div>
                        <div class="met-prog-item">
                            <span class="met-prog-name">Tratamientos</span>
                            <div class="met-prog-bar-wrap"><div class="met-prog-fill" style="width:48%;background:linear-gradient(90deg,#c084fc,#a855f7);"></div></div>
                            <span class="met-prog-val">48%</span>
                        </div>
                        <div class="met-prog-item">
                            <span class="met-prog-name">Medicamentos</span>
                            <div class="met-prog-bar-wrap"><div class="met-prog-fill" style="width:32%;background:linear-gradient(90deg,#d8b4fe,#c084fc);"></div></div>
                            <span class="met-prog-val">32%</span>
                        </div>
                    </div>
                </div>

                <!-- KPI 5: Diagnósticos por especialidad -->
                <div class="met-kpi-card reveal" style="transition-delay:0.4s">
                    <div class="met-kpi-header">
                        <div class="met-kpi-icon-sm" style="background:#fff7ed;color:#ea580c;">
                            <i class="fa-solid fa-stethoscope"></i>
                        </div>
                        <div>
                            <div class="met-kpi-title">Top Especialidades</div>
                            <div class="met-kpi-sub">Por volumen de pacientes</div>
                        </div>
                    </div>
                    <div class="met-specialty-list">
                        <div class="met-spec-item">
                            <span class="met-spec-dot" style="background:#3b82f6;"></span>
                            <span class="met-spec-name">Medicina General</span>
                            <div class="met-spec-bar-wrap"><div class="met-spec-bar" style="width:85%;background:#3b82f6;"></div></div>
                            <span class="met-spec-pct">85%</span>
                        </div>
                        <div class="met-spec-item">
                            <span class="met-spec-dot" style="background:#06b6d4;"></span>
                            <span class="met-spec-name">Pediatría</span>
                            <div class="met-spec-bar-wrap"><div class="met-spec-bar" style="width:62%;background:#06b6d4;"></div></div>
                            <span class="met-spec-pct">62%</span>
                        </div>
                        <div class="met-spec-item">
                            <span class="met-spec-dot" style="background:#8b5cf6;"></span>
                            <span class="met-spec-name">Cardiología</span>
                            <div class="met-spec-bar-wrap"><div class="met-spec-bar" style="width:47%;background:#8b5cf6;"></div></div>
                            <span class="met-spec-pct">47%</span>
                        </div>
                        <div class="met-spec-item">
                            <span class="met-spec-dot" style="background:#f59e0b;"></span>
                            <span class="met-spec-name">Traumatología</span>
                            <div class="met-spec-bar-wrap"><div class="met-spec-bar" style="width:38%;background:#f59e0b;"></div></div>
                            <span class="met-spec-pct">38%</span>
                        </div>
                        <div class="met-spec-item">
                            <span class="met-spec-dot" style="background:#10b981;"></span>
                            <span class="met-spec-name">Oncología</span>
                            <div class="met-spec-bar-wrap"><div class="met-spec-bar" style="width:29%;background:#10b981;"></div></div>
                            <span class="met-spec-pct">29%</span>
                        </div>
                    </div>
                </div>

                <!-- KPI 6: Sistema live status -->
                <div class="met-kpi-card reveal" style="transition-delay:0.5s">
                    <div class="met-kpi-header">
                        <div class="met-kpi-icon-sm" style="background:#f0fdf4;color:#16a34a;">
                            <i class="fa-solid fa-circle-nodes"></i>
                        </div>
                        <div>
                            <div class="met-kpi-title">Estado del Sistema</div>
                            <div class="met-kpi-sub">Monitoreo en tiempo real</div>
                        </div>
                        <div class="met-kpi-badge green">
                            <span class="relative flex h-1.5 w-1.5 mr-1">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                            </span>Operativo
                        </div>
                    </div>
                    <div class="met-status-list">
                        <div class="met-status-item">
                            <span class="met-status-dot online"></span>
                            <span class="met-status-name">API Gateway</span>
                            <span class="met-status-ms">12ms</span>
                            <span class="met-status-ok">✓</span>
                        </div>
                        <div class="met-status-item">
                            <span class="met-status-dot online"></span>
                            <span class="met-status-name">Base de Datos</span>
                            <span class="met-status-ms">4ms</span>
                            <span class="met-status-ok">✓</span>
                        </div>
                        <div class="met-status-item">
                            <span class="met-status-dot online"></span>
                            <span class="met-status-name">Motor de IA</span>
                            <span class="met-status-ms">89ms</span>
                            <span class="met-status-ok">✓</span>
                        </div>
                        <div class="met-status-item">
                            <span class="met-status-dot online"></span>
                            <span class="met-status-name">Notificaciones</span>
                            <span class="met-status-ms">7ms</span>
                            <span class="met-status-ok">✓</span>
                        </div>
                        <div class="met-status-item">
                            <span class="met-status-dot online"></span>
                            <span class="met-status-name">Backups Cloud</span>
                            <span class="met-status-ms">Sync</span>
                            <span class="met-status-ok">✓</span>
                        </div>
                    </div>
                    <div class="met-uptime-bar-wrap">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Uptime 30 días</span>
                        <div class="met-uptime-bar">
                            <template x-for="i in 30">
                                <div class="met-uptime-block" :style="Math.random() > 0.02 ? 'background:#10b981' : 'background:#f87171'"></div>
                            </template>
                        </div>
                        <span class="text-[11px] font-black text-emerald-600">99.98%</span>
                    </div>
                </div>

            </div>

            <!-- FILA 3: Clínicas activas mapa estilizado + Quote -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Mapa de cobertura stylized -->
                <div class="met-coverage-card reveal">
                    <div class="met-coverage-header">
                        <i class="fa-solid fa-earth-americas text-blue-500"></i>
                        <span>Cobertura Latinoamérica</span>
                        <div class="met-kpi-badge blue ml-auto">500+ clínicas</div>
                    </div>
                    <div class="met-coverage-grid">
                        <div class="met-country" style="--pct:92%"><span>🇵🇪 Perú</span><div class="met-country-bar"><div style="width:92%;background:linear-gradient(90deg,#3b82f6,#2563eb);"></div></div><span class="met-country-num">92%</span></div>
                        <div class="met-country" style="--pct:78%"><span>🇲🇽 México</span><div class="met-country-bar"><div style="width:78%;background:linear-gradient(90deg,#06b6d4,#0891b2);"></div></div><span class="met-country-num">78%</span></div>
                        <div class="met-country" style="--pct:65%"><span>🇨🇴 Colombia</span><div class="met-country-bar"><div style="width:65%;background:linear-gradient(90deg,#8b5cf6,#7c3aed);"></div></div><span class="met-country-num">65%</span></div>
                        <div class="met-country" style="--pct:54%"><span>🇦🇷 Argentina</span><div class="met-country-bar"><div style="width:54%;background:linear-gradient(90deg,#10b981,#059669);"></div></div><span class="met-country-num">54%</span></div>
                        <div class="met-country" style="--pct:41%"><span>🇨🇱 Chile</span><div class="met-country-bar"><div style="width:41%;background:linear-gradient(90deg,#f59e0b,#d97706);"></div></div><span class="met-country-num">41%</span></div>
                        <div class="met-country" style="--pct:33%"><span>🇧🇷 Brasil</span><div class="met-country-bar"><div style="width:33%;background:linear-gradient(90deg,#f97316,#ea580c);"></div></div><span class="met-country-num">33%</span></div>
                    </div>
                </div>

                <!-- Testimonial + award -->
                <div class="met-testimonial-card reveal" style="transition-delay:0.15s">
                    <div class="met-award-badge">
                        <i class="fa-solid fa-trophy text-amber-500 text-xl"></i>
                        <div>
                            <div class="font-black text-slate-800 text-sm">Software Médico #1</div>
                            <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Latinoamérica 2026</div>
                        </div>
                    </div>
                    <blockquote class="met-quote">
                        "ClinicHub transformó completamente la operación de nuestras 3 clínicas. Redujimos el tiempo de espera en un 62% y los errores de medicación cayeron a casi cero. Es el sistema más completo que hemos probado."
                    </blockquote>
                    <div class="met-author">
                        <div class="met-author-avatar" style="background:linear-gradient(135deg,#2563eb,#4f46e5);">DR</div>
                        <div>
                            <div class="font-bold text-slate-800 text-sm">Dr. Rodrigo Mendoza</div>
                            <div class="text-[11px] text-slate-400 font-medium">Director Médico — Clínicas Lima Norte</div>
                        </div>
                        <div class="ml-auto flex gap-0.5">
                            <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                            <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                            <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                            <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                            <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                        </div>
                    </div>

                    <!-- Mini stats inline -->
                    <div class="met-mini-stats">
                        <div class="met-mini-stat">
                            <span class="met-mini-num" style="color:#2563eb;">-62%</span>
                            <span class="met-mini-label">Espera</span>
                        </div>
                        <div class="met-mini-divider"></div>
                        <div class="met-mini-stat">
                            <span class="met-mini-num" style="color:#059669;">+89%</span>
                            <span class="met-mini-label">Precisión</span>
                        </div>
                        <div class="met-mini-divider"></div>
                        <div class="met-mini-stat">
                            <span class="met-mini-num" style="color:#9333ea;">3x</span>
                            <span class="met-mini-label">Productividad</span>
                        </div>
                        <div class="met-mini-divider"></div>
                        <div class="met-mini-stat">
                            <span class="met-mini-num" style="color:#d97706;">+47%</span>
                            <span class="met-mini-label">Eficiencia</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- ===========================
         IMPACTO REAL
    =========================== -->
    <section id="impacto" class="impact-section py-28 px-6 lg:px-16">
        <div class="max-w-7xl mx-auto text-center space-y-14 relative z-10">
            <div class="reveal">
                <div class="inline-flex items-center gap-2 bg-blue-500/15 border border-blue-500/30 rounded-full px-4 py-1.5 mb-5">
                    <i class="fa-solid fa-rocket text-blue-400 text-xs"></i>
                    <span class="text-[11px] font-bold text-blue-300 uppercase tracking-wider">Resultados Comprobados</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-white">Impacto Real en la<br><span class="bg-linear-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Gestión Clínica</span></h2>
                <p class="text-slate-400 text-lg mt-4 max-w-2xl mx-auto font-medium">Transformamos la atención médica con datos y tecnología avanzada</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="impact-card rounded-3xl p-10 reveal">
                    <div class="h-14 w-14 rounded-2xl bg-blue-500/20 border border-blue-500/30 flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-chart-line text-blue-400 text-2xl"></i>
                    </div>
                    <p class="text-5xl font-black text-white">+47<span class="text-2xl text-blue-400">%</span></p>
                    <p class="text-sm font-semibold text-slate-400 mt-3">Eficiencia operativa</p>
                </div>
                <div class="impact-card rounded-3xl p-10 reveal" style="transition-delay: 0.15s">
                    <div class="h-14 w-14 rounded-2xl bg-cyan-500/20 border border-cyan-500/30 flex items-center justify-center mx-auto mb-6">
                        <i class="fa-regular fa-clock text-cyan-400 text-2xl"></i>
                    </div>
                    <p class="text-5xl font-black text-white">-62<span class="text-2xl text-cyan-400">%</span></p>
                    <p class="text-sm font-semibold text-slate-400 mt-3">Tiempos de espera</p>
                </div>
                <div class="impact-card rounded-3xl p-10 reveal" style="transition-delay: 0.3s">
                    <div class="h-14 w-14 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-heart-circle-check text-emerald-400 text-2xl"></i>
                    </div>
                    <p class="text-5xl font-black text-white">+89<span class="text-2xl text-emerald-400">%</span></p>
                    <p class="text-sm font-semibold text-slate-400 mt-3">Precisión diagnóstica</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===========================
         CTA FINAL
    =========================== -->
    <section class="bg-linear-to-r from-blue-600 via-indigo-600 to-violet-600 py-24 px-6 text-white text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: url('/descarga.jpg'); background-size: cover; background-position: center;"></div>
        <div class="relative z-10 max-w-3xl mx-auto space-y-6">
            <h2 class="text-4xl sm:text-5xl font-extrabold">Comienza a Transformar<br>tu Clínica Hoy</h2>
            <p class="text-blue-100 text-lg font-medium">Únete a más de 500 clínicas que ya confían en ClinicHub</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                <a href="/register" class="shine-btn bg-white text-blue-700 font-bold px-10 py-4 rounded-xl hover:bg-blue-50 transition-all shadow-xl flex items-center gap-2">
                    <i class="fa-solid fa-sparkles text-blue-500"></i> Comenzar Gratis
                </a>
                <a href="/login" class="border-2 border-white/50 text-white font-bold px-10 py-4 rounded-xl hover:bg-white/10 transition-all flex items-center gap-2">
                    <i class="fa-regular fa-circle-user"></i> Ya tengo cuenta
                </a>
            </div>
        </div>
    </section>

    <!-- ===========================
         FOOTER
    =========================== -->
    <footer class="border-t border-slate-200/60 bg-white py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-8">
                <div class="flex items-center space-x-3">
                    <div class="bg-linear-to-br from-blue-600 to-indigo-600 text-white h-10 w-10 rounded-xl flex items-center justify-center shadow-md shadow-blue-500/30">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <span class="text-xl font-black bg-linear-to-r from-slate-900 to-blue-800 bg-clip-text text-transparent">Clinic<span class="text-blue-600">Hub</span></span>
                </div>

                <div class="flex flex-wrap justify-center gap-6 text-sm font-semibold text-slate-500">
                    <a href="#" class="hover:text-blue-600 transition">Términos de Servicio</a>
                    <a href="#" class="hover:text-blue-600 transition">Privacidad Médica</a>
                    <a href="#" class="hover:text-blue-600 transition">Certificaciones HIPAA</a>
                    <a href="#" class="hover:text-blue-600 transition">Soporte 24/7</a>
                </div>
            </div>
            <div class="border-t border-slate-200/60 pt-6 text-center">
                <p class="text-xs font-semibold text-slate-400">&copy; © 2026 ClinicHub Premium Medical OS. Desarrollado con arquitectura web optimizada de alto rendimiento.</p>
            </div>
        </div>
    </footer>

    <!-- ===========================
         MODAL DEMO INTERACTIVO
    =========================== -->
    <div x-show="showDemo" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop" x-transition>
        <div class="modal-glass rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden" @click.outside="showDemo = false">
            <div class="flex justify-between items-center p-6 border-b border-slate-200 bg-linear-to-r from-blue-50 to-indigo-50">
                <div>
                    <h3 class="text-2xl font-black text-slate-900">Demo Interactiva</h3>
                    <p class="text-sm text-slate-500 font-medium mt-0.5">Vista previa del sistema ClinicHub Premium</p>
                </div>
                <button @click="showDemo = false" class="h-9 w-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-700 transition text-lg font-bold">✕</button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                    <template x-for="(demo, idx) in demoItems" :key="idx">
                        <div class="cursor-pointer group" @click="demoActive = idx">
                            <div class="aspect-video rounded-2xl flex items-center justify-center text-white transition-all duration-200 group-hover:scale-105 shadow-md"
                                 :class="[demo.gradient, demoActive === idx ? 'ring-4 ring-offset-2 ' + demo.ring : '']">
                                <i :class="demo.icon + ' text-3xl'"></i>
                            </div>
                            <p class="text-center text-xs font-bold mt-2 transition" :class="demoActive === idx ? demo.textColor : 'text-slate-500'" x-text="demo.label"></p>
                        </div>
                    </template>
                </div>

                <div class="bg-linear-to-br from-slate-50 to-blue-50/40 rounded-2xl p-8 text-center border border-slate-200">
                    <template x-for="(demo, idx) in demoItems" :key="idx">
                        <div x-show="demoActive === idx" x-transition>
                            <div class="h-16 w-16 rounded-2xl flex items-center justify-center mx-auto mb-5 text-white shadow-lg"
                                 :class="demo.gradient">
                                <i :class="demo.icon + ' text-2xl'"></i>
                            </div>
                            <h4 class="text-xl font-extrabold text-slate-900" x-text="demo.title"></h4>
                            <p class="text-slate-600 mt-2 font-medium" x-text="demo.desc"></p>
                            <a :href="demo.link" class="inline-flex items-center gap-2 mt-6 bg-linear-to-r from-blue-600 to-indigo-600 text-white font-bold px-6 py-3 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition shadow-lg shadow-blue-500/30">
                                Acceder al módulo <i class="fa-solid fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- ===========================
         CHATBOT IA REAL
    =========================== -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-4">
        <!-- Ventana de chat -->
        <div x-show="chatOpen" x-cloak x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             class="chat-window w-92.5 h-130 rounded-3xl flex flex-col overflow-hidden">

            <!-- Header chat -->
            <div class="chat-header px-5 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="h-10 w-10 rounded-xl bg-linear-to-br from-blue-600 to-indigo-600 flex items-center justify-center">
                            <i class="fa-solid fa-robot text-white"></i>
                        </div>
                        <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full bg-emerald-500 border-2 border-slate-900"></span>
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm leading-tight">ClinicHub AI</p>
                        <p class="text-slate-400 text-xs">Asistente médico inteligente</p>
                    </div>
                    <span class="ai-badge text-[10px] font-bold text-blue-300 px-2 py-0.5 rounded-full ml-1">Claude AI</span>
                </div>
                <button @click="chatOpen = false" class="h-8 w-8 rounded-lg hover:bg-white/10 flex items-center justify-center text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-minus"></i>
                </button>
            </div>

            <!-- Messages -->
            <div class="chat-messages flex-1 overflow-y-auto p-4 space-y-3 text-sm" x-ref="chatMessages">
                <template x-for="(msg, idx) in chatMessages" :key="idx">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div :class="msg.role === 'user' ? 'chat-bubble-user' : 'chat-bubble-ai'" class="max-w-[80%] px-4 py-3 text-sm leading-relaxed">
                            <template x-if="msg.role === 'assistant'">
                                <span><i class="fa-solid fa-robot text-blue-400 text-xs mr-1.5"></i></span>
                            </template>
                            <span x-text="msg.content"></span>
                        </div>
                    </div>
                </template>

                <!-- Typing indicator -->
                <div x-show="isTyping" class="flex justify-start">
                    <div class="chat-bubble-ai px-4 py-3 flex items-center gap-1.5">
                        <span class="text-slate-400 text-xs mr-1">Escribiendo</span>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            </div>

            <!-- Input -->
            <div class="chat-input-area p-4">
                <div class="flex items-center gap-2">
                    <input type="text"
                           x-model="chatInput"
                           @keydown.enter.prevent="sendMessage()"
                           :disabled="isTyping"
                           placeholder="Pregunta sobre el sistema..."
                           class="chat-input flex-1 px-4 py-3 rounded-xl text-sm">
                    <button @click="sendMessage()"
                            :disabled="isTyping || !chatInput.trim()"
                            class="chat-send-btn h-11 w-11 rounded-xl flex items-center justify-center text-white cursor-pointer">
                        <i class="fa-solid fa-paper-plane text-sm" x-show="!isTyping"></i>
                        <i class="fa-solid fa-spinner fa-spin text-sm" x-show="isTyping"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- FAB -->
        <button @click="chatOpen = !chatOpen" class="chat-fab h-14 w-14 rounded-full flex items-center justify-center text-white cursor-pointer">
            <i class="fa-solid fa-robot text-2xl" x-show="!chatOpen"></i>
            <i class="fa-solid fa-xmark text-2xl" x-show="chatOpen"></i>
        </button>
    </div>

    <!-- ===========================
         JAVASCRIPT PRINCIPAL
    =========================== -->
    <script>
    function clinicHub() {
        return {
            activeSection: 'inicio',
            showDemo: false,
            demoActive: 0,
            chatOpen: false,
            chatInput: '',
            isTyping: false,
            chatMessages: [
                {
                    role: 'assistant',
                    content: '¡Hola! Soy el asistente de ClinicHub. Puedo ayudarte con información sobre los módulos, funcionalidades o cómo usar el sistema. ¿En qué te ayudo?'
                }
            ],
            navItems: [
                { id: 'inicio',    label: 'Inicio',      icon: 'fa-solid fa-house' },
                { id: 'modulos',   label: 'Módulos',     icon: 'fa-solid fa-cube' },
                { id: 'metricas',  label: 'Métricas',    icon: 'fa-solid fa-chart-simple' },
                { id: 'impacto',   label: 'Impacto',     icon: 'fa-solid fa-rocket' },
            ],
            demoItems: [
                {
                    gradient: 'bg-gradient-to-br from-blue-500 to-indigo-600',
                    ring: 'ring-blue-500',
                    textColor: 'text-blue-600',
                    icon: 'fa-solid fa-chart-line',
                    label: 'Dashboard',
                    title: 'Dashboard en Tiempo Real',
                    desc: 'Visualiza métricas clave, flujo de pacientes y análisis predictivo con inteligencia artificial.',
                    link: '/dashboard'
                },
                {
                    gradient: 'bg-gradient-to-br from-emerald-500 to-teal-600',
                    ring: 'ring-emerald-500',
                    textColor: 'text-emerald-600',
                    icon: 'fa-solid fa-calendar-check',
                    label: 'Citas',
                    title: 'Calendario Interactivo de Citas',
                    desc: 'Programación avanzada con estados automáticos, asignación de consultorios y recordatorios.',
                    link: '/citas'
                },
                {
                    gradient: 'bg-gradient-to-br from-purple-500 to-pink-600',
                    ring: 'ring-purple-500',
                    textColor: 'text-purple-600',
                    icon: 'fa-solid fa-file-prescription',
                    label: 'Expedientes',
                    title: 'Expediente Electrónico Clínico',
                    desc: 'Historial clínico completo, diagnósticos registrados y seguimiento de tratamientos activos.',
                    link: '/pacientes'
                },
                {
                    gradient: 'bg-gradient-to-br from-cyan-500 to-blue-600',
                    ring: 'ring-cyan-500',
                    textColor: 'text-cyan-600',
                    icon: 'fa-solid fa-capsules',
                    label: 'Medicamentos',
                    title: 'Control de Medicamentos',
                    desc: 'Dosificación precisa, control de frecuencias y alertas de efectos secundarios en tiempo real.',
                    link: '/medicamentos'
                },
                {
                    gradient: 'bg-gradient-to-br from-amber-500 to-orange-600',
                    ring: 'ring-amber-500',
                    textColor: 'text-amber-600',
                    icon: 'fa-solid fa-user-doctor',
                    label: 'Médicos',
                    title: 'Gestión del Equipo Médico',
                    desc: 'Especialidades, horarios, rendimiento y métricas por médico en un solo panel.',
                    link: '/medicos'
                },
                {
                    gradient: 'bg-gradient-to-br from-rose-500 to-red-600',
                    ring: 'ring-rose-500',
                    textColor: 'text-rose-600',
                    icon: 'fa-solid fa-kit-medical',
                    label: 'Tratamientos',
                    title: 'Seguimiento de Tratamientos',
                    desc: 'Evolución médica vinculada a planes terapéuticos activos con reportes automatizados.',
                    link: '/tratamientos'
                },
            ],

            init() {
                this.initHexParticles();
                this.initScrollReveal();
                this.initScrollSpy();
                this.initCounters();
            },

            scrollTo(id) {
                const el = document.getElementById(id);
                if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                this.activeSection = id;
            },

            // ===== CHATBOT IA REAL =====
            async sendMessage() {
                const text = this.chatInput.trim();
                if (!text || this.isTyping) return;

                this.chatMessages.push({ role: 'user', content: text });
                this.chatInput = '';
                this.isTyping = true;

                await this.$nextTick();
                this.scrollChat();

                try {
                    const response = await fetch('https://api.anthropic.com/v1/messages', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            model: 'claude-sonnet-4-20250514',
                            max_tokens: 400,
                            system: `Eres el asistente de IA de ClinicHub, un sistema premium de gestión médica en español.
                            Ayudas a usuarios con información sobre los módulos del sistema: Gestión de Pacientes, Citas Inteligentes, Diagnósticos, Tratamientos, Medicamentos y Médicos.
                            Responde siempre en español, de forma concisa (máximo 3 oraciones), profesional y amigable.
                            Si preguntan sobre funcionalidades, explica cómo el módulo correspondiente ayuda al trabajo médico.`,
                            messages: this.chatMessages.map(m => ({ role: m.role, content: m.content }))
                        })
                    });

                    const data = await response.json();
                    const reply = data?.content?.[0]?.text || 'Lo siento, hubo un error. ¿Puedo ayudarte con algo más?';
                    this.chatMessages.push({ role: 'assistant', content: reply });
                } catch (err) {
                    this.chatMessages.push({ role: 'assistant', content: 'Lo siento, hubo un problema de conexión. Por favor intenta de nuevo.' });
                }

                this.isTyping = false;
                await this.$nextTick();
                this.scrollChat();
            },

            scrollChat() {
                const el = this.$refs.chatMessages;
                if (el) el.scrollTop = el.scrollHeight;
            },

            // ===== HEX PARTICLES =====
            initHexParticles() {
                const container = document.getElementById('hexParticles');
                if (!container) return;

                const colors = [
                    'rgba(37,99,235,0.5)',
                    'rgba(99,102,241,0.4)',
                    'rgba(14,165,233,0.45)',
                    'rgba(139,92,246,0.3)',
                    'rgba(6,182,212,0.4)',
                ];

                for (let i = 0; i < 18; i++) {
                    const size = Math.random() * 50 + 20;
                    const x = Math.random() * 100;
                    const duration = Math.random() * 18 + 12;
                    const delay = Math.random() * 15;
                    const color = colors[Math.floor(Math.random() * colors.length)];

                    const hex = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    hex.setAttribute('viewBox', '0 0 100 115');
                    hex.setAttribute('width', size);
                    hex.setAttribute('height', size * 1.15);

                    const polygon = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
                    polygon.setAttribute('points', '50,0 100,25 100,75 50,100 0,75 0,25');
                    polygon.style.fill = 'none';
                    polygon.style.stroke = color;
                    polygon.style.strokeWidth = '2';

                    hex.appendChild(polygon);
                    hex.classList.add('hex-particle');
                    hex.style.left = x + 'vw';
                    hex.style.animationDuration = duration + 's';
                    hex.style.animationDelay = delay + 's';

                    container.appendChild(hex);
                }
            },

            // ===== SCROLL REVEAL =====
            initScrollReveal() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(e => {
                        if (e.isIntersecting) { e.target.classList.add('visible'); }
                    });
                }, { threshold: 0.15 });

                document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
            },

            // ===== SCROLL SPY =====
            initScrollSpy() {
                const ids = ['inicio', 'modulos', 'metricas', 'impacto'];
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(e => {
                        if (e.isIntersecting) this.activeSection = e.target.id;
                    });
                }, { rootMargin: '-40% 0px -55% 0px' });

                ids.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) observer.observe(el);
                });
            },

            // ===== COUNTERS =====
            initCounters() {
                const counters = document.querySelectorAll('.counter');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (!entry.isIntersecting) return;
                        const el = entry.target;
                        const target = parseInt(el.dataset.target);
                        const suffix = el.dataset.suffix || '';
                        const isK = suffix.includes('K');
                        const display = isK ? Math.round(target / 1000) : target;
                        let current = 0;
                        const step = Math.ceil(display / 50);
                        const timer = setInterval(() => {
                            current = Math.min(current + step, display);
                            el.textContent = current + (isK ? 'K+' : suffix);
                            if (current >= display) clearInterval(timer);
                        }, 30);
                        observer.unobserve(el);
                    });
                }, { threshold: 0.5 });

                counters.forEach(c => observer.observe(c));
            }
        }
    }
    </script>

    <style>
        @keyframes progressLoad {
            from { width: 0%; }
            to   { width: 78%; }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }
    </style>

</body>
</html>
