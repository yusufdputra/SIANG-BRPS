<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpKeberangkatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('op_keberangkatans', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('id_kendaraan');
            $table->date('tanggal');
            $table->enum('status', ['N','Y']);
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
        Schema::dropIfExists('op_keberangkatans');
    }
}
