<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_outlet')->references('id')->on('outlets')->onDelete('cascade');
            $table->string('kode_invoice')->unique();
            $table->foreignId('id_member')->references('id')->on('members')->onDelete('cascade');
            $table->string('tanggal');
            $table->string('batas_waktu')->nullable();
            $table->string('tanggal_bayar')->nullable();
            $table->integer('biaya_tambahan')->nullable();
            $table->bigInteger('total_harga')->nullable();
            $table->double('diskon')->nullable();
            $table->integer('pajak')->nullable();
            $table->enum('status',['baru','proses','selesai','diambil']);
            $table->enum('dibayar',['dibayar','belum']);
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
