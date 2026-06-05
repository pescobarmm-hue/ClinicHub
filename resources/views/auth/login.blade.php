<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>ClinicHub · Inicio de sesión seguro</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #03050a;
            overflow-x: hidden;
        }

        /* Glass card premium - sin fondo blanco nunca */
        .glass-card {
            background: rgba(5, 8, 15, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(59, 130, 246, 0.15);
        }

        /* Campos de input premium - NUNCA BLANCOS */
        .input-premium {
            background: rgba(2, 4, 8, 0.8);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.25s ease;
            color: #e2e8f0;
        }

        .input-premium:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            background: #020408;
            outline: none;
        }

        .input-premium::placeholder {
            color: #475569;
            font-weight: 400;
        }

        /* =========================================
           SOLUCIÓN PARA EL AUTOFILL BLANCO
           ========================================= */
        .input-premium:-webkit-autofill,
        .input-premium:-webkit-autofill:hover,
        .input-premium:-webkit-autofill:focus,
        .input-premium:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #020408 inset !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Botón principal gradiente */
        .btn-primary {
            background: linear-gradient(105deg, #2563eb, #1d4ed8);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -8px #1e3a8a;
            background: linear-gradient(105deg, #3b82f6, #2563eb);
        }

        /* Botones sociales */
        .social-btn {
            background: rgba(15, 20, 30, 0.6);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.2s ease;
        }

        .social-btn:hover {
            background: rgba(37, 99, 235, 0.15);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-1px);
        }

        /* Botón de retorno */
        .btn-return {
            background: rgba(5, 8, 15, 0.7);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.25s ease;
        }

        .btn-return:hover {
            background: rgba(37, 99, 235, 0.15);
            border-color: rgba(59, 130, 246, 0.5);
            color: #60a5fa;
        }

        /* Checkbox personalizado */
        input[type="checkbox"] {
            background-color: rgba(2, 4, 8, 0.8);
            border-color: rgba(59, 130, 246, 0.3);
        }

        input[type="checkbox"]:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        /* Scroll elegante */
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #0a0d14;
        }
        ::-webkit-scrollbar-thumb {
            background: #2563eb;
            border-radius: 10px;
        }
    </style>
</head>
<body class="text-gray-200 antialiased">

<div x-data="loginForm()" class="relative min-h-screen flex items-center justify-center p-4 md:p-6 overflow-hidden">

    <!-- Canvas de fondo animado -->
    <canvas id="animated-bg" class="fixed inset-0 w-full h-full -z-20 pointer-events-none"></canvas>

    <!-- Capas de blur dinámicas -->
    <div class="fixed top-1/4 left-1/4 w-96 h-96 bg-blue-600 rounded-full blur-[150px] opacity-15 animate-pulse-slow -z-10"></div>
    <div class="fixed bottom-1/4 right-1/4 w-80 h-80 bg-indigo-600 rounded-full blur-[140px] opacity-12 animate-pulse-slow -z-10" style="animation-delay: 5s;"></div>
    <div class="fixed top-1/2 left-1/2 w-64 h-64 bg-purple-600 rounded-full blur-[120px] opacity-8 animate-pulse-slow -z-10" style="animation-delay: 2s;"></div>

    <!-- Botón volver -->
    <div class="absolute top-5 left-5 md:top-7 md:left-7 z-50">
        <a href="{{ route('home') }}" class="btn-return flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-medium text-gray-300 shadow-lg transition-all">
            <i class="fa-solid fa-arrow-left text-[11px]"></i>
            <span>Volver al inicio</span>
        </a>
    </div>

    <!-- Card principal -->
    <div class="w-full max-w-6xl my-12 rounded-3xl overflow-hidden shadow-2xl border border-blue-500/10 animate-fade-in">
        <div class="flex flex-col lg:flex-row">

            <!-- Lado izquierdo: branding y estadísticas -->
            <div class="w-full lg:w-1/2 bg-gradient-to-br from-slate-950/90 via-slate-900/80 to-indigo-950/40 p-8 md:p-10 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-blue-500/10">
                <div>
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/25">
                            <i class="fa-solid fa-heart-pulse text-white text-xl"></i>
                        </div>
                        <div>
                            <span class="text-2xl font-black tracking-tight block leading-none text-white">Clinic<span class="text-blue-400">Hub</span></span>
                            <span class="text-[10px] font-bold text-blue-400/80 uppercase tracking-wider block mt-0.5">Premium Medical OS</span>
                        </div>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tight text-white">
                        Gestión médica<br>
                        <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">inteligente y segura</span>
                    </h1>
                    <p class="text-slate-400 mt-4 text-sm leading-relaxed max-w-md">
                        Accede a tu panel unificado con análisis en tiempo real, historial clínico y automatización de citas.
                    </p>

                    <div class="grid grid-cols-2 gap-3 mt-10">
                        <div class="flex items-center gap-2 bg-white/5 rounded-xl p-2.5 border border-blue-500/10">
                            <i class="fa-solid fa-shield-halved text-blue-400 text-xs"></i>
                            <span class="text-xs font-medium text-slate-300">Cifrado end-to-end</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 rounded-xl p-2.5 border border-blue-500/10">
                            <i class="fa-solid fa-chart-line text-emerald-400 text-xs"></i>
                            <span class="text-xs font-medium text-slate-300">Analítica predictiva</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 rounded-xl p-2.5 border border-blue-500/10">
                            <i class="fa-solid fa-clock text-cyan-400 text-xs"></i>
                            <span class="text-xs font-medium text-slate-300">Soporte 24/7</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 rounded-xl p-2.5 border border-blue-500/10">
                            <i class="fa-solid fa-mobile-screen-button text-purple-400 text-xs"></i>
                            <span class="text-xs font-medium text-slate-300">App multi‑dispositivo</span>
                        </div>
                    </div>
                </div>

                <!-- Tarjetas de estadísticas -->
                <div class="mt-12 space-y-3">
                    <div class="flex items-center justify-between bg-black/30 rounded-2xl p-4 border border-blue-500/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                                <i class="fa-solid fa-hospital-user text-blue-400 text-base"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold leading-none text-white">+124<span class="text-xs text-emerald-400 font-semibold ml-1">↑12%</span></div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Nuevos pacientes (mes)</div>
                            </div>
                        </div>
                        <i class="fa-regular fa-calendar-check text-slate-500 text-base"></i>
                    </div>
                    <div class="flex items-center justify-between bg-black/30 rounded-2xl p-4 border border-blue-500/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 flex items-center justify-center">
                                <i class="fa-solid fa-gauge-high text-indigo-400 text-base"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold leading-none text-white">98%</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Tasa de satisfacción</div>
                            </div>
                        </div>
                        <i class="fa-regular fa-thumbs-up text-slate-500 text-base"></i>
                    </div>
                </div>
            </div>

            <!-- Lado derecho: formulario de login -->
            <div class="w-full lg:w-1/2 glass-card p-8 md:p-10 flex flex-col justify-center">

                <!-- Cabecera -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-7">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">Bienvenido de vuelta</h2>
                        <p class="text-slate-400 text-sm mt-0.5">Ingresa tus credenciales para continuar</p>
                    </div>
                    <div class="sm:text-right">
                        <span class="text-[10px] text-slate-500 uppercase tracking-wider">¿Eres nuevo?</span>
                        <a href="{{ route('register') }}" class="text-xs font-bold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1 mt-0.5 justify-start sm:justify-end">
                            Registrarse <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- Mensajes de error -->
                @if(session('error'))
                    <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-3.5 mb-5 flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-exclamation text-red-400 mt-0.5 text-sm"></i>
                        <p class="text-xs text-red-200">{{ session('error') }}</p>
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-3.5 mb-5 flex items-start gap-2.5">
                        <i class="fa-solid fa-triangle-exclamation text-amber-400 text-sm mt-0.5"></i>
                        <p class="text-xs text-amber-200">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" @submit.prevent="handleSubmit" class="space-y-5">
                    @csrf

                    <!-- Campo email -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Correo electrónico</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="email" name="email" x-model="form.email"
                                   class="input-premium w-full pl-11 pr-4 py-3 rounded-xl text-sm focus:outline-none"
                                   placeholder="tu@email.com" autocomplete="email" required>
                        </div>
                        <template x-if="errors.email">
                            <p class="text-red-400 text-xs mt-1.5" x-text="errors.email"></p>
                        </template>
                    </div>

                    <!-- Campo password -->
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Contraseña</label>
                            <a href="#" class="text-xs text-blue-400 hover:text-blue-300 transition">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input :type="showPassword ? 'text' : 'password'" name="password" x-model="form.password"
                                   class="input-premium w-full pl-11 pr-12 py-3 rounded-xl text-sm focus:outline-none"
                                   placeholder="··········" autocomplete="current-password" required>
                            <button type="button" @click="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition">
                                <i :class="showPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye'"></i>
                            </button>
                        </div>
                        <template x-if="errors.password">
                            <p class="text-red-400 text-xs mt-1.5" x-text="errors.password"></p>
                        </template>
                    </div>

                    <!-- Recordar sesión -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember" x-model="form.remember" class="w-4 h-4 rounded focus:ring-blue-500/30 focus:ring-offset-0">
                            <span class="text-xs text-slate-400">Recordar sesión</span>
                        </label>
                    </div>

                    <!-- Botón submit -->
                    <button type="submit" :disabled="loading"
                            class="btn-primary w-full py-3.5 rounded-xl font-bold text-white text-sm mt-3 flex items-center justify-center gap-2 disabled:opacity-60 transition-all cursor-pointer">
                        <i x-show="!loading" class="fa-regular fa-paper-plane text-xs"></i>
                        <i x-show="loading" class="fa-solid fa-spinner fa-spin text-xs"></i>
                        <span x-text="loading ? 'Autenticando...' : 'Iniciar sesión'"></span>
                    </button>
                </form>

                <!-- Separador -->
                <div class="relative flex items-center my-7">
                    <div class="flex-grow border-t border-blue-500/10"></div>
                    <span class="mx-4 text-[10px] text-slate-500 uppercase tracking-wider font-medium">O continuar con</span>
                    <div class="flex-grow border-t border-blue-500/10"></div>
                </div>

                <!-- Botones sociales con SVG originales -->
                <!-- Botones sociales con SVG originales -->
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('auth.redirect', ['provider' => 'google']) }}"
                       class="social-btn flex items-center justify-center gap-2 rounded-xl py-2.5 px-3 text-xs font-semibold text-gray-200 transition-all duration-200 bg-gray-800 hover:bg-gray-700 border border-gray-700">
                        <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span>Google</span>
                    </a>
                
                    <a href="{{ route('auth.redirect', ['provider' => 'github']) }}"
                       class="social-btn flex items-center justify-center gap-2 rounded-xl py-2.5 px-3 text-xs font-semibold text-gray-200 transition-all duration-200 bg-gray-800 hover:bg-gray-700 border border-gray-700">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.03-2.682-.103-.253-.447-1.27.098-2.646 0 0 .84-.269 2.75 1.025.8-.223 1.65-.334 2.5-.334.85 0 1.7.111 2.5.334 1.91-1.294 2.75-1.025 2.75-1.025.545 1.376.201 2.393.099 2.646.64.698 1.03 1.591 1.03 2.682 0 3.841-2.337 4.687-4.565 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
                        </svg>
                        <span>GitHub</span>
                    </a>
                </div>

                <!-- Badges de seguridad -->
                <div class="flex justify-center gap-5 mt-8 pt-5 border-t border-blue-500/10 text-[10px] text-slate-500 font-semibold uppercase tracking-wider">
                    <span><i class="fa-solid fa-shield-halved text-blue-500/60 mr-1"></i> SSL 256-bit</span>
                    <span><i class="fa-regular fa-clock text-indigo-500/60 mr-1"></i> 2FA Ready</span>
                    <span><i class="fa-solid fa-database text-purple-500/60 mr-1"></i> GDPR</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fondo animado premium
    (function dynamicBackground() {
        const canvas = document.getElementById('animated-bg');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let width, height;
        let particles = [];

        function resize() {
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width;
            canvas.height = height;
            initParticles();
        }

        function initParticles() {
            const count = Math.min(100, Math.floor(width / 18));
            particles = [];
            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    radius: Math.random() * 2.5 + 0.5,
                    alpha: Math.random() * 0.3 + 0.1,
                    vx: (Math.random() - 0.5) * 0.25,
                    vy: (Math.random() - 0.5) * 0.2
                });
            }
        }

        function draw() {
            if (!ctx) return;
            ctx.clearRect(0, 0, width, height);
            for (let p of particles) {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(59, 130, 246, ${p.alpha})`;
                ctx.fill();
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0) p.x = width;
                if (p.x > width) p.x = 0;
                if (p.y < 0) p.y = height;
                if (p.y > height) p.y = 0;
            }
            requestAnimationFrame(draw);
        }

        window.addEventListener('resize', () => resize());
        resize();
        draw();
    })();

    // Lógica completa del formulario
    function loginForm() {
        return {
            form: {
                email: '',
                password: '',
                remember: false
            },
            showPassword: false,
            loading: false,
            errors: {
                email: '',
                password: ''
            },
            togglePassword() {
                this.showPassword = !this.showPassword;
            },
            validateEmail() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!this.form.email) {
                    this.errors.email = 'El correo electrónico es obligatorio';
                    return false;
                } else if (!emailRegex.test(this.form.email)) {
                    this.errors.email = 'Ingresa un correo electrónico válido';
                    return false;
                } else {
                    this.errors.email = '';
                    return true;
                }
            },
            validatePassword() {
                if (!this.form.password) {
                    this.errors.password = 'La contraseña es obligatoria';
                    return false;
                } else if (this.form.password.length < 4) {
                    this.errors.password = 'La contraseña debe tener al menos 4 caracteres';
                    return false;
                } else {
                    this.errors.password = '';
                    return true;
                }
            },
            handleSubmit(e) {
                this.loading = true;
                const isEmailValid = this.validateEmail();
                const isPasswordValid = this.validatePassword();

                if (!isEmailValid || !isPasswordValid) {
                    this.loading = false;
                    return;
                }
                e.target.submit();
            }
        };
    }
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s cubic-bezier(0.2, 0.9, 0.4, 1) forwards;
    }
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.15; transform: scale(1); }
        50% { opacity: 0.25; transform: scale(1.08); }
    }
    .animate-pulse-slow {
        animation: pulse-slow 12s infinite;
    }
</style>
</body>
</html>
