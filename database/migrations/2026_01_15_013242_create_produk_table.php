<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('foto')->nullable(); // Menambahkan nullable()
            $table->string('nama');
            $table->decimal('harga_beli', 12, 2); // Disarankan menggunakan decimal untuk nilai uang
            $table->decimal('harga_jual', 12, 2); 
            $table->integer('stok');
            $table->index('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};