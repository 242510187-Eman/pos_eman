@extends('layouts.app')

@section('title', 'Ringkasan POS - Premium Luxury Edition')

@section('content')

@include('layouts.navbar')

{{-- Font & Icons --}}
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* =========================================
       GLOBAL & BACKGROUND STYLING
    ========================================= */
    body {
        background-color: #030712 !important;
        background-image: 
            radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.12) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.1) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(59, 130, 246, 0.15) 0px, transparent 50%) !important;
        background-attachment: fixed !important;
        color: #f3f4f6;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Ambient Background Glow */
    .dashboard-container {
        position: relative;
        z-index: 5;
        animation: dashboardFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* =========================================
       GLASS CARD & UTILITIES
    ========================================= */
    .glass-card {
        background: rgba(17, 24, 39, 0.65);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
        border-color: rgba(255, 255, 255, 0.18);
    }

    .card-header-luxury {
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 18px 24px;
        border-radius: 20px 20px 0 0;
    }

    /* =========================================
       WELCOME BANNER
    ========================================= */
    .banner-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.8), rgba(168, 85, 247, 0.8));
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #fff;
    }

    .badge-status-active {
        background: rgba(34, 197, 94, 0.12);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #4ade80;
        font-weight: 600;
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .status-dot-green {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: #22c55e;
        box-shadow: 0 0 10px #22c55e;
    }

    /* =========================================
       STATISTICS CARDS
    ========================================= */
    .stat-card {
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.5s ease;
    }

    .stat-card:hover::before {
        background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px -10px rgba(99, 102, 241, 0.25);
    }

    .stat-title {
        color: #9ca3af;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .stat-value {
        font-family: 'Syne', sans-serif;
        font-size: 22px;
        font-weight: 800;
        color: #ffffff;
        margin-top: 8px;
    }

    .stat-value.text-success-custom {
        color: #4ade80 !important;
        text-shadow: 0 0 12px rgba(74, 222, 128, 0.2);
    }

    .stat-value.text-info-custom {
        color: #38bdf8 !important;
        text-shadow: 0 0 12px rgba(56, 189, 248, 0.2);
    }

    /* =========================================
       TOP PRODUCTS & RANKING
    ========================================= */
    .product-item {
        padding: 14px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: background 0.2s;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .rank-badge {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 12px;
        background: rgba(255, 255, 255, 0.05);
        color: #9ca3af;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .rank-1 { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; border: none; box-shadow: 0 0 12px rgba(245, 158, 11, 0.4); }
    .rank-2 { background: linear-gradient(135deg, #94a3b8, #64748b); color: #fff; border: none; }
    .rank-3 { background: linear-gradient(135deg, #b45309, #78350f); color: #fff; border: none; }

    .sales-badge {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
        border: 1px solid rgba(168, 85, 247, 0.4);
        color: #c084fc;
        font-weight: 700;
        font-size: 12px;
        padding: 6px 16px;
        border-radius: 20px;
    }

    /* =========================================
       STOCK WARNINGS
    ========================================= */
    .warning-box {
        border-left: 3px solid #f59e0b;
    }

    .danger-box {
        border-left: 3px solid #ef4444;
    }

    .badge-stock-low {
        background: rgba(245, 158, 11, 0.15);
        border: 1px solid rgba(245, 158, 11, 0.3);
        color: #fbbf24;
        font-weight: 700;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 8px;
    }

    .badge-stock-empty {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #f87171;
        font-weight: 700;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 8px;
    }

    /* =========================================
       PAGINATION OVERRIDE FOR DARK THEME
    ========================================= */
    .pagination .page-link {
        background: rgba(15, 23, 42, 0.6) !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
        color: #9ca3af !important;
        font-size: 12px;
        border-radius: 8px;
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
        border-color: transparent !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }

    /* =========================================
       ANIMATIONS
    ========================================= */
    @keyframes dashboardFadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container-fluid px-4 py-4 dashboard-container">

    {{-- BARIS ATAS: Welcome Banner Minimalis --}}
    <div class="glass-card p-3 mb-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="banner-icon">
                <i class="bi bi-bar-chart-line-fill"></i>
            </div>
            <div>
                <h5 class="fw-bold m-0 text-white" style="font-family: 'Syne', sans-serif;">Ringkasan Performa</h5>
                <small class="text-muted">{{ $tanggalHariIni->translatedFormat('d F Y') }}</small>
            </div>
        </div>
        <div>
            <span class="badge-status-active">
                <span class="status-dot-green"></span>
                Sistem Aktif
            </span>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)
        {{-- STATISTIK PENJUALAN (4 Kartu Mini Berderet) --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="glass-card stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="stat-title">Pendapatan</span>
                        <i class="bi bi-wallet2 text-indigo fs-5" style="color: #818cf8;"></i>
                    </div>
                    <div class="stat-value">
                        Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-card stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="stat-title">Total Nota</span>
                        <i class="bi bi-receipt text-purple fs-5" style="color: #c084fc;"></i>
                    </div>
                    <div class="stat-value">
                        {{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} <span class="fs-6 fw-normal text-muted">Tx</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-card stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="stat-title">Tunai (Cash)</span>
                        <i class="bi bi-cash-stack text-success fs-5" style="color: #4ade80;"></i>
                    </div>
                    <div class="stat-value text-success-custom">
                        Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-card stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="stat-title">Non-Tunai</span>
                        <i class="bi bi-credit-card-2-front text-info fs-5" style="color: #38bdf8;"></i>
                    </div>
                    <div class="stat-value text-info-custom">
                        Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- LAYOUT UTAMA: Split 2 Kolom (Kiri: Produk Terlaris, Kanan: Warning Stok) --}}
    <div class="row g-4">
        
        {{-- KOLOM KIRI: Produk Terlaris --}}
        <div class="col-lg-7">
            <div class="glass-card h-100 d-flex flex-column">
                <div class="card-header-luxury d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-trophy-fill text-warning fs-5"></i>
                        <h6 class="fw-bold m-0 text-white">Produk Terlaris (Bulan Ini)</h6>
                    </div>
                    <span class="badge bg-dark border border-secondary text-muted px-2 py-1 fs-12">Top Items</span>
                </div>

                <div class="p-4 flex-grow-1">
                    @forelse($produkTerlaris as $index => $produk)
                        <div class="product-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rank-badge {{ $index == 0 ? 'rank-1' : ($index == 1 ? 'rank-2' : ($index == 2 ? 'rank-3' : '')) }}">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <div class="fw-semibold text-white fs-15">{{ $produk->nama }}</div>
                                    <small class="text-muted">Sisa Stok: <span class="text-gray-300">{{ $produk->stok }}</span></small>
                                </div>
                            </div>
                            <span class="sales-badge">
                                {{ $produk->total_terjual }} Terjual
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                            <span>Belum ada riwayat penjualan produk.</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: Peringatan Stok --}}
        <div class="col-lg-5">
            <div class="d-flex flex-column gap-4">
                
                {{-- Box Stok Menipis --}}
                <div class="glass-card warning-box">
                    <div class="card-header-luxury d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                        <h6 class="fw-bold text-warning m-0">Stok Menipis</h6>
                    </div>
                    <div class="p-3">
                        @forelse($produkStokRendah as $produk)
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary border-opacity-10">
                                <span class="text-gray-200 fs-14">{{ $produk->nama }}</span>
                                <span class="badge-stock-low">{{ $produk->stok }} tersisa</span>
                            </div>
                        @empty
                            <div class="text-muted small py-2">Semua stok produk cukup.</div>
                        @endforelse

                        @if($produkStokRendah->hasPages())
                            <div class="mt-3 pt-2 border-top border-secondary border-opacity-10">
                                {{ $produkStokRendah->links() }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Box Stok Habis --}}
                <div class="glass-card danger-box">
                    <div class="card-header-luxury d-flex align-items-center gap-2">
                        <i class="bi bi-slash-circle-fill text-danger"></i>
                        <h6 class="fw-bold text-danger m-0">Stok Habis</h6>
                    </div>
                    <div class="p-3">
                        @forelse($produkStokHabis as $produk)
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary border-opacity-10">
                                <span class="text-gray-200 fs-14">{{ $produk->nama }}</span>
                                <span class="badge-stock-empty">Kosong</span>
                            </div>
                        @empty
                            <div class="text-muted small py-2">Tidak ada produk yang habis.</div>
                        @endforelse

                        @if($produkStokHabis->hasPages())
                            <div class="mt-3 pt-2 border-top border-secondary border-opacity-10">
                                {{ $produkStokHabis->links() }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection