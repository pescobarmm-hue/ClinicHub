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
            background: #05070a;
            overflow-x: hidden;
            color: #ffffff;
        }

        .glass-card {
            background: rgba(10, 14, 23, 0.75);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .input-premium {
            background: rgba(5, 7, 12, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.25s ease;
        }
        .input-premium:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            background: #070a10;
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(105deg, #2563eb, #1d4ed8);
            transition: all 0.25s ease;
        }
        .btn-primary:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -6px #1e3a8a;
            background: linear-gradient(105deg, #3b82f6, #2563eb);
        }

        .social-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.2s ease;
        }
        .social-btn:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #0f1119; }
        ::-webkit-scrollbar-thumb { background: #2d3748; border-radius: 10px; }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.5s cubic-bezier(0.2, 0.9, 0.4, 1) forwards;
        }
        .animate-pulse-slow {
            animation: pulse 10s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(1.05); }
        }
    </style>
</head>
<body class="antialiased">

<div x-data="registerForm()" class="relative min-h-screen flex items-center justify-center p-4 md:p-6 overflow-hidden">

    <canvas id="animated-bg" class="fixed inset-0 w-full h-full -z-20 pointer-events-none"></canvas>

    <div class="fixed top-1/4 left-1/4 w-96 h-96 bg-blue-600 rounded-full blur-[130px] opacity-20 animate-pulse-slow -z-10"></div>
    <div class="fixed bottom-1/4 right-1/4 w-80 h-80 bg-indigo-600 rounded-full blur-[120px] opacity-15 animate-pulse-slow -z-10" style="animation-delay: 2s;"></div>

    <div class="w-full max-w-5xl my-auto rounded-3xl overflow-hidden shadow-2xl border border-white/5 animate-fade-in z-10">
        <div class="flex flex-col lg:flex-row">

            <!-- Botón volver -->
    <div class="absolute top-5 left-5 md:top-7 md:left-7 z-50">
        <a href="{{ route('home') }}" class="btn-return flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-medium text-gray-300 shadow-lg transition-all">
            <i class="fa-solid fa-arrow-left text-[11px]"></i>
            <span>Volver al inicio</span>
        </a>
    </div>s
            <div class="w-full lg:w-1/2 bg-gradient-to-br from-slate-950/90 via-slate-900/80 to-indigo-950/40 p-8 md:p-12 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-white/5 backdrop-blur-sm">
                <div>
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center shadow-md">
                            <i class="fa-solid fa-heart-pulse text-white text-base"></i>
                        </div>
                        <div>
                            <span class="text-xl font-black tracking-tight block leading-none">Clinic<span class="text-blue-400">Hub</span></span>
                            <span class="text-[9px] font-bold text-blue-400/60 uppercase tracking-wider block mt-0.5">Premium Medical OS</span>
                        </div>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tight">
                        Únete al<br>
                        <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">ecosistema médico</span>
                    </h1>
                    <p class="text-slate-400 mt-4 text-sm leading-relaxed max-w-md">
                        Crea tu cuenta gratuita y accede a herramientas de gestión clínica, análisis predictivo y mucho más.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-8">
                        <div class="flex items-center gap-3 bg-white/[0.02] rounded-xl p-3 border border-white/[0.05]">
                            <i class="fa-solid fa-shield-halved text-blue-400 text-sm"></i>
                            <span class="text-xs font-medium text-slate-300">Cifrado end-to-end</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/[0.02] rounded-xl p-3 border border-white/[0.05]">
                            <i class="fa-solid fa-chart-line text-emerald-400 text-sm"></i>
                            <span class="text-xs font-medium text-slate-300">Analítica predictiva</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/[0.02] rounded-xl p-3 border border-white/[0.05]">
                            <i class="fa-solid fa-clock text-cyan-400 text-sm"></i>
                            <span class="text-xs font-medium text-slate-300">Soporte 24/7</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/[0.02] rounded-xl p-3 border border-white/[0.05]">
                            <i class="fa-solid fa-mobile-screen-button text-purple-400 text-sm"></i>
                            <span class="text-xs font-medium text-slate-300">App multi‑dispositivo</span>
                        </div>
                    </div>
                </div>

                <div class="mt-10 space-y-3 hidden md:block">
                    <div class="flex items-center justify-between bg-black/20 rounded-xl p-4 border border-white/[0.05]">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                <i class="fa-solid fa-hospital-user text-blue-400 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-xl font-bold leading-none">+124<span class="text-xs text-emerald-400 font-semibold ml-1">↑12%</span></div>
                                <div class="text-[11px] text-slate-400 mt-1">Nuevos pacientes (mes)</div>
                            </div>
                        </div>
                        <i class="fa-regular fa-calendar-check text-slate-600 text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 glass-card p-8 md:p-12 flex flex-col justify-center">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight">Crear cuenta</h2>
                        <p class="text-slate-400 text-sm mt-0.5">Completa tus datos para comenzar</p>
                    </div>
                    <div class="sm:text-right pt-1 sm:pt-0">
                        <span class="block text-[11px] text-slate-500 font-medium uppercase tracking-wider">¿Ya tienes cuenta?</span>
                        <a href="{{ route('login') }}" class="text-xs font-bold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1 mt-0.5 justify-start sm:justify-end">
                            Iniciar sesión <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-3.5 mb-6 flex items-start gap-2.5">
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
                            <input type="text" name="name" x-model="form.name"
                                   class="input-premium w-full px-4 py-3 rounded-xl text-sm text-white focus:outline-none" required>
                            <template x-if="errors.name"><p class="text-red-400 text-xs mt-1.5" x-text="errors.name"></p></template>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Apellido</label>
                            <input type="text" name="lastname" x-model="form.lastname"
                                   class="input-premium w-full px-4 py-3 rounded-xl text-sm text-white focus:outline-none" required>
                            <template x-if="errors.lastname"><p class="text-red-400 text-xs mt-1.5" x-text="errors.lastname"></p></template>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Correo electrónico</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="email" name="email" x-model="form.email"
                                   class="input-premium w-full pl-11 pr-4 py-3 rounded-xl text-sm text-white focus:outline-none" autocomplete="email" required>
                        </div>
                        <template x-if="errors.email"><p class="text-red-400 text-xs mt-1.5" x-text="errors.email"></p></template>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Contraseña</label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input :type="showPassword ? 'text' : 'password'" name="password" x-model="form.password"
                                   class="input-premium w-full pl-11 pr-12 py-3 rounded-xl text-sm text-white focus:outline-none" autocomplete="new-password" required>
                            <button type="button" @click="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition">
                                <i :class="showPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye'"></i>
                            </button>
                        </div>
                        <div class="mt-2">
                            <div class="flex gap-1 h-1.5">
                                <div class="flex-1 rounded-full" :class="strengthClass(0)"></div>
                                <div class="flex-1 rounded-full" :class="strengthClass(1)"></div>
                                <div class="flex-1 rounded-full" :class="strengthClass(2)"></div>
                                <div class="flex-1 rounded-full" :class="strengthClass(3)"></div>
                            </div>
                            <p class="text-[10px] mt-1 font-semibold" :class="strengthTextColor" x-text="strengthText"></p>
                        </div>
                        <template x-if="errors.password"><p class="text-red-400 text-xs mt-1.5" x-text="errors.password"></p></template>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Confirmar contraseña</label>
                        <div class="relative">
                            <i class="fa-solid fa-check-double absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="password" name="password_confirmation" x-model="form.password_confirmation"
                                   class="input-premium w-full pl-11 pr-4 py-3 rounded-xl text-sm text-white focus:outline-none" autocomplete="off" required>
                        </div>
                        <template x-if="errors.password_confirmation"><p class="text-red-400 text-xs mt-1.5" x-text="errors.password_confirmation"></p></template>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" name="terms" x-model="form.terms" class="w-4 h-4 rounded border-slate-700 bg-slate-900 text-blue-500 focus:ring-blue-500/30">
                        <label class="text-xs text-slate-400 cursor-pointer">
                            Acepto los <a href="#" class="text-blue-400 hover:text-blue-300">Términos</a> y la <a href="#" class="text-blue-400 hover:text-blue-300">Privacidad</a>.
                        </label>
                    </div>
                    <template x-if="errors.terms"><p class="text-red-400 text-xs" x-text="errors.terms"></p></template>

                    <button type="submit" :disabled="loading"
                            class="btn-primary w-full py-3.5 rounded-xl font-bold text-white text-sm mt-4 flex items-center justify-center gap-2 disabled:opacity-60 transition-all cursor-pointer">
                        <i x-show="!loading" class="fa-regular fa-user-plus text-xs"></i>
                        <i x-show="loading" class="fa-solid fa-spinner fa-spin text-xs"></i>
                        <span x-text="loading ? 'Creando cuenta...' : 'Registrarse ahora'"></span>
                    </button>
                </form>

                <div class="relative flex items-center my-6">
                    <div class="flex-grow border-t border-white/[0.06]"></div>
                    <span class="mx-3 text-[10px] text-slate-500 uppercase tracking-widest font-medium">O registrarse con</span>
                    <div class="flex-grow border-t border-white/[0.06]"></div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('auth.redirect', ['provider' => 'google']) }}"
                       class="social-btn flex items-center justify-center gap-2 rounded-xl py-2.5 text-xs font-semibold text-slate-200 transition">
                        <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Google
                    </a>
                    <a href="{{ route('auth.redirect', ['provider' => 'github']) }}"
                       class="social-btn flex items-center justify-center gap-2 rounded-xl py-2.5 text-xs font-semibold text-slate-200 transition">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.03-2.682-.103-.253-.447-1.27.098-2.646 0 0 .84-.269 2.75 1.025.8-.223 1.65-.334 2.5-.334.85 0 1.7.111 2.5.334 1.91-1.294 2.75-1.025 2.75-1.025.545 1.376.201 2.393.099 2.646.64.698 1.03 1.591 1.03 2.682 0 3.841-2.337 4.687-4.565 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
                        </svg>
                        GitHub
                    </a>
                </div>

                <div class="flex justify-center gap-4 mt-8 pt-4 border-t border-white/[0.06] text-[10px] text-slate-500 font-semibold uppercase tracking-wider">
                    <span><i class="fa-solid fa-shield-halved text-blue-500/60 mr-1"></i> SSL 256</span>
                    <span><i class="fa-regular fa-clock text-indigo-500/60 mr-1"></i> 2FA Ready</span>
                    <span><i class="fa-solid fa-database text-purple-500/60 mr-1"></i> GDPR</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function dynamicBackground() {
        const canvas = document.getElementById('animated-bg');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let width, height;
        let blobs = [];
        let particles = [];

        function resize() {
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width;
            canvas.height = height;
            initBlobsAndParticles();
        }

        function initBlobsAndParticles() {
            blobs = [
                { x: width * 0.2, y: height * 0.3, radius: 220, color: 'rgba(37, 99, 235, 0.15)', vx: 0.2, vy: 0.15 },
                { x: width * 0.8, y: height * 0.7, radius: 280, color: 'rgba(99, 102, 241, 0.12)', vx: -0.18, vy: 0.1 },
                { x: width * 0.5, y: height * 0.5, radius: 190, color: 'rgba(168, 85, 247, 0.1)', vx: 0.12, vy: -0.2 }
            ];
            const particleCount = Math.min(80, Math.floor(width / 20));
            particles = [];
            for (let i = 0; i < particleCount; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    radius: Math.random() * 2 + 0.6,
                    alpha: Math.random() * 0.4 + 0.1,
                    vx: (Math.random() - 0.5) * 0.3,
                    vy: (Math.random() - 0.5) * 0.2
                });
            }
        }

        function update() {
            for (let b of blobs) {
                b.x += b.vx; b.y += b.vy;
                if (b.x - b.radius < 0 || b.x + b.radius > width) b.vx *= -1;
                if (b.y - b.radius < 0 || b.y + b.radius > height) b.vy *= -1;
            }
            for (let p of particles) {
                p.x += p.vx; p.y += p.vy;
                if (p.x < 0) p.x = width; if (p.x > width) p.x = 0;
                if (p.y < 0) p.y = height; if (p.y > height) p.y = 0;
            }
        }

        function draw() {
            if (!ctx) return;
            ctx.clearRect(0, 0, width, height);
            for (let b of blobs) {
                const grad = ctx.createRadialGradient(b.x, b.y, b.radius * 0.2, b.x, b.y, b.radius);
                grad.addColorStop(0, b.color);
                grad.addColorStop(1, 'rgba(0,0,0,0)');
                ctx.beginPath();
                ctx.arc(b.x, b.y, b.radius, 0, Math.PI * 2);
                ctx.fillStyle = grad;
                ctx.fill();
            }
            for (let p of particles) {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(96, 165, 250, ${p.alpha})`;
                ctx.fill();
            }
            update();
            requestAnimationFrame(draw);
        }

        window.addEventListener('resize', resize);
        resize();
        draw();
    })();

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
                    this.strength = score;
                });
            },
            strengthClass(level) {
                if (this.strength > level) return 'bg-emerald-500';
                if (this.strength === level && this.strength > 0) return 'bg-yellow-400';
                return 'bg-slate-700';
            },
            get strengthText() {
                return ['Muy débil', 'Débil', 'Media', 'Fuerte', 'Muy fuerte'][this.strength] || '';
            },
            get strengthTextColor() {
                return ['text-red-400', 'text-orange-400', 'text-yellow-400', 'text-emerald-400', 'text-emerald-500'][this.strength];
            },
            togglePassword() { this.showPassword = !this.showPassword; },
            handleSubmit(e) {
                this.loading = true;
                this.errors = {};
                if (!this.form.name.trim()) this.errors.name = 'Requerido';
                if (!this.form.lastname.trim()) this.errors.lastname = 'Requerido';
                if (!this.form.email.includes('@')) this.errors.email = 'Inválido';
                if (this.form.password.length < 8) this.errors.password = 'Mínimo 8 caracteres';
                if (this.form.password !== this.form.password_confirmation) this.errors.password_confirmation = 'No coinciden';
                if (!this.form.terms) this.errors.terms = 'Requerido';

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
