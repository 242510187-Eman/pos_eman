<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS Premium Luxury Edition</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Google Font: Plus Jakarta Sans & Syne --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* =========================================
           ULTRA LUXURY BACKGROUND
        ========================================= */
        body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            background-color: #030712;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.25) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.2) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.15) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(59, 130, 246, 0.2) 0px, transparent 50%);
            position: relative;
        }

        /* Ambient Glow Orbs */
        .glow-orb-1 {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.35) 0%, rgba(0, 0, 0, 0) 70%);
            top: -100px;
            left: -100px;
            filter: blur(50px);
            animation: floatOrb 10s infinite alternate ease-in-out;
        }

        .glow-orb-2 {
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.3) 0%, rgba(0, 0, 0, 0) 70%);
            bottom: -150px;
            right: -100px;
            filter: blur(60px);
            animation: floatOrb 12s infinite alternate-reverse ease-in-out;
        }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 40px) scale(1.1); }
        }

        /* GRID PATTERN OVERLAY */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 35px 35px;
            pointer-events: none;
        }

        /* =========================================
           GLASS CARD CONTAINER
        ========================================= */
        .login-wrapper {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
            animation: cardAppear 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .login-card {
            background: rgba(17, 24, 39, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 45px 40px 35px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 
                0 30px 60px -12px rgba(0, 0, 0, 0.56),
                0 18px 36px -18px rgba(0, 0, 0, 0.72),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.15);
            position: relative;
            overflow: hidden;
        }

        /* Radiant Top Line */
        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899);
        }

        /* =========================================
           BRANDING SECTION
        ========================================= */
        .brand-section {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }

        .brand-icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 24px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.8), rgba(168, 85, 247, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        }

        .brand-title {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.3px;
        }

        .brand-subtitle {
            color: #9ca3af;
            font-size: 11px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* =========================================
           WELCOME TEXT
        ========================================= */
        .welcome-title {
            font-size: 24px;
            font-weight: 700;
            color: #f9fafb;
            margin-bottom: 6px;
        }

        .welcome-text {
            color: #9ca3af;
            font-size: 13px;
            margin-bottom: 28px;
        }

        /* =========================================
           INPUT FIELD STYLING
        ========================================= */
        .input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 18px;
            z-index: 5;
            transition: all 0.3s ease;
        }

        .form-control-custom {
            width: 100%;
            height: 54px;
            padding-left: 50px;
            padding-right: 50px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(15, 23, 42, 0.6);
            color: #f3f4f6;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control-custom::placeholder {
            color: #4b5563;
        }

        .form-control-custom:focus {
            background: rgba(15, 23, 42, 0.85);
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15), 0 0 20px rgba(99, 102, 241, 0.2);
            outline: none;
            color: #ffffff;
        }

        .form-control-custom:focus ~ .input-icon {
            color: #818cf8;
        }

        .toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            cursor: pointer;
            font-size: 18px;
            z-index: 5;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #f3f4f6;
        }

        /* =========================================
           REMEMBER & FORGOT
        ========================================= */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 5px 0 26px;
        }

        .form-check-input {
            background-color: rgba(31, 41, 55, 0.8);
            border-color: rgba(255, 255, 255, 0.15);
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #6366f1;
            border-color: #6366f1;
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
        }

        .remember-label {
            color: #9ca3af;
            font-size: 12px;
            cursor: pointer;
            user-select: none;
        }

        .forgot-link {
            color: #818cf8;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .forgot-link:hover {
            color: #a5b4fc;
            text-shadow: 0 0 8px rgba(129, 140, 248, 0.4);
        }

        /* =========================================
           LUXURY SHIMMER BUTTON
        ========================================= */
        .btn-login {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #9333ea 100%);
            color: white;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        /* Effect Shimmer Light */
        .btn-login::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                60deg,
                transparent,
                rgba(255, 255, 255, 0.25),
                transparent
            );
            transform: rotate(30deg);
            transition: all 0.75s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(124, 58, 237, 0.6);
            color: #ffffff;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* =========================================
           CUSTOM ERROR ALERT
        ========================================= */
        .alert-custom {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 12px;
            font-size: 12px;
            padding: 12px 15px;
            backdrop-filter: blur(5px);
        }

        .invalid-feedback {
            font-size: 11px;
            color: #f87171;
            margin-top: 6px;
            margin-left: 4px;
        }

        /* =========================================
           FOOTER
        ========================================= */
        .login-footer {
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            color: #6b7280;
            font-size: 11px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            padding: 4px 10px;
            border-radius: 20px;
            color: #4ade80;
            font-weight: 600;
            font-size: 10px;
            margin-bottom: 8px;
        }

        .footer-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 8px #22c55e;
        }

        /* =========================================
           ANIMATION
        ========================================= */
        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (max-width: 480px) {
            body { padding: 15px; }
            .login-card { padding: 35px 24px 25px; }
            .brand-title { font-size: 20px; }
            .welcome-title { font-size: 21px; }
        }
    </style>
</head>

<body>

    <div class="glow-orb-1"></div>
    <div class="glow-orb-2"></div>
    <div class="grid-overlay"></div>

    <div class="login-wrapper">
        <div class="login-card">

            {{-- BRANDING --}}
            <div class="brand-section">
                <div class="brand-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <div>
                    <div class="brand-title">APEX POS</div>
                    <div class="brand-subtitle">Enterprise Edition</div>
                </div>
            </div>

            {{-- WELCOME HEADER --}}
            <div>
                <div class="welcome-title">Selamat Datang ✨</div>
                <div class="welcome-text">Masuk ke akun Anda untuk mengelola sistem.</div>
            </div>

            {{-- SESSION ERROR ALERT --}}
            @if(session('error'))
                <div class="alert-custom mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill fs-6"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            {{-- LOGIN FORM --}}
            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                {{-- EMAIL --}}
                <div class="input-wrapper">
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control-custom @error('email') is-invalid @enderror" 
                        placeholder="Alamat Email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                    >
                    <i class="bi bi-envelope-check input-icon"></i>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="input-wrapper">
                    <input 
                        type="password" 
                        name="password" 
                        id="passwordInput" 
                        class="form-control-custom @error('password') is-invalid @enderror" 
                        placeholder="Kata Sandi" 
                        required
                    >
                    <i class="bi bi-key input-icon"></i>
                    <i class="bi bi-eye toggle-password" id="toggleIcon" onclick="togglePassword()" title="Tampilkan kata sandi"></i>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- REMEMBER ME & FORGOT PASSWORD --}}
                <div class="remember-row">
                    <div class="form-check d-flex align-items-center gap-2">
                        <input 
                            class="form-check-input mt-0" 
                            type="checkbox" 
                            name="remember" 
                            id="rememberMe" 
                            value="1" 
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label class="remember-label" for="rememberMe">Ingat Saya</label>
                    </div>

                    <a href="#" class="forgot-link">Lupa Sandi?</a>
                </div>

                {{-- SUBMIT BUTTON --}}
                <button type="submit" class="btn-login">
                    <span>Masuk</span>
                    <i class="bi bi-arrow-right-short fs-4"></i>
                </button>

            </form>

            {{-- FOOTER --}}
            <div class="login-footer">
                <div class="status-badge">
                    <span class="footer-dot"></span>
                    <span>Sistem Terenkripsi & Aktif</span>
                </div>
                <div>
                    &copy; {{ date('Y') }} APEX POS. All rights reserved.
                </div>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
                toggleIcon.setAttribute('title', 'Sembunyikan kata sandi');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
                toggleIcon.setAttribute('title', 'Tampilkan kata sandi');
            }
        }
    </script>

</body>
</html>