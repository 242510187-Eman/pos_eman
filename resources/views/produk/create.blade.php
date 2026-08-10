@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --primary-color: #059669;
        --primary-dark: #047857;
        --primary-light: #ecfdf5;
        --text-main: #0f172a;
        --text-muted: #64748b;
        --radius-card: 20px;
        --radius-element: 12px;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Poppins', sans-serif;
    }

    .page-title {
        color: var(--text-main);
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 500;
    }

    .page-card {
        background: #ffffff;
        border-radius: var(--radius-card);
        padding: 32px;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04), 0 5px 15px -5px rgba(0, 0, 0, 0.02);
        border: 1px solid #f1f5f9;
    }

    .btn-back {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: var(--text-main);
        border-radius: var(--radius-element);
        font-weight: 600;
        padding: 10px 16px;
        font-size: 14px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: var(--primary-dark);
        transform: translateY(-1px);
    }
</style>

<div class="container-fluid py-4 px-4">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="page-title mb-1">📦 Tambah Produk Baru</h1>
            <p class="page-subtitle mb-0">Lengkapi formulir di bawah ini untuk mendaftarkan inventaris produk baru ke sistem POS</p>
        </div>

        <a href="{{ route('produk.index') }}" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Daftar Produk
        </a>
    </div>

    <!-- Main Card Form -->
    <div class="page-card">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('Produk._form')
        </form>
    </div>
</div>

@endsection