<?php

use App\Models\Buku;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Buku::class);
            $table->foreignIdFor(User::class);

            $table->date('tanggal_pinjam')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status', ['pinjam', 'kembali'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjams');
    }
};
