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

  <!-- MAIN PANEL -->
  <div id="mainPanel">
    <header class="topbar">
      <div class="topbar-title">
        <h2 id="topbarTitle">Panel Principal</h2>
        <p id="topbarSub">Vista general del sistema</p>
      </div>
      <div class="topbar-search">
        <i class="fas fa-search"></i>
        <input type="text" id="globalSearch" placeholder="Buscar en este módulo...">
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
// BASE DE DATOS (conectada al backend, sin datos estáticos)
// ════════════════════════════════════════════════════════════════
let db = {
  pacientes: [],
  medicos: [],
  citas: [],
  diagnosticos: [],
  medicamentos: [],
  tratamientos: []
};
let nextIds = {}; // Se calculará al cargar los datos del servidor
let currentModule = 'inicio';
let currentSearch = '';
let pendingModalSave = null;

// ════════════════════════════════════════════════════════════════
// CARGA DE DATOS DESDE EL SERVIDOR (reemplaza los endpoints)
// ════════════════════════════════════════════════════════════════
async function loadDB() {
  try {
    // Reemplaza estas URLs con las rutas reales de tu API
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
    console.error('Error al cargar datos desde el servidor:', error);
    toast('Error al conectar con la base de datos', 'error');
  }

  // Calcula los próximos IDs (si tu backend usa autoincrement, puedes omitir esto)
  for (let k in db) {
    nextIds[k] = db[k].length ? Math.max(...db[k].map(i => i.id)) + 1 : 1;
  }
}

// ════════════════════════════════════════════════════════════════
// GUARDADO EN EL SERVIDOR (ejemplo genérico – adáptalo a tu API)
// ════════════════════════════════════════════════════════════════
async function saveRecordToServer(entity, record, isNew) {
  const url = isNew ? `/api/${entity}` : `/api/${entity}/${record.id}`;
  const method = isNew ? 'POST' : 'PUT';

  try {
    const response = await fetch(url, {
      method,
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Solo necesario si usas Laravel
      },
      body: JSON.stringify(record)
    });

    if (!response.ok) throw new Error('Error en la petición');
    const saved = await response.json();
    // Si la API devuelve {ok:true, data:{...}}, extraer data
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
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
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
  inicio:      { title: 'Panel Principal',   sub: 'Vista general del sistema',        icon: 'chart-pie' },
  pacientes:   { title: 'Pacientes',         sub: 'Gestión de pacientes registrados',  icon: 'users' },
  medicos:     { title: 'Médicos',           sub: 'Especialistas del sistema',         icon: 'user-md' },
  citas:       { title: 'Citas',             sub: 'Calendario de atención médica',     icon: 'calendar-check' },
  diagnosticos:{ title: 'Diagnósticos',      sub: 'Historial clínico de diagnósticos', icon: 'stethoscope' },
  tratamientos:{ title: 'Tratamientos',      sub: 'Planes de tratamiento activos',     icon: 'notes-medical' },
  medicamentos:{ title: 'Medicamentos',      sub: 'Inventario y stock farmacéutico',   icon: 'capsules' },
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
// RENDER DASHBOARD (se mantiene igual, ahora usa db cargada)
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
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon blue"><i class="fas fa-users"></i></div>
          <span class="stat-trend up">↑ +12%</span>
        </div>
        <div class="stat-num" id="animPt">0</div>
        <div class="stat-label">Pacientes Activos</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon teal"><i class="fas fa-calendar-check"></i></div>
          <span class="stat-trend up">↑ +8%</span>
        </div>
        <div class="stat-num" id="animCt">0</div>
        <div class="stat-label">Citas Totales</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon purple"><i class="fas fa-user-md"></i></div>
          <span class="stat-trend neutral">Estable</span>
        </div>
        <div class="stat-num" id="animMd">0</div>
        <div class="stat-label">Especialistas</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon amber"><i class="fas fa-capsules"></i></div>
          <span class="stat-trend down">↓ −3%</span>
        </div>
        <div class="stat-num" id="animSt">0</div>
        <div class="stat-label">Stock Total</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon rose"><i class="fas fa-calendar-day"></i></div>
          <span class="stat-trend up">Hoy</span>
        </div>
        <div class="stat-num" id="animCh">0</div>
        <div class="stat-label">Citas de Hoy</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon sky"><i class="fas fa-notes-medical"></i></div>
          <span class="stat-trend up">↑ activo</span>
        </div>
        <div class="stat-num">${db.tratamientos.length}</div>
        <div class="stat-label">Tratamientos</div>
      </div>
    </div>

    <div class="grid-2">
      <div class="card">
        <div class="card-title"><i class="fas fa-chart-line"></i> Citas por Mes</div>
        <div class="chart-wrap"><canvas id="chartCitas"></canvas></div>
      </div>
      <div class="card">
        <div class="card-title"><i class="fas fa-chart-doughnut"></i> Distribución</div>
        <div class="chart-wrap"><canvas id="chartDist"></canvas></div>
      </div>
    </div>

    <div class="grid-3">
      <div class="card">
        <div class="card-title"><i class="fas fa-clock"></i> Próximas Citas</div>
        <div class="appt-list">${upcomingCitas || '<p style="color:var(--pearl-400);font-size:.85rem;text-align:center;padding:1rem">Sin citas registradas</p>'}</div>
      </div>
      <div class="card">
        <div class="card-title"><i class="fas fa-info-circle"></i> Resumen Rápido</div>
        <div class="quick-stat-row">
          <div class="quick-stat"><div class="num">${db.diagnosticos.length}</div><div class="lbl">Diagnósticos</div></div>
          <div class="quick-stat"><div class="num">${db.medicamentos.length}</div><div class="lbl">Medicamentos</div></div>
        </div>
        <div class="quick-stat-row">
          <div class="quick-stat"><div class="num">${db.tratamientos.length}</div><div class="lbl">Tratamientos</div></div>
          <div class="quick-stat"><div class="num">${db.citas.filter(c => c.estado === 'pendiente').length}</div><div class="lbl">Pendientes</div></div>
        </div>
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
    data: {
      labels: ['Ene','Feb','Mar','Abr','May','Jun'],
      datasets: [{
        label: 'Citas', data: [8,14,11,18,22, db.citas.length],
        borderColor: '#64748b', backgroundColor: 'rgba(100,116,139,0.06)',
        tension: 0.4, fill: true, pointRadius: 4, pointBackgroundColor: '#64748b',
        borderWidth: 2
      }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 11 } } },
        y: { grid: { color: 'rgba(148,163,184,0.15)' }, ticks: { color: '#94a3b8', font: { size: 11 } } }
      }
    }
  });

  const ctx2 = document.getElementById('chartDist')?.getContext('2d');
  if (ctx2) new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Pacientes','Médicos','Citas','Medicamentos'],
      datasets: [{
        data: [db.pacientes.length, db.medicos.length, db.citas.length, db.medicamentos.length],
        backgroundColor: ['#bfdbfe','#bbf7d0','#ddd6fe','#fed7aa'],
        borderColor: ['#93c5fd','#86efac','#c4b5fd','#fdba74'],
        borderWidth: 1
      }]
    },
    options: { responsive: true, maintainAspectRatio: false, cutout: '68%',
      plugins: { legend: { position: 'bottom', labels: { color: '#64748b', font: { size: 11 }, padding: 12 } } }
    }
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
    { k: 'nombre',           l: 'Nombre' },
    { k: 'apellido',         l: 'Apellido' },
    { k: 'fecha_nacimiento', l: 'Fecha Nac.' },
    { k: 'genero',           l: 'Género' },
    { k: 'telefono',         l: 'Teléfono' },
    { k: 'tipo_sangre',      l: 'Tipo Sangre' },
    ],
  medicos: [
    { k: 'nombre',           l: 'Nombre' },
    { k: 'apellido',         l: 'Apellido' },
    { k: 'especialidad',     l: 'Especialidad' },
    { k: 'telefono',         l: 'Teléfono' },
    { k: 'email',            l: 'Email' },
    { k: 'licencia',         l: 'Licencia' },
    { k: 'años_experiencia', l: 'Años de Exp.' },
    ],
  citas: [
    { k: 'paciente',  l: 'Paciente' },
    { k: 'medico',    l: 'Médico' },
    { k: 'fecha',     l: 'Fecha' },
    { k: 'hora',      l: 'Hora' },
    { k: 'motivo',    l: 'Motivo' },
    { k: 'sala',      l: 'Sala' },
    { k: 'estado',    l: 'Estado' },
],

  diagnosticos: [
      { k: 'paciente',    l: 'Paciente' },
      { k: 'medico',      l: 'Médico' },
      { k: 'diagnostico', l: 'Diagnóstico' },
      { k: 'gravedad',    l: 'Gravedad' },
      { k: 'fecha',       l: 'Fecha' },
  ],
  medicamentos: [
    { k: 'nombre',      l: 'Nombre' },
    { k: 'dosis',       l: 'Dosis' },
    { k: 'frecuencia',  l: 'Frecuencia' },
    { k: 'duracion',    l: 'Duración' },
    { k: 'tratamiento', l: 'Tratamiento' },
    { k: 'proveedor',   l: 'Proveedor' },
  ],
  tratamientos: [
    { k: 'nombre',      l: 'Nombre' },
    { k: 'paciente',    l: 'Paciente' },
    { k: 'medico',      l: 'Médico' },
    { k: 'duracion',    l: 'Duración' },
    { k: 'estado',      l: 'Estado' },
    { k: 'descripcion', l: 'Descripción' },
  ],
};

function resolveVal(entity, field, val) {
  // Relaciones: resolver nombre desde db
  if (field === 'pacienteId') {
    return db.pacientes.find(p => p.id === val)?.nombre ?? '—';
  }
  if (field === 'medicoId') {
    const m = db.medicos.find(m => m.id === val);
    return m ? `${m.nombre ?? ''} ${m.apellido ?? ''}`.trim() : '—';
  }

  // Badges de estado
  if (field === 'estado') {
    const map = {
      activo:     'badge-active',
      pendiente:  'badge-pending',
      finalizado: 'badge-done',
      cancelado:  'badge-cancel',
      suspendido: 'badge-cancel',
    };
    const key  = (val ?? '').toLowerCase();
    const cls  = map[key] ?? 'badge-pending';
    const label = val ? val.charAt(0).toUpperCase() + val.slice(1) : 'Pendiente';
    return `<span class="badge ${cls}">${label}</span>`;
  }

  if (field === 'gravedad') {
    const map = {
        'leve':     'badge-active',
        'moderado': 'badge-pending',
        'severo':   'badge-cancel',
    };
    const key = (val ?? '').toLowerCase();
    const cls = map[key] ?? 'badge-done';
    return val
        ? `<span class="badge ${cls}">${val}</span>`
        : '<span style="color:var(--pearl-400)">—</span>';
}

  // Precios / costos
  if (['precio', 'costo'].includes(field)) {
    return `S/ ${parseFloat(val ?? 0).toFixed(2)}`;
  }

  if (['paciente', 'medico', 'diagnostico'].includes(field)) {
    return val ?? '—';
  }

  return val ?? '—';
}

// ════════════════════════════════════════════════════════════════
// RENDER DATA TABLE
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
    </tr>`;aaa
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
// MODAL
// ════════════════════════════════════════════════════════════════
function openModal(entity, id) {
  const record = id ? db[entity].find(r => r.id === id) : null;
  const fields = FIELDS[entity];
  document.getElementById('modalTitle').textContent = `${id ? 'Editar' : 'Nuevo'} ${MODULE_META[entity]?.title || entity}`;

  let formHtml = '';
  const rows = [];
  for (let i = 0; i < fields.length; i += 2) {
    const f1 = fields[i], f2 = fields[i + 1];
    rows.push(`<div class="${f2 ? 'form-row' : ''}">
      ${buildField(f1, record)}
      ${f2 ? buildField(f2, record) : ''}
    </div>`);
  }
  formHtml = rows.join('');
  document.getElementById('modalBody').innerHTML = formHtml;

  pendingModalSave = () => saveRecord(entity, id);
  document.getElementById('modalOverlay').classList.add('active');
}

function buildField(f, record) {
  const val = record ? record[f.k] : '';
  if (f.k === 'pacienteId') {
    const opts = db.pacientes.map(p => `<option value="${p.id}" ${record && record.pacienteId === p.id ? 'selected' : ''}>${p.nombre}</option>`).join('');
    return `<div class="form-group"><label class="form-label">${f.l}</label><select id="ff_${f.k}" class="form-select"><option value="">Seleccionar...</option>${opts}</select></div>`;
  }
  if (f.k === 'medicoId') {
    const opts = db.medicos.map(m => `<option value="${m.id}" ${record && record.medicoId === m.id ? 'selected' : ''}>${m.nombre}</option>`).join('');
    return `<div class="form-group"><label class="form-label">${f.l}</label><select id="ff_${f.k}" class="form-select"><option value="">Seleccionar...</option>${opts}</select></div>`;
  }
  if (f.k === 'estado') {
    const opts = ['activo','pendiente','finalizado','cancelado'].map(s => `<option value="${s}" ${val === s ? 'selected' : ''}>${s.charAt(0).toUpperCase() + s.slice(1)}</option>`).join('');
    return `<div class="form-group"><label class="form-label">${f.l}</label><select id="ff_${f.k}" class="form-select">${opts}</select></div>`;
  }
  const type = f.k === 'fecha' || f.k === 'fechaInicio' ? 'date' :
               f.k === 'hora' ? 'time' :
               ['precio','costo','stock','edad'].includes(f.k) ? 'number' : 'text';
  return `<div class="form-group"><label class="form-label">${f.l}</label><input id="ff_${f.k}" type="${type}" value="${val || ''}" class="form-input" placeholder="${f.l}..." ${type === 'number' ? 'min="0" step="0.01"' : ''}></div>`;
}

async function saveRecord(entity, id) {
  const fields = FIELDS[entity];
  const data = {};
  for (const f of fields) {
    const el = document.getElementById(`ff_${f.k}`);
    if (!el) continue;
    let v = el.value.trim();
    if (['precio','costo','stock','edad'].includes(f.k)) v = parseFloat(v) || 0;
    else if (['pacienteId','medicoId'].includes(f.k)) v = parseInt(v) || 0;
    data[f.k] = v;
  }

  try {
    if (id) {
      // Actualizar existente
      const updated = await saveRecordToServer(entity, { ...data, id }, false);
      const idx = db[entity].findIndex(r => r.id === id);
      if (idx >= 0) db[entity][idx] = updated;
      toast('Registro actualizado correctamente');
    } else {
      // Crear nuevo
      const created = await saveRecordToServer(entity, data, true);
      db[entity].push(created);
      nextIds[entity] = Math.max(nextIds[entity], created.id + 1);
      toast('Registro creado exitosamente');
    }
    closeModal();
    renderModule();
    updateBadges();
  } catch (error) {
    // El error ya fue mostrado en saveRecordToServer
  }
}

function closeModal() {
  document.getElementById('modalOverlay').classList.remove('active');
  pendingModalSave = null;
}

async function deleteRec(entity, id) {
  // Validaciones de integridad (pueden moverse al backend)
  if (entity === 'pacientes') {
    if (db.citas.some(c => c.pacienteId === id) || db.diagnosticos.some(d => d.pacienteId === id) || db.tratamientos.some(t => t.pacienteId === id)) {
      toast('Paciente con registros activos, no se puede eliminar', 'error'); return;
    }
  }
  if (entity === 'medicos') {
    if (db.citas.some(c => c.medicoId === id) || db.diagnosticos.some(d => d.medicoId === id)) {
      toast('Médico con citas asignadas, no se puede eliminar', 'error'); return;
    }
  }

  if (!confirm('¿Deseas eliminar este registro?')) return;

  try {
    await deleteRecordFromServer(entity, id);
    db[entity] = db[entity].filter(r => r.id !== id);
    renderModule();
    updateBadges();
    toast('Registro eliminado');
  } catch (error) {
    // Error ya mostrado
  }
}

function updateBadges() {
  ['pacientes','medicos','citas'].forEach(k => {
    const el = document.getElementById('badge' + capitalize(k));
    if (el) el.textContent = db[k].length;
  });
}

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

  document.querySelectorAll('.nav-item[data-module]').forEach(n => {
    n.onclick = () => navigate(n.dataset.module);
  });

  document.getElementById('globalSearch').addEventListener('input', e => {
    currentSearch = e.target.value;
    if (currentModule !== 'inicio') renderTable(currentModule);
  });

  document.getElementById('logoutBtn').onclick = () => {
    fetch('{{ route("logout") }}', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
    }).then(() => window.location.href = '/').catch(() => window.location.href = '/');
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
