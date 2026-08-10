{{-- layouts/navbar.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-slate shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 12px 24px;">
    <div class="container-fluid p-0">
        
        {{-- Brand Logo & Name --}}
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-white fs-5 m-0" href="{{ Route::has('dashboard') ? route('dashboard') : url('/dashboard') }}">
            <div class="d-flex align-items-center justify-content-center rounded-3 text-white" style="width: 38px; height: 38px; background-color: #4f46e5;">
                <i class="bi bi-box-seam-fill fs-6"></i>
            </div>
            <span>POS System</span>
        </a>

        {{-- Mobile Toggle Button --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPOS" aria-controls="navbarPOS" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navigation Links & Actions --}}
        <div class="collapse navbar-collapse" id="navbarPOS">
            <ul class="navbar-nav me-auto ms-lg-4 mb-2 mb-lg-0 gap-1">
                
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 text-white fw-semibold {{ request()->is('dashboard') ? 'active' : 'text-opacity-75' }}" 
                       style="{{ request()->is('dashboard') ? 'background-color: #4f46e5;' : '' }}" 
                       href="{{ Route::has('dashboard') ? route('dashboard') : url('/dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>

                {{-- Users --}}
                @can('viewAny', App\Models\User::class)
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 text-white fw-medium {{ request()->is('users*') ? 'active' : 'text-opacity-75' }}" 
                       style="{{ request()->is('users*') ? 'background-color: #4f46e5;' : '' }}" 
                       href="{{ Route::has('users.index') ? route('users.index') : url('/users') }}">
                        <i class="bi bi-people me-1"></i> Users
                    </a>
                </li>
                @endcan

                {{-- Produk --}}
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 text-white fw-medium {{ request()->is('produk*') ? 'active' : 'text-opacity-75' }}" 
                       style="{{ request()->is('produk*') ? 'background-color: #4f46e5;' : '' }}" 
                       href="{{ Route::has('produk.index') ? route('produk.index') : url('/produk') }}">
                        <i class="bi bi-box-seam me-1"></i> Produk
                    </a>
                </li>

                {{-- Penjualan --}}
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 text-white fw-medium {{ request()->is('penjualan*') ? 'active' : 'text-opacity-75' }}" 
                       style="{{ request()->is('penjualan*') ? 'background-color: #4f46e5;' : '' }}" 
                       href="{{ Route::has('penjualan.index') ? route('penjualan.index') : url('/penjualan') }}">
                        <i class="bi bi-cart-check me-1"></i> Penjualan
                    </a>
                </li>

            </ul>

            {{-- Logout Button --}}
            <form action="{{ Route::has('logout') ? route('logout') : url('/logout') }}" method="POST" class="d-flex m-0">
                @csrf
                <button type="submit" class="btn btn-danger px-3 py-2 rounded-3 fw-semibold d-flex align-items-center gap-2 border-0" style="background-color: #ef4444;">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>

        </div>
    </div>
</nav>