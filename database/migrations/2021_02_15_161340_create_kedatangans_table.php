<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKedatangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kedatangans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('jam');
            $table->date('tanggal');
            $table->integer('id_kendaraan');
            $table->string('tujuan');
            $table->integer('penumpang');
            $table->softDeletes();
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
        Schema::dropIfExists('kedatangans');
    }
}
