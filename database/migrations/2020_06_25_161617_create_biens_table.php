<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proprietaires_id');
            $table->foreign('proprietaires_id')->references('id')
                ->on('proprietaires')
                ->onDelete('restrict')
                ->onUpdate('restrict')
            ;
            $table->string('description');
            $table->string('adresse');
            $table->string('type');
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
        Schema::dropIfExists('biens');
    }
}
