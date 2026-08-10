@extends('layouts.app')

@section('title', 'Tambah Pengguna Baru')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

```
{{-- Breadcrumb --}}
<div class="mb-4">
    <a href="{{ route('admin.users') }}" class="text-decoration-none text-secondary">
        Pengelolaan Pengguna
    </a>
    <span class="mx-2 text-muted">/</span>
    <span class="text-dark">Tambah Pengguna</span>
</div>

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Tambah Pengguna Baru</h2>
        <p class="text-muted mb-0">
            Daftarkan akun baru dan tentukan hak akses pengguna.
        </p>
    </div>

    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
        ← Kembali
    </a>
</div>

{{-- Content --}}
<div class="row">

    {{-- Form --}}
    <div class="col-lg-8">

        <div class="border rounded-3 p-4 bg-white">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                @include('users._form')

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">

                    <a href="{{ route('admin.users') }}"
                       class="btn btn-light border">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Pengguna
                    </button>

                </div>
            </form>
        </div>

    </div>

    {{-- Panduan --}}
    <div class="col-lg-4 mt-4 mt-lg-0">

        <div class="border rounded-3 p-4 bg-white">

            <h6 class="fw-bold mb-3">
                Panduan Pendaftaran
            </h6>

            <div class="small text-muted">

                <p class="mb-3">
                    <strong>Email</strong><br>
                    Gunakan alamat email yang aktif dan belum digunakan
                    oleh akun lain.
                </p>

                <p class="mb-3">
                    <strong>Kata sandi</strong><br>
                    Gunakan kata sandi minimal 8 karakter.
                </p>

                <p class="mb-0">
                    <strong>Role</strong><br>
                    Pilih role sesuai kebutuhan pengguna, seperti Admin
                    atau Kasir.
                </p>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection
