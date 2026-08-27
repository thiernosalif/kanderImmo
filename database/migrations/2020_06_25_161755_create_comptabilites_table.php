<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComptabilitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptabilites', function (Blueprint $table) {
            $table->id();

            $table->double('retrait');
            $table->double('depot');
            $table->text('motif');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')
                ->on('users')
            ;
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
        Schema::dropIfExists('comptabilites');
    }
}
