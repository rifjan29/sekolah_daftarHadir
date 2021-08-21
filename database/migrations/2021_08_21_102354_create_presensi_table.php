<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('guru_id', false, true);
            $table->bigInteger('user_id', false, true);
            $table->enum('presensi', ['Hadir', 'Absen', 'Alpa']);
            $table->longText('ket')->nullable();
            $table->timestamps();
            $table->foreign('guru_id')->references('id')->on('guru');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensi');
    }
}
