
@extends('layouts.app')

@section('title', 'Katalog Produk - Premium Edition')

@section('content')

@include('layouts.navbar')

{{-- Font & Icons --}}
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background-color: #030712 !important;
        background-image:
            radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.12) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.10) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(59, 130, 246, 0.15) 0px, transparent 50%) !important;
        background-attachment: fixed !important;
        color: #f3f4f6;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .catalog-container {
        position: relative;
        z-index: 5;
        animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .glass-card {
        background: rgba(17, 24, 39, 0.65);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.10);
        border-radius: 20px;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
    }

    .header-tag {
        background: rgba(99, 102, 241, 0.15);
        color: #818cf8;
        border: 1px solid rgba(129, 140, 248, 0.30);
        font-weight: 600;
        font-size: 11px;
        letter-spacing: 0.5px;
    }

    .btn-add-product {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        padding: 10px 22px;
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-add-product:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(124, 58, 237, 0.5);
        color: #ffffff;
    }

    .search-wrapper {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 14px;
        padding: 4px 8px;
        transition: all 0.3s ease;
    }

    .search-wrapper:focus-within {
        border-color: #818cf8;
        box-shadow:
            0 0 0 4px rgba(99, 102, 241, 0.15),
            0 0 20px rgba(99, 102, 241, 0.20);
    }

    .search-wrapper .form-control {
        background: transparent !important;
        border: none !important;
        color: #ffffff !important;
        font-size: 14px;
        padding-left: 0;
    }

    .search-wrapper .form-control::placeholder {
        color: #6b7280;
    }

    .btn-filter-submit {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #f3f4f6;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .btn-filter-submit:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
    }

    .table-luxury {
        color: #e5e7eb !important;
        vertical-align: middle;
        margin-bottom: 0;
    }

    .table-luxury thead th {
        background: rgba(15, 23, 42, 0.85) !important;
        color: #9ca3af !important;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 16px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.10) !important;
    }

    .table-luxury tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        transition: all 0.2s ease;
    }

    .table-luxury tbody tr:hover {
        background: rgba(255, 255, 255, 0.03) !important;
    }

    .table-luxury tbody td {
        padding: 16px 20px;
        font-size: 14px;
        border: none !important;
    }

    .product-thumb-frame {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .table-luxury tbody tr:hover .product-thumb-frame {
        transform: scale(1.08);
        border-color: rgba(129, 140, 248, 0.40);
    }

    .product-price-tag {
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 15px;
        background: linear-gradient(135deg, #a5b4fc 0%, #c084fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .price-empty {
        color: #f87171;
        font-size: 13px;
        font-weight: 700;
    }

    .badge-stock-luxury {
        font-size: 11px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-stock-safe {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.30);
    }

    .badge-stock-low {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.30);
    }

    .badge-stock-empty {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.30);
    }

    .btn-action-glass {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
    }

    .btn-action-edit {
        background: rgba(245, 158, 11, 0.12);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }

    .btn-action-edit:hover {
        background: rgba(245, 158, 11, 0.25);
        color: #fef08a;
        transform: translateY(-2px);
    }

    .btn-action-delete {
        background: rgba(239, 68, 68, 0.12);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }

    .btn-action-delete:hover {
        background: rgba(239, 68, 68, 0.25);
        color: #fca5a5;
        transform: translateY(-2px);
    }

    .empty-state {
        padding: 70px 20px !important;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container-fluid px-4 py-4 catalog-container">

    {{-- HEADER --}}
    <div class="glass-card p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge header-tag px-3 py-1 rounded-pill">
                        <i class="bi bi-box-seam me-1"></i>
                        MANAJEMEN INVENTARIS
                    </span>
                </div>

                <h2 class="fw-bold m-0 text-white"
                    style="font-family: 'Syne', sans-serif;">
                    Katalog Produk
                </h2>

                <p class="text-muted mb-0 mt-1 small">
                    Kelola ketersediaan stok, harga, dan rincian produk toko.
                </p>
            </div>

            <div>
                <a href="{{ Route::has('produk.create') ? route('produk.create') : url('/produk/create') }}"
                   class="btn-add-product d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>Tambah Produk</span>
                </a>
            </div>

        </div>
    </div>

    {{-- SEARCH --}}
    <div class="glass-card p-3 mb-4">
        <form action="{{ Route::has('produk.index') ? route('produk.index') : url('/produk') }}"
              method="GET">

            <div class="row g-2 align-items-center">

                <div class="col-12 col-md-9">
                    <div class="search-wrapper d-flex align-items-center px-3">

                        <i class="bi bi-search text-muted me-2 fs-6"></i>

                        <input
                            type="text"
                            name="search"
                            class="form-control shadow-none"
                            placeholder="Cari nama produk atau kategori..."
                            value="{{ request('search') }}"
                        >

                        @if(request('search'))
                            <a href="{{ Route::has('produk.index') ? route('produk.index') : url('/produk') }}"
                               class="text-muted text-decoration-none small ms-2">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        @endif

                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <button type="submit"
                            class="btn btn-filter-submit w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-funnel-fill"></i>
                        <span>Terapkan Filter</span>
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- TABEL --}}
    <div class="glass-card p-2 p-md-3">

        <div class="table-responsive rounded-4 overflow-hidden">

            <table class="table table-luxury">

                <thead>
                    <tr>
                        <th width="80" class="text-center">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga Jual</th>
                        <th class="text-center">Status Stok</th>
                        <th>Petugas Input</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
@forelse($produk as $item)

    @php
        // PERBAIKAN: Gunakan $item->harga_jual sesuai nama kolom di database/controller
        $harga = $item->harga_jual ?? null;

        $stok = (int) ($item->stok ?? 0);

        if ($stok <= 0) {
            $badgeStyle = 'badge-stock-empty';
            $iconStyle = 'bi-exclamation-octagon-fill';
        } elseif ($stok <= 5) {
            $badgeStyle = 'badge-stock-low';
            $iconStyle = 'bi-exclamation-triangle-fill';
        } else {
            $badgeStyle = 'badge-stock-safe';
            $iconStyle = 'bi-check-circle-fill';
        }
    @endphp
                        <tr>

                            {{-- GAMBAR --}}
                            <td class="text-center">

                                <div class="product-thumb-frame mx-auto">

                                    @if(!empty($item->foto))

                                        <img
                                            src="{{ asset('storage/' . $item->foto) }}"
                                            alt="{{ $item->nama }}"
                                            class="w-100 h-100 object-fit-cover"
                                        >

                                    @else

                                        <i class="bi bi-box-seam fs-5 text-muted opacity-50"></i>

                                    @endif

                                </div>

                            </td>

                            {{-- NAMA --}}
                            <td>

                                <div class="fw-bold text-black">
                                    {{ $item->nama }}
                                </div>

                                <small class="text-muted" style="font-size: 11px;">
                                    SKU: #PRD-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                                </small>

                            </td>

                            {{-- HARGA --}}
                            <td>

                                @if($harga !== null && $harga !== '' && (float) $harga > 0)

                                    <span class="product-price-tag">
                                        Rp {{ number_format((float) $harga, 0, ',', '.') }}
                                    </span>

                                @else

                                    <span class="price-empty">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        Harga belum diatur
                                    </span>

                                @endif

                            </td>

                            {{-- STOK --}}
                            <td class="text-center">

                                <span class="badge-stock-luxury {{ $badgeStyle }}">

                                    <i class="bi {{ $iconStyle }}"></i>

                                    {{ number_format($stok, 0, ',', '.') }} Unit

                                </span>

                            </td>

                            {{-- USER --}}
                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <i class="bi bi-person-circle text-muted"></i>

                                    <span class="text-gray-300">
                                        {{ optional($item->user)->name ?? 'Admin' }}
                                    </span>

                                </div>

                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">

                                <div class="d-flex align-items-center justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ Route::has('produk.edit') ? route('produk.edit', $item->id) : url('/produk/' . $item->id . '/edit') }}"
                                        class="btn-action-glass btn-action-edit"
                                        title="Edit Produk"
                                    >
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ Route::has('produk.destroy') ? route('produk.destroy', $item->id) : url('/produk/' . $item->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action-glass btn-action-delete"
                                            title="Hapus Produk"
                                        >
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center empty-state text-muted">

                                <i class="bi bi-inbox display-4 text-muted opacity-25 d-block mb-3"></i>

                                <span class="fw-medium">
                                    Belum ada data produk yang terdaftar.
                                </span>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if(method_exists($produk, 'hasPages') && $produk->hasPages())

            <div class="d-flex justify-content-end mt-4 px-2">
                {{ $produk->links() }}
            </div>

        @endif

    </div>

</div>

@endsection

