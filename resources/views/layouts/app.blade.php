<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ClinicHub - @yield('title', 'Gestión Médica')</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-item { transition: all 0.2s ease; }
        .sidebar-item:hover { background: rgba(59, 130, 246, 0.1); transform: translateX(4px); }
        .sidebar-item.active { background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.1)); border-left: 3px solid #3b82f6; }
        .glass-nav { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.1); }
        .animate-pulse-slow { animation: pulseSlow 3s ease-in-out infinite; }
        @keyframes pulseSlow { 0%, 100% { opacity: 0.5; } 50% { opacity: 0.8; } }
        
        /* Scrollbar personalizada */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-blue-50/30">

    <!-- Sidebar - Solo visible en móviles (toggle) -->
    <div id="mobileSidebar" class="fixed inset-0 z-50 lg:hidden hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleMobileSidebar()"></div>
        <div class="absolute left-0 top-0 bottom-0 w-72 bg-white shadow-2xl p-6">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-2">
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-600 text-white h-10 w-10 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <span class="text-xl font-bold">ClinicHub</span>
                </div>
                <button onclick="toggleMobileSidebar()" class="text-slate-400"><i class="fa-solid fa-xmark text-2xl"></i></button>
            </div>
            @include('layouts.partials.sidebar-menu')
        </div>
    </div>

    <!-- Sidebar Desktop -->
    <aside class="fixed left-0 top-0 bottom-0 w-72 bg-white border-r border-slate-200 hidden lg:flex flex-col shadow-xl z-30">
        <div class="p-6 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-blue-600 to-indigo-600 text-white h-12 w-12 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <i class="fa-solid fa-heart-pulse text-xl animate-pulse"></i>
                </div>
                <div>
                    <span class="text-xl font-black tracking-tight bg-gradient-to-r from-slate-900 to-blue-800 bg-clip-text text-transparent">Clinic<span class="text-blue-600">Hub</span></span>
                    <p class="text-[9px] font-bold text-slate-400 -mt-1 tracking-wider">PREMIUM MEDICAL OS</p>
                </div>
            </div>
        </div>
        
        <nav class="flex-1 overflow-y-auto py-6 px-4">
            @include('layouts.partials.sidebar-menu')
        </nav>

        <div class="p-4 border-t border-slate-100">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-500 transition">
                            <i class="fa-solid fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Contenido principal -->
    <main class="lg:ml-72 min-h-screen">
        <!-- Navbar superior -->
        <nav class="glass-nav border-b border-slate-200/60 sticky top-0 z-20 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <button onclick="toggleMobileSidebar()" class="lg:hidden text-slate-600 text-xl">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold text-slate-800">@yield('header-title', 'Dashboard')</h1>
                    <p class="text-xs text-slate-400 hidden sm:block">@yield('header-subtitle', 'Panel de control principal')</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <i class="fa-regular fa-bell text-slate-500 text-xl cursor-pointer hover:text-blue-600 transition"></i>
                    <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 rounded-full text-[8px] text-white flex items-center justify-center">3</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-white font-bold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden md:block">
                        <p class="text-sm font-semibold text-slate-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenido dinámico -->
        <div class="p-6">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm flex items-center gap-3 animate__animated animate__fadeInDown">
                    <i class="fa-solid fa-check-circle text-emerald-500 text-lg"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>
    @stack('scripts')
</body>
</html>