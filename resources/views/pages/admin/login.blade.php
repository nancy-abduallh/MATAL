<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>تسجيل دخول المشرفين والإدارة · بوابة مَطَلّ المركزية</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #071722;
            color: #E2E8F0;
        }

        .admin-login-card {
            background: linear-gradient(145deg, rgba(14, 38, 55, 0.9) 0%, rgba(8, 22, 33, 0.98) 100%);
            border: 1px solid rgba(6, 182, 212, 0.25);
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.8), 0 0 35px rgba(6, 182, 212, 0.15);
            backdrop-filter: blur(20px);
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50% { opacity: 0.65; transform: scale(1.08); }
        }
        .pulse-glow { animation: pulseGlow 8s ease-in-out infinite; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6 relative overflow-hidden selection:bg-[#06B6D4] selection:text-white">

    <!-- Ambient glowing high-tech orbs -->
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-cyan-600/20 blur-[100px] pointer-events-none pulse-glow"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-sky-600/20 blur-[100px] pointer-events-none pulse-glow" style="animation-delay: -4s;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-20" style="background-image: radial-gradient(rgba(6, 182, 212, 0.4) 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="relative z-10 w-full max-w-lg">
        
        <!-- Header Brand -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block group mb-3" title="العودة للرئيسية">
                <img src="/images/matal_logo_white_text.png" alt="مَطَلّ MATAL" class="h-16 w-auto mx-auto drop-shadow-lg transition-transform duration-300 group-hover:scale-105">
            </a>
            <div class="flex items-center justify-center gap-2 mt-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-cyan-500/15 text-[#38BDF8] border border-cyan-500/30">
                    <i class="fa-solid fa-shield-halved"></i> بوابة المشرفين والإدارة المركزية
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-white mt-3">تسجيل الدخول الإداري</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">منظومة التحليلات والتحكم المتقدمة (Power BI Executive Suite)</p>
        </div>

        <!-- Login Card -->
        <div class="admin-login-card rounded-3xl p-6 sm:p-10 relative">

            <!-- Security Badge Alert -->
            <div class="mb-6 p-3.5 rounded-2xl bg-cyan-950/40 border border-cyan-500/20 flex items-start gap-3 text-xs leading-relaxed text-cyan-200">
                <i class="fa-solid fa-lock text-cyan-400 mt-0.5 text-sm shrink-0"></i>
                <div>
                    <span class="font-bold text-white block mb-0.5">منطقة وصول إدارية مقيدة</span>
                    هذه البوابة مخصصة حصراً للمشرفين المعتمدين لمنصة مَطَلّ. جميع النشاطات مسجلة ومحمية بالتشفير.
                </div>
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="admin_email" class="block text-xs font-black text-slate-300 mb-2">
                        البريد الإلكتروني الإداري <span class="text-cyan-400">*</span>
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-user-shield absolute right-4 top-1/2 -translate-y-1/2 text-cyan-400 text-sm pointer-events-none"></i>
                        <input id="admin_email" type="email" name="email" 
                               value="{{ old('email', app()->environment('local') ? 'admin@matal.sa' : '') }}" 
                               required 
                               placeholder="admin@matal.sa" 
                               class="w-full rounded-xl bg-slate-900/80 border border-cyan-500/30 text-white placeholder-slate-500 text-sm pr-11 pl-4 py-3 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/20 transition" 
                               dir="ltr" style="text-align: right;">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs font-bold text-rose-400 flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="admin_password" class="block text-xs font-black text-slate-300">
                            كلمة المرور المشفرة <span class="text-cyan-400">*</span>
                        </label>
                    </div>
                    <div class="relative">
                        <i class="fa-solid fa-key absolute right-4 top-1/2 -translate-y-1/2 text-cyan-400 text-sm pointer-events-none"></i>
                        <input id="admin_password" type="password" name="password" 
                               @if(app()->environment('local')) value="password123" @endif 
                               required 
                               placeholder="••••••••••••" 
                               class="w-full rounded-xl bg-slate-900/80 border border-cyan-500/30 text-white placeholder-slate-500 text-sm pr-11 pl-11 py-3 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/20 transition" 
                               dir="ltr" style="text-align: right;">
                        <button type="button" id="togglePwBtn" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-lg text-slate-400 hover:text-cyan-300 hover:bg-white/5 transition flex items-center justify-center" aria-label="إظهار كلمة المرور">
                            <i class="fa-regular fa-eye text-sm"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs font-bold text-rose-400 flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me & Security Policy -->
                <div class="flex items-center justify-between text-xs font-semibold text-slate-400">
                    <label class="inline-flex items-center gap-2 cursor-pointer hover:text-slate-200 transition">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded accent-cyan-500 bg-slate-900 border-cyan-500/40">
                        <span>إبقاء الجلسة نشطة بأمان</span>
                    </label>
                    <span class="text-slate-500">جلسة محمية بـ SSL/TLS</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-[#0891B2] via-[#0284C7] to-[#0369A1] hover:from-[#06B6D4] hover:to-[#0284C7] text-white font-black text-sm shadow-xl shadow-cyan-900/40 border border-cyan-400/40 hover:shadow-cyan-500/25 transition-all duration-300 flex items-center justify-center gap-2 transform hover:-translate-y-0.5 cursor-pointer">
                    <i class="fa-solid fa-right-to-bracket text-base"></i>
                    <span>دخول مصرح للوحة الإدارة والتحليلات</span>
                </button>

            </form>

            @if(app()->environment('local'))
                <div class="mt-6 pt-5 border-t border-cyan-500/15 text-center">
                    <button type="button" onclick="document.getElementById('admin_email').value='admin@matal.sa'; document.getElementById('admin_password').value='password123';" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-cyan-500/10 border border-cyan-500/25 text-cyan-300 hover:bg-cyan-500/20 text-xs font-bold transition">
                        <i class="fa-solid fa-wand-magic-sparkles text-cyan-400"></i>
                        <span>ملء بيانات الحساب التجريبي للإدارة تلقائياً (Local Demo)</span>
                    </button>
                </div>
            @endif

        </div>

        <!-- Footer Back link -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-cyan-300 transition">
                <i class="fa-solid fa-arrow-right"></i>
                <span>العودة إلى الواجهة العامة لمنصة مَطَلّ</span>
            </a>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pwInput = document.getElementById('admin_password');
            const toggleBtn = document.getElementById('togglePwBtn');
            if (toggleBtn && pwInput) {
                toggleBtn.addEventListener('click', () => {
                    const isText = pwInput.type === 'text';
                    pwInput.type = isText ? 'password' : 'text';
                    toggleBtn.querySelector('i').className = isText ? 'fa-regular fa-eye text-sm' : 'fa-regular fa-eye-slash text-sm';
                });
            }
        });
    </script>
</body>
</html>
