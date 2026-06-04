<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicHub - Panel de Control Master</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .galactic-bg { background-color: #030712; background-image: radial-gradient(at 0% 0%, rgba(30, 58, 138, 0.2) 0, transparent 50%), radial-gradient(at 100% 100%, rgba(76, 29, 149, 0.15) 0, transparent 50%); }
        .glass-panel { background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .glass-sidebar { background: rgba(3, 7, 18, 0.6); backdrop-filter: blur(16px); border-right: 1px solid rgba(255, 255, 255, 0.05); }
        .active-nav { background: linear-gradient(90deg, rgba(37, 99, 235, 0.15) 0%, rgba(37, 99, 235, 0) 100%); border-left: 3px solid #2563eb; color: #ffffff; }
    </style>
</head>
<body class="galactic-bg text-slate-100 min-h-screen flex flex-col antialiased" x-data="{ chatbotOpen: false, sidebarOpen: true }">

    <nav class="sticky top-0 z-40 w-full glass-panel px-6 py-3.5 flex justify-between items-center shadow-2xl">
        <div class="flex items-center space-x-4">
            <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 hover:text-white transition">
                <i class="fa-solid fa-bars-staggered text-lg"></i>
            </button>
            <div class="flex items-center space-x-2.5">
                <div class="bg-blue-600 text-white h-9 w-9 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <i class="fa-solid fa-square-h text-xl"></i>
                </div>
                <span class="text-lg font-extrabold tracking-wider bg-gradient-to-r from-white via-slate-200 to-blue-400 bg-clip-text text-transparent">
                    CLINIC<span class="text-blue-500">HUB</span>
                </span>
                <span class="text-[10px] bg-blue-500/10 border border-blue-500/20 text-blue-400 px-2 py-0.5 rounded-full font-bold uppercase tracking-widest hidden sm:inline-block">Master V4</span>
            </div>
        </div>

        <div class="flex items-center space-x-6">
            <div class="hidden lg:flex items-center space-x-2 text-xs font-semibold text-slate-400 bg-slate-900/50 border border-slate-800/80 px-3 py-1.5 rounded-lg">
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Servidor: Operacional</span>
            </div>
            
            <div class="relative cursor-pointer text-slate-400 hover:text-white transition">
                <i class="fa-regular fa-bell text-lg"></i>
                <span class="absolute -top-1 -right-1 h-2 w-2 rounded-full bg-blue-500"></span>
            </div>

            <div class="flex items-center space-x-3 border-l border-slate-800 pl-4">
                <div class="hidden md:block text-right">
                    <p class="text-xs font-bold text-white">Dr. Alexander</p>
                    <p class="text-[10px] text-slate-400 font-medium">Administrador</p>
                </div>
                <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-sm text-white shadow-md">
                    A
                </div>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 relative">
        
        <aside class="w-64 glass-sidebar p-4 space-y-1.5 fixed md:sticky top-[65px] h-[calc(100vh-65px)] z-30 transition-all duration-300"
               :class="sidebarOpen ? 'left-0' : '-left-64 md:w-0 md:p-0 md:overflow-hidden'">
            
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 pt-2 mb-3">Módulos Core</p>
            
            <a href="/dashboard" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-900/60 hover:text-white transition group {{ Request::is('dashboard') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-chart-pie w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                <span class="font-semibold text-xs tracking-wide">Dashboard Principal</span>
            </a>
            
            <a href="/pacientes" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-900/60 hover:text-white transition group {{ Request::is('pacientes*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-user-injured w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                <span class="font-semibold text-xs tracking-wide">Pacientes</span>
            </a>
            
            <a href="/medicos" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-900/60 hover:text-white transition group {{ Request::is('medicos*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-user-md w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                <span class="font-semibold text-xs tracking-wide">Médicos Especialistas</span>
            </a>
            
            <a href="/citas" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-900/60 hover:text-white transition group {{ Request::is('citas*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-calendar-check w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                <span class="font-semibold text-xs tracking-wide">Control de Citas</span>
            </a>

            <div class="pt-4 border-t border-slate-900 my-3"></div>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 mb-3">Área Clínica</p>

            <a href="/diagnosticos" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-900/60 hover:text-white transition group {{ Request::is('diagnosticos*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-file-medical w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                <span class="font-semibold text-xs tracking-wide">Diagnósticos</span>
            </a>

            <a href="/tratamientos" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-900/60 hover:text-white transition group {{ Request::is('tratamientos*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-kit-medical w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                <span class="font-semibold text-xs tracking-wide">Planes de Tratamiento</span>
            </a>

            <a href="/medicamentos" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-900/60 hover:text-white transition group {{ Request::is('medicamentos*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-capsules w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                <span class="font-semibold text-xs tracking-wide">Vademécum / Medicinas</span>
            </a>
        </aside>

        <main class="flex-1 p-6 md:p-8 overflow-x-hidden">
            @yield('content')
        </main>
        
    </div>

    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
        <div x-show="chatbotOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" class="w-85 h-105 glass-panel rounded-2xl shadow-2xl mb-4 flex flex-col overflow-hidden border border-slate-800">
            <div class="bg-slate-950/80 p-4 border-b border-slate-800 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <span class="text-xs font-bold tracking-wider uppercase text-slate-300">Asistente ClinicHub AI</span>
                </div>
                <button @click="chatbotOpen = false" class="text-slate-400 hover:text-white transition"><i class="fa-solid fa-xmark text-xs"></i></button>
            </div>
            <div class="flex-1 p-4 overflow-y-auto space-y-3.5 text-xs">
                <div class="bg-slate-900/80 border border-slate-800 p-3 rounded-2xl max-w-[85%] text-slate-300 leading-relaxed">
                    Hola Dr. Alexander. Estoy interconectado con la base de datos clínica. ¿Desea consultar estadísticas de pacientes, verificar salas de citas libres o revisar tratamientos vigentes?
                </div>
            </div>
            <div class="p-3 bg-slate-950/80 border-t border-slate-800 flex items-center space-x-2">
                <input type="text" placeholder="Escriba un comando clínico..." class="w-full bg-slate-900 border border-slate-800/60 p-2.5 rounded-xl text-xs focus:outline-none focus:border-blue-500 text-white placeholder-slate-500">
                <button class="bg-blue-600 text-white h-8 w-8 rounded-xl hover:bg-blue-700 transition flex items-center justify-center shadow-md shadow-blue-500/10"><i class="fa-solid fa-paper-plane text-xs"></i></button>
            </div>
        </div>

        <button @click="chatbotOpen = !chatbotOpen" class="bg-gradient-to-tr from-blue-600 to-blue-700 text-white h-13 w-13 rounded-2xl flex items-center justify-center shadow-xl shadow-blue-600/20 hover:scale-105 active:scale-95 transition-all duration-200 border border-blue-500/30">
            <i class="fa-solid fa-robot text-xl" x-show="!chatbotOpen"></i>
            <i class="fa-solid fa-minus text-xl" x-show="chatbotOpen"></i>
        </button>
    </div>

    @stack('scripts')
</body>
</html>