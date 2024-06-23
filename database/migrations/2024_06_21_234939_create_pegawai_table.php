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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 70);
            $table->string('jenis_kelamin', 10);
            $table->date('tanggal_lahir');
            $table->string('no_telepon', 20);
            $table->string('email', 70);
            $table->text('alamat');
            $table->date('tanggal_bergabung');
            $table->string('jabatan', 70);
            $table->unsignedBigInteger('gaji');
            $table->string('foto', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
