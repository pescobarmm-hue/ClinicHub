<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>ClinicHub · Registro seguro</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
            color: #ffffff;
        }

        /* Glass card premium unificado con el login */
        .glass-card {
            background: rgba(5, 8, 15, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(59, 130, 246, 0.15);
        }

        /* Inputs premium unificados */
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
        }

        /* Autofill para evitar fondos blancos */
        .input-premium:-webkit-autofill,
        .input-premium:-webkit-autofill:hover,
        .input-premium:-webkit-autofill:focus,
        .input-premium:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #020408 inset !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Botón de retorno unificado */
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

        .btn-primary {
            background: linear-gradient(105deg, #2563eb, #1d4ed8);
            transition: all 0.25s ease;
        }
        .btn-primary:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -8px #1e3a8a;
            background: linear-gradient(105deg, #3b82f6, #2563eb);
        }

        input[type="checkbox"] {
            background-color: rgba(2, 4, 8, 0.8);
            border-color: rgba(59, 130, 246, 0.3);
        }
        input[type="checkbox"]:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #0a0d14; }
        ::-webkit-scrollbar-thumb { background: #2563eb; border-radius: 10px; }

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
</head>
<body class="antialiased text-gray-200">

<div x-data="registerForm()" class="relative min-h-screen flex items-center justify-center p-4 md:p-6 overflow-hidden">

    <canvas id="animated-bg" class="fixed inset-0 w-full h-full -z-20 pointer-events-none"></canvas>

    <div class="fixed top-1/4 left-1/4 w-96 h-96 bg-blue-600 rounded-full blur-[150px] opacity-15 animate-pulse-slow -z-10"></div>
    <div class="fixed bottom-1/4 right-1/4 w-80 h-80 bg-indigo-600 rounded-full blur-[140px] opacity-12 animate-pulse-slow -z-10" style="animation-delay: 5s;"></div>

    <div class="absolute top-5 left-5 md:top-7 md:left-7 z-50">
        <a href="{{ route('home') }}" class="btn-return flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-medium text-gray-300 shadow-lg transition-all">
            <i class="fa-solid fa-arrow-left text-[11px]"></i>
            <span>Volver al inicio</span>
        </a>
    </div>

    <div class="w-full max-w-6xl my-12 rounded-3xl overflow-hidden shadow-2xl border border-blue-500/10 animate-fade-in z-10">
        <div class="flex flex-col lg:flex-row">

            <div class="w-full lg:w-1/2 bg-gradient-to-br from-slate-950/90 via-slate-900/80 to-indigo-950/40 p-8 md:p-10 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-blue-500/10 backdrop-blur-sm">
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
                        Únete al<br>
                        <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">ecosistema médico</span>
                    </h1>
                    <p class="text-slate-400 mt-4 text-sm leading-relaxed max-w-md">
                        Crea tu cuenta gratuita y accede a herramientas de gestión clínica, análisis predictivo y mucho más.
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

                <div class="mt-12 space-y-3 hidden md:block">
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
                </div>
            </div>

            <div class="w-full lg:w-1/2 glass-card p-8 md:p-10 flex flex-col justify-center">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-7">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">Crear cuenta</h2>
                        <p class="text-slate-400 text-sm mt-0.5">Completa tus datos para comenzar</p>
                    </div>
                    <div class="sm:text-right">
                        <span class="text-[10px] text-slate-500 uppercase tracking-wider block">¿Ya tienes cuenta?</span>
                        <a href="{{ route('login') }}" class="text-xs font-bold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1 mt-0.5 justify-start sm:justify-end">
                            Iniciar sesión <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-3.5 mb-5 flex items-start gap-2.5">
                        <i class="fa-solid fa-triangle-exclamation text-amber-400 text-sm mt-0.5"></i>
                        <ul class="text-xs text-amber-200 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" @submit.prevent="handleSubmit" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Nombre</label>
                            <input type="text" name="name" x-model="form.name" placeholder="Ej. Juan"
                                   class="input-premium w-full px-4 py-3 rounded-xl text-sm focus:outline-none" required>
                            <template x-if="errors.name"><p class="text-red-400 text-xs mt-1.5" x-text="errors.name"></p></template>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Apellido</label>
                            <input type="text" name="lastname" x-model="form.lastname" placeholder="Ej. Pérez"
                                   class="input-premium w-full px-4 py-3 rounded-xl text-sm focus:outline-none" required>
                            <template x-if="errors.lastname"><p class="text-red-400 text-xs mt-1.5" x-text="errors.lastname"></p></template>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Correo electrónico</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="email" name="email" x-model="form.email" placeholder="tu@email.com"
                                   class="input-premium w-full pl-11 pr-4 py-3 rounded-xl text-sm focus:outline-none" autocomplete="email" required>
                        </div>
                        <template x-if="errors.email"><p class="text-red-400 text-xs mt-1.5" x-text="errors.email"></p></template>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Contraseña</label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input :type="showPassword ? 'text' : 'password'" name="password" x-model="form.password" placeholder="••••••••••••"
                                   class="input-premium w-full pl-11 pr-12 py-3 rounded-xl text-sm focus:outline-none" autocomplete="new-password" required>
                            <button type="button" @click="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition">
                                <i :class="showPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye'"></i>
                            </button>
                        </div>

                        <div class="mt-2.5 px-0.5" x-show="form.password.length > 0">
                            <div class="flex gap-1 h-1">
                                <div class="flex-1 rounded-full transition-all duration-300" :class="strengthClass(0)"></div>
                                <div class="flex-1 rounded-full transition-all duration-300" :class="strengthClass(1)"></div>
                                <div class="flex-1 rounded-full transition-all duration-300" :class="strengthClass(2)"></div>
                                <div class="flex-1 rounded-full transition-all duration-300" :class="strengthClass(3)"></div>
                            </div>
                            <div class="flex justify-between items-center mt-1.5">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Seguridad:</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider transition-colors duration-300" :class="strengthTextColor" x-text="strengthText"></span>
                            </div>
                        </div>
                        <template x-if="errors.password"><p class="text-red-400 text-xs mt-1.5" x-text="errors.password"></p></template>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Confirmar contraseña</label>
                        <div class="relative">
                            <i class="fa-solid fa-check-double absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="password" name="password_confirmation" x-model="form.password_confirmation" placeholder="••••••••••••"
                                   class="input-premium w-full pl-11 pr-4 py-3 rounded-xl text-sm focus:outline-none" autocomplete="off" required>
                        </div>
                        <template x-if="errors.password_confirmation"><p class="text-red-400 text-xs mt-1.5" x-text="errors.password_confirmation"></p></template>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" name="terms" id="terms" x-model="form.terms" class="w-4 h-4 rounded focus:ring-blue-500/30 focus:ring-offset-0">
                        <label for="terms" class="text-xs text-slate-400 cursor-pointer select-none">
                            Acepto los <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">Términos de servicio</a> y la <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">Política de Privacidad</a>.
                        </label>
                    </div>
                    <template x-if="errors.terms"><p class="text-red-400 text-xs mt-1" x-text="errors.terms"></p></template>

                    <button type="submit" :disabled="loading"
                            class="btn-primary w-full py-3.5 rounded-xl font-bold text-white text-sm mt-3 flex items-center justify-center gap-2 disabled:opacity-60 transition-all cursor-pointer">
                        <i x-show="!loading" class="fa-regular fa-user-plus text-xs"></i>
                        <i x-show="loading" class="fa-solid fa-spinner fa-spin text-xs"></i>
                        <span x-text="loading ? 'Creando cuenta...' : 'Registrarse ahora'"></span>
                    </button>
                </form>

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
    // Fondo animado unificado
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

    // AlpineJS para el Formulario
    function registerForm() {
        return {
            form: { name: '', lastname: '', email: '', password: '', password_confirmation: '', terms: false },
            showPassword: false,
            loading: false,
            errors: {},
            strength: 0,
            init() {
                this.$watch('form.password', value => {
                    let score = 0;
                    if (value.length >= 8) score++;
                    if (value.match(/[A-Z]/)) score++;
                    if (value.match(/[0-9]/)) score++;
                    if (value.match(/[^a-zA-Z0-9]/)) score++;
                    this.strength = value.length === 0 ? 0 : score;
                });
            },
            strengthClass(level) {
                if (this.strength === 0) return 'bg-slate-800';
                if (this.strength > level) {
                    if (this.strength <= 2) return 'bg-red-500';
                    if (this.strength === 3) return 'bg-yellow-500';
                    return 'bg-emerald-500';
                }
                return 'bg-slate-800';
            },
            get strengthText() {
                if (this.form.password.length === 0) return '';
                return ['Muy débil', 'Débil', 'Media', 'Fuerte', 'Muy fuerte'][this.strength];
            },
            get strengthTextColor() {
                if (this.form.password.length === 0) return 'text-slate-500';
                return ['text-red-500', 'text-red-400', 'text-yellow-500', 'text-emerald-400', 'text-emerald-500'][this.strength];
            },
            togglePassword() { this.showPassword = !this.showPassword; },
            handleSubmit(e) {
                this.loading = true;
                this.errors = {};

                if (!this.form.name.trim()) this.errors.name = 'El nombre es requerido';
                if (!this.form.lastname.trim()) this.errors.lastname = 'El apellido es requerido';
                if (!this.form.email.includes('@')) this.errors.email = 'Ingresa un correo válido';
                if (this.form.password.length < 8) this.errors.password = 'La contraseña debe tener al menos 8 caracteres';
                if (this.form.password !== this.form.password_confirmation) this.errors.password_confirmation = 'Las contraseñas no coinciden';
                if (!this.form.terms) this.errors.terms = 'Debes aceptar los términos y condiciones';

                if (Object.keys(this.errors).length > 0) {
                    this.loading = false;
                    return;
                }
                e.target.submit();
            }
        }
    }
</script>
</body>
</html>
