@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --pos-indigo: #4f46e5;
        --pos-indigo-hover: #4338ca;
        --pos-dark: #0f172a;
        --pos-slate: #1e293b;
        --pos-border: rgba(255, 255, 255, 0.08);
    }

    body {
        background-color: #0b0f19 !important;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        color: #f1f5f9 !important;
    }

    .header-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border: 1px solid var(--pos-border);
    }

    .btn-add {
        background-color: var(--pos-indigo) !important;
        color: #ffffff !important;
        border: none !important;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-add:hover {
        background-color: var(--pos-indigo-hover) !important;
        color: #ffffff;
    }

    .card-custom {
        background: var(--pos-slate) !important;
        border-radius: 16px;
        border: 1px solid var(--pos-border) !important;
    }

    .table-custom {
        color: #e2e8f0 !important;
        vertical-align: middle;
        margin-bottom: 0;
    }

    .table-custom thead th {
        background-color: #0f172a !important;
        color: #94a3b8 !important;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        border-bottom: 1px solid var(--pos-border) !important;
    }

    .table-custom tbody tr {
        border-bottom: 1px solid var(--pos-border) !important;
        transition: background-color 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.03) !important;
    }

    .table-custom tbody td {
        padding: 14px 16px;
        font-size: 13.5px;
        border: none !important;
    }

    .badge-role {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: uppercase;
    }

    .badge-admin {
        background: rgba(79, 70, 229, 0.15) !important;
        color: #818cf8 !important;
        border: 1px solid rgba(129, 140, 248, 0.2);
    }

    .badge-kasir {
        background: rgba(34, 197, 94, 0.15) !important;
        color: #4ade80 !important;
        border: 1px solid rgba(74, 222, 128, 0.2);
    }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-action-warning {
        background: rgba(251, 191, 36, 0.1) !important;
        color: #fbbf24 !important;
        border: 1px solid rgba(251, 191, 36, 0.2) !important;
    }

    .btn-action-warning:hover {
        background: #fbbf24 !important;
        color: #0f172a !important;
    }

    .btn-action-danger {
        background: rgba(248, 113, 113, 0.1) !important;
        color: #f87171 !important;
        border: 1px solid rgba(248, 113, 113, 0.2) !important;
    }

    .btn-action-danger:hover {
        background: #f87171 !important;
        color: #ffffff !important;
    }
</style>

<div class="container-fluid py-4 px-4">

    {{-- HEADER --}}
    <div class="card header-card rounded-4 p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="fw-bold text-white mb-1">Manajemen Pengguna</h2>
                <p class="text-secondary small mb-0">Kelola data pengguna dan hak akses sistem.</p>
            </div>

            <div>
                <a href="{{ Route::has('users.create') ? route('users.create') : (Route::has('admin.users.create') ? route('admin.users.create') : url('/users/create')) }}" class="btn-add d-inline-flex align-items-center gap-2">
                    <span>+ Tambah Pengguna</span>
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 py-2 px-3 mb-4 text-white" style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(74, 222, 128, 0.3) !important;">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- DATA PENGGUNA --}}
    <div class="card card-custom p-3 p-md-4">
        <div class="table-responsive rounded-3 overflow-hidden">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="25%">Nama</th>
                        <th width="30%">Email</th>
                        <th width="20%">Role / Hak Akses</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                    <tr>
                        <td class="text-center text-secondary fw-semibold">
                            {{ method_exists($users, 'firstItem') ? $users->firstItem() + $loop->index : $loop->iteration }}
                        </td>
                        <td class="fw-semibold text-white">
                            {{ $user->name }}
                        </td>
                        <td class="text-slate-300">
                            {{ $user->email }}
                        </td>
                        <td>
                            @php
                                $roleName = $user->role->name ?? $user->role ?? 'Kasir';
                            @endphp
                            <span class="badge-role {{ strtolower($roleName) == 'admin' ? 'badge-admin' : 'badge-kasir' }}">
                                {{ strtoupper($roleName) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                {{-- EDIT --}}
                                <a href="{{ Route::has('users.edit') ? route('users.edit', $user->id) : (Route::has('admin.users.edit') ? route('admin.users.edit', $user->id) : url('/users/' . $user->id . '/edit')) }}" class="btn-action btn-action-warning" title="Edit Pengguna">
                                    ✏️
                                </a>

                                {{-- HAPUS --}}
                                <form action="{{ Route::has('users.destroy') ? route('users.destroy', $user->id) : (Route::has('admin.users.destroy') ? route('admin.users.destroy', $user->id) : url('/users/' . $user->id)) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-action-danger" title="Hapus Pengguna" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-secondary">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINASI --}}
        @if(isset($users) && method_exists($users, 'links'))
            <div class="d-flex justify-content-end mt-3">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>

@endsection