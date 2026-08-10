@extends('layouts.app')

@section('title', 'Edit Pengguna - ' . $user->name)

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
    <span class="text-dark">Edit Pengguna</span>
</div>

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Edit Pengguna</h2>
        <p class="text-muted mb-0">
            Perbarui informasi akun <strong>{{ $user->name }}</strong>
        </p>
    </div>

    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
        ← Kembali
    </a>
</div>

{{-- Form --}}
<div class="row">
    <div class="col-lg-8">

        <div class="border rounded-3 p-4 bg-white">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                @include('users._form')

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('admin.users') }}" class="btn btn-light border">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>

    {{-- Catatan --}}
    <div class="col-lg-4 mt-4 mt-lg-0">

        <div class="border rounded-3 p-4 bg-white">
            <h6 class="fw-bold mb-3">
                Catatan
            </h6>

            <div class="small text-muted">

                <p class="mb-3">
                    <strong>Kata sandi</strong><br>
                    Kosongkan jika tidak ingin mengubah kata sandi.
                </p>

                <p class="mb-3">
                    <strong>Email</strong><br>
                    Pastikan email baru belum digunakan akun lain.
                </p>

                <p class="mb-0">
                    <strong>Role</strong><br>
                    Perubahan role akan memengaruhi hak akses pengguna.
                </p>

            </div>
        </div>

    </div>
</div>
```

</div>

@endsection
