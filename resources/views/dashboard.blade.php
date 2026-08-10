@extends('layouts.app')

@section('title', 'Ringkasan POS')

@section('content')

@include('layouts.navbar')

<div class="container-fluid px-4 py-3">

    {{-- BARIS ATAS: Welcome Banner Minimalis --}}
    <div class="p-3 mb-4 rounded-3 border bg-white d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                📊
            </div>
            <div>
                <h5 class="fw-bold m-0">Ringkasan Performa</h5>
                <small class="text-muted">{{ $tanggalHariIni->translatedFormat('d F Y') }}</small>
            </div>
        </div>
        <span class="badge rounded-pill bg-light text-dark border">
            Status: Aktif
        </span>
    </div>

    @can('viewAny', App\Models\User::class)
        {{-- STATISTIK PENJUALAN (4 Kartu Mini Berderet) --}}
        <div class="row g-2 mb-4">
            <div class="col-6 col-md-3">
                <div class="p-3 border rounded-3 bg-white">
                    <div class="text-muted small text-uppercase">Pendapatan</div>
                    <div class="fs-5 fw-bold text-dark mt-1">
                        Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border rounded-3 bg-white">
                    <div class="text-muted small text-uppercase">Total Nota</div>
                    <div class="fs-5 fw-bold text-dark mt-1">
                        {{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} Transaksi
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border rounded-3 bg-white">
                    <div class="text-muted small text-uppercase">Tunai (Cash)</div>
                    <div class="fs-5 fw-bold text-success mt-1">
                        Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border rounded-3 bg-white">
                    <div class="text-muted small text-uppercase">Non-Tunai</div>
                    <div class="fs-5 fw-bold text-info mt-1">
                        Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- LAYOUT UTAMA: Split 2 Kolom (Kiri: Produk Terlaris, Kanan: Warning Stok) --}}
    <div class="row g-3">
        
        {{-- KOLOM KIRI: Produk Terlaris --}}
        <div class="col-lg-7">
            <div class="border rounded-3 bg-white p-3 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <h6 class="fw-bold m-0">🏆 Produk Terlaris (Bulan Ini)</h6>
                    <small class="text-muted">Top Items</small>
                </div>

                <div class="list-group list-group-flush">
                    @forelse($produkTerlaris as $index => $produk)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <div class="d-flex align-items-center gap-3">
                                <span class="fw-bold text-muted" style="width: 20px;">{{ $index + 1 }}.</span>
                                <div>
                                    <div class="fw-semibold text-dark">{{ $produk->nama }}</div>
                                    <small class="text-muted">Sisa Stok: {{ $produk->stok }}</small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                {{ $produk->total_terjual }} Terjual
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted small">
                            Belum ada riwayat penjualan produk.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: Peringatan Stok (Stok Rendah & Habis Digabung Vertikal) --}}
        <div class="col-lg-5">
            <div class="d-flex flex-column gap-3">
                
                {{-- Box Stok Menipis --}}
                <div class="border rounded-3 bg-white p-3">
                    <h6 class="fw-bold text-warning mb-3">⚠️ Stok Menipis</h6>
                    <ul class="list-group list-group-flush small">
                        @forelse($produkStokRendah as $produk)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1 border-0">
                                <span>{{ $produk->nama }}</span>
                                <span class="fw-bold text-warning">{{ $produk->stok }} tersisa</span>
                            </li>
                        @empty
                            <li class="list-group-item px-0 text-muted border-0">Semua stok produk cukup.</li>
                        @endforelse
                    </ul>
                    @if($produkStokRendah->hasPages())
                        <div class="mt-2 pt-2 border-top">
                            {{ $produkStokRendah->links() }}
                        </div>
                    @endif
                </div>

                {{-- Box Stok Habis --}}
                <div class="border rounded-3 bg-white p-3">
                    <h6 class="fw-bold text-danger mb-3">🚫 Stok Habis</h6>
                    <ul class="list-group list-group-flush small">
                        @forelse($produkStokHabis as $produk)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1 border-0">
                                <span>{{ $produk->nama }}</span>
                                <span class="badge bg-danger">Kosong</span>
                            </li>
                        @empty
                            <li class="list-group-item px-0 text-muted border-0">Tidak ada produk yang habis.</li>
                        @endforelse
                    </ul>
                    @if($produkStokHabis->hasPages())
                        <div class="mt-2 pt-2 border-top">
                            {{ $produkStokHabis->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>

</div>

@endsection