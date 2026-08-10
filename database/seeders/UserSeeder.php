<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil role admin dan kasir
        $admin = Role::where('name', 'admin')->first();
        $kasir = Role::where('name', 'kasir')->first();

        // Cek apakah role tersedia
        if (!$admin || !$kasir) {
            throw new \Exception(
                'Role admin atau kasir belum tersedia. Pastikan RoleSeeder dijalankan terlebih dahulu.'
            );
        }

        // User Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => $admin->id,
        ]);

        // User Kasir
        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => $kasir->id,
        ]);
    }
}
