@csrf

@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

 <h4>Detail Penjualan</h4>

 <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Kasir : {{ $sale->user->name }}</h5>
    <h6 class="card-subtitle mb-2 text-muted">Tanggal Transaksi : {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</h6>
    <h6 class="card-text">Total Pembayaran : Rp.{{ number_format($sale->total_pembayaran) }}</h6>
  </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Foto</th>
      <th>Nama</th>
      <th>Harga</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    @foreach($sale->itempenjualan as $item)
    <tr>
            <th scope="row">{{ $i++;}}</th>
            <td>
                <img src="{{ asset('storage/' .$item->produk->foto) }}" width="100">
            <td>{{ $item->produk->nama }}</td>
            <td>Rp.{{ number_format($item->produk->harga_jual) }}</td>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
