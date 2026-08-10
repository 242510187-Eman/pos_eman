@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">Daftar Penjualan</h3>
            <p class="text-secondary small mb-0">Riwayat data transaksi kasir</p>
        </div>
        <a href="{{ Route::has('penjualan.create') ? route('penjualan.create') : url('/penjualan/create') }}" class="btn btn-primary px-3 fw-semibold" style="background-color: #4f46e5; border: none;">
            + Tambah Penjualan
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 text-white mb-4" style="background-color: #10b981;">
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD UTAMA --}}
    <div class="card border-0 rounded-3 shadow-sm" style="background-color: #1e293b;">
        <div class="card-body p-3">

            {{-- SEARCH --}}
            <form action="{{ Route::has('penjualan.index') ? route('penjualan.index') : url('/penjualan') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0 text-white" style="background-color: #0f172a;" placeholder="Cari kasir atau metode...">
                    <button type="submit" class="btn text-white fw-semibold" style="background-color: #4f46e5;">Cari</button>
                </div>
            </form>

            {{-- TABEL --}}
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-secondary small">
                            <th width="50">NO</th>
                            <th>TANGGAL</th>
                            <th>KASIR</th>
                            <th>TOTAL</th>
                            <th>METODE</th>
                            <th>STATUS</th>
                            <th class="text-center" width="120">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales ?? [] as $sale)
                        <tr>
                            <td>{{ method_exists($sales, 'firstItem') ? $sales->firstItem() + $loop->index : $loop->iteration }}</td>
                            <td>{{ isset($sale->created_at) && method_exists($sale->created_at, 'translatedFormat') ? $sale->created_at->translatedFormat('d/m/Y H:i') : ($sale->created_at ?? '-') }}</td>
                            <td>{{ optional($sale->user)->name ?? 'Kasir Umum' }}</td>
                            <td class="fw-bold text-success">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</td>
                            <td><span class="badge bg-secondary">{{ strtoupper($sale->metode_pembayaran ?? 'CASH') }}</span></td>
                            <td>
                                @if(strtoupper($sale->status ?? '') == 'OPEN')
                                    <span class="badge bg-warning text-dark">OPEN</span>
                                @else
                                    <span class="badge bg-success">COMPLETED</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ Route::has('penjualan.show') ? route('penjualan.show', $sale) : url('/penjualan/' . ($sale->id ?? '')) }}" class="btn btn-info text-white" title="Lihat">👁️</a>
                                    <a href="{{ Route::has('penjualan.edit') ? route('penjualan.edit', $sale) : url('/penjualan/' . ($sale->id ?? '') . '/edit') }}" class="btn btn-warning text-dark" title="Edit">✏️</a>
                                    <form action="{{ Route::has('penjualan.destroy') ? route('penjualan.destroy', $sale) : url('/penjualan/' . ($sale->id ?? '')) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" title="Hapus">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-secondary">
                                Tidak ada data penjualan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINASI --}}
            @if(isset($sales) && method_exists($sales, 'links'))
                <div class="d-flex justify-content-end mt-3">
                    {{ $sales->appends(request()->query())->links() }}
                </div>
            @endif

        </div>
    </div>

</div>

@endsection