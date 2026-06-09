<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pearl Clinic OS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:opsz,wght@9..40,300;400;500;600&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<style>
:root {
  /* Paleta de colores principal (tonos perla/gris azulado) */
  --pearl-50: #fafbfc;
  --pearl-100: #f4f6f8;
  --pearl-200: #eaecf0;
  --pearl-300: #d8dde5;
  --pearl-400: #b0bac8;
  --pearl-500: #8493a8;
  --pearl-600: #5d6e85;
  --pearl-700: #3e4f63;
  --pearl-800: #2a3547;
  --pearl-900: #19222e;
  /* Colores de acento y brillo */
  --plat-shine: #e8edf4;
  --plat-glow: rgba(180,196,218,0.18);
  --accent-ice: #c8d8e8;
  --accent-silver: #a8bbd0;
  --accent-crystal: #dce8f0;
  /* Dimensiones y formas */
  --sidebar-w: 272px;
  --radius-card: 22px;
  --radius-lg: 16px;
  --radius-md: 10px;
  /* Sombras */
  --shadow-pearl: 0 2px 24px rgba(120,140,165,0.10), 0 1px 4px rgba(120,140,165,0.06);
  --shadow-lift: 0 12px 48px rgba(80,105,135,0.14), 0 2px 8px rgba(80,105,135,0.08);
  --shadow-deep: 0 24px 80px rgba(60,85,115,0.18);
  /* Animaciones */
  --transition: cubic-bezier(0.4, 0, 0.2, 1);
  /* Familias de fuentes */
  --font-display: 'Cormorant Garamond', serif;
  --font-body: 'DM Sans', sans-serif;
  --font-mono: 'DM Mono', monospace;
}

/* Reinicio básico de márgenes y modelo de caja */
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

/* Desplazamiento suave en toda la página */
html { scroll-behavior: smooth; }

body {
  font-family: var(--font-body);
  background: var(--pearl-100);
  color: var(--pearl-800);
  min-height: 100vh;
  overflow-x: hidden;
}

/* ══════════════════════════════════════════════════════════════
   PANTALLA DE BIENVENIDA (SPLASH SCREEN) – INTRO CINEMÁTICA
   ══════════════════════════════════════════════════════════════ */
#splashScreen {
  /* Cubre toda la ventana mientras se carga */
  position: fixed; inset: 0; z-index: 99999;
  background: linear-gradient(160deg, #f8f9fb 0%, #edf1f7 40%, #e4ecf5 100%);
  display: flex; align-items: center; justify-content: center;
  /* Se desvanece al quitar la clase .fade-out */
  transition: opacity 1.2s var(--transition), transform 1.2s var(--transition);
  overflow: hidden;
}
#splashScreen.fade-out {
  opacity: 0; transform: scale(1.04); pointer-events: none;
}

/* Anillos decorativos de fondo que se expanden lentamente */
.splash-bg-rings {
  position: absolute; inset: 0; overflow: hidden;
}
.splash-ring {
  position: absolute; border-radius: 50%;
  border: 1px solid rgba(168,187,208,0.25);
  animation: ringExpand 4s ease-out infinite;
}
/* Cada anillo tiene distinto tamaño y retraso para crear efecto de capas */
.splash-ring:nth-child(1) { width:300px; height:300px; left:50%; top:50%; transform:translate(-50%,-50%); animation-delay:0s; }
.splash-ring:nth-child(2) { width:500px; height:500px; left:50%; top:50%; transform:translate(-50%,-50%); animation-delay:0.6s; }
.splash-ring:nth-child(3) { width:720px; height:720px; left:50%; top:50%; transform:translate(-50%,-50%); animation-delay:1.2s; }
.splash-ring:nth-child(4) { width:960px; height:960px; left:50%; top:50%; transform:translate(-50%,-50%); animation-delay:1.8s; }
@keyframes ringExpand {
  0% { opacity:0.7; transform:translate(-50%,-50%) scale(0.8); }
  100% { opacity:0; transform:translate(-50%,-50%) scale(1.3); }
}

/* Pequeñas partículas flotantes en el fondo del splash */
.splash-particle {
  position: absolute; width:3px; height:3px; border-radius:50%;
  background: var(--accent-silver); opacity:0;
  animation: particleDrift 5s ease-in-out infinite;
}
@keyframes particleDrift {
  0% { opacity:0; transform:translateY(0) scale(0); }
  20% { opacity:0.6; transform:translateY(-20px) scale(1); }
  80% { opacity:0.3; transform:translateY(-80px) scale(0.8); }
  100% { opacity:0; transform:translateY(-120px) scale(0); }
}

/* Contenido central del splash (logo, título, cargando) */
.splash-center {
  position: relative; text-align: center; z-index:1;
  /* Animación de entrada */
  animation: splashReveal 1.4s var(--transition) forwards;
  opacity: 0;
}
@keyframes splashReveal {
  0% { opacity:0; transform:translateY(24px); }
  100% { opacity:1; transform:translateY(0); }
}

/* Emblema circular con anillos giratorios */
.splash-emblem {
  width: 88px; height: 88px; margin: 0 auto 2rem;
  position: relative;
}
.splash-emblem-ring {
  position: absolute; inset: 0; border-radius: 50%;
  border: 1.5px solid var(--accent-silver);
  animation: emblemSpin 8s linear infinite;
}
.splash-emblem-ring:nth-child(2) {
  inset: 8px;
  border-color: var(--accent-ice);
  animation-direction: reverse;
  animation-duration: 6s;
}
@keyframes emblemSpin {
  to { transform: rotate(360deg); }
}
.splash-emblem-inner {
  position: absolute; inset: 16px;
  background: linear-gradient(145deg, #fff, var(--plat-shine));
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 4px 20px rgba(120,148,180,0.2);
}
.splash-emblem-inner i { font-size: 22px; color: var(--pearl-600); }

/* Título grande tipo serif */
.splash-title {
  font-family: var(--font-display);
  font-size: 3.8rem; font-weight: 300;
  letter-spacing: 0.12em; color: var(--pearl-800);
  line-height: 1;
}
.splash-title span { font-weight: 600; }

/* Subtítulo en mayúsculas pequeñas */
.splash-sub {
  font-size: 0.72rem; letter-spacing: 0.35em;
  color: var(--pearl-500); margin-top: 0.5rem;
  text-transform: uppercase;
}

/* Línea divisoria fina */
.splash-divider {
  width: 48px; height: 1px; background: var(--accent-silver);
  margin: 1.8rem auto;
}

/* Saludo y nombre de usuario */
.splash-greeting {
  font-size: 1.1rem; color: var(--pearl-600);
  font-weight: 300;
}
.splash-greeting strong { font-weight: 500; color: var(--pearl-700); }

/* Indicador de carga (tres puntos animados) */
.splash-loader {
  margin-top: 2.5rem; display: flex; align-items: center;
  justify-content: center; gap: 6px;
}
.splash-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--accent-silver);
  animation: dotPulse 1.4s ease-in-out infinite;
}
.splash-dot:nth-child(2) { animation-delay: 0.2s; }
.splash-dot:nth-child(3) { animation-delay: 0.4s; }
@keyframes dotPulse {
  0%, 80%, 100% { transform:scale(0.6); opacity:0.4; }
  40% { transform:scale(1); opacity:1; }
}

/* ══════════════════════════════════════════════════════════════
   ESTRUCTURA PRINCIPAL DE LA APLICACIÓN
   ══════════════════════════════════════════════════════════════ */
#appShell {
  display: flex; min-height: 100vh;
  /* Aparece con suavidad después del splash */
  opacity: 0; animation: appReveal 0.8s var(--transition) forwards;
}
@keyframes appReveal {
  from { opacity:0; transform:translateY(8px); }
  to { opacity:1; transform:translateY(0); }
}

/* ══════════════════════════════════════════════════════════════
   BARRA LATERAL (SIDEBAR) CON NAVEGACIÓN
   ══════════════════════════════════════════════════════════════ */
#sidebar {
  width: var(--sidebar-w); min-height: 100vh;
  background: #fff;
  border-right: 1px solid var(--pearl-200);
  display: flex; flex-direction: column;
  padding: 0;
  position: sticky; top: 0; height: 100vh; overflow-y: auto;
  flex-shrink: 0;
  box-shadow: 2px 0 20px rgba(100,120,150,0.06);
}

/* Cabecera de la marca/logotipo */
.sidebar-brand {
  padding: 2rem 1.5rem 1.5rem;
  border-bottom: 1px solid var(--pearl-200);
}
.brand-mark {
  display: flex; align-items: center; gap: 0.75rem;
}
.brand-icon {
  width: 40px; height: 40px; border-radius: 12px;
  background: linear-gradient(145deg, var(--pearl-100), var(--plat-shine));
  border: 1px solid var(--pearl-300);
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 2px 8px rgba(100,120,150,0.12);
}
.brand-icon i { font-size: 18px; color: var(--pearl-600); }
.brand-text h1 {
  font-family: var(--font-display);
  font-size: 1.35rem; font-weight: 600;
  color: var(--pearl-800); letter-spacing: 0.01em;
  line-height: 1.1;
}
.brand-text p {
  font-size: 0.65rem; color: var(--pearl-400);
  letter-spacing: 0.15em; text-transform: uppercase; margin-top: 1px;
}

/* Etiquetas de sección en la navegación */
.sidebar-section-label {
  padding: 1.4rem 1.5rem 0.5rem;
  font-size: 0.6rem; letter-spacing: 0.2em;
  text-transform: uppercase; color: var(--pearl-400);
  font-weight: 500;
}

/* Cada ítem del menú */
.nav-item {
  display: flex; align-items: center; gap: 0.75rem;
  padding: 0.7rem 1.2rem;
  margin: 0.15rem 0.7rem;
  border-radius: var(--radius-md);
  color: var(--pearl-600);
  font-size: 0.875rem; font-weight: 400;
  cursor: pointer;
  transition: all 0.2s var(--transition);
  position: relative;
  user-select: none;
}
.nav-item i { width: 20px; font-size: 1rem; text-align:center; flex-shrink:0; }
/* Badge numérico opcional (contador) */
.nav-item .nav-badge {
  margin-left: auto; background: var(--pearl-100);
  border: 1px solid var(--pearl-200);
  color: var(--pearl-500); font-size: 0.65rem;
  padding: 1px 7px; border-radius: 20px;
  font-variant-numeric: tabular-nums;
}
.nav-item:hover {
  background: var(--pearl-50);
  color: var(--pearl-800);
}
/* Ítem activo */
.nav-item.active {
  background: linear-gradient(135deg, var(--pearl-100), var(--plat-shine));
  color: var(--pearl-800);
  font-weight: 500;
  border: 1px solid var(--pearl-200);
  box-shadow: 0 1px 6px rgba(100,120,150,0.08);
}
.nav-item.active::before {
  content:''; position:absolute; left: 0; top: 20%; bottom: 20%;
  width: 3px; border-radius: 0 3px 3px 0;
  background: linear-gradient(to bottom, var(--pearl-600), var(--pearl-400));
  margin-left: -0.7rem;
}

/* Espacio flexible para empujar el footer hacia abajo */
.sidebar-spacer { flex: 1; }

/* Pie de la barra lateral con datos del usuario y botón de salir */
.sidebar-footer {
  padding: 1rem 0.7rem;
  border-top: 1px solid var(--pearl-200);
}
.user-chip {
  display: flex; align-items: center; gap: 0.65rem;
  padding: 0.65rem 0.9rem;
  background: var(--pearl-50);
  border: 1px solid var(--pearl-200);
  border-radius: var(--radius-md);
}
.user-avatar {
  width: 32px; height: 32px; border-radius: 50%;
  background: linear-gradient(135deg, var(--pearl-300), var(--pearl-400));
  display: flex; align-items: center; justify-content: center;
  font-size: 0.75rem; color: var(--pearl-800); font-weight: 500;
  flex-shrink: 0;
}
.user-info { flex: 1; min-width: 0; }
.user-info .name { font-size: 0.82rem; font-weight: 500; color: var(--pearl-800); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.user-info .role { font-size: 0.67rem; color: var(--pearl-400); }
.sidebar-footer .logout-btn {
  width: 100%; margin-top: 0.5rem;
  display: flex; align-items: center; gap: 0.6rem;
  padding: 0.55rem 0.9rem;
  background: transparent;
  border: none; border-radius: var(--radius-md);
  color: var(--pearl-500); font-size: 0.82rem;
  cursor: pointer; font-family: var(--font-body);
  transition: all 0.18s; text-align: left;
}
.sidebar-footer .logout-btn:hover { background: #fff4f4; color: #b91c1c; }

/* ══════════════════════════════════════════════════════════════
   PANEL PRINCIPAL (CONTENIDO DERECHO)
   ══════════════════════════════════════════════════════════════ */
#mainPanel {
  flex: 1; min-width: 0;
  display: flex; flex-direction: column;
  background: var(--pearl-100);
}

/* Barra superior (topbar) con título y búsqueda */
.topbar {
  background: rgba(255,255,255,0.9);
  backdrop-filter: blur(16px); /* Efecto vidrio */
  border-bottom: 1px solid var(--pearl-200);
  padding: 1rem 2rem;
  display: flex; align-items: center; gap: 1.5rem;
  position: sticky; top: 0; z-index: 100;
}
.topbar-title {
  flex: 1;
}
.topbar-title h2 {
  font-family: var(--font-display);
  font-size: 1.55rem; font-weight: 600;
  color: var(--pearl-800); line-height: 1.1;
}
.topbar-title p {
  font-size: 0.75rem; color: var(--pearl-400);
  margin-top: 2px; letter-spacing: 0.04em;
}
/* Campo de búsqueda en la topbar */
.topbar-search {
  display: flex; align-items: center; gap: 0.6rem;
  background: var(--pearl-50);
  border: 1px solid var(--pearl-200);
  border-radius: 50px; padding: 0.5rem 1rem;
  width: 280px; transition: all 0.2s;
}
.topbar-search:focus-within {
  border-color: var(--pearl-400);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(168,187,208,0.15);
  width: 340px;
}
.topbar-search i { color: var(--pearl-400); font-size: 0.9rem; flex-shrink:0; }
.topbar-search input {
  border: none; background: transparent; outline: none;
  font-family: var(--font-body); font-size: 0.85rem;
  color: var(--pearl-800); width: 100%;
}
.topbar-search input::placeholder { color: var(--pearl-400); }
/* Botones de acción (campana, etc.) */
.topbar-actions { display: flex; align-items: center; gap: 0.5rem; }
.icon-btn {
  width: 36px; height: 36px; border-radius: 50%;
  background: var(--pearl-50); border: 1px solid var(--pearl-200);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; color: var(--pearl-500); font-size: 0.9rem;
  transition: all 0.18s;
}
.icon-btn:hover { background: #fff; border-color: var(--pearl-300); color: var(--pearl-700); box-shadow: var(--shadow-pearl); }
.notif-dot { position: relative; }
.notif-dot::after {
  content:''; position:absolute; top:6px; right:6px;
  width:7px; height:7px; background:#e74c3c;
  border-radius:50%; border:1.5px solid var(--pearl-50);
}

/* Área de contenido principal (se reemplaza según la navegación) */
#contentArea {
  flex: 1; padding: 2rem;
  overflow-y: auto;
}

/* ══════════════════════════════════════════════════════════════
   COMPONENTES DEL DASHBOARD
   ══════════════════════════════════════════════════════════════ */
/* Encabezados de sección */
.section-header {
  display: flex; align-items: baseline; justify-content: space-between;
  margin-bottom: 1.2rem;
}
.section-header h3 {
  font-family: var(--font-display);
  font-size: 1.4rem; font-weight: 600;
  color: var(--pearl-800);
}
.section-header p { font-size: 0.78rem; color: var(--pearl-400); }

/* Cuadrícula de tarjetas de estadísticas */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  gap: 1.2rem;
  margin-bottom: 2rem;
}
.stat-card {
  background: #fff;
  border: 1px solid var(--pearl-200);
  border-radius: var(--radius-card);
  padding: 1.4rem 1.5rem;
  position: relative; overflow: hidden;
  transition: all 0.3s var(--transition);
  /* Se animan al aparecer, una tras otra */
  animation: statReveal 0.6s var(--transition) both;
}
@keyframes statReveal {
  from { opacity:0; transform:translateY(16px); }
  to { opacity:1; transform:translateY(0); }
}
/* Retrasos para cada tarjeta (efecto cascada) */
.stat-card:nth-child(1) { animation-delay:0.05s; }
.stat-card:nth-child(2) { animation-delay:0.10s; }
.stat-card:nth-child(3) { animation-delay:0.15s; }
.stat-card:nth-child(4) { animation-delay:0.20s; }
.stat-card:nth-child(5) { animation-delay:0.25s; }
.stat-card:nth-child(6) { animation-delay:0.30s; }
/* Línea decorativa inferior al hacer hover */
.stat-card::after {
  content:''; position:absolute; bottom:0; left:0; right:0; height:3px;
  background: linear-gradient(90deg, transparent, var(--pearl-300), transparent);
  opacity:0; transition: opacity 0.3s;
}
.stat-card:hover { transform:translateY(-4px); box-shadow: var(--shadow-lift); }
.stat-card:hover::after { opacity:1; }
.stat-card-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1rem;
}
/* Icono de la estadística, con colores temáticos */
.stat-icon {
  width: 42px; height: 42px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem;
}
.stat-icon.blue { background: #eff6ff; color: #2563eb; }
.stat-icon.teal { background: #f0fdf8; color: #0d9488; }
.stat-icon.purple { background: #f5f3ff; color: #7c3aed; }
.stat-icon.rose { background: #fff1f2; color: #e11d48; }
.stat-icon.amber { background: #fffbeb; color: #d97706; }
.stat-icon.sky { background: #f0f9ff; color: #0284c7; }
/* Tendencia (sube, baja, estable) */
.stat-trend {
  font-size: 0.72rem; font-weight: 500;
  padding: 3px 8px; border-radius: 20px;
}
.stat-trend.up { background: #f0fdf8; color: #059669; }
.stat-trend.down { background: #fff1f2; color: #e11d48; }
.stat-trend.neutral { background: var(--pearl-100); color: var(--pearl-500); }
/* Número grande de la estadística */
.stat-num {
  font-family: var(--font-display);
  font-size: 2.4rem; font-weight: 600;
  color: var(--pearl-800); line-height: 1;
  letter-spacing: -0.02em;
  margin-bottom: 0.25rem;
}
/* Etiqueta descriptiva */
.stat-label {
  font-size: 0.78rem; color: var(--pearl-500); font-weight: 400;
}

/* Rejillas auxiliares para distribuir contenido */
.grid-2 {
  display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;
  margin-bottom: 2rem;
}
.grid-3 { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; }

/* Tarjeta genérica con sombra suave al hover */
.card {
  background: #fff;
  border: 1px solid var(--pearl-200);
  border-radius: var(--radius-card);
  padding: 1.5rem;
  transition: box-shadow 0.3s;
}
.card:hover { box-shadow: var(--shadow-pearl); }
.card-title {
  font-family: var(--font-display);
  font-size: 1.1rem; font-weight: 600;
  color: var(--pearl-800); margin-bottom: 1rem;
  display: flex; align-items: center; gap: 0.5rem;
}
.card-title i { color: var(--pearl-400); font-size: 1rem; }

/* Lista de próximas citas */
.appt-list { display: flex; flex-direction: column; gap: 0.65rem; }
.appt-item {
  display: flex; align-items: center; gap: 0.9rem;
  padding: 0.75rem 1rem;
  background: var(--pearl-50);
  border: 1px solid var(--pearl-100);
  border-radius: var(--radius-md);
  transition: all 0.2s;
}
.appt-item:hover { background: var(--pearl-100); border-color: var(--pearl-200); }
.appt-avatar {
  width: 36px; height: 36px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.75rem; font-weight: 500;
  flex-shrink: 0;
}
.appt-info { flex: 1; min-width: 0; }
.appt-name { font-size: 0.85rem; font-weight: 500; color: var(--pearl-800); }
.appt-meta { font-size: 0.73rem; color: var(--pearl-500); }
.appt-time {
  font-size: 0.75rem; font-family: var(--font-mono);
  color: var(--pearl-600); white-space: nowrap;
  background: var(--pearl-100); padding: 3px 8px;
  border-radius: 6px;
}

/* Etiquetas de estado */
.badge {
  display: inline-flex; align-items: center; gap: 4px;
  font-size: 0.7rem; font-weight: 500;
  padding: 3px 10px; border-radius: 20px;
}
.badge-active { background:#f0fdf8; color:#059669; }
.badge-pending { background:#fffbeb; color:#d97706; }
.badge-done { background:#f5f3ff; color:#7c3aed; }
.badge-cancel { background:#fff1f2; color:#e11d48; }

/* ══════════════════════════════════════════════════════════════
   MÓDULO DE TABLA DE DATOS
   ══════════════════════════════════════════════════════════════ */
.module-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1.5rem;
}
.module-header-left h2 {
  font-family: var(--font-display);
  font-size: 1.8rem; font-weight: 600; color: var(--pearl-800);
}
.module-header-left p { font-size: 0.78rem; color: var(--pearl-400); margin-top: 2px; }
/* Botón "Agregar nuevo" */
.btn-add {
  display: flex; align-items: center; gap: 0.5rem;
  padding: 0.65rem 1.4rem;
  background: var(--pearl-800);
  color: #fff; border: none;
  border-radius: 50px; font-size: 0.85rem;
  font-weight: 500; cursor: pointer;
  font-family: var(--font-body);
  transition: all 0.2s;
  box-shadow: 0 2px 12px rgba(50,70,100,0.2);
}
.btn-add:hover { background: var(--pearl-900); transform: translateY(-1px); box-shadow: 0 4px 20px rgba(50,70,100,0.28); }

/* Contenedor de la tabla con bordes redondeados */
.table-wrap {
  background: #fff;
  border: 1px solid var(--pearl-200);
  border-radius: var(--radius-card);
  overflow: hidden;
  box-shadow: var(--shadow-pearl);
}
/* Barra de herramientas sobre la tabla (búsqueda + conteo) */
.table-toolbar {
  display: flex; align-items: center; gap: 1rem;
  padding: 1rem 1.5rem;
  border-bottom: 1px solid var(--pearl-100);
}
.table-search {
  display: flex; align-items: center; gap: 0.5rem;
  background: var(--pearl-50); border: 1px solid var(--pearl-200);
  border-radius: 50px; padding: 0.4rem 0.9rem; flex: 1; max-width: 360px;
}
.table-search input {
  border: none; background: transparent; outline: none;
  font-size: 0.83rem; font-family: var(--font-body);
  color: var(--pearl-800); width: 100%;
}
.table-count {
  font-size: 0.78rem; color: var(--pearl-400);
  font-variant-numeric: tabular-nums;
  margin-left: auto;
}
/* Tabla de datos */
.data-table {
  width: 100%; border-collapse: collapse;
}
.data-table thead th {
  background: var(--pearl-50);
  padding: 0.85rem 1.2rem;
  text-align: left; font-size: 0.72rem;
  font-weight: 500; letter-spacing: 0.08em;
  text-transform: uppercase; color: var(--pearl-500);
  border-bottom: 1px solid var(--pearl-100);
  white-space: nowrap;
}
.data-table tbody tr {
  border-bottom: 1px solid var(--pearl-50);
  transition: background 0.15s;
}
.data-table tbody tr:last-child { border-bottom: none; }
.data-table tbody tr:hover { background: var(--pearl-50); }
.data-table tbody td {
  padding: 0.9rem 1.2rem;
  font-size: 0.84rem; color: var(--pearl-700);
}
/* Columna de ID con fuente monoespaciada */
.data-table tbody td.id-col {
  font-family: var(--font-mono); font-size: 0.75rem;
  color: var(--pearl-400);
}
/* Botones de acción por fila */
.action-btns { display: flex; align-items: center; gap: 0.4rem; }
.action-btn {
  width: 30px; height: 30px; border-radius: 8px;
  border: 1px solid var(--pearl-200);
  background: transparent; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.8rem; color: var(--pearl-500);
  transition: all 0.15s;
}
.action-btn:hover { background: var(--pearl-100); color: var(--pearl-800); }
.action-btn.delete:hover { background: #fff1f2; color: #e11d48; border-color: #fecdd3; }
/* Mensaje cuando la tabla está vacía */
.table-empty {
  text-align: center; padding: 3rem;
}
.table-empty i { font-size: 2.5rem; color: var(--pearl-300); display:block; margin-bottom: 1rem; }
.table-empty p { color: var(--pearl-400); font-size: 0.88rem; }

/* ══════════════════════════════════════════════════════════════
   SISTEMA DE VENTANAS MODALES
   ══════════════════════════════════════════════════════════════ */
#modalOverlay {
  position: fixed; inset: 0; z-index: 9999;
  background: rgba(15,25,45,0.35);
  backdrop-filter: blur(12px); /* Efecto de desenfoque detrás del modal */
  display: flex; align-items: center; justify-content: center;
  padding: 1rem;
  opacity: 0; visibility: hidden;
  transition: all 0.3s var(--transition);
}
#modalOverlay.active { opacity: 1; visibility: visible; }
.modal-box {
  background: #fff;
  border-radius: 24px;
  width: 100%; max-width: 520px;
  max-height: 90vh; overflow-y: auto;
  box-shadow: var(--shadow-deep);
  border: 1px solid var(--pearl-200);
  transform: translateY(20px) scale(0.97);
  transition: transform 0.3s var(--transition);
}
#modalOverlay.active .modal-box { transform: translateY(0) scale(1); }
.modal-header {
  padding: 1.5rem 1.8rem 1rem;
  border-bottom: 1px solid var(--pearl-100);
  display: flex; align-items: center; justify-content: space-between;
}
.modal-header h3 {
  font-family: var(--font-display);
  font-size: 1.4rem; font-weight: 600;
  color: var(--pearl-800);
}
.modal-close {
  width: 32px; height: 32px; border-radius: 50%;
  border: 1px solid var(--pearl-200); background: transparent;
  cursor: pointer; display: flex; align-items: center; justify-content: center;
  font-size: 0.9rem; color: var(--pearl-400); transition: all 0.15s;
}
.modal-close:hover { background: var(--pearl-100); color: var(--pearl-800); }
.modal-body { padding: 1.5rem 1.8rem; }

/* Campos de formulario dentro del modal */
.form-group { margin-bottom: 1.1rem; }
.form-label {
  display: block; font-size: 0.78rem; font-weight: 500;
  color: var(--pearl-600); margin-bottom: 0.4rem;
  letter-spacing: 0.02em;
}
.form-input, .form-select {
  width: 100%; padding: 0.65rem 0.9rem;
  background: var(--pearl-50);
  border: 1px solid var(--pearl-200);
  border-radius: var(--radius-md);
  font-family: var(--font-body); font-size: 0.875rem;
  color: var(--pearl-800); outline: none;
  transition: all 0.2s;
}
.form-input:focus, .form-select:focus {
  border-color: var(--pearl-400);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(168,187,208,0.2);
}
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem; }
/* Pie del modal con botones */
.modal-footer {
  padding: 1rem 1.8rem 1.5rem;
  display: flex; align-items: center; gap: 0.75rem; justify-content: flex-end;
}
.btn-cancel {
  padding: 0.6rem 1.3rem;
  background: transparent; border: 1px solid var(--pearl-200);
  border-radius: 50px; font-size: 0.84rem; cursor: pointer;
  font-family: var(--font-body); color: var(--pearl-600);
  transition: all 0.15s;
}
.btn-cancel:hover { background: var(--pearl-50); }
.btn-save {
  padding: 0.6rem 1.5rem;
  background: var(--pearl-800); border: none;
  border-radius: 50px; color: #fff; font-size: 0.84rem;
  font-weight: 500; cursor: pointer; font-family: var(--font-body);
  transition: all 0.2s;
  box-shadow: 0 2px 10px rgba(50,70,100,0.18);
}
.btn-save:hover { background: var(--pearl-900); }

/* ══════════════════════════════════════════════════════════════
   NOTIFICACIONES TOAST
   ══════════════════════════════════════════════════════════════ */
#toastContainer {
  position: fixed; bottom: 1.5rem; right: 1.5rem;
  z-index: 99998; display: flex; flex-direction: column; gap: 0.5rem;
  pointer-events: none;
}
.toast {
  display: flex; align-items: center; gap: 0.7rem;
  padding: 0.8rem 1.2rem;
  background: var(--pearl-900);
  color: var(--pearl-100);
  border-radius: 50px;
  font-size: 0.84rem;
  box-shadow: 0 4px 24px rgba(20,35,60,0.3);
  animation: toastIn 0.35s var(--transition);
  pointer-events: auto;
  border: 1px solid rgba(255,255,255,0.08);
}
.toast.success i { color: #6ee7b7; }
.toast.error i { color: #fca5a5; }
@keyframes toastIn {
  from { opacity:0; transform:translateX(24px) scale(0.95); }
  to { opacity:1; transform:translateX(0) scale(1); }
}
@keyframes toastOut {
  to { opacity:0; transform:translateX(24px) scale(0.95); }
}

/* ══════════════════════════════════════════════════════════════
   VARIOS / GRÁFICOS Y ESTADÍSTICAS RÁPIDAS
   ══════════════════════════════════════════════════════════════ */
.chart-wrap { position: relative; height: 240px; margin-top: 0.5rem; }
.chart-wrap-sm { position: relative; height: 180px; margin-top: 0.5rem; }

.quick-stat-row {
  display: flex; gap: 0.6rem; margin-bottom: 1.2rem;
}
.quick-stat {
  flex: 1; background: var(--pearl-50); border: 1px solid var(--pearl-100);
  border-radius: var(--radius-md);
  padding: 0.7rem 0.9rem; text-align: center;
}
.quick-stat .num { font-family: var(--font-display); font-size: 1.5rem; font-weight: 600; color: var(--pearl-800); }
.quick-stat .lbl { font-size: 0.68rem; color: var(--pearl-400); letter-spacing: 0.06em; }

/* Animación de entrada para cada vista dentro del área de contenido */
#contentArea > * { animation: fadeUp 0.35s var(--transition) both; }

/* ══════════════════════════════════════════════════════════════
   MEJORAS UX MODAL PACIENTES
   ══════════════════════════════════════════════════════════════ */
/* Selector visual de género */
.gender-selector { display: flex; gap: 0.5rem; }
.gender-option {
  flex: 1; display: flex; flex-direction: column; align-items: center;
  gap: 0.35rem; padding: 0.65rem 0.5rem;
  border: 1.5px solid var(--pearl-200); border-radius: var(--radius-md);
  cursor: pointer; background: var(--pearl-50);
  transition: all 0.18s; font-size: 0.78rem;
  color: var(--pearl-500); font-family: var(--font-body);
}
.gender-option i { font-size: 1.1rem; }
.gender-option:hover { border-color: var(--pearl-400); background: #fff; color: var(--pearl-700); }
.gender-option.selected {
  border-color: var(--pearl-700); background: var(--pearl-800);
  color: #fff; box-shadow: 0 2px 8px rgba(42,53,71,0.18);
}
/* Chips de tipo de sangre */
.blood-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 0.4rem; }
.blood-chip {
  text-align: center; padding: 0.45rem 0.3rem;
  border: 1.5px solid var(--pearl-200); border-radius: 8px;
  cursor: pointer; font-size: 0.82rem; font-weight: 600;
  color: var(--pearl-500); background: var(--pearl-50);
  font-family: var(--font-mono); transition: all 0.15s;
}
.blood-chip:hover { border-color: var(--pearl-400); color: var(--pearl-700); background: #fff; }
.blood-chip.selected {
  border-color: #dc2626; background: #fef2f2; color: #dc2626;
}
/* Indicador de edad calculada */
.age-badge {
  display: inline-flex; align-items: center; gap: 0.3rem;
  background: var(--pearl-100); border: 1px solid var(--pearl-200);
  border-radius: 50px; padding: 0.2rem 0.65rem;
  font-size: 0.75rem; color: var(--pearl-600); margin-top: 0.35rem;
  font-family: var(--font-mono); transition: all 0.2s;
}
.age-badge.visible { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; }
/* Input con ícono de teléfono */
.phone-wrap { position: relative; }
.phone-wrap .phone-prefix {
  position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);
  font-size: 0.78rem; color: var(--pearl-400); font-family: var(--font-mono);
  pointer-events: none; user-select: none;
}
.phone-wrap input { padding-left: 2.4rem !important; }
/* Divider en modal */
.modal-divider {
  height: 1px; background: var(--pearl-100); margin: 0.5rem 0 1rem;
}
@keyframes fadeUp {
  from { opacity:0; transform:translateY(10px); }
  to { opacity:1; transform:translateY(0); }
}

/* Personalización de la barra de desplazamiento */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: var(--pearl-300); border-radius: 5px; }
::-webkit-scrollbar-thumb:hover { background: var(--pearl-400); }

/* ══════════════════════════════════════════════════════════════
   REGLAS RESPONSIVAS (TABLETS Y MÓVILES)
   ══════════════════════════════════════════════════════════════ */
@media (max-width: 900px) {
  /* Barra lateral colapsada (sólo iconos) */
  :root { --sidebar-w: 60px; }
  .nav-item span, .brand-text, .user-info, .sidebar-section-label, .nav-badge { display: none; }
  .nav-item { justify-content: center; }
  .nav-item.active::before { display: none; }
  .brand-mark { justify-content: center; }
  .grid-2, .grid-3 { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
  #contentArea { padding: 1rem; }
  .topbar { padding: 0.75rem 1rem; }
  .stats-grid { grid-template-columns: 1fr 1fr; }
}

/* ══════════════════════════════════════════════════════════════
   BANNER DE BIENVENIDA DEL DASHBOARD
   ══════════════════════════════════════════════════════════════ */
.welcome-banner {
  background: linear-gradient(135deg, var(--pearl-800) 0%, var(--pearl-700) 50%, var(--pearl-600) 100%);
  border-radius: var(--radius-card);
  padding: 2rem 2.5rem;
  margin-bottom: 2rem;
  position: relative; overflow: hidden;
  animation: statReveal 0.5s var(--transition) both;
}
/* Adornos con formas circulares translúcidas */
.welcome-banner::before {
  content: ''; position: absolute;
  width: 400px; height: 400px; border-radius: 50%;
  background: rgba(255,255,255,0.04);
  top: -120px; right: -80px;
}
.welcome-banner::after {
  content: ''; position: absolute;
  width: 200px; height: 200px; border-radius: 50%;
  background: rgba(255,255,255,0.03);
  bottom: -60px; right: 200px;
}
.welcome-banner h2 {
  font-family: var(--font-display);
  font-size: 2rem; font-weight: 300;
  color: #fff; line-height: 1.2;
  position: relative; z-index:1;
}
.welcome-banner h2 span { font-weight: 600; }
.welcome-banner p {
  color: rgba(255,255,255,0.6);
  margin-top: 0.5rem; font-size: 0.85rem;
  position: relative; z-index:1;
}
.welcome-banner .banner-stats {
  display: flex; gap: 2rem; margin-top: 1.5rem;
  position: relative; z-index:1;
}
.banner-stat .n {
  font-family: var(--font-display);
  font-size: 1.8rem; font-weight: 600;
  color: #fff;
}
.banner-stat .l { font-size: 0.72rem; color: rgba(255,255,255,0.5); letter-spacing: 0.06em; }

/* ══════ SEARCH DROPDOWN MASTER ══════ */
#searchDropdown {
  position: absolute; top: calc(100% + 8px); left: 0; right: 0;
  background: #fff; border: 1px solid var(--pearl-200);
  border-radius: 16px; box-shadow: 0 20px 60px rgba(60,85,115,0.16), 0 4px 16px rgba(60,85,115,0.08);
  z-index: 9999; overflow: hidden;
  max-height: 440px; overflow-y: auto;
  display: none; /* oculto por defecto */
  animation: dropReveal .18s cubic-bezier(.4,0,.2,1);
  min-width: 380px;
}
@keyframes dropReveal {
  from { opacity:0; transform:translateY(-8px) scale(.98); }
  to   { opacity:1; transform:translateY(0) scale(1); }
}
.search-section-label {
  padding: .45rem 1rem .25rem;
  font-size: .6rem; letter-spacing: .18em; text-transform: uppercase;
  color: var(--pearl-400); font-weight: 600;
  border-top: 1px solid var(--pearl-100);
}
.search-section-label:first-child { border-top: none; }
.search-result-item {
  display: flex; align-items: center; gap: .75rem;
  padding: .6rem 1rem; cursor: pointer;
  transition: background .12s;
}
.search-result-item:hover, .search-result-item.kbd-focus {
  background: var(--pearl-50);
}
.search-result-icon {
  width: 32px; height: 32px; border-radius: 9px; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: .85rem;
}
.search-result-icon.mod  { background: var(--pearl-100); color: var(--pearl-600); }
.search-result-icon.pac  { background: #eff6ff; color: #2563eb; }
.search-result-icon.med  { background: #f0fdf8; color: #0d9488; }
.search-result-icon.cit  { background: #f5f3ff; color: #7c3aed; }
.search-result-icon.diag { background: #fff7ed; color: #ea580c; }
.search-result-icon.trat { background: #fdf4ff; color: #9333ea; }
.search-result-icon.medi { background: #fffbeb; color: #d97706; }
.search-result-text { flex: 1; min-width: 0; }
.search-result-text strong {
  font-size: .84rem; color: var(--pearl-800); display: block;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.search-result-text span {
  font-size: .72rem; color: var(--pearl-400);
}
.search-result-tag {
  font-size: .65rem; padding: 2px 8px; border-radius: 20px;
  background: var(--pearl-100); color: var(--pearl-500);
  white-space: nowrap;
}
.search-result-arrow { color: var(--pearl-300); font-size: .75rem; }
.search-empty {
  padding: 2rem 1rem; text-align: center;
  color: var(--pearl-400); font-size: .85rem;
}
.search-empty i { font-size: 1.4rem; display: block; margin-bottom: .5rem; color: var(--pearl-300); }
.search-footer {
  padding: .5rem 1rem;
  border-top: 1px solid var(--pearl-100);
  display: flex; gap: 1rem;
  background: var(--pearl-50);
}
.search-footer-hint {
  font-size: .65rem; color: var(--pearl-400);
  display: flex; align-items: center; gap: .3rem;
}
.search-footer-hint kbd {
  background: #fff; border: 1px solid var(--pearl-200);
  border-radius: 4px; padding: 1px 5px;
  font-size: .62rem; color: var(--pearl-600);
  font-family: var(--font-mono);
}

/* ========== ESTILOS PARA FORMULARIOS MEJORADOS ========== */

/* Selector de género y radios */
.gender-selector, .radio-group, .severity-group {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-top: 0.25rem;
}
.radio-label{
    cursor: pointer;
    user-select: none;
}
.radio-label input{
    display: none;
}
.gender-option, .radio-label, .severity-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 40px;
    border: 1.5px solid var(--pearl-200);
    background: var(--pearl-50);
    cursor: pointer;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.2s ease;
    color: var(--pearl-700);
}

.gender-option i {
    font-size: 0.9rem;
}

.gender-option:hover, .radio-label:hover, .severity-chip:hover {
    border-color: var(--pearl-400);
    background: #fff;
    transform: translateY(-1px);
}

.gender-option.selected, .radio-label.selected, .severity-chip.selected {
    border-color: var(--pearl-700);
    background: var(--pearl-800);
    color: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* Selector de experiencia médica */
.exp-selector {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.25rem;
}

.exp-btn {
    padding: 0.5rem 1rem;
    border-radius: 40px;
    border: 1.5px solid var(--pearl-200);
    background: var(--pearl-50);
    cursor: pointer;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.2s ease;
    color: var(--pearl-700);
}

.exp-btn:hover {
    border-color: var(--pearl-400);
    background: #fff;
    transform: translateY(-1px);
}

.exp-btn.selected {
    border-color: var(--pearl-700);
    background: var(--pearl-800);
    color: #fff;
}

/* Grid de tipos de sangre */
.blood-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
    margin-top: 0.25rem;
}

.blood-chip {
    text-align: center;
    padding: 0.5rem 0.3rem;
    border: 1.5px solid var(--pearl-200);
    border-radius: 10px;
    cursor: pointer;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--pearl-600);
    background: var(--pearl-50);
    transition: all 0.2s ease;
    font-family: var(--font-mono);
}

.blood-chip:hover {
    border-color: var(--pearl-400);
    background: #fff;
    transform: translateY(-1px);
}

.blood-chip.selected {
    border-color: #dc2626;
    background: #fef2f2;
    color: #dc2626;
}

/* Teléfono con prefijo */
.phone-wrap {
    position: relative;
}

.phone-wrap .phone-prefix {
    position: absolute;
    left: 0.85rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.8rem;
    color: var(--pearl-500);
    font-family: var(--font-mono);
    font-weight: 500;
    pointer-events: none;
}

.phone-wrap input {
    padding-left: 2.5rem !important;
}

/* Badge de edad */
.age-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    background: var(--pearl-100);
    border: 1px solid var(--pearl-200);
    border-radius: 40px;
    padding: 0.2rem 0.75rem;
    font-size: 0.7rem;
    color: var(--pearl-600);
    margin-top: 0.4rem;
}

.age-badge.visible {
    background: #d1fae5;
    border-color: #6ee7b7;
    color: #065f46;
}

/* Radio buttons ocultos pero funcionales */
.radio-label input {
    display: none;
}

/* Campo personalizado para experiencia */
#expCustom {
    margin-top: 0.6rem;
}

/* Ajustes de espaciado en formularios */
.form-row {
    margin-bottom: 0.2rem;
}

.form-group {
    margin-bottom: 1rem;
}

/* Toolbar de búsqueda en tablas */
.table-toolbar {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--pearl-100);
}

.table-search {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--pearl-50);
    border: 1px solid var(--pearl-200);
    border-radius: 40px;
    padding: 0.4rem 0.9rem;
    flex: 1;
    max-width: 300px;
}

.table-search input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 0.85rem;
    width: 100%;
}

/* Botones de acción en tabla */
.tbl-actions {
    display: flex;
    gap: 0.3rem;
}

.act-btn {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: 1px solid var(--pearl-200);
    background: transparent;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--pearl-500);
    transition: all 0.15s;
    text-decoration: none;
}

.act-btn:hover {
    background: var(--pearl-100);
    color: var(--pearl-800);
}

.act-btn.del:hover {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

/* Paginación */
.pagination {
    display: flex;
    gap: 0.3rem;
    justify-content: center;
    margin-top: 1rem;
}

.pagination a, .pagination span {
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    border: 1px solid var(--pearl-200);
    color: var(--pearl-600);
    text-decoration: none;
    font-size: 0.8rem;
}

.pagination .active span {
    background: var(--pearl-800);
    color: #fff;
    border-color: var(--pearl-800);
}

/* Mensajes de validación */
.text-danger {
    color: #dc2626;
    font-size: 0.7rem;
    margin-top: 0.25rem;
    display: block;
}

.is-invalid {
    border-color: #dc2626 !important;
    background: #fef2f2 !important;
}

/* Badges en tablas */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.2rem 0.6rem;
    border-radius: 40px;
    font-size: 0.7rem;
    font-weight: 500;
}

.badge-active { background: #d1fae5; color: #065f46; }
.badge-pending { background: #fed7aa; color: #9a3412; }
.badge-done { background: #e0e7ff; color: #3730a3; }
.badge-cancel { background: #fee2e2; color: #991b1b; }

/* Mejoras adicionales para inputs y selects */
.form-input, .form-select, .form-textarea {
    background: #fff;
    border: 1px solid var(--pearl-200);
    border-radius: 12px;
    padding: 0.7rem 1rem;
    font-size: 0.85rem;
    transition: all 0.2s;
}

.form-input:focus, .form-select:focus, .form-textarea:focus {
    border-color: var(--pearl-500);
    box-shadow: 0 0 0 3px rgba(90, 110, 130, 0.1);
    outline: none;
}

/* Títulos de formularios en modal */
.modal-header h3 {
    font-size: 1.3rem;
}

/* Botones más elegantes */
.btn-primary, .btn-secondary {
    padding: 0.6rem 1.2rem;
    border-radius: 40px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background: var(--pearl-800);
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background: var(--pearl-900);
    transform: translateY(-1px);
}

.btn-secondary {
    background: transparent;
    border: 1px solid var(--pearl-300);
    color: var(--pearl-600);
}

.btn-secondary:hover {
    background: var(--pearl-50);
    border-color: var(--pearl-400);
}

</style>
</head>
<body>
<!-- ═══════════════════════════════════════════════════════════════
     PANTALLA DE CARGA INICIAL (SPLASH SCREEN)
═══════════════════════════════════════════════════════════════════ -->
<div id="splashScreen">
  <div class="splash-bg-rings">
    <div class="splash-ring"></div>
    <div class="splash-ring"></div>
    <div class="splash-ring"></div>
    <div class="splash-ring"></div>
  </div>
  <div class="splash-center" id="splashCenter">
    <div class="splash-emblem">
      <div class="splash-emblem-ring"></div>
      <div class="splash-emblem-ring"></div>
      <div class="splash-emblem-inner">
        <i class="fas fa-heartbeat"></i>
      </div>
    </div>
    <div class="splash-title">PEARL<span>OS</span></div>
    <div class="splash-sub">Clinical Management System</div>
    <div class="splash-divider"></div>
    <div class="splash-greeting">Bienvenido, <strong id="splashName">Dr.</strong></div>
    <div class="splash-loader">
      <div class="splash-dot"></div>
      <div class="splash-dot"></div>
      <div class="splash-dot"></div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════
     ESTRUCTURA PRINCIPAL DE LA APLICACIÓN
═══════════════════════════════════════════════════════════════════ -->
<div id="appShell" style="display:none;">
  <!-- SIDEBAR -->
  <nav id="sidebar">
    <div class="sidebar-brand">
      <div class="brand-mark">
        <div class="brand-icon"><i class="fas fa-heartbeat"></i></div>
        <div class="brand-text">
          <h1>PearlClinic</h1>
          <p>Medical OS · v2.0</p>
        </div>
      </div>
    </div>

    <div class="sidebar-section-label">General</div>
    <div class="nav-item active" data-module="inicio" id="navInicio">
      <i class="fas fa-chart-pie"></i><span>Panel Principal</span>
    </div>

    <div class="sidebar-section-label">Gestión Clínica</div>
    <div class="nav-item" data-module="pacientes" id="navPacientes">
      <i class="fas fa-users"></i><span>Pacientes</span>
      <span class="nav-badge" id="badgePacientes">0</span>
    </div>
    <div class="nav-item" data-module="medicos" id="navMedicos">
      <i class="fas fa-user-md"></i><span>Médicos</span>
      <span class="nav-badge" id="badgeMedicos">0</span>
    </div>
    <div class="nav-item" data-module="citas" id="navCitas">
      <i class="fas fa-calendar-check"></i><span>Citas</span>
      <span class="nav-badge" id="badgeCitas">0</span>
    </div>

    <div class="sidebar-section-label">Clínica</div>
    <div class="nav-item" data-module="diagnosticos" id="navDiagnosticos">
      <i class="fas fa-stethoscope"></i><span>Diagnósticos</span>
    </div>
    <div class="nav-item" data-module="tratamientos" id="navTratamientos">
      <i class="fas fa-notes-medical"></i><span>Tratamientos</span>
    </div>
    <div class="nav-item" data-module="medicamentos" id="navMedicamentos">
      <i class="fas fa-capsules"></i><span>Medicamentos</span>
    </div>

    <div class="sidebar-spacer"></div>
    <div class="sidebar-footer">
      <div class="user-chip">
        <div class="user-avatar" id="sidebarAvatar">DR</div>
        <div class="user-info">
          <div class="name" id="sidebarName">Doctor</div>
          <div class="role">Administrador</div>
        </div>
      </div>
      <button class="logout-btn" id="logoutBtn">
        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
      </button>
    </div>
  </nav>

  <!-- MAIN PANEL Y BARRA DE BUSCADOR -->
  <div id="mainPanel">
    <header class="topbar">
      <div class="topbar-title">
        <h2 id="topbarTitle">Panel Principal</h2>
        <p id="topbarSub">Vista general del sistema</p>
      </div>
      <div class="topbar-search" id="searchWrapper" style="position:relative;">
        <i class="fas fa-search" id="searchIcon"></i>
        <input type="text" id="globalSearch" placeholder="Buscar módulos, pacientes, médicos..." autocomplete="off">
        <div id="searchSpinner" style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);">
          <i class="fas fa-circle-notch fa-spin" style="color:var(--pearl-400);font-size:.8rem;"></i>
        </div>
        <div id="searchDropdown"></div>
      </div>
      <div class="topbar-actions">
        <div class="icon-btn notif-dot" title="Notificaciones"><i class="fas fa-bell"></i></div>
        <div class="icon-btn" title="Configuración"><i class="fas fa-cog"></i></div>
      </div>
    </header>
    <div id="contentArea"></div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════
     MODAL
═══════════════════════════════════════════════════════════════════ -->
<div id="modalOverlay">
  <div class="modal-box">
    <div class="modal-header">
      <h3 id="modalTitle">Nuevo Registro</h3>
      <button class="modal-close" id="modalClose"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body" id="modalBody"></div>
    <div class="modal-footer">
      <button class="btn-cancel" id="modalCancel">Cancelar</button>
      <button class="btn-save" id="modalSave"><i class="fas fa-check" style="margin-right:0.4rem;"></i>Guardar</button>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════
     TOAST CONTAINER
═══════════════════════════════════════════════════════════════════ -->
<div id="toastContainer"></div>

<script>
// ════════════════════════════════════════════════════════════════
// BASE DE DATOS
// ════════════════════════════════════════════════════════════════
let db = {
  pacientes: [],
  medicos: [],
  citas: [],
  diagnosticos: [],
  medicamentos: [],
  tratamientos: []
};
let nextIds = {};
let currentModule = 'inicio';
let currentSearch = '';
let pendingModalSave = null;

// ════════════════════════════════════════════════════════════════
// CARGA DE DATOS
// ════════════════════════════════════════════════════════════════
async function loadDB() {
  try {
    const [pacientes, medicos, citas, diagnosticos, medicamentos, tratamientos] = await Promise.all([
      fetch('/api/pacientes').then(r => r.json()),
      fetch('/api/medicos').then(r => r.json()),
      fetch('/api/citas').then(r => r.json()),
      fetch('/api/diagnosticos').then(r => r.json()),
      fetch('/api/medicamentos').then(r => r.json()),
      fetch('/api/tratamientos').then(r => r.json())
    ]);
    db = { pacientes, medicos, citas, diagnosticos, medicamentos, tratamientos };
  } catch (error) {
    console.error('Error al cargar datos:', error);
    toast('Error al conectar con la base de datos', 'error');
  }
  for (let k in db) {
    nextIds[k] = db[k].length ? Math.max(...db[k].map(i => i.id)) + 1 : 1;
  }
}

// ════════════════════════════════════════════════════════════════
// GUARDADO EN SERVIDOR
// ════════════════════════════════════════════════════════════════
async function saveRecordToServer(entity, record, isNew) {
  const url = isNew ? `/api/${entity}` : `/api/${entity}/${record.id}`;
  const method = isNew ? 'POST' : 'PUT';
  try {
    const response = await fetch(url, {
      method,
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify(record)
    });
    if (!response.ok) throw new Error('Error en la petición');
    const saved = await response.json();
    return saved.data ? saved.data : saved;
  } catch (error) {
    console.error('Error al guardar:', error);
    toast('No se pudo guardar el registro', 'error');
    throw error;
  }
}

async function deleteRecordFromServer(entity, id) {
  try {
    const response = await fetch(`/api/${entity}/${id}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });
    if (!response.ok) throw new Error('Error al eliminar');
    return true;
  } catch (error) {
    console.error('Error al eliminar:', error);
    toast('No se pudo eliminar el registro', 'error');
    throw error;
  }
}

// ════════════════════════════════════════════════════════════════
// TOAST
// ════════════════════════════════════════════════════════════════
function toast(msg, type = 'success') {
  const el = document.createElement('div');
  el.className = `toast ${type}`;
  el.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${msg}`;
  document.getElementById('toastContainer').appendChild(el);
  setTimeout(() => {
    el.style.animation = 'toastOut 0.3s forwards';
    setTimeout(() => el.remove(), 300);
  }, 2800);
}

// ════════════════════════════════════════════════════════════════
// NAVIGATION
// ════════════════════════════════════════════════════════════════
const MODULE_META = {
  inicio:      { title: 'Panel Principal',   sub: 'Vista general del sistema' },
  pacientes:   { title: 'Pacientes',         sub: 'Gestión de pacientes registrados' },
  medicos:     { title: 'Médicos',           sub: 'Especialistas del sistema' },
  citas:       { title: 'Citas',             sub: 'Calendario de atención médica' },
  diagnosticos:{ title: 'Diagnósticos',      sub: 'Historial clínico de diagnósticos' },
  tratamientos:{ title: 'Tratamientos',      sub: 'Planes de tratamiento activos' },
  medicamentos:{ title: 'Medicamentos',      sub: 'Inventario y stock farmacéutico' },
};

function setActiveNav(mod) {
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  const el = document.getElementById('nav' + capitalize(mod));
  if (el) el.classList.add('active');
  const meta = MODULE_META[mod] || {};
  document.getElementById('topbarTitle').textContent = meta.title || mod;
  document.getElementById('topbarSub').textContent = meta.sub || '';
}

function capitalize(s) { return s.charAt(0).toUpperCase() + s.slice(1); }

function navigate(mod) {
  currentModule = mod;
  currentSearch = '';
  document.getElementById('globalSearch').value = '';
  setActiveNav(mod);
  renderModule();
}

// ════════════════════════════════════════════════════════════════
// RENDER DASHBOARD
// ════════════════════════════════════════════════════════════════
const avColors = ['#dbeafe','#dcfce7','#fef9c3','#fce7f3','#ede9fe','#ffedd5'];
const avText   = ['#1d4ed8','#15803d','#854d0e','#9d174d','#6d28d9','#c2410c'];

function renderDashboard() {
  const pt = db.pacientes.length, ct = db.citas.length, md = db.medicos.length;
  const stock = db.medicamentos.length;
  const today = new Date().toISOString().slice(0,10);
  const citasHoy = db.citas.filter(c => (c.fecha || '').slice(0,10) === today).length;
  const ingresos = db.tratamientos.reduce((a,b) => a + (b.costo || 0), 0)
                     .toLocaleString('es-PE', { style: 'currency', currency: 'PEN' });

  const userName = document.getElementById('sidebarName').textContent;
  const hour = new Date().getHours();
  const greeting = hour < 12 ? 'Buenos días' : hour < 18 ? 'Buenas tardes' : 'Buenas noches';

  const upcomingCitas = db.citas.slice(0,5).map(c => {
    const p = db.pacientes.find(x => x.id === c.pacienteId);
    const m = db.medicos.find(x => x.id === c.medicoId);
    const initials = p ? p.nombre.split(' ').map(w => w[0]).join('').slice(0,2) : '??';
    const ci = avColors[c.id % avColors.length];
    const ct2 = avText[c.id % avText.length];
    const badgeCls = {
      activo: 'badge-active',
      pendiente: 'badge-pending',
      finalizado: 'badge-done',
      cancelado: 'badge-cancel'
    }[c.estado] || 'badge-pending';
    return `<div class="appt-item">
      <div class="appt-avatar" style="background:${ci};color:${ct2}">${initials}</div>
      <div class="appt-info">
        <div class="appt-name">${p?.nombre || '—'}</div>
        <div class="appt-meta">${m?.nombre || '—'} · ${c.motivo || '—'}</div>
      </div>
      <span class="appt-time">${c.hora || '—'}</span>
      <span class="badge ${badgeCls}" style="margin-left:0.5rem">${c.estado || 'pendiente'}</span>
    </div>`;
  }).join('');

  document.getElementById('contentArea').innerHTML = `
    <div class="welcome-banner">
      <h2>${greeting}, <span id="bannerName">${userName}</span> 👋</h2>
      <p>Tu sistema clínico está operando con normalidad · ${new Date().toLocaleDateString('es-PE',{weekday:'long',year:'numeric',month:'long',day:'numeric'})}</p>
      <div class="banner-stats">
        <div class="banner-stat"><div class="n">${pt}</div><div class="l">PACIENTES</div></div>
        <div class="banner-stat"><div class="n">${ct}</div><div class="l">CITAS</div></div>
        <div class="banner-stat"><div class="n">${md}</div><div class="l">MÉDICOS</div></div>
        <div class="banner-stat"><div class="n">${citasHoy}</div><div class="l">HOY</div></div>
      </div>
    </div>

    <div class="stats-grid">
      <div class="stat-card"><div class="stat-card-header"><div class="stat-icon blue"><i class="fas fa-users"></i></div><span class="stat-trend up">↑ +12%</span></div><div class="stat-num" id="animPt">0</div><div class="stat-label">Pacientes Activos</div></div>
      <div class="stat-card"><div class="stat-card-header"><div class="stat-icon teal"><i class="fas fa-calendar-check"></i></div><span class="stat-trend up">↑ +8%</span></div><div class="stat-num" id="animCt">0</div><div class="stat-label">Citas Totales</div></div>
      <div class="stat-card"><div class="stat-card-header"><div class="stat-icon purple"><i class="fas fa-user-md"></i></div><span class="stat-trend neutral">Estable</span></div><div class="stat-num" id="animMd">0</div><div class="stat-label">Especialistas</div></div>
      <div class="stat-card"><div class="stat-card-header"><div class="stat-icon amber"><i class="fas fa-capsules"></i></div><span class="stat-trend down">↓ −3%</span></div><div class="stat-num" id="animSt">0</div><div class="stat-label">Stock Total</div></div>
      <div class="stat-card"><div class="stat-card-header"><div class="stat-icon rose"><i class="fas fa-calendar-day"></i></div><span class="stat-trend up">Hoy</span></div><div class="stat-num" id="animCh">0</div><div class="stat-label">Citas de Hoy</div></div>
      <div class="stat-card"><div class="stat-card-header"><div class="stat-icon sky"><i class="fas fa-notes-medical"></i></div><span class="stat-trend up">↑ activo</span></div><div class="stat-num">${db.tratamientos.length}</div><div class="stat-label">Tratamientos</div></div>
    </div>

    <div class="grid-2">
      <div class="card"><div class="card-title"><i class="fas fa-chart-line"></i> Citas por Mes</div><div class="chart-wrap"><canvas id="chartCitas"></canvas></div></div>
      <div class="card"><div class="card-title"><i class="fas fa-chart-doughnut"></i> Distribución</div><div class="chart-wrap"><canvas id="chartDist"></canvas></div></div>
    </div>

    <div class="grid-3">
      <div class="card"><div class="card-title"><i class="fas fa-clock"></i> Próximas Citas</div><div class="appt-list">${upcomingCitas || '<p style="color:var(--pearl-400);font-size:.85rem;text-align:center;padding:1rem">Sin citas registradas</p>'}</div></div>
      <div class="card"><div class="card-title"><i class="fas fa-info-circle"></i> Resumen Rápido</div>
        <div class="quick-stat-row"><div class="quick-stat"><div class="num">${db.diagnosticos.length}</div><div class="lbl">Diagnósticos</div></div><div class="quick-stat"><div class="num">${db.medicamentos.length}</div><div class="lbl">Medicamentos</div></div></div>
        <div class="quick-stat-row"><div class="quick-stat"><div class="num">${db.tratamientos.length}</div><div class="lbl">Tratamientos</div></div><div class="quick-stat"><div class="num">${db.citas.filter(c => c.estado === 'pendiente').length}</div><div class="lbl">Pendientes</div></div></div>
        <div style="margin-top:1rem; padding:1rem; background:var(--pearl-50); border-radius:12px; border:1px solid var(--pearl-100);">
          <div style="font-size:.72rem;color:var(--pearl-400);letter-spacing:.06em;margin-bottom:.3rem;">INGRESOS ESTIMADOS</div>
          <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:600;color:var(--pearl-800);">${ingresos}</div>
        </div>
      </div>
    </div>
  `;

  animCount('animPt', pt, 900);
  animCount('animCt', ct, 900);
  animCount('animMd', md, 900);
  animCount('animSt', stock, 900);
  animCount('animCh', citasHoy, 900);

  const ctx1 = document.getElementById('chartCitas')?.getContext('2d');
  if (ctx1) new Chart(ctx1, {
    type: 'line',
    data: { labels: ['Ene','Feb','Mar','Abr','May','Jun'], datasets: [{ label: 'Citas', data: [8,14,11,18,22, db.citas.length], borderColor: '#64748b', backgroundColor: 'rgba(100,116,139,0.06)', tension: 0.4, fill: true, pointRadius: 4, pointBackgroundColor: '#64748b', borderWidth: 2 }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 11 } } }, y: { grid: { color: 'rgba(148,163,184,0.15)' }, ticks: { color: '#94a3b8', font: { size: 11 } } } } }
  });

  const ctx2 = document.getElementById('chartDist')?.getContext('2d');
  if (ctx2) new Chart(ctx2, {
    type: 'doughnut',
    data: { labels: ['Pacientes','Médicos','Citas','Medicamentos'], datasets: [{ data: [db.pacientes.length, db.medicos.length, db.citas.length, db.medicamentos.length], backgroundColor: ['#bfdbfe','#bbf7d0','#ddd6fe','#fed7aa'], borderColor: ['#93c5fd','#86efac','#c4b5fd','#fdba74'], borderWidth: 1 }] },
    options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { position: 'bottom', labels: { color: '#64748b', font: { size: 11 }, padding: 12 } } } }
  });
}

function animCount(id, target, duration) {
  const el = document.getElementById(id);
  if (!el) return;
  const start = performance.now();
  function step(now) {
    const progress = Math.min((now - start) / duration, 1);
    const ease = 1 - Math.pow(1 - progress, 3);
    el.textContent = Math.round(ease * target);
    if (progress < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

// ════════════════════════════════════════════════════════════════
// FIELD DEFINITIONS
// ════════════════════════════════════════════════════════════════
const FIELDS = {
  pacientes: [
    { k: 'nombre', l: 'Nombre' }, { k: 'apellido', l: 'Apellido' },
    { k: 'fecha_nacimiento', l: 'Fecha Nac.' }, { k: 'genero', l: 'Género' },
    { k: 'telefono', l: 'Teléfono' }, { k: 'tipo_sangre', l: 'Tipo Sangre' }
  ],
  medicos: [
    { k: 'nombre', l: 'Nombre' }, { k: 'apellido', l: 'Apellido' },
    { k: 'especialidad', l: 'Especialidad' }, { k: 'telefono', l: 'Teléfono' },
    { k: 'email', l: 'Email' }, { k: 'licencia', l: 'Licencia' },
    { k: 'años_experiencia', l: 'Años de Exp.' }
  ],
  citas: [
    { k: 'pacienteId', l: 'Paciente' }, { k: 'medicoId', l: 'Médico' },
    { k: 'fecha', l: 'Fecha' }, { k: 'hora', l: 'Hora' },
    { k: 'motivo', l: 'Motivo' }, { k: 'sala', l: 'Sala' },
    { k: 'estado', l: 'Estado' }
  ],
  diagnosticos: [
    { k: 'pacienteId', l: 'Paciente' }, { k: 'medicoId', l: 'Médico' },
    { k: 'diagnostico', l: 'Diagnóstico' }, { k: 'gravedad', l: 'Gravedad' },
    { k: 'fecha', l: 'Fecha' }
  ],
  medicamentos: [
    { k: 'nombre', l: 'Nombre' }, { k: 'dosis', l: 'Dosis' },
    { k: 'frecuencia', l: 'Frecuencia' }, { k: 'duracion', l: 'Duración' },
    { k: 'tratamientoId', l: 'Tratamiento' }, { k: 'proveedor', l: 'Proveedor' },
    { k: 'efectos_secundarios', l: 'Efectos secundarios' }
  ],
  tratamientos: [
    { k: 'nombre', l: 'Nombre' }, { k: 'diagnosticoId', l: 'Diagnóstico' },
    { k: 'medicoId', l: 'Médico' }, { k: 'duracion', l: 'Duración' },
    { k: 'estado', l: 'Estado' }, { k: 'descripcion', l: 'Descripción' },
    { k: 'frecuencia_administracion', l: 'Frecuencia' }
  ],
};

function resolveVal(entity, field, val) {
  if (field === 'pacienteId') return db.pacientes.find(p => p.id === val)?.nombre ?? '—';
  if (field === 'medicoId') {
    const m = db.medicos.find(m => m.id === val);
    return m ? `${m.nombre ?? ''} ${m.apellido ?? ''}`.trim() : '—';
  }
  if (field === 'diagnosticoId') {
    const d = db.diagnosticos.find(d => d.id === val);
    return d ? (d.diagnostico || d.descripcion) : '—';
  }
  if (field === 'tratamientoId') {
    const t = db.tratamientos.find(t => t.id === val);
    return t ? t.nombre : '—';
  }
  if (field === 'estado') {
    const map = { activo: 'badge-active', pendiente: 'badge-pending', finalizado: 'badge-done', cancelado: 'badge-cancel' };
    const key = (val ?? '').toLowerCase();
    const cls = map[key] ?? 'badge-pending';
    const label = val ? val.charAt(0).toUpperCase() + val.slice(1) : 'Pendiente';
    return `<span class="badge ${cls}">${label}</span>`;
  }
  if (field === 'gravedad') {
    const map = { leve: 'badge-active', moderado: 'badge-pending', severo: 'badge-cancel', crítico: 'badge-cancel' };
    const key = (val ?? '').toLowerCase();
    const cls = map[key] ?? 'badge-done';
    return val ? `<span class="badge ${cls}">${val}</span>` : '<span style="color:var(--pearl-400)">—</span>';
  }
  return val ?? '—';
}

// ════════════════════════════════════════════════════════════════
// RENDER TABLE
// ════════════════════════════════════════════════════════════════
function renderTable(entity) {
  let data = [...db[entity]];
  const term = currentSearch.toLowerCase();
  if (term) data = data.filter(r => JSON.stringify(r).toLowerCase().includes(term));
  const fields = FIELDS[entity];
  const cols = fields.map(f => `<th>${f.l}</th>`).join('') + '<th style="width:90px">Acciones</th>';
  const rows = data.map(row => {
    const cells = fields.map(f => `<td>${resolveVal(entity, f.k, row[f.k])}</td>`).join('');
    return `<tr>
      ${cells}
      <td><div class="action-btns">
        <button class="action-btn" onclick="openModal('${entity}',${row.id})" title="Editar"><i class="fas fa-pen"></i></button>
        <button class="action-btn delete" onclick="deleteRec('${entity}',${row.id})" title="Eliminar"><i class="fas fa-trash"></i></button>
      </div></td>
    </tr>`;
  }).join('');

  const emptyRow = `<tr><td colspan="${fields.length + 1}"><div class="table-empty">
    <i class="fas fa-inbox"></i>
    <p>No hay registros${term ? ' que coincidan con "' + term + '"' : ''}</p>
  </div></td></tr>`;

  document.getElementById('contentArea').innerHTML = `
    <div class="module-header">
      <div class="module-header-left">
        <h2>${MODULE_META[entity]?.title || entity}</h2>
        <p>${MODULE_META[entity]?.sub || ''}</p>
      </div>
      <button class="btn-add" onclick="openModal('${entity}',null)">
        <i class="fas fa-plus"></i> Nuevo registro
      </button>
    </div>
    <div class="table-wrap">
      <div class="table-toolbar">
        <div class="table-search">
          <i class="fas fa-search" style="color:var(--pearl-400);font-size:.85rem"></i>
          <input type="text" placeholder="Buscar en ${MODULE_META[entity]?.title || entity}..." value="${currentSearch}"
            oninput="currentSearch=this.value; renderTable('${entity}')">
        </div>
        <span class="table-count">${data.length} registro${data.length !== 1 ? 's' : ''}</span>
      </div>
      <div style="overflow-x:auto">
        <table class="data-table">
          <thead><tr>${cols}</tr></thead>
          <tbody>${rows || emptyRow}</tbody>
        </table>
      </div>
    </div>
  `;
}

function renderModule() {
  if (currentModule === 'inicio') renderDashboard();
  else renderTable(currentModule);
}

// ════════════════════════════════════════════════════════════════
// FUNCIONES AUXILIARES (compartidas)
// ════════════════════════════════════════════════════════════════
function esc(v) { return (v || '').toString().replace(/"/g, '&quot;'); }
function formatPhone(input) {
  let v = input.value.replace(/\D/g, '').slice(0, 9);
  if (v.length > 6) v = v.slice(0,3) + ' ' + v.slice(3,6) + ' ' + v.slice(6);
  else if (v.length > 3) v = v.slice(0,3) + ' ' + v.slice(3);
  input.value = v;
}
function calcAge(dateStr) {
  const birth = new Date(dateStr);
  const today = new Date();
  let age = today.getFullYear() - birth.getFullYear();
  const m = today.getMonth() - birth.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
  return age;
}
function onBirthDateChange(val) {
  const badge = document.getElementById('ageBadge');
  if (!badge) return;
  if (!val) { badge.style.display = 'none'; return; }
  const age = calcAge(val);
  if (age >= 0 && age < 130) {
    badge.innerHTML = `<i class="fas fa-birthday-cake"></i> ${age} años`;
    badge.className = 'age-badge visible';
    badge.style.display = '';
  } else badge.style.display = 'none';
}
function selectGender(val) {
  document.getElementById('ff_genero').value = val;
  document.querySelectorAll('.gender-option').forEach(btn => {
    btn.classList.toggle('selected', btn.textContent.trim() === val);
  });
}
function selectBlood(val) {
  const hidden = document.getElementById('ff_tipo_sangre');
  if (hidden.value === val) {
    hidden.value = '';
    document.querySelectorAll('.blood-chip').forEach(c => c.classList.remove('selected'));
  } else {
    hidden.value = val;
    document.querySelectorAll('.blood-chip').forEach(c => {
      c.classList.toggle('selected', c.textContent === val);
    });
  }
}
function selectMedicoExp(btn) {
  document.querySelectorAll('.exp-btn').forEach(b => b.classList.remove('selected'));
  btn.classList.add('selected');
  const hidden = document.getElementById('ff_años_experiencia');
  const custom = document.getElementById('expCustom');
  hidden.value = btn.dataset.value;
  if (btn.dataset.value === '20+') custom.style.display = 'block';
  else { custom.style.display = 'none'; custom.value = ''; }
}
function selectSeverity(el) {
  document.querySelectorAll('.severity-chip').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  document.getElementById('ff_gravedad').value = el.dataset.value;
}

// Al hacer UN CLIC: Selecciona el rango de años y oculta la barra (salvo si es '20')
function selectMedicoExp(button) {
  // Quitamos la selección a todos los demás botones
  document.querySelectorAll('.exp-btn').forEach(btn => btn.classList.remove('selected'));

  // Marcamos el botón actual
  button.classList.add('selected');

  const val = button.getAttribute('data-value');
  document.getElementById('ff_años_experiencia').value = val;

  const customInput = document.getElementById('expCustom');
  if (val === '20') {
    customInput.style.display = 'block';
  } else {
    customInput.style.display = 'none';
    customInput.value = ''; // Limpiamos el valor exacto si cambia a un rango
  }
}

// Al hacer DOBLE CLIC: Desmarca el rango y abre la barra para escribir el número exacto (ej. 2)
function deselectMedicoExp(button) {
  // Quitamos la marca visual del botón
  button.classList.remove('selected');

  // Reseteamos el valor oculto general
  document.getElementById('ff_años_experiencia').value = '';

  // Mostramos la barra para que digite el número personalizado
  const customInput = document.getElementById('expCustom');
  customInput.style.display = 'block';
  customInput.focus(); // Coloca el cursor automáticamente en la barra
}



// ════════════════════════════════════════════════════════════════
// FORMULARIOS
// ════════════════════════════════════════════════════════════════
function buildPacienteForm(record) {
  const r = record || {};
  const genero = r.genero || '';
  const sangre = r.tipo_sangre || '';
  const generos = [
    { v: 'Masculino', icon: 'fas fa-mars', label: 'Masculino' },
    { v: 'Femenino', icon: 'fas fa-venus', label: 'Femenino' },
    { v: 'Otro', icon: 'fas fa-genderless', label: 'Otro' }
  ];
  const genderBtns = generos.map(g => `<button type="button" class="gender-option ${genero === g.v ? 'selected' : ''}" onclick="selectGender('${g.v}')"><i class="${g.icon}"></i>${g.label}</button>`).join('');
  const bloods = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
  const bloodChips = bloods.map(b => `<div class="blood-chip ${sangre === b ? 'selected' : ''}" onclick="selectBlood('${b}')">${b}</div>`).join('');
  let ageHtml = '';
  if (r.fecha_nacimiento) {
    const age = calcAge(r.fecha_nacimiento);
    ageHtml = `<span class="age-badge visible" id="ageBadge"><i class="fas fa-birthday-cake"></i> ${age} años</span>`;
  } else ageHtml = `<span class="age-badge" id="ageBadge" style="display:none"></span>`;
  return `
    <div class="form-row">
      <div class="form-group"><label class="form-label">Nombre <span style="color:#e11d48">*</span></label><input id="ff_nombre" type="text" class="form-input" value="${esc(r.nombre)}" placeholder="Ej. María" required></div>
      <div class="form-group"><label class="form-label">Apellido</label><input id="ff_apellido" type="text" class="form-input" value="${esc(r.apellido)}" placeholder="Ej. García López"></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Fecha de nacimiento</label><input id="ff_fecha_nacimiento" type="date" class="form-input" value="${r.fecha_nacimiento || ''}" max="${new Date().toISOString().slice(0,10)}" onchange="onBirthDateChange(this.value)">${ageHtml}</div>
      <div class="form-group"><label class="form-label">Teléfono</label><div class="phone-wrap"><span class="phone-prefix">+51</span><input id="ff_telefono" type="tel" class="form-input" value="${esc(r.telefono)}" placeholder="999 999 999" maxlength="12" oninput="formatPhone(this)"></div></div>
    </div>
    <div class="form-group"><label class="form-label">Género</label><div class="gender-selector">${genderBtns}</div><input type="hidden" id="ff_genero" value="${esc(genero)}"></div>
    <div class="form-group"><label class="form-label">Tipo de sangre</label><div class="blood-grid">${bloodChips}</div><input type="hidden" id="ff_tipo_sangre" value="${esc(sangre)}"></div>
    <div class="form-group"><label class="form-label">Dirección</label><input id="ff_direccion" type="text" class="form-input" value="${esc(r.direccion)}" placeholder="Av. Los Pinos 123, San Isidro..."></div>
  `;
}

function buildMedicoForm(record) {
  const r = record || {};
  const expValue = r.años_experiencia || '';
  const expOptions = [
    { value: '1-3', label: '1-3 años' }, { value: '4-7', label: '4-7 años' },
    { value: '8-12', label: '8-12 años' }, { value: '13-19', label: '13-19 años' },
    { value: '20', label: '20 años a mas' }
  ];
  //ondblclick
  const expButtons = expOptions.map(opt => `
    <button type="button"
            class="exp-btn ${expValue === opt.value ? 'selected' : ''}"
            data-value="${opt.value}"
            onclick="selectMedicoExp(this)"
            ondblclick="deselectMedicoExp(this)">
      ${opt.label}
    </button>
  `).join('');

  return `
    <div class="form-row"><div class="form-group"><label class="form-label">Nombre *</label><input id="ff_nombre" class="form-input" value="${esc(r.nombre)}" required></div>
    <div class="form-group"><label class="form-label">Apellido</label><input id="ff_apellido" class="form-input" value="${esc(r.apellido)}"></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Especialidad *</label><input id="ff_especialidad" class="form-input" value="${esc(r.especialidad)}" required></div>
    <div class="form-group"><label class="form-label">Teléfono</label><div class="phone-wrap"><span class="phone-prefix">+51</span><input id="ff_telefono" class="form-input" value="${esc(r.telefono)}" maxlength="12" oninput="formatPhone(this)"></div></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Email</label><input id="ff_email" type="email" class="form-input" value="${esc(r.email)}"></div>
    <div class="form-group"><label class="form-label">Licencia</label><input id="ff_licencia" class="form-input" value="${esc(r.licencia)}"></div></div>
    <div class="form-group"><label class="form-label">Años de experiencia</label><div class="exp-selector">${expButtons}</div>
    <input type="hidden" id="ff_años_experiencia" value="${esc(expValue)}">
    <input type="number" id="expCustom" class="form-input" style="margin-top:.6rem; display:${expValue === '20' ? 'block' : 'true'};" placeholder="Escribe años exactos..."></div>
  `;
}

function buildCitaForm(record) {
  const r = record || {};
  const pacientesOpts = db.pacientes.map(p => `<option value="${p.id}" ${r.pacienteId === p.id ? 'selected' : ''}>${p.nombre} ${p.apellido || ''}</option>`).join('');
  const medicosOpts = db.medicos.map(m => `<option value="${m.id}" ${r.medicoId === m.id ? 'selected' : ''}>${m.nombre} ${m.apellido || ''}</option>`).join('');
  const estados = ['pendiente', 'activo', 'finalizado', 'cancelado'];
  const estadoRadios = estados.map(e => `
<label class="radio-label ${r.estado === e ? 'selected' : ''}"
       onclick="
         document.getElementById('ff_estado').value='${e}';
         document.querySelectorAll('.radio-label').forEach(x=>x.classList.remove('selected'));
         this.classList.add('selected');
       ">
    <input type="radio"
           name="estado_radio"
           value="${e}"
           ${r.estado === e ? 'checked' : ''}>
    <span>${e.charAt(0).toUpperCase() + e.slice(1)}</span>
</label>
`).join('');
  return `
    <div class="form-row"><div class="form-group"><label class="form-label">Paciente *</label><select id="ff_pacienteId" class="form-select" required><option value="">Seleccionar...</option>${pacientesOpts}</select></div>
    <div class="form-group"><label class="form-label">Médico *</label><select id="ff_medicoId" class="form-select" required><option value="">Seleccionar...</option>${medicosOpts}</select></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Fecha *</label><input id="ff_fecha" type="date" class="form-input" value="${r.fecha || ''}" min="${new Date().toISOString().slice(0,10)}" required></div>
    <div class="form-group"><label class="form-label">Hora *</label><input id="ff_hora" type="time" class="form-input" value="${r.hora || '09:00'}" step="60" required></div></div>
    <div class="form-group"><label class="form-label">Motivo</label><input id="ff_motivo" class="form-input" value="${esc(r.motivo)}"></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Sala</label><input id="ff_sala" class="form-input" value="${esc(r.sala)}"></div>
    <div class="form-group"><label class="form-label">Estado</label><div class="radio-group">${estadoRadios}</div><input type="hidden" id="ff_estado" value="${r.estado || 'pendiente'}"></div></div>
  `;
}

function buildDiagnosticoForm(record) {
  const r = record || {};
  const pacientesOpts = db.pacientes.map(p => `<option value="${p.id}" ${r.pacienteId === p.id ? 'selected' : ''}>${p.nombre} ${p.apellido || ''}</option>`).join('');
  const medicosOpts = db.medicos.map(m => `<option value="${m.id}" ${r.medicoId === m.id ? 'selected' : ''}>${m.nombre} ${m.apellido || ''}</option>`).join('');
  const gravedades = ['Leve', 'Moderado', 'Severo', 'Crítico'];
  const gravedadChips = gravedades.map(g => `<div class="severity-chip ${r.gravedad === g ? 'selected' : ''}" data-value="${g}" onclick="selectSeverity(this)">${g}</div>`).join('');
  return `
    <div class="form-row"><div class="form-group"><label class="form-label">Paciente *</label><select id="ff_pacienteId" class="form-select" required><option value="">Seleccionar...</option>${pacientesOpts}</select></div>
    <div class="form-group"><label class="form-label">Médico</label><select id="ff_medicoId" class="form-select"><option value="">Seleccionar...</option>${medicosOpts}</select></div></div>
    <div class="form-group"><label class="form-label">Diagnóstico *</label><input id="ff_diagnostico" class="form-input" value="${esc(r.diagnostico)}" required></div>
    <div class="form-group"><label class="form-label">Gravedad</label><div class="severity-group">${gravedadChips}</div><input type="hidden" id="ff_gravedad" value="${esc(r.gravedad)}"></div>
    <div class="form-group"><label class="form-label">Fecha</label><input id="ff_fecha" type="date" class="form-input" value="${r.fecha || new Date().toISOString().slice(0,10)}"></div>
  `;
}

function buildTratamientoForm(record) {
  const r = record || {};
  const diagnosticosOpts = db.diagnosticos.map(d => `<option value="${d.id}" ${r.diagnosticoId === d.id ? 'selected' : ''}>${d.diagnostico || d.descripcion} (${db.pacientes.find(p => p.id === d.pacienteId)?.nombre || '?'})</option>`).join('');
  const medicosOpts = db.medicos.map(m => `<option value="${m.id}" ${r.medicoId === m.id ? 'selected' : ''}>${m.nombre} ${m.apellido || ''}</option>`).join('');
  const estados = ['Activo', 'Finalizado', 'Suspendido'];
  const estadoRadios = estados.map(e => `
    <label class="radio-label ${r.estado === e ? 'selected' : ''}"
           onclick="
               document.getElementById('ff_estado').value='${e}';
               document.querySelectorAll('#modalBody .radio-label').forEach(l => l.classList.remove('selected'));
               this.classList.add('selected');
           ">
        <input type="radio" name="estado_radio" value="${e}" ${r.estado === e ? 'checked' : ''} style="display: none;">
        <span>${e}</span>
    </label>
`).join('');
  return `
    <div class="form-row"><div class="form-group"><label class="form-label">Nombre *</label><input id="ff_nombre" class="form-input" value="${esc(r.nombre)}" required></div>
    <div class="form-group"><label class="form-label">Duración *</label><input id="ff_duracion" class="form-input" value="${esc(r.duracion)}" required></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Diagnóstico asociado *</label><select id="ff_diagnosticoId" class="form-select" required><option value="">Seleccionar...</option>${diagnosticosOpts}</select></div>
    <div class="form-group"><label class="form-label">Médico a cargo *</label><select id="ff_medicoId" class="form-select" required><option value="">Seleccionar...</option>${medicosOpts}</select></div></div>
    <div class="form-group"><label class="form-label">Descripción *</label><textarea id="ff_descripcion" class="form-textarea" rows="3" required>${esc(r.descripcion)}</textarea></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Estado</label><div class="radio-group">${estadoRadios}</div><input type="hidden" id="ff_estado" value="${r.estado || 'Activo'}"></div>
    <div class="form-group"><label class="form-label">Frecuencia administración</label><input id="ff_frecuencia_administracion" class="form-input" value="${esc(r.frecuencia_administracion)}"></div></div>
  `;
}

function buildMedicamentoForm(record) {
  const r = record || {};
  const tratamientosOpts = db.tratamientos.map(t => `<option value="${t.id}" ${r.tratamientoId === t.id ? 'selected' : ''}>${t.nombre} (${db.diagnosticos.find(d => d.id === t.diagnosticoId)?.diagnostico || '?'})</option>`).join('');
  return `
    <div class="form-row"><div class="form-group"><label class="form-label">Nombre *</label><input id="ff_nombre" class="form-input" value="${esc(r.nombre)}" required></div>
    <div class="form-group"><label class="form-label">Dosis *</label><input id="ff_dosis" class="form-input" value="${esc(r.dosis)}" required></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Frecuencia *</label><input id="ff_frecuencia" class="form-input" value="${esc(r.frecuencia)}" required></div>
    <div class="form-group"><label class="form-label">Duración *</label><input id="ff_duracion" class="form-input" value="${esc(r.duracion)}" required></div></div>
    <div class="form-group"><label class="form-label">Tratamiento asociado *</label><select id="ff_tratamientoId" class="form-select" required><option value="">Seleccionar...</option>${tratamientosOpts}</select></div>
    <div class="form-group"><label class="form-label">Proveedor</label><input id="ff_proveedor" class="form-input" value="${esc(r.proveedor)}"></div>
    <div class="form-group"><label class="form-label">Efectos secundarios</label><textarea id="ff_efectos_secundarios" class="form-textarea" rows="2">${esc(r.efectos_secundarios)}</textarea></div>
  `;
}

// ════════════════════════════════════════════════════════════════
// MODAL Y SAVE
// ════════════════════════════════════════════════════════════════
function openModal(entity, id) {
  const record = id ? db[entity].find(r => r.id === id) : null;
  let formHtml = '';
  if (entity === 'pacientes') formHtml = buildPacienteForm(record);
  else if (entity === 'medicos') formHtml = buildMedicoForm(record);
  else if (entity === 'citas') formHtml = buildCitaForm(record);
  else if (entity === 'diagnosticos') formHtml = buildDiagnosticoForm(record);
  else if (entity === 'tratamientos') formHtml = buildTratamientoForm(record);
  else if (entity === 'medicamentos') formHtml = buildMedicamentoForm(record);
  document.getElementById('modalBody').innerHTML = formHtml;
  document.getElementById('modalTitle').textContent = `${id ? 'Editar' : 'Nuevo'} ${MODULE_META[entity]?.title || entity}`;
  pendingModalSave = () => saveRecord(entity, id);
  document.getElementById('modalOverlay').classList.add('active');
}

async function saveRecord(entity, id) {
  let data = {};
  if (entity === 'pacientes') {
    ['nombre', 'apellido', 'fecha_nacimiento', 'telefono', 'genero', 'tipo_sangre', 'direccion'].forEach(k => {
      const el = document.getElementById(`ff_${k}`);
      if (el) data[k] = el.value.trim();
    });
    if (data.telefono) data.telefono = data.telefono.replace(/\s/g, '');
  } else if (entity === 'medicos') {
    let exp = document.getElementById('ff_años_experiencia')?.value;
    const customExp = document.getElementById('expCustom')?.value;
    if (exp === '20+' && customExp && !isNaN(customExp)) exp = customExp;
    data = {
      nombre: document.getElementById('ff_nombre')?.value.trim(),
      apellido: document.getElementById('ff_apellido')?.value.trim(),
      especialidad: document.getElementById('ff_especialidad')?.value.trim(),
      telefono: document.getElementById('ff_telefono')?.value.trim().replace(/\s/g, ''),
      email: document.getElementById('ff_email')?.value.trim(),
      licencia: document.getElementById('ff_licencia')?.value.trim(),
      años_experiencia: exp
    };
  } else if (entity === 'citas') {
    data = {
      pacienteId: parseInt(document.getElementById('ff_pacienteId')?.value) || 0,
      medicoId: parseInt(document.getElementById('ff_medicoId')?.value) || 0,
      fecha: document.getElementById('ff_fecha')?.value,
      hora: document.getElementById('ff_hora')?.value,
      motivo: document.getElementById('ff_motivo')?.value.trim(),
      sala: document.getElementById('ff_sala')?.value.trim(),
      estado: document.getElementById('ff_estado')?.value
    };
  } else if (entity === 'diagnosticos') {
    data = {
      pacienteId: parseInt(document.getElementById('ff_pacienteId')?.value) || 0,
      medicoId: parseInt(document.getElementById('ff_medicoId')?.value) || 0,
      diagnostico: document.getElementById('ff_diagnostico')?.value.trim(),
      gravedad: document.getElementById('ff_gravedad')?.value,
      fecha: document.getElementById('ff_fecha')?.value
    };
  } else if (entity === 'tratamientos') {
    data = {
      nombre: document.getElementById('ff_nombre')?.value.trim(),
      duracion: document.getElementById('ff_duracion')?.value.trim(),
      diagnosticoId: parseInt(document.getElementById('ff_diagnosticoId')?.value) || 0,
      medicoId: parseInt(document.getElementById('ff_medicoId')?.value) || 0,
      descripcion: document.getElementById('ff_descripcion')?.value.trim(),
      estado: document.getElementById('ff_estado')?.value,
      frecuencia_administracion: document.getElementById('ff_frecuencia_administracion')?.value.trim()
    };
  } else if (entity === 'medicamentos') {
    data = {
      nombre: document.getElementById('ff_nombre')?.value.trim(),
      dosis: document.getElementById('ff_dosis')?.value.trim(),
      frecuencia: document.getElementById('ff_frecuencia')?.value.trim(),
      duracion: document.getElementById('ff_duracion')?.value.trim(),
      tratamientoId: parseInt(document.getElementById('ff_tratamientoId')?.value) || 0,
      proveedor: document.getElementById('ff_proveedor')?.value.trim(),
      efectos_secundarios: document.getElementById('ff_efectos_secundarios')?.value.trim()
    };
  }
  try {
    if (id) {
      const updated = await saveRecordToServer(entity, { ...data, id }, false);
      const idx = db[entity].findIndex(r => r.id === id);
      if (idx >= 0) db[entity][idx] = updated;
      toast('Registro actualizado correctamente');
    } else {
      const created = await saveRecordToServer(entity, data, true);
      db[entity].push(created);
      toast('Registro creado exitosamente');
    }
    closeModal();
    renderModule();
    updateBadges();
  } catch (error) { toast('Error al guardar', 'error'); }
}

function closeModal() {
  document.getElementById('modalOverlay').classList.remove('active');
  pendingModalSave = null;
}

async function deleteRec(entity, id) {
  if (entity === 'pacientes' && (db.citas.some(c => c.pacienteId === id) || db.diagnosticos.some(d => d.pacienteId === id))) {
    toast('Paciente con registros activos, no se puede eliminar', 'error');
    return;
  }
  if (entity === 'medicos' && (db.citas.some(c => c.medicoId === id) || db.diagnosticos.some(d => d.medicoId === id))) {
    toast('Médico con citas asignadas, no se puede eliminar', 'error');
    return;
  }
  if (!confirm('¿Deseas eliminar este registro?')) return;
  try {
    await deleteRecordFromServer(entity, id);
    db[entity] = db[entity].filter(r => r.id !== id);
    renderModule();
    updateBadges();
    toast('Registro eliminado');
  } catch (error) { toast('Error al eliminar', 'error'); }
}

function updateBadges() {
  ['pacientes', 'medicos', 'citas'].forEach(k => {
    const el = document.getElementById('badge' + capitalize(k));
    if (el) el.textContent = db[k].length;
  });
}

// ════════════════════════════════════════════════════════════════
// BUSCADOR GLOBAL
// ════════════════════════════════════════════════════════════════
(function() {
  const MODULES = [
    { id:'inicio', label:'Panel Principal', icon:'fa-chart-pie', cls:'mod', sub:'Vista general del sistema' },
    { id:'pacientes', label:'Pacientes', icon:'fa-users', cls:'pac', sub:'Gestión de pacientes activos' },
    { id:'medicos', label:'Médicos', icon:'fa-user-md', cls:'med', sub:'Especialistas registrados' },
    { id:'citas', label:'Citas', icon:'fa-calendar-check', cls:'cit', sub:'Agenda de citas' },
    { id:'diagnosticos', label:'Diagnósticos', icon:'fa-stethoscope', cls:'diag', sub:'Historial de diagnósticos' },
    { id:'tratamientos', label:'Tratamientos', icon:'fa-notes-medical', cls:'trat', sub:'Tratamientos activos' },
    { id:'medicamentos', label:'Medicamentos', icon:'fa-capsules', cls:'medi', sub:'Stock de medicamentos' }
  ];
  const REC_CONFIG = {
    pacientes: { icon:'fa-user', cls:'pac', label: r => r.nombre, sub: r => r.email || r.telefono || '' },
    medicos: { icon:'fa-stethoscope', cls:'med', label: r => r.nombre, sub: r => r.especialidad || '' },
    citas: { icon:'fa-calendar', cls:'cit', label: r => { const p = db.pacientes?.find(x=>x.id===r.pacienteId); return p ? `Cita · ${p.nombre}` : `Cita #${r.id}`; }, sub: r => r.fecha || '' },
    diagnosticos: { icon:'fa-file-medical', cls:'diag', label: r => r.diagnostico || r.descripcion || `Diagnóstico #${r.id}`, sub: r => { const p = db.pacientes?.find(x=>x.id===r.pacienteId); return p ? p.nombre : ''; } },
    tratamientos: { icon:'fa-pills', cls:'trat', label: r => r.nombre || `Tratamiento #${r.id}`, sub: r => { const d = db.diagnosticos?.find(x=>x.id===r.diagnosticoId); return d ? (d.diagnostico||'') : ''; } },
    medicamentos: { icon:'fa-capsules', cls:'medi', label: r => r.nombre, sub: r => `Dosis: ${r.dosis || '—'}` }
  };
  let kbdIdx = -1, allItems = [];
  const input = document.getElementById('globalSearch');
  const drop = document.getElementById('searchDropdown');
  const wrap = document.getElementById('searchWrapper');
  function show() { drop.style.display = 'block'; }
  function hide() { drop.style.display = 'none'; kbdIdx = -1; }
  function highlight(text, q) {
    if (!q) return text;
    const re = new RegExp(`(${q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
    return text.replace(re, '<mark style="background:#fef9c3;border-radius:2px;padding:0 1px;">$1</mark>');
  }
  function buildResults(q) {
    allItems = [];
    const sections = [];
    const ql = q.toLowerCase();
    const mods = MODULES.filter(m => m.label.toLowerCase().includes(ql) || m.sub.toLowerCase().includes(ql));
    if (mods.length) {
      sections.push(`<div class="search-section-label"><i class="fas fa-th-large" style="margin-right:.4rem;"></i>Módulos</div>`);
      mods.forEach(m => {
        const idx = allItems.length;
        allItems.push({ type:'module', id: m.id });
        sections.push(`<div class="search-result-item" data-idx="${idx}"><div class="search-result-icon ${m.cls}"><i class="fas ${m.icon}"></i></div><div class="search-result-text"><strong>${highlight(m.label, q)}</strong><span>${m.sub}</span></div><span class="search-result-tag">Módulo</span><i class="fas fa-arrow-right search-result-arrow"></i></div>`);
      });
    }
    const entityOrder = ['pacientes','medicos','citas','diagnosticos','tratamientos','medicamentos'];
    const entityLabels = { pacientes:'Pacientes', medicos:'Médicos', citas:'Citas', diagnosticos:'Diagnósticos', tratamientos:'Tratamientos', medicamentos:'Medicamentos' };
    entityOrder.forEach(ent => {
      const cfg = REC_CONFIG[ent];
      const records = (db[ent] || []).filter(r => {
        const lbl = cfg.label(r).toLowerCase();
        const sub = cfg.sub(r).toLowerCase();
        return lbl.includes(ql) || sub.includes(ql);
      }).slice(0, 4);
      if (!records.length) return;
      sections.push(`<div class="search-section-label"><i class="fas ${cfg.icon}" style="margin-right:.4rem;"></i>${entityLabels[ent]}</div>`);
      records.forEach(r => {
        const idx = allItems.length;
        allItems.push({ type:'record', entity: ent, id: r.id });
        const lbl = cfg.label(r);
        const sub = cfg.sub(r);
        sections.push(`<div class="search-result-item" data-idx="${idx}"><div class="search-result-icon ${cfg.cls}"><i class="fas ${cfg.icon}"></i></div><div class="search-result-text"><strong>${highlight(lbl, q)}</strong>${sub ? `<span>${highlight(sub, q)}</span>` : ''}</div><span class="search-result-tag">#${r.id}</span><i class="fas fa-arrow-right search-result-arrow"></i></div>`);
      });
    });
    if (!sections.length) return `<div class="search-empty"><i class="fas fa-search"></i>Sin resultados para "<strong>${q}</strong>"</div>`;
    const footer = `<div class="search-footer"><span class="search-footer-hint"><kbd>↑</kbd><kbd>↓</kbd> navegar</span><span class="search-footer-hint"><kbd>↵</kbd> abrir</span><span class="search-footer-hint"><kbd>Esc</kbd> cerrar</span></div>`;
    return sections.join('') + footer;
  }
  function selectItem(idx) {
    const item = allItems[idx];
    if (!item) return;
    if (item.type === 'module') navigate(item.id);
    else navigate(item.entity);
    input.value = '';
    hide();
  }
  function updateKbd() {
    document.querySelectorAll('#searchDropdown .search-result-item').forEach((el,i) => {
      el.classList.toggle('kbd-focus', i === kbdIdx);
      if (i === kbdIdx) el.scrollIntoView({ block:'nearest' });
    });
  }
  input.addEventListener('input', e => {
    const q = e.target.value.trim();
    currentSearch = q;
    if (currentModule !== 'inicio') renderTable(currentModule);
    if (q.length < 1) { hide(); return; }
    drop.innerHTML = buildResults(q);
    show();
    kbdIdx = -1;
    drop.querySelectorAll('.search-result-item').forEach(el => { el.addEventListener('mousedown', ev => { ev.preventDefault(); selectItem(+el.dataset.idx); }); });
  });
  input.addEventListener('keydown', e => {
    const items = drop.querySelectorAll('.search-result-item');
    if (!items.length) return;
    if (e.key === 'ArrowDown') { e.preventDefault(); kbdIdx = Math.min(kbdIdx+1, items.length-1); updateKbd(); }
    else if (e.key === 'ArrowUp') { e.preventDefault(); kbdIdx = Math.max(kbdIdx-1, 0); updateKbd(); }
    else if (e.key === 'Enter') { e.preventDefault(); if (kbdIdx >= 0) selectItem(kbdIdx); }
    else if (e.key === 'Escape') { hide(); input.blur(); }
  });
  input.addEventListener('focus', () => { if (input.value.trim().length > 0 && allItems.length > 0) show(); });
  document.addEventListener('mousedown', e => { if (!wrap.contains(e.target)) hide(); });
})();

// ════════════════════════════════════════════════════════════════
// INITIALIZATION
// ════════════════════════════════════════════════════════════════
async function init() {
  await loadDB();
  const userName = "{{ Auth::user()->name ?? Auth::user()->email ?? 'Administrador' }}";
  const initials = userName.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase();
  document.getElementById('sidebarName').textContent = userName;
  document.getElementById('sidebarAvatar').textContent = initials;
  document.getElementById('splashName').textContent = userName;
  updateBadges();
  document.getElementById('modalClose').onclick = closeModal;
  document.getElementById('modalCancel').onclick = closeModal;
  document.getElementById('modalSave').onclick = () => { if (pendingModalSave) pendingModalSave(); };
  document.getElementById('modalOverlay').onclick = (e) => { if (e.target === document.getElementById('modalOverlay')) closeModal(); };
  document.querySelectorAll('.nav-item[data-module]').forEach(n => { n.onclick = () => navigate(n.dataset.module); });
  document.getElementById('logoutBtn').onclick = () => {
    fetch('{{ route("logout") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' } })
      .then(() => window.location.href = '/').catch(() => window.location.href = '/');
  };
  setTimeout(() => {
    document.getElementById('splashScreen').classList.add('fade-out');
    document.getElementById('appShell').style.display = 'flex';
    setTimeout(() => {
      document.getElementById('splashScreen').style.display = 'none';
      renderDashboard();
    }, 1200);
  }, 2600);
  const bg = document.querySelector('.splash-bg-rings');
  for (let i = 0; i < 18; i++) {
    const d = document.createElement('div');
    d.className = 'splash-particle';
    d.style.cssText = `left:${10 + Math.random() * 80}%;top:${20 + Math.random() * 60}%;animation-delay:${Math.random() * 4}s;animation-duration:${3 + Math.random() * 4}s;`;
    bg.appendChild(d);
  }
}
document.addEventListener('DOMContentLoaded', init);
</script>
</body>
</html>
