# Daftar Penjualan — Background Berbeda

```blade
@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')

@include('layouts.navbar')

<style>
    /* ================================
       BACKGROUND HALAMAN
    ================================= */
    body {
        background: #eef2f7 !important;
        color: #1e293b;
    }

    /* Background utama halaman */
    .penjualan-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #eef2f7 0%, #e2e8f0 100%);
        padding-bottom: 40px;
    }

    /* ================================
       HEADER
    ================================= */
    .page-title {
        color: #1e293b !important;
    }

    .page-subtitle {
        color: #64748b !important;
    }

    /* ================================
       CARD UTAMA
    ================================= */
    .sales-card {
        background-color: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 14px;
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
    }

    /* ================================
       SEARCH
    ================================= */
    .search-input {
        background-color: #f8fafc !important;
        color: #1e293b !important;
        border: 1px solid #cbd5e1 !important;
    }

    .search-input:focus {
        background-color: #ffffff !important;
        color: #1e293b !important;
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15) !important;
    }

    .search-input::placeholder {
        color: #94a3b8 !important;
    }

    .search-button {
        background-color: #4f46e5 !important;
        border: none !important;
    }

    .search-button:hover {
        background-color: #4338ca !important;
    }

    /* ================================
       TABEL
    ================================= */
    .sales-table {
        color: #334155 !important;
        background-color: #ffffff !important;
        border-radius: 10px;
        overflow: hidden;
    }

    .sales-table thead {
        background-color: #f1f5f9 !important;
    }

    .sales-table thead th {
        color: #64748b !important;
        font-size: 12px;
        font-weight: 700;
        border-bottom: 1px solid #e2e8f0;
        padding: 14px;
    }

    .sales-table tbody tr {
        background-color: #ffffff !important;
        color: #334155 !important;
        border-bottom: 1px solid #e2e8f0;
    }

    .sales-table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    .sales-table tbody td {
        padding: 14px;
        color: #334155 !important;
        border-color: #e2e8f0 !important;
    }

    /* ================================
       TOTAL
    ================================= */
    .total-price {
        color: #059669 !important;
    }

    /* ================================
       TOMBOL TAMBAH
    ================================= */
    .btn-add {
        background-color: #4f46e5 !important;
        border: none !important;
        color: #ffffff !important;
    }

    .btn-add:hover {
        background-color: #4338ca !important;
        color: #ffffff !important;
    }

    /* ================================
       ALERT
    ================================= */
    .success-alert {
        background-color: #10b981 !important;
        color: #ffffff !important;
    }

    /* ================================
       EMPTY DATA
    ================================= */
    .empty-data {
        color: #94a3b8 !important;
    }

    /* ================================
       PAGINATION
    ================================= */
    .pagination {
        margin-bottom: 0;
    }
</style>


<div class="penjualan-page">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold page-title mb-1">
                    Daftar Penjualan
                </h3>

                <p class="page-subtitle small mb-0">
                    Riwayat data transaksi kasir
                </p>
            </div>

            <a
                href="{{ Route::has('penjualan.create') ? route('penjualan.create') : url('/penjualan/create') }}"
                class="btn btn-add px-3 fw-semibold"
            >
                + Tambah Penjualan
            </a>

        </div>


        {{-- ALERT --}}
        @if(session('success'))

            <div class="alert success-alert border-0 rounded-3 mb-4">
                {{ session('success') }}
            </div>

        @endif


        {{-- CARD UTAMA --}}
        <div class="card sales-card">

            <div class="card-body p-3">

                {{-- SEARCH --}}
                <form
                    action="{{ Route::has('penjualan.index') ? route('penjualan.index') : url('/penjualan') }}"
                    method="GET"
                    class="mb-3"
                >

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control search-input"
                            placeholder="Cari kasir atau metode..."
                        >

                        <button
                            type="submit"
                            class="btn search-button text-white fw-semibold"
                        >
                            Cari
                        </button>

                    </div>

                </form>


                {{-- TABEL --}}
                <div class="table-responsive">

                    <table class="table sales-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th width="50">
                                    NO
                                </th>

                                <th>
                                    TANGGAL
                                </th>

                                <th>
                                    KASIR
                                </th>

                                <th>
                                    TOTAL
                                </th>

                                <th>
                                    METODE
                                </th>

                                <th>
                                    STATUS
                                </th>

                                <th
                                    class="text-center"
                                    width="120"
                                >
                                    AKSI
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($sales ?? [] as $sale)

                                <tr>

                                    {{-- NO --}}
                                    <td>
                                        {{ method_exists($sales, 'firstItem')
                                            ? $sales->firstItem() + $loop->index
                                            : $loop->iteration
                                        }}
                                    </td>


                                    {{-- TANGGAL --}}
                                    <td>

                                        @if(
                                            isset($sale->created_at) &&
                                            method_exists($sale->created_at, 'translatedFormat')
                                        )

                                            {{ $sale->created_at->translatedFormat('d/m/Y H:i') }}

                                        @else

                                            {{ $sale->created_at ?? '-' }}

                                        @endif

                                    </td>


                                    {{-- KASIR --}}
                                    <td>
                                        {{ optional($sale->user)->name ?? 'Kasir Umum' }}
                                    </td>


                                    {{-- TOTAL --}}
                                    <td class="fw-bold total-price">

                                        Rp
                                        {{ number_format(
                                            $sale->total_pembayaran ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </td>


                                    {{-- METODE --}}
                                    <td>

                                        <span class="badge bg-secondary">
                                            {{ strtoupper(
                                                $sale->metode_pembayaran ?? 'CASH'
                                            ) }}
                                        </span>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if(
                                            strtoupper($sale->status ?? '') == 'OPEN'
                                        )

                                            <span class="badge bg-warning text-dark">
                                                OPEN
                                            </span>

                                        @else

                                            <span class="badge bg-success">
                                                COMPLETED
                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="text-center">

                                        <div class="btn-group btn-group-sm">

                                            {{-- LIHAT --}}
                                            <a
                                                href="{{ Route::has('penjualan.show')
                                                    ? route('penjualan.show', $sale)
                                                    : url('/penjualan/' . ($sale->id ?? ''))
                                                }}"
                                                class="btn btn-info text-white"
                                                title="Lihat"
                                            >
                                                👁️
                                            </a>


                                            {{-- EDIT --}}
                                            <a
                                                href="{{ Route::has('penjualan.edit')
                                                    ? route('penjualan.edit', $sale)
                                                    : url('/penjualan/' . ($sale->id ?? '') . '/edit')
                                                }}"
                                                class="btn btn-warning text-dark"
                                                title="Edit"
                                            >
                                                ✏️
                                            </a>


                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ Route::has('penjualan.destroy')
                                                    ? route('penjualan.destroy', $sale)
                                                    : url('/penjualan/' . ($sale->id ?? ''))
                                                }}"
                                                method="POST"
                                                class="d-inline"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Hapus data ini?')"
                                                    title="Hapus"
                                                >
                                                    🗑️
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="text-center py-5 empty-data"
                                    >
                                        Tidak ada data penjualan.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINASI --}}
                @if(
                    isset($sales) &&
                    method_exists($sales, 'links')
                )

                    <div class="d-flex justify-content-end mt-3">

                        {{ $sales->appends(
                            request()->query()
                        )->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection