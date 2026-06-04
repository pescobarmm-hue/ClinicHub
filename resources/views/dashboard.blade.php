<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Hub - La Gestión Médica del Futuro</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .glass-dark { background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(16px); }
        .gradient-text { background: linear-gradient(135deg, #0f172a 0%, #2563eb 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900 antialiased selection:bg-blue-500 selection:text-white" x-data="{ openAuth: false, authMode: 'login', chatOpen: false }">

    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[600px] pointer-events-none -z-10 overflow-hidden opacity-70">
        <div class="absolute -top-[20%] -left-[10%] w-[600px] h-[600px] rounded-full bg-blue-200/50 blur-[120px] animate-pulse"></div>
        <div class="absolute top-[10%] -right-[10%] w-[500px] h-[500px] rounded-full bg-cyan-200/40 blur-[100px]"></div>
    </div>

    <nav class="sticky top-0 z-40 w-full transition-all duration-300 border-b border-slate-200/50 glass px-6 lg:px-16 py-4 flex justify-between items-center shadow-xs">
        <div class="flex items-center space-x-2.5">
            <div class="bg-blue-600 text-white h-10 w-10 rounded-xl flex items-center justify-center shadow-md shadow-blue-500/30">
                <i class="fa-solid fa-heart-pulse text-lg animate-pulse"></i>
            </div>
            <span class="text-xl font-extrabold tracking-tight text-slate-900">
                Clinic<span class="text-blue-600">Hub</span>
            </span>
        </div>
        
        <div class="hidden md:flex items-center space-x-8 font-semibold text-sm text-slate-600">
            <a href="#caracteristicas" class="hover:text-blue-600 transition">Funcionalidades</a>
            <a href="#estadisticas" class="hover:text-blue-600 transition">Impacto</a>
            <a href="#chatbot-info" class="hover:text-blue-600 transition">Asistente AI</a>
        </div>

        <div class="flex items-center space-x-4">
            <button @click="openAuth = true; authMode = 'login'" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition">Iniciar Sesión</button>
            <button @click="openAuth = true; authMode = 'register'" class="bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-slate-900/10 hover:scale-[1.02] active:scale-[0.98] transition-all">Comenzar Gratis</button>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-6 lg:px-16 pt-16 pb-24 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 space-y-6 text-center lg:text-left animate__animated animate__fadeInLeft">
            <div class="inline-flex items-center space-x-2 bg-blue-50 border border-blue-200/60 px-3 py-1.5 rounded-full">
                <i class="fa-solid fa-star text-blue-500 text-xs"></i>
                <span class="text-xs font-bold text-blue-700 tracking-wide uppercase">El Sistema #1 en Gestión Médica</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.1]">
                La Gestión Médica <br>del <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Futuro</span>
            </h1>
            <p class="text-lg text-slate-600 max-w-xl font-medium leading-relaxed">
                Transformamos la gestión hospitalaria con tecnología de punta. Todo lo que necesitas para gestionar pacientes, citas, diagnósticos y tratamientos en una plataforma ultra-moderna.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                <button @click="openAuth = true; authMode = 'register'" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl shadow-xl shadow-blue-600/20 hover:scale-[1.03] transition-all flex items-center justify-center space-x-2">
                    <span>Comenzar Ahora</span>
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </button>
                <a href="#caracteristicas" class="w-full sm:w-auto text-center border border-slate-300 bg-white text-slate-700 font-bold px-8 py-4 rounded-xl hover:bg-slate-50 transition shadow-xs">
                    Ver Demo en Vivo
                </a>
            </div>
            <div class="flex items-center justify-center lg:justify-start space-x-6 pt-6 text-slate-400">
                <div class="flex space-x-1 text-emerald-500 text-sm">
                    <i class="fa-solid fa-circle-check"></i> <i class="fa-solid fa-circle-check"></i> <i class="fa-solid fa-circle-check"></i> <i class="fa-solid fa-circle-check"></i> <i class="fa-solid fa-circle-check"></i>
                </div>
                <span class="text-xs font-semibold text-slate-500">5/5 estrellas en opiniones</span>
            </div>
        </div>

        <div class="lg:col-span-5 relative animate__animated animate__fadeInRight">
            <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-400 opacity-20 blur-xl"></div>
            <div class="relative bg-white border border-slate-200/80 p-6 rounded-2xl shadow-2xl space-y-6">
                <div class="bg-blue-50/60 border border-blue-100 p-4 rounded-xl flex justify-between items-center">
                    <div>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Citas de Hoy</span>
                        <h4 class="text-4xl font-extrabold text-slate-900 mt-1">42</h4>
                        <span class="text-xs font-bold text-emerald-600"><i class="fa-solid fa-arrow-trend-up"></i> +12% vs ayer</span>
                    </div>
                    <div class="bg-cyan-500 text-white h-12 w-12 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/20">
                        <i class="fa-solid fa-chart-line text-lg"></i>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="border border-slate-100 p-4 rounded-xl bg-slate-50/50">
                        <i class="fa-solid fa-user-injured text-blue-500 text-lg mb-2"></i>
                        <h5 class="text-2xl font-bold text-slate-800">324</h5>
                        <p class="text-xs font-medium text-slate-500">Pacientes</p>
                    </div>
                    <div class="border border-slate-100 p-4 rounded-xl bg-slate-50/50">
                        <i class="fa-solid fa-heart-pulse text-cyan-500 text-lg mb-2"></i>
                        <h5 class="text-2xl font-bold text-slate-800">98%</h5>
                        <p class="text-xs font-medium text-slate-500">Eficiencia</p>
                    </div>
                </div>
                <div class="border border-amber-100 bg-amber-50/40 p-4 rounded-xl flex items-center space-x-3">
                    <i class="fa-regular fa-clock text-amber-600 text-xl animate-spin-slow"></i>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Tiempo Promedio de Espera</p>
                        <p class="text-base font-bold text-slate-800">18 min</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="caracteristicas" class="bg-white border-t border-b border-slate-200/60 py-24 px-6 lg:px-16">
        <div class="max-w-7xl mx-auto space-y-16">
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">Todo lo que Necesitas en un Solo Lugar</h2>
                <p class="text-base text-slate-500 font-medium">Funcionalidades diseñadas por profesionales médicos para profesionales médicos.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group border border-slate-200/80 p-8 rounded-2xl bg-[#f8fafc]/50 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300">
                    <div class="bg-blue-100 text-blue-600 h-12 w-12 rounded-xl flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-user-injured"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Gestión de Pacientes</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Administra expedientes completos con historial médico detallado, tipo de sangre y datos demográficos estructurados.</p>
                </div>
                <div class="group border border-slate-200/80 p-8 rounded-2xl bg-[#f8fafc]/50 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300">
                    <div class="bg-cyan-100 text-cyan-600 h-12 w-12 rounded-xl flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Citas Inteligentes</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Sistema avanzado de programación de citas con estados automatizados y asignación de consultorios clínicos.</p>
                </div>
                <div class="group border border-slate-200/80 p-8 rounded-2xl bg-[#f8fafc]/50 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300">
                    <div class="bg-indigo-100 text-indigo-600 h-12 w-12 rounded-xl flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-file-medical"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Diagnósticos Profesionales</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Registro completo de evaluaciones con niveles de gravedad, recomendaciones y tipo de diagnóstico clínico.</p>
                </div>
                <div class="group border border-slate-200/80 p-8 rounded-2xl bg-[#f8fafc]/50 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300">
                    <div class="bg-purple-100 text-purple-600 h-12 w-12 rounded-xl flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-kit-medical"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Tratamientos Médicos</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Gestión integral y seguimiento de la evolución médica, vinculada directamente a los planes terapéuticos activos.</p>
                </div>
                <div class="group border border-slate-200/80 p-8 rounded-2xl bg-[#f8fafc]/50 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300">
                    <div class="bg-emerald-100 text-emerald-600 h-12 w-12 rounded-xl flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-capsules"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Control de Medicamentos</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Dosificación precisa, asignación de frecuencias de consumo, alertas de efectos secundarios y control de proveedores.</p>
                </div>
                <div class="group border border-slate-200/80 p-8 rounded-2xl bg-[#f8fafc]/50 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300">
                    <div class="bg-amber-100 text-amber-600 h-12 w-12 rounded-xl flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Seguridad Grado Médico</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Encriptación estricta de expedientes de salud y protección absoluta de los datos sensibles de pacientes y médicos.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="estadisticas" class="max-w-7xl mx-auto px-6 lg:px-16 py-20 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
        <div class="space-y-1">
            <h4 class="text-4xl lg:text-5xl font-extrabold text-slate-900">50K+</h4>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pacientes Atendidos</p>
        </div>
        <div class="space-y-1">
            <h4 class="text-4xl lg:text-5xl font-extrabold text-blue-600">1,200+</h4>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Médicos Activos</p>
        </div>
        <div class="space-y-1">
            <h4 class="text-4xl lg:text-5xl font-extrabold text-slate-900">98%</h4>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Satisfacción</p>
        </div>
        <div class="space-y-1">
            <h4 class="text-4xl lg:text-5xl font-extrabold text-slate-900">24/7</h4>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Disponibilidad</p>
        </div>
    </section>

    <footer class="border-t border-slate-200/80 bg-slate-50 py-12 text-center text-xs font-semibold text-slate-500">
        &copy; 2026 ClinicHub. Desarrollado con estándares de ingeniería de software a Nivel Master.
    </footer>

    <div x-show="openAuth" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/40 backdrop-blur-md" x-transition>
        <div @click.away="openAuth = false" class="bg-white/90 border border-slate-200 p-8 rounded-3xl shadow-2xl w-full max-w-md space-y-6 relative animate__animated animate__zoomIn animate__faster">
            <button @click="openAuth = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            
            <div class="text-center space-y-1">
                <h3 class="text-2xl font-extrabold text-slate-900" x-text="authMode === 'login' ? 'Bienvenido de Nuevo' : 'Crear Cuenta Premium'"></h3>
                <p class="text-xs text-slate-500 font-medium" x-text="authMode === 'login' ? 'Ingresa tus credenciales para acceder a ClinicHub' : 'Regístrate y revoluciona tu gestión médica'"></p>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <a href="/auth/google" class="flex items-center justify-center space-x-2 border border-slate-200 bg-white p-3 rounded-xl hover:bg-slate-50 transition text-sm font-bold text-slate-700 shadow-xs">
                    <i class="fa-brands fa-google text-red-500"></i>
                    <span>Google</span>
                </a>
                <a href="/auth/github" class="flex items-center justify-center space-x-2 border border-slate-200 bg-white p-3 rounded-xl hover:bg-slate-50 transition text-sm font-bold text-slate-700 shadow-xs">
                    <i class="fa-brands fa-github text-slate-900"></i>
                    <span>GitHub</span>
                </a>
            </div>

            <div class="flex items-center my-4 before:flex-1 before:border-t before:border-slate-200 after:flex-1 after:border-t after:border-slate-200">
                <p class="mx-4 text-xs font-bold text-slate-400 uppercase">O usar email</p>
            </div>

            <form action="#" method="POST" class="space-y-4">
                <div x-show="authMode === 'register'" class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase">Nombre Completo</label>
                    <input type="text" class="w-full border border-slate-200 p-3 rounded-xl text-sm focus:outline-blue-500 bg-white" placeholder="Dr. Alexander Mendoza">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase">Correo Electrónico</label>
                    <input type="email" class="w-full border border-slate-200 p-3 rounded-xl text-sm focus:outline-blue-500 bg-white" placeholder="nombre@clinichub.com">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase">Contraseña</label>
                    <input type="password" class="w-full border border-slate-200 p-3 rounded-xl text-sm focus:outline-blue-500 bg-white" placeholder="••••••••">
                </div>
                <a href="/dashboard" class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold p-3 rounded-xl shadow-lg shadow-blue-600/10 transition mt-6">
                    <span x-text="authMode === 'login' ? 'Entrar a la Plataforma' : 'Finalizar Registro'"></span>
                </a>
            </form>

            <div class="text-center pt-2">
                <button @click="authMode = authMode === 'login' ? 'register' : 'login'" class="text-xs font-bold text-blue-600 hover:underline" x-text="authMode === 'login' ? '¿No tienes cuenta? Regístrate aquí' : '¿Ya eres usuario? Inicia sesión'"></button>
            </div>
        </div>
    </div>

    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
        <div x-show="chatOpen" x-transition class="w-80 h-96 bg-slate-900 text-white rounded-2xl shadow-2xl border border-slate-800 mb-4 flex flex-col overflow-hidden animate__animated animate__fadeInUp animate__faster">
            <div class="bg-slate-950 p-4 border-b border-slate-800 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-xs font-bold tracking-wider uppercase">ClinicHub AI Assistant</span>
                </div>
                <button @click="chatOpen = false" class="text-slate-400 hover:text-white"><i class="fa-solid fa-minus"></i></button>
            </div>
            <div class="flex-1 p-4 overflow-y-auto space-y-3 text-xs">
                <div class="bg-slate-800 p-3 rounded-xl max-w-[85%]">
                    ¡Hola! Soy tu asistente médico inteligente de ClinicHub. ¿En qué puedo ayudarte hoy a gestionar tu clínica?
                </div>
                <div class="bg-blue-600 p-3 rounded-xl max-w-[85%] self-end ml-auto">
                    ¿Cuáles son los módulos del sistema?
                </div>
                <div class="bg-slate-800 p-3 rounded-xl max-w-[85%]">
                    Contamos con control completo de Pacientes, Médicos, Citas, Diagnósticos, Tratamientos y Medicamentos interconectados.
                </div>
            </div>
            <div class="p-3 bg-slate-950 border-t border-slate-800 flex items-center space-x-2">
                <input type="text" placeholder="Pregunta algo..." class="w-full bg-slate-900 border border-slate-800 p-2 rounded-lg text-xs focus:outline-none focus:border-blue-500">
                <button class="bg-blue-600 px-3 py-2 rounded-lg text-xs hover:bg-blue-700 transition"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>

        <button @click="chatOpen = !chatOpen" class="bg-slate-900 hover:bg-slate-800 text-white h-14 w-14 rounded-full flex items-center justify-center shadow-2xl border border-slate-800 hover:scale-105 active:scale-95 transition-all">
            <i class="fa-solid fa-robot text-xl" x-show="!chatOpen"></i>
            <i class="fa-solid fa-xmark text-xl" x-show="chatOpen"></i>
        </button>
    </div>

</body>
</html>