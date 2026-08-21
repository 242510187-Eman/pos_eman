@extends('layouts.app')

@section('title', 'Manajemen Pengguna - Premium Luxury Edition')

@section('content')

@include('layouts.navbar')

{{-- Font & Icons --}}
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* =========================================
       GLOBAL & BACKGROUND STYLING
    ========================================= */
    body {
        background-color: #030712 !important;
        background-image: 
            radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.12) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.1) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(59, 130, 246, 0.15) 0px, transparent 50%) !important;
        background-attachment: fixed !important;
        color: #f3f4f6;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .user-management-container {
        position: relative;
        z-index: 5;
        animation: userFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* =========================================
       GLASS CARD & UTILITIES
    ========================================= */
    .glass-card {
        background: rgba(17, 24, 39, 0.65);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Header Styling */
    .header-tag {
        background: rgba(99, 102, 241, 0.15);
        color: #818cf8;
        border: 1px solid rgba(129, 140, 248, 0.3);
        font-weight: 600;
        font-size: 11px;
        letter-spacing: 0.5px;
    }

    .btn-add-user {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        padding: 10px 22px;
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-add-user:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(124, 58, 237, 0.5);
        color: #ffffff;
    }

    /* Alert Styling */
    .glass-alert-success {
        background: rgba(34, 197, 94, 0.12);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #4ade80;
        backdrop-filter: blur(10px);
        font-weight: 500;
    }

    /* =========================================
       TABLE STYLING
    ========================================= */
    .table-luxury {
        color: #e5e7eb !important;
        vertical-align: middle;
        margin-bottom: 0;
    }

    .table-luxury thead th {
        background: rgba(15, 23, 42, 0.8) !important;
        color: #9ca3af !important;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 16px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .table-luxury tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        transition: background 0.2s ease;
    }

    .table-luxury tbody tr:hover {
        background: rgba(255, 255, 255, 0.03) !important;
    }

    .table-luxury tbody td {
        padding: 16px 20px;
        font-size: 14px;
        border: none !important;
    }

    /* User Avatar Initial Circle */
    .user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(168, 85, 247, 0.3));
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Role Badges */
    .badge-role {
        font-size: 11px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 20px;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-admin {
        background: rgba(168, 85, 247, 0.15) !important;
        color: #c084fc !important;
        border: 1px solid rgba(168, 85, 247, 0.3);
    }

    .badge-kasir {
        background: rgba(34, 197, 94, 0.15) !important;
        color: #4ade80 !important;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    /* Glass Action Buttons */
    .btn-action-glass {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
    }

    .btn-action-edit {
        background: rgba(245, 158, 11, 0.12);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }

    .btn-action-edit:hover {
        background: rgba(245, 158, 11, 0.25);
        color: #fef08a;
        transform: translateY(-2px);
    }

    .btn-action-delete {
        background: rgba(239, 68, 68, 0.12);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }

    .btn-action-delete:hover {
        background: rgba(239, 68, 68, 0.25);
        color: #fca5a5;
        transform: translateY(-2px);
    }

    /* =========================================
       PAGINATION OVERRIDE
    ========================================= */
    .pagination .page-link {
        background: rgba(15, 23, 42, 0.6) !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
        color: #9ca3af !important;
        font-size: 12px;
        border-radius: 8px;
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
        border-color: transparent !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }

    /* Animations */
    @keyframes userFadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container-fluid px-4 py-4 user-management-container">

    {{-- HEADER BANNER --}}
    <div class="glass-card p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge header-tag px-3 py-1 rounded-pill">
                        <i class="bi bi-shield-lock me-1"></i> ACCESS CONTROL
                    </span>
                </div>
                <h2 class="fw-bold m-0 text-white" style="font-family: 'Syne', sans-serif;">Manajemen Pengguna</h2>
                <p class="text-muted mb-0 mt-1 small">Kelola data pengguna dan hak akses sistem POS secara aman.</p>
            </div>

            <div>
                <a href="{{ Route::has('users.create') ? route('users.create') : (Route::has('admin.users.create') ? route('admin.users.create') : url('/users/create')) }}" class="btn-add-user d-inline-flex align-items-center gap-2">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Tambah Pengguna</span>
                </a>
            </div>
        </div>
    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="alert glass-alert-success border-0 rounded-4 p-3 mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- TABEL DATA PENGGUNA --}}
    <div class="glass-card p-2 p-md-3">
        <div class="table-responsive rounded-4 overflow-hidden">
            <table class="table table-luxury">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="30%">Nama Pengguna</th>
                        <th width="30%">Email</th>
                        <th width="20%">Role / Hak Akses</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                    <tr>
                        <td class="text-center text-muted fw-semibold">
                            {{ method_exists($users, 'firstItem') ? $users->firstItem() + $loop->index : $loop->iteration }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-white">{{ $user->name }}</div>
                                    <small class="text-muted" style="font-size: 11px;">ID: #{{ $user->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-gray-300">
                            {{ $user->email }}
                        </td>
                        <td>
                            @php
                                $roleName = $user->role->name ?? $user->role ?? 'Kasir';
                                $isAdmin = strtolower($roleName) == 'admin';
                            @endphp
                            <span class="badge-role {{ $isAdmin ? 'badge-admin' : 'badge-kasir' }}">
                                <i class="bi {{ $isAdmin ? 'bi-shield-check' : 'bi-person-badge' }}"></i>
                                {{ strtoupper($roleName) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                {{-- EDIT --}}
                                <a href="{{ Route::has('users.edit') ? route('users.edit', $user->id) : (Route::has('admin.users.edit') ? route('admin.users.edit', $user->id) : url('/users/' . $user->id . '/edit')) }}" class="btn-action-glass btn-action-edit" title="Edit Pengguna">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>

                                {{-- HAPUS --}}
                                <form action="{{ Route::has('users.destroy') ? route('users.destroy', $user->id) : (Route::has('admin.users.destroy') ? route('admin.users.destroy', $user->id) : url('/users/' . $user->id)) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-glass btn-action-delete" title="Hapus Pengguna" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-people display-4 opacity-25 d-block mb-2"></i>
                            <span>Belum ada data pengguna yang terdaftar.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINASI --}}
        @if(isset($users) && method_exists($users, 'links') && $users->hasPages())
            <div class="d-flex justify-content-end mt-4 px-2">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>

@endsection