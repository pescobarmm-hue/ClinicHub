<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicHub | Gestión medica</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-premium { background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }
        .glass-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .gradient-gold { background: linear-gradient(135deg, #f5af19 0%, #f12711 100%); }
        .gradient-platinum { background: linear-gradient(135deg, #e8e8e8 0%, #b8b8b8 100%); }
        .star-rated { background: linear-gradient(135deg, #FFD700, #FFA500); }
        .hover-glow:hover { box-shadow: 0 0 30px rgba(37, 99, 235, 0.3); transform: translateY(-2px); }
        .animate-float { animation: float 3s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        .animate-pulse-slow { animation: pulseSlow 3s ease-in-out infinite; }
        @keyframes pulseSlow { 0%, 100% { opacity: 0.4; } 50% { opacity: 0.8; } }
        .shine-effect { position: relative; overflow: hidden; }
        .shine-effect::after { content: ''; position: absolute; top: -50%; left: -60%; width: 200%; height: 200%; background: linear-gradient(115deg, rgba(255,255,255,0) 10%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 90%); transform: rotate(25deg); animation: shine 3s infinite; }
        @keyframes shine { 0% { transform: translateX(-100%) rotate(25deg); } 20%, 100% { transform: translateX(100%) rotate(25deg); } }
        .modal-backdrop { background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(8px); }
        .stat-number { font-variant-numeric: tabular-nums; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-blue-50/30 text-slate-900 antialiased selection:bg-blue-600 selection:text-white" x-data="{ 
    openAuth: false, 
    authMode: 'login', 
    chatOpen: false,
    showDemo: false,
    demoImage: 1,
    activeNav: 'inicio'
}">

    <!-- Fondo atmosférico premium -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute top-[10%] -left-[10%] w-[500px] h-[500px] rounded-full bg-blue-400/20 blur-[120px] animate-pulse-slow"></div>
        <div class="absolute bottom-[20%] -right-[10%] w-[400px] h-[400px] rounded-full bg-purple-400/15 blur-[100px] animate-pulse-slow" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-[40%] left-[30%] w-[300px] h-[300px] rounded-full bg-cyan-400/10 blur-[80px] animate-pulse-slow" style="animation-delay: 3s;"></div>
    </div>

    <!-- Navegación Ultra Premium -->
    <nav class="sticky top-4 z-50 w-full max-w-7xl mx-auto px-4 lg:px-8 transition-all duration-300">
        <div class="glass-premium border border-white/30 rounded-2xl shadow-2xl shadow-slate-200/50 px-6 py-3 flex flex-wrap items-center justify-between gap-4">
            <!-- Logo -->
            <div class="flex items-center space-x-2.5 group cursor-pointer">
                <div class="bg-gradient-to-br from-blue-600 to-indigo-600 text-white h-11 w-11 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-heart-pulse text-xl animate-pulse"></i>
                </div>
                <div>
                    <span class="text-xl font-black tracking-tight bg-gradient-to-r from-slate-900 to-blue-800 bg-clip-text text-transparent">Clinic<span class="text-blue-600">Hub</span></span>
                    <p class="text-[9px] font-bold text-slate-400 -mt-1 tracking-wider">PREMIUM MEDICAL OS</p>
                </div>
            </div>

            <!-- Menú Principal con íconos premium -->
            <div class="hidden lg:flex items-center space-x-1 bg-slate-100/50 rounded-full p-1">
                <a href="#inicio" @click.prevent="activeNav='inicio'" class="flex items-center space-x-2 px-4 py-2 rounded-full text-sm font-semibold transition-all" :class="activeNav === 'inicio' ? 'bg-white shadow-md text-blue-600' : 'text-slate-600 hover:bg-white/60'">
                    <i class="fa-solid fa-chart-line text-xs"></i>
                    <span>Inicio</span>
                </a>
                <a href="#caracteristicas" @click.prevent="activeNav='caracteristicas'" class="flex items-center space-x-2 px-4 py-2 rounded-full text-sm font-semibold transition-all" :class="activeNav === 'caracteristicas' ? 'bg-white shadow-md text-blue-600' : 'text-slate-600 hover:bg-white/60'">
                    <i class="fa-solid fa-cube text-xs"></i>
                    <span>Módulos</span>
                </a>
                <a href="#estadisticas" @click.prevent="activeNav='estadisticas'" class="flex items-center space-x-2 px-4 py-2 rounded-full text-sm font-semibold transition-all" :class="activeNav === 'estadisticas' ? 'bg-white shadow-md text-blue-600' : 'text-slate-600 hover:bg-white/60'">
                    <i class="fa-solid fa-chart-simple text-xs"></i>
                    <span>Métricas</span>
                </a>
                <a href="#impacto" @click.prevent="activeNav='impacto'" class="flex items-center space-x-2 px-4 py-2 rounded-full text-sm font-semibold transition-all" :class="activeNav === 'impacto' ? 'bg-white shadow-md text-blue-600' : 'text-slate-600 hover:bg-white/60'">
                    <i class="fa-solid fa-rocket text-xs"></i>
                    <span>Impacto</span>
                </a>
                <a href="#asistente" @click.prevent="activeNav='asistente'" class="flex items-center space-x-2 px-4 py-2 rounded-full text-sm font-semibold transition-all" :class="activeNav === 'asistente' ? 'bg-white shadow-md text-blue-600' : 'text-slate-600 hover:bg-white/60'">
                    <i class="fa-solid fa-microchip text-xs"></i>
                    <span>Asistente IA</span>
                </a>
            </div>

            <!-- Botones de acción -->
            <div class="flex items-center space-x-3">
                <a href="/login" class="text-sm font-bold text-slate-700 hover:text-blue-600 transition px-4 py-2 rounded-xl hover:bg-white/50">
                    <i class="fa-regular fa-circle-user mr-1"></i> Iniciar Sesión
                </a>
                <a href="/register" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-600/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2 shine-effect">
                    <i class="fa-solid fa-sparkles"></i>
                    <span>Comenzar Gratis</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION PREMIUM -->
    <header id="inicio" class="max-w-7xl mx-auto px-6 lg:px-16 pt-24 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Lado izquierdo - Contenido -->
            <div class="lg:col-span-7 space-y-8 text-center lg:text-left animate__animated animate__fadeInLeft">
                <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur-sm border border-blue-200/50 px-4 py-2 rounded-full shadow-sm mx-auto lg:mx-0">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-bold text-blue-700 tracking-wide uppercase">⭐ El Sistema #1 en Gestión Médica 2026</span>
                </div>
                
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-[1.1]">
                    <span class="text-slate-900">La Gestión Médica</span>
                    <br>
                    <span class="bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600 bg-clip-text text-transparent">del Futuro</span>
                </h1>
                
                <p class="text-xl text-slate-600 max-w-xl leading-relaxed font-medium mx-auto lg:mx-0">
                    Transformamos la gestión hospitalaria con tecnología de punta. Todo lo que necesitas para gestionar pacientes, citas, diagnósticos y tratamientos en una plataforma ultra-moderna.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    <a href="/register" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold px-8 py-4 rounded-xl shadow-xl shadow-blue-600/30 hover:scale-[1.02] transition-all flex items-center justify-center gap-2 shine-effect">
                        <i class="fa-solid fa-gem"></i>
                        <span>Comenzar Ahora</span>
                        <i class="fa-solid fa-arrow-right text-sm group-hover:translate-x-1 transition"></i>
                    </a>
                    <button @click="showDemo = true" class="w-full sm:w-auto border-2 border-slate-300 bg-white/80 text-slate-700 font-bold px-8 py-4 rounded-xl hover:bg-white hover:border-blue-400 transition-all flex items-center justify-center gap-2 shadow-md">
                        <i class="fa-solid fa-play-circle text-blue-500"></i>
                        <span>Ver Demo en Vivo</span>
                    </button>
                </div>
                
                <!-- Rating de estrellas reales -->
                <div class="flex flex-col items-center lg:items-start gap-3 pt-6">
                    <div class="flex items-center gap-2">
                        <div class="flex gap-1">
                            <i class="fa-solid fa-star text-amber-400 text-sm"></i>
                            <i class="fa-solid fa-star text-amber-400 text-sm"></i>
                            <i class="fa-solid fa-star text-amber-400 text-sm"></i>
                            <i class="fa-solid fa-star text-amber-400 text-sm"></i>
                            <i class="fa-solid fa-star text-amber-400 text-sm"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-500">5.0</span>
                    </div>
                    <div class="flex items-center gap-4 text-xs text-slate-500">
                        <span><i class="fa-regular fa-circle-check text-emerald-500 mr-1"></i> 2,847+ reseñas verificadas</span>
                        <span><i class="fa-regular fa-building text-blue-500 mr-1"></i> 500+ clínicas activas</span>
                    </div>
                </div>
            </div>

            <!-- Lado derecho - Tarjeta métricas premium -->
            <div class="lg:col-span-5 relative animate__animated animate__fadeInRight">
                <div class="absolute -inset-2 rounded-3xl bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 opacity-20 blur-2xl animate-float"></div>
                <div class="relative bg-white/90 backdrop-blur-md border border-white/50 rounded-2xl shadow-2xl p-6 space-y-5">
                    
                    <!-- Header tarjeta -->
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                <i class="fa-regular fa-calendar-alt"></i> HOY
                            </span>
                            <h4 class="text-3xl font-extrabold text-slate-900 mt-1">42 <span class="text-lg font-medium text-slate-400">citas</span></h4>
                        </div>
                        <div class="bg-gradient-to-br from-cyan-500 to-blue-500 text-white h-14 w-14 rounded-2xl flex items-center justify-center shadow-lg shadow-cyan-500/30">
                            <i class="fa-solid fa-chart-line text-xl"></i>
                        </div>
                    </div>
                    
                    <!-- Métricas grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-slate-50 to-white border border-slate-100 p-4 rounded-xl">
                            <i class="fa-solid fa-user-group text-blue-500 text-lg mb-2"></i>
                            <h5 class="text-2xl font-black text-slate-800 stat-number">324</h5>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Pacientes activos</p>
                            <span class="text-[9px] text-emerald-600 mt-1 inline-flex items-center gap-0.5"><i class="fa-solid fa-arrow-up"></i> +12%</span>
                        </div>
                        <div class="bg-gradient-to-br from-slate-50 to-white border border-slate-100 p-4 rounded-xl">
                            <i class="fa-solid fa-gauge-high text-cyan-500 text-lg mb-2"></i>
                            <h5 class="text-2xl font-black text-slate-800">98<span class="text-base">%</span></h5>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Eficiencia</p>
                            <span class="text-[9px] text-emerald-600 mt-1 inline-flex items-center gap-0.5"><i class="fa-solid fa-arrow-up"></i> +5%</span>
                        </div>
                    </div>
                    
                    <!-- Tiempo espera -->
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/50 p-4 rounded-xl flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-amber-100 flex items-center justify-center">
                                <i class="fa-regular fa-clock text-amber-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase">Tiempo promedio</p>
                                <p class="text-xl font-black text-slate-800">18 <span class="text-sm">minutos</span></p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-100 px-2 py-1 rounded-lg"><i class="fa-solid fa-arrow-trend-down"></i> -6%</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- SECCIÓN DE CARACTERÍSTICAS PREMIUM -->
    <section id="caracteristicas" class="bg-white/50 border-t border-b border-slate-200/40 py-24 px-6 lg:px-16">
        <div class="max-w-7xl mx-auto space-y-16">
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-200 rounded-full px-4 py-1.5 mb-2">
                    <i class="fa-solid fa-microchip text-blue-500 text-xs"></i>
                    <span class="text-[10px] font-bold text-blue-700 uppercase tracking-wider">Ecosistema Médico 360°</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900">Todo lo que Necesitas<br>en un <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Solo Lugar</span></h2>
                <p class="text-lg text-slate-500 font-medium">Funcionalidades diseñadas por profesionales médicos para profesionales médicos.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Tarjeta 1 -->
                <div class="group bg-white border border-slate-200/80 p-8 rounded-2xl hover:shadow-2xl hover:border-blue-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 h-14 w-14 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-user-injured"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Gestión de Pacientes</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Administra expedientes completos con historial médico detallado, tipo de sangre y datos demográficos estructurados.</p>
                    <div class="mt-4 opacity-0 group-hover:opacity-100 transition">
                        <span class="text-xs font-bold text-blue-600">Explorar →</span>
                    </div>
                </div>
                <!-- Tarjeta 2 -->
                <div class="group bg-white border border-slate-200/80 p-8 rounded-2xl hover:shadow-2xl hover:border-cyan-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-cyan-100 to-cyan-200 text-cyan-600 h-14 w-14 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Citas Inteligentes</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Sistema avanzado de programación de citas con estados automatizados y asignación de consultorios clínicos.</p>
                    <div class="mt-4 opacity-0 group-hover:opacity-100 transition">
                        <span class="text-xs font-bold text-cyan-600">Explorar →</span>
                    </div>
                </div>
                <!-- Tarjeta 3 -->
                <div class="group bg-white border border-slate-200/80 p-8 rounded-2xl hover:shadow-2xl hover:border-indigo-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-indigo-100 to-indigo-200 text-indigo-600 h-14 w-14 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-file-medical"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Diagnósticos Profesionales</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Registro completo de evaluaciones con niveles de gravedad, recomendaciones y tipo de diagnóstico clínico.</p>
                    <div class="mt-4 opacity-0 group-hover:opacity-100 transition">
                        <span class="text-xs font-bold text-indigo-600">Explorar →</span>
                    </div>
                </div>
                <!-- Tarjeta 4 -->
                <div class="group bg-white border border-slate-200/80 p-8 rounded-2xl hover:shadow-2xl hover:border-purple-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-purple-100 to-purple-200 text-purple-600 h-14 w-14 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-kit-medical"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Tratamientos Médicos</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Gestión integral y seguimiento de la evolución médica, vinculada directamente a los planes terapéuticos activos.</p>
                    <div class="mt-4 opacity-0 group-hover:opacity-100 transition">
                        <span class="text-xs font-bold text-purple-600">Explorar →</span>
                    </div>
                </div>
                <!-- Tarjeta 5 -->
                <div class="group bg-white border border-slate-200/80 p-8 rounded-2xl hover:shadow-2xl hover:border-emerald-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-emerald-100 to-emerald-200 text-emerald-600 h-14 w-14 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-capsules"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Control de Medicamentos</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Dosificación precisa, asignación de frecuencias de consumo, alertas de efectos secundarios y control de proveedores.</p>
                    <div class="mt-4 opacity-0 group-hover:opacity-100 transition">
                        <span class="text-xs font-bold text-emerald-600">Explorar →</span>
                    </div>
                </div>
                <!-- Tarjeta 6 -->
                <div class="group bg-white border border-slate-200/80 p-8 rounded-2xl hover:shadow-2xl hover:border-amber-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-amber-100 to-amber-200 text-amber-600 h-14 w-14 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Seguridad Grado Médico</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Encriptación estricta de expedientes de salud y protección absoluta de los datos sensibles de pacientes y médicos.</p>
                    <div class="mt-4 opacity-0 group-hover:opacity-100 transition">
                        <span class="text-xs font-bold text-amber-600">Explorar →</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN ESTADÍSTICAS PREMIUM -->
    <section id="estadisticas" class="max-w-7xl mx-auto px-6 lg:px-16 py-20">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center group cursor-pointer">
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-md">
                    <i class="fa-solid fa-users text-blue-600 text-3xl"></i>
                </div>
                <h4 class="text-4xl lg:text-5xl font-black text-slate-900 stat-number">50K<span class="text-2xl">+</span></h4>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">Pacientes Atendidos</p>
            </div>
            <div class="text-center group cursor-pointer">
                <div class="bg-gradient-to-br from-cyan-100 to-cyan-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-md">
                    <i class="fa-solid fa-user-doctor text-cyan-600 text-3xl"></i>
                </div>
                <h4 class="text-4xl lg:text-5xl font-black text-slate-900 stat-number">1,200<span class="text-2xl">+</span></h4>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">Médicos Activos</p>
            </div>
            <div class="text-center group cursor-pointer">
                <div class="bg-gradient-to-br from-emerald-100 to-emerald-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-md">
                    <i class="fa-solid fa-star text-emerald-600 text-3xl"></i>
                </div>
                <h4 class="text-4xl lg:text-5xl font-black text-slate-900">98<span class="text-2xl">%</span></h4>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">Satisfacción</p>
            </div>
            <div class="text-center group cursor-pointer">
                <div class="bg-gradient-to-br from-purple-100 to-purple-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-md">
                    <i class="fa-solid fa-clock text-purple-600 text-3xl"></i>
                </div>
                <h4 class="text-4xl lg:text-5xl font-black text-slate-900">24/7</h4>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">Disponibilidad</p>
            </div>
        </div>
    </section>

    <!-- SECCIÓN IMPACTO -->
    <section id="impacto" class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white py-24 px-6 lg:px-16">
        <div class="max-w-7xl mx-auto text-center space-y-12">
            <div>
                <i class="fa-solid fa-chart-line text-blue-400 text-4xl mb-4"></i>
                <h2 class="text-4xl sm:text-5xl font-extrabold">Impacto Real en la Gestión Clínica</h2>
                <p class="text-slate-300 text-lg mt-4 max-w-2xl mx-auto">Transformamos la atención médica con datos y tecnología avanzada</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <i class="fa-solid fa-chart-line text-blue-400 text-3xl mb-4"></i>
                    <p class="text-4xl font-black">+47<span class="text-xl">%</span></p>
                    <p class="text-sm font-medium text-slate-300 mt-2">Eficiencia operativa</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <i class="fa-regular fa-clock text-cyan-400 text-3xl mb-4"></i>
                    <p class="text-4xl font-black">-62<span class="text-xl">%</span></p>
                    <p class="text-sm font-medium text-slate-300 mt-2">Tiempos de espera</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <i class="fa-solid fa-heart-circle-check text-emerald-400 text-3xl mb-4"></i>
                    <p class="text-4xl font-black">+89<span class="text-xl">%</span></p>
                    <p class="text-sm font-medium text-slate-300 mt-2">Precisión diagnóstica</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t border-slate-200/60 bg-white py-12 px-6 text-center">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-wrap justify-center gap-8 mb-8 text-sm font-medium text-slate-500">
                <a href="#" class="hover:text-blue-600 transition">Términos de Servicio</a>
                <a href="#" class="hover:text-blue-600 transition">Privacidad Médica</a>
                <a href="#" class="hover:text-blue-600 transition">Certificaciones HIPAA</a>
                <a href="#" class="hover:text-blue-600 transition">Soporte 24/7</a>
            </div>
            <p class="text-xs font-semibold text-slate-400">
                &copy; 2026 ClinicHub Premium Medical OS. Desarrollado con estándares de ingeniería de software a Nivel Master.
            </p>
        </div>
    </footer>

    <!-- MODAL DEMO INTERACTIVO -->
    <div x-show="showDemo" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop" x-transition>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden animate__animated animate__zoomIn">
            <div class="flex justify-between items-center p-6 border-b border-slate-200 bg-gradient-to-r from-blue-50 to-white">
                <div>
                    <h3 class="text-2xl font-black text-slate-900">Demo Interactiva</h3>
                    <p class="text-sm text-slate-500">Vista previa del Dashboard Premium</p>
                </div>
                <button @click="showDemo = false" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[60vh]">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="cursor-pointer group" @click="demoImage = 1">
                        <div class="aspect-video bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white group-hover:scale-105 transition shadow-md">
                            <i class="fa-solid fa-chart-line text-3xl"></i>
                        </div>
                        <p class="text-center text-xs font-medium mt-2 text-slate-600">Dashboard Analítico</p>
                    </div>
                    <div class="cursor-pointer group" @click="demoImage = 2">
                        <div class="aspect-video bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center text-white group-hover:scale-105 transition shadow-md">
                            <i class="fa-solid fa-calendar-check text-3xl"></i>
                        </div>
                        <p class="text-center text-xs font-medium mt-2 text-slate-600">Gestión de Citas</p>
                    </div>
                    <div class="cursor-pointer group" @click="demoImage = 3">
                        <div class="aspect-video bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white group-hover:scale-105 transition shadow-md">
                            <i class="fa-solid fa-file-prescription text-3xl"></i>
                        </div>
                        <p class="text-center text-xs font-medium mt-2 text-slate-600">Expedientes Médicos</p>
                    </div>
                </div>
                <div class="mt-8 bg-slate-100 rounded-2xl p-8 text-center border-2 border-dashed border-slate-300">
                    <div x-show="demoImage === 1" x-transition>
                        <i class="fa-solid fa-chart-line text-blue-500 text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold text-slate-900">Dashboard en Tiempo Real</h4>
                        <p class="text-slate-600 mt-2">Visualiza métricas clave, flujo de pacientes y análisis predictivo con IA</p>
                    </div>
                    <div x-show="demoImage === 2" x-transition>
                        <i class="fa-solid fa-calendar-check text-emerald-500 text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold text-slate-900">Calendario Interactivo</h4>
                        <p class="text-slate-600 mt-2">Programación de citas con arrastrar y soltar, recordatorios automáticos</p>
                    </div>
                    <div x-show="demoImage === 3" x-transition>
                        <i class="fa-solid fa-file-prescription text-purple-500 text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold text-slate-900">Expediente Electrónico</h4>
                        <p class="text-slate-600 mt-2">Historial clínico completo, diagnóstico y seguimiento de tratamientos</p>
                    </div>
                    <a href="/register" class="inline-block mt-6 bg-blue-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-700 transition shadow-lg">
                        Comenzar Ahora <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CHATBOT ASISTENTE IA -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
        <div x-show="chatOpen" x-transition class="w-96 h-[500px] bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-2xl shadow-2xl border border-slate-700 mb-4 flex flex-col overflow-hidden">
            <div class="bg-slate-950/90 p-4 border-b border-slate-700 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="h-3 w-3 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-sm font-bold tracking-wide">ClinicHub AI Assistant</span>
                    <span class="text-[10px] bg-blue-600/30 px-2 py-0.5 rounded-full">GPT-5</span>
                </div>
                <button @click="chatOpen = false" class="text-slate-400 hover:text-white"><i class="fa-solid fa-minus"></i></button>
            </div>
            <div class="flex-1 p-4 overflow-y-auto space-y-3 text-sm">
                <div class="bg-slate-800/80 p-3 rounded-2xl rounded-tl-sm max-w-[85%]">
                    <i class="fa-solid fa-robot text-blue-400 text-xs mr-1"></i>
                    ¡Hola! Soy el asistente médico inteligente de ClinicHub. ¿En qué puedo ayudarte?
                </div>
                <div class="bg-blue-600 p-3 rounded-2xl rounded-tr-sm max-w-[85%] self-end ml-auto">
                    ¿Qué módulos ofrece la plataforma?
                </div>
                <div class="bg-slate-800/80 p-3 rounded-2xl rounded-tl-sm max-w-[85%]">
                    ClinicHub incluye: Gestión de Pacientes, Citas Inteligentes, Diagnósticos, Tratamientos, Control de Medicamentos y Seguridad Grado Médico.
                </div>
                <div class="bg-slate-800/80 p-3 rounded-2xl rounded-tl-sm max-w-[85%]">
                    Además contamos con analítica predictiva por IA y reportes automáticos. ¿Te gustaría ver una demo?
                </div>
            </div>
            <div class="p-3 bg-slate-950/90 border-t border-slate-700 flex items-center gap-2">
                <input type="text" placeholder="Escribe tu pregunta..." class="flex-1 bg-slate-900 border border-slate-700 p-3 rounded-xl text-sm focus:outline-none focus:border-blue-500 text-white placeholder:text-slate-500">
                <button class="bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-xl transition"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>
        <button @click="chatOpen = !chatOpen" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white h-14 w-14 rounded-full flex items-center justify-center shadow-2xl shadow-blue-500/30 hover:scale-105 transition-all">
            <i class="fa-solid fa-robot text-2xl" x-show="!chatOpen"></i>
            <i class="fa-solid fa-xmark text-2xl" x-show="chatOpen"></i>
        </button>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>