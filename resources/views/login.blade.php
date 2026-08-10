<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Point of Sale</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            padding: 40px 32px;
            border: 1px solid #f1f5f9;
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            background: #4f46e5;
            color: #ffffff;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.25);
        }

        .form-floating .form-control {
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            padding-left: 45px;
        }

        .form-floating .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .input-icon-left {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            z-index: 4;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            font-size: 18px;
            z-index: 4;
        }

        .toggle-password:hover {
            color: #4f46e5;
        }

        .btn-primary-custom {
            background: #4f46e5;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            color: #ffffff;
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            background: #4338ca;
            box-shadow: 0 6px 15px rgba(79, 70, 229, 0.3);
        }

        .text-indigo {
            color: #4f46e5;
        }

        .text-indigo:hover {
            color: #4338ca;
        }
    </style>
</head>

<body>

<div class="login-card">

    {{-- Brand Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="brand-icon">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <h4 class="fw-bold m-0 text-dark">POS System</h4>
            <span class="text-muted small">Silakan masuk ke akun Anda</span>
        </div>
    </div>

    {{-- Session Error --}}
    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-3 small py-2 px-3 mb-3 d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        {{-- Email --}}
        <div class="position-relative mb-3">
            <i class="bi bi-envelope input-icon-left"></i>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control ps-5 py-2 position-relative @error('email') is-invalid @enderror" 
                placeholder="Alamat Email"
                value="{{ old('email') }}"
                required 
                autofocus
            >
            @error('email')
                <div class="invalid-feedback small mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="position-relative mb-3">
            <i class="bi bi-lock input-icon-left"></i>
            <input 
                type="password" 
                name="password" 
                id="passwordInput" 
                class="form-control ps-5 pe-5 py-2 @error('password') is-invalid @enderror" 
                placeholder="Kata Sandi"
                required
            >
            <i 
                class="bi bi-eye toggle-password" 
                id="toggleIcon" 
                onclick="togglePassword()"
                title="Tampilkan kata sandi"
            ></i>
            @error('password')
                <div class="invalid-feedback small mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Remember & Forgot --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    name="remember" 
                    id="rememberMe" 
                    value="1"
                    {{ old('remember') ? 'checked' : '' }}
                >
                <label class="form-check-label small text-muted" for="rememberMe">
                    Ingat Saya
                </label>
            </div>
            <a href="#" class="small text-indigo text-decoration-none fw-semibold">
                Lupa Sandi?
            </a>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2">
            <span>Masuk Kasir</span>
            <i class="bi bi-arrow-right"></i>
        </button>

    </form>

    {{-- Footer --}}
    <div class="text-center mt-4 pt-3 border-top text-muted small">
        &copy; {{ date('Y') }} POS System. All rights reserved.
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