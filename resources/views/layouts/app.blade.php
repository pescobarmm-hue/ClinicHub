{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicHub | @yield('title', 'Gestión Médica Premium')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }
        .nav-glass {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 8px 40px rgba(37,99,235,0.08);
        }
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
        @keyframes shineSweep {
            0%{ transform: rotate(25deg) translateX(-100%); }
            20%,100%{ transform: rotate(25deg) translateX(100%); }
        }
        .auth-bg {
            position: fixed;
            inset: 0;
            background-image: url('/imagen2.jpg');
            background-size: cover;
            background-position: center;
            z-index: 0;
        }
        .auth-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(125deg, rgba(219,234,254,0.88) 0%, rgba(238,242,255,0.82) 45%, rgba(255,255,255,0.75) 70%);
        }
        .particle-float {
            position: absolute;
            background: rgba(37,99,235,0.15);
            border-radius: 50%;
            filter: blur(40px);
            animation: floatAnim 14s infinite alternate ease-in-out;
        }
        @keyframes floatAnim {
            0% { transform: translateY(0) scale(1); opacity: 0.2; }
            100% { transform: translateY(-60px) scale(1.2); opacity: 0.5; }
        }
        .glass-card {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.6);
            transition: all 0.4s cubic-bezier(0.2,0.9,0.4,1.1);
        }
        .glass-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px -12px rgba(37,99,235,0.25);
            border-color: rgba(37,99,235,0.3);
        }
        .input-premium {
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0;
            background: white;
        }
        .input-premium:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
        }
        .social-btn {
            transition: all 0.25s ease;
        }
        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
    </style>
    @stack('styles')
</head>
<body class="antialiased">

    <!-- Navbar Global -->
    <nav class="fixed top-4 z-50 w-full max-w-7xl mx-auto px-4 lg:px-8 left-1/2 -translate-x-1/2" style="width: calc(100% - 2rem)">
        <div class="nav-glass rounded-2xl px-6 py-3 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center space-x-3 group cursor-pointer" onclick="window.location.href='/'">
                <div class="bg-gradient-to-br from-blue-600 to-indigo-600 text-white h-11 w-11 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-heart-pulse text-lg"></i>
                </div>
                <div>
                    <span class="text-xl font-black tracking-tight bg-gradient-to-r from-slate-900 to-blue-800 bg-clip-text text-transparent">Clinic<span class="text-blue-600">Hub</span></span>
                    <p class="text-[9px] font-bold text-slate-400 -mt-0.5 tracking-wider uppercase">Premium Medical OS</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                @auth
                    <div class="flex items-center gap-3 bg-white/60 rounded-full px-4 py-2">
                        <i class="fa-regular fa-circle-user text-blue-600"></i>
                        <span class="text-sm font-semibold">{{ Auth::user()->name }}</span>
                        <a href="{{ route('logout') }}" class="text-xs font-bold text-red-500 hover:text-red-700">Salir</a>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-blue-600 transition px-4 py-2 rounded-xl flex items-center gap-2">
                        <i class="fa-regular fa-circle-user"></i> Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="shine-btn bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-600/30 hover:scale-[1.02] transition-all flex items-center gap-2">
                        <i class="fa-solid fa-sparkles text-xs"></i>
                        <span>Comenzar Gratis</span>
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Scripts base -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Eliminar mensajes flash automáticamente
            setTimeout(() => {
                document.querySelectorAll('.flash-message').forEach(el => el.remove());
            }, 4000);
        });
    </script>
    @stack('scripts')
</body>
</html>
