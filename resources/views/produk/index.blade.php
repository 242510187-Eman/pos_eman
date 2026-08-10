@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --pos-primary: #4f46e5;
        --pos-primary-hover: #4338ca;
        --pos-dark: #0f172a;
        --pos-light-bg: #f8fafc;
    }

    body {
        background-color: var(--pos-light-bg);
    }

    .header-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }

    .btn-primary-custom {
        background-color: var(--pos-primary);
        color: #ffffff;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-primary-custom:hover {
        background-color: var(--pos-primary-hover);
        color: #ffffff;
    }

    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #f1f5f9;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08) !important;
    }

    .product-image-placeholder {
        height: 180px;
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        position: relative;
    }

    .badge-stock {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(4px);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .badge-user {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(4px);
        color: #cbd5e1;
    }
</style>

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="card header-card text-white p-4 mb-4 rounded-4 border-0 shadow-sm">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge px-3 py-1 rounded-pill" style="background-color: rgba(79, 70, 229, 0.2); color: #818cf8; border: 1px solid rgba(129, 140, 248, 0.3);">
                        <i class="bi bi-box-seam me-1"></i> MANAJEMEN STOK
                    </span>
                </div>
                <h2 class="fw-bold m-0">Katalog Produk</h2>
                <p class="text-secondary mb-0 mt-1 small">
                    Kelola stok dan daftar harga produk toko secara real-time
                </p>
            </div>
            <div>
                <a href="{{ Route::has('produk.create') ? route('produk.create') : url('/produk/create') }}" class="btn btn-primary-custom px-4 py-2 rounded-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                    <i class="bi bi-plus-lg fs-6"></i>
                    <span>Tambah Produk Baru</span>
                </a>
            </div>
        </div>
    </div>

    {{-- SEARCH & FILTER BAR --}}
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
        <form action="{{ Route::has('produk.index') ? route('produk.index') : url('/produk') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control border-start-0 ps-0 shadow-none" 
                            placeholder="Cari nama produk..." 
                            value="{{ request('search') }}"
                        >
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom w-100 fw-semibold">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- DAFTAR PRODUK GRID --}}
    <div class="row g-4 mb-4">
        @forelse($produk as $item)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card product-card rounded-4 shadow-sm h-100 border-0 bg-white">
                    
                    {{-- Gambar / Placeholder Produk --}}
                    <div class="product-image-placeholder">
                        @if(isset($item->foto) && $item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <i class="bi bi-box-seam display-4 opacity-50"></i>
                        @endif

                        {{-- Badge Stok --}}
                        <span class="badge badge-stock px-2.5 py-1.5 rounded-3 font-monospace small">
                            Stok: {{ $item->stok }}
                        </span>

                        {{-- Badge Author --}}
                        <span class="badge badge-user px-2 py-1 rounded-2 small fw-normal">
                            <i class="bi bi-person-fill me-1"></i> {{ $item->user->name ?? 'Administrator' }}
                        </span>
                    </div>

                    {{-- Info Produk --}}
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $item->nama }}">
                                {{ $item->nama }}
                            </h6>
                            <p class="text-indigo fw-bold mb-2" style="color: var(--pos-primary);">
                                Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex gap-2 mt-2 pt-2 border-top">
                            <a href="{{ Route::has('produk.edit') ? route('produk.edit', $item->id) : url('/produk/' . $item->id . '/edit') }}" class="btn btn-sm btn-light text-dark w-100 fw-semibold rounded-2 border">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <form action="{{ Route::has('produk.destroy') ? route('produk.destroy', $item->id) : url('/produk/' . $item->id) }}" method="POST" class="w-100" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100 fw-semibold rounded-2">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                    <i class="bi bi-box-seam display-1 text-muted opacity-25 mb-3"></i>
                    <h5 class="fw-bold text-dark">Belum Ada Produk</h5>
                    <p class="text-muted small mb-3">Tidak ada data produk yang ditemukan atau diketik dalam pencarian.</p>
                    <div>
                        <a href="{{ Route::has('produk.create') ? route('produk.create') : url('/produk/create') }}" class="btn btn-primary-custom px-4 py-2 rounded-3 fw-semibold">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Produk Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINASI --}}
    @if(method_exists($produk, 'hasPages') && $produk->hasPages())
        <div class="d-flex justify-content-center">
            {{ $produk->links() }}
        </div>
    @endif

</div>

@endsection