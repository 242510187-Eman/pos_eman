<?php

namespace App\Policies;

use App\Models\Produk;
use App\Models\User;

class ProdukPolicy
{
    /**
     * Izinkan user yang sudah login untuk melihat daftar produk
     */
    public function viewAny(User $user): bool
    {
        return true; // Mengizinkan semua user yang terotentikasi
    }

    /**
     * Izinkan melihat detail produk
     */
    public function view(User $user, Produk $produk): bool
    {
        return true;
    }

    /**
     * Izinkan membuat produk
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Izinkan mengedit produk
     */
    public function update(User $user, Produk $produk): bool
    {
        return true;
    }

    /**
     * Izinkan menghapus produk
     */
    public function delete(User $user, Produk $produk): bool
    {
        return true;
    }
}