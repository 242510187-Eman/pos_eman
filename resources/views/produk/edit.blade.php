@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --primary-color: #059669;
        --primary-dark: #047857;
        --primary-light: #ecfdf5;
        --text-main: #0f172a;
        --text-muted: #64748b;
        --radius-card: 24px;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Poppins', sans-serif;
    }

    .page-header-wrapper {
        max-width: 900px;
        margin: 0 auto 24px;
    }

    .btn-back-modern {
        background: #fff;
        border: 1px solid #e2e8f0;
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: .25s ease;
    }

    .btn-back-modern:hover {
        background: var(--primary-light);
        color: var(--primary-dark);
        transform: translateY(-1px);
    }

    .page-title {
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -.7px;
        color: var(--text-main);
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 14px;
    }

    .page-card-luxury {
        background: #fff;
        max-width: 900px;
        margin: auto;
        padding: 40px;
        border-radius: var(--radius-card);
        position: relative;
        overflow: hidden;
        box-shadow:
            0 20px 40px -15px rgba(15,23,42,.05),
            0 0 0 1px rgba(226,232,240,.8);
    }

    .page-card-luxury::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(
            90deg,
            #059669,
            #34d399,
            #059669
        );
    }
</style>


<div class="container-fluid py-4 px-4">

    {{-- Header --}}
    <div class="page-header-wrapper">

        <a href="{{ route('produk.index') }}" class="btn-back-modern mb-3">
            ← Kembali ke Daftar Produk
        </a>

        <h1 class="page-title mb-1">
            ✏️ Edit Data Produk
        </h1>

        <p class="page-subtitle">
            Perbarui spesifikasi, harga, dan manajemen inventaris produk.
        </p>

    </div>


    {{-- Form Edit Produk --}}
    <div class="page-card-luxury">

        <form 
            action="{{ route('produk.update', $produk->id) }}" 
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            @include('Produk._form')

        </form>

    </div>

</div>


@endsection