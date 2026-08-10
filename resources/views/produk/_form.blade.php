<style>
    .form-label-luxury {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #64748b;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-luxury {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 12px 16px;
        font-size: 14px;
        color: #0f172a;
        background-color: #f8fafc;
        transition: all .25s ease;
    }

    .form-control-luxury:focus {
        background: #fff;
        border-color: #059669;
        box-shadow: 0 0 0 4px rgba(5,150,105,.12);
    }

    .image-preview-container {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 16px;
        text-align: center;
    }

    .btn-save-luxury {
        background: linear-gradient(135deg,#059669,#047857);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 600;
    }

    .btn-cancel-luxury {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 24px;
        color: #64748b;
        text-decoration: none;
    }
</style>

<div class="row g-4 mb-4">

    @if(isset($produk) && $produk->foto)
    <div class="col-md-6">
        <label class="form-label-luxury">Foto Saat Ini</label>

        <div class="image-preview-container">
            <img src="{{ asset('storage/'.$produk->foto) }}"
                 style="width:130px;height:130px;object-fit:cover;"
                 class="rounded shadow">
        </div>

        <div class="form-check mt-3">
            <input class="form-check-input"
                   type="checkbox"
                   name="hapus_foto"
                   value="1"
                   id="hapus_foto">

            <label class="form-check-label" for="hapus_foto">
                Hapus Foto
            </label>
        </div>

    </div>
    @endif


    <div class="{{ isset($produk) && $produk->foto ? 'col-md-6' : 'col-md-12' }}">

        <label class="form-label-luxury">
            Upload Foto
        </label>

        <div class="image-preview-container">

            <input
                type="file"
                name="foto"
                class="form-control form-control-luxury @error('foto') is-invalid @enderror"
                onchange="previewImage(this)">

            <img
                id="preview"
                style="display:none;width:120px;height:120px;object-fit:cover;margin-top:15px;"
                class="rounded shadow">

        </div>

        @error('foto')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>


<div class="mb-4">

    <label class="form-label-luxury">
        Nama Produk
    </label>

    <input
        type="text"
        name="nama"
        value="{{ old('nama',$produk->nama ?? '') }}"
        class="form-control form-control-luxury @error('nama') is-invalid @enderror">

    @error('nama')
        <div class="text-danger mt-2">
            {{ $message }}
        </div>
    @enderror

</div>


<div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label-luxury">
            Harga Beli
        </label>

        <div class="input-group">

            <span class="input-group-text">Rp</span>

            <input
                type="number"
                name="harga_beli"
                value="{{ old('harga_beli',$produk->harga_beli ?? '') }}"
                class="form-control form-control-luxury @error('harga_beli') is-invalid @enderror">

        </div>

        @error('harga_beli')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
        @enderror

    </div>


    <div class="col-md-6 mb-4">

        <label class="form-label-luxury">
            Harga Jual
        </label>

        <div class="input-group">

            <span class="input-group-text">Rp</span>

            <input
                type="number"
                name="harga_jual"
                value="{{ old('harga_jual',$produk->harga_jual ?? '') }}"
                class="form-control form-control-luxury @error('harga_jual') is-invalid @enderror">

        </div>

        @error('harga_jual')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>


<div class="mb-4">

    <label class="form-label-luxury">
        Stok
    </label>

    <input
        type="number"
        name="stok"
        value="{{ old('stok',$produk->stok ?? '') }}"
        class="form-control form-control-luxury @error('stok') is-invalid @enderror">

    @error('stok')
        <div class="text-danger mt-2">
            {{ $message }}
        </div>
    @enderror

</div>


<div class="d-flex justify-content-end gap-3 border-top pt-4">

    <a href="{{ route('produk.index') }}"
       class="btn btn-cancel-luxury">
        Batal
    </a>

    <button class="btn btn-save-luxury" type="submit">
        💾 Simpan Produk
    </button>

</div>


<script>
function previewImage(input){

    const preview=document.getElementById('preview');

    if(input.files && input.files[0]){

        preview.src=URL.createObjectURL(input.files[0]);

        preview.style.display='block';

    }

}
</script>