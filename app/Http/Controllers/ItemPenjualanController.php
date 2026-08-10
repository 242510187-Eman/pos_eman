<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {

                // Ambil transaksi OPEN milik user
                $sale = Penjualan::where('user_id', Auth::id())
                    ->where('status', 'OPEN')
                    ->lockForUpdate()
                    ->first();

                if (!$sale) {
                    throw new \Exception('Transaksi sudah selesai.');
                }

                $product = Produk::lockForUpdate()->findOrFail($request->product_id);

                // Cek stok
                if ($product->stok < $request->quantity) {
                    throw new \Exception('Stok produk tidak mencukupi.');
                }

                // Kurangi stok
                $product->decrement('stok', $request->quantity);

                // Cari item di keranjang
                $item = ItemPenjualan::where('penjualan_id', $sale->id)
                    ->where('produk_id', $product->id)
                    ->lockForUpdate()
                    ->first();

                if ($item) {
                    $item->kuantitas += $request->quantity;
                } else {
                    $item = new ItemPenjualan([
                        'penjualan_id' => $sale->id,
                        'produk_id'    => $product->id,
                        'kuantitas'    => $request->quantity,
                        'harga_satuan' => $product->harga_jual,
                    ]);
                }

                $item->subtotal = $item->kuantitas * $item->harga_satuan;
                $item->save();

                // Update total penjualan
                $sale->update([
                    'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        return back();
    }

    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        // KUNCI JIKA COMPLETED
        if ($itempenjualan->penjualan->status === 'COMPLETED') {
            return back()->with('errors', 'Transaksi sudah selesai.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request, $itempenjualan) {

                $produk = $itempenjualan->produk()->lockForUpdate()->first();

                $selisih = $request->quantity - $itempenjualan->kuantitas;

                // Qty bertambah → cek stok
                if ($selisih > 0) {
                    if ($produk->stok < $selisih) {
                        throw new \Exception('Stok produk tidak mencukupi.');
                    }
                    $produk->decrement('stok', $selisih);
                }

                // Qty berkurang → kembalikan stok
                if ($selisih < 0) {
                    $produk->increment('stok', abs($selisih));
                }

                $itempenjualan->update([
                    'kuantitas' => $request->quantity,
                    'subtotal'  => $request->quantity * $itempenjualan->harga_satuan
                ]);

                $itempenjualan->penjualan->update([
                    'total_pembayaran' =>
                        $itempenjualan->penjualan->itemPenjualan()->sum('subtotal')
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        return back();
    }

    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        DB::transaction(function () use ($itempenjualan) {

            $produk = $itempenjualan->produk;
            $sale   = $itempenjualan->penjualan;

            // Kembalikan stok
            $produk->increment('stok', $itempenjualan->kuantitas);

            // Hapus item
            $itempenjualan->delete();

            // Update total
            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back();
    }
}
