<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biens_id');
            $table->foreign('biens_id')->references('id')
                ->on('biens')
            ;
            $table->unsignedBigInteger('locataires_id');
            $table->foreign('locataires_id')->references('id')
                ->on('locataires')
                ->onDelete('cascade')
                ->onUpdate('restrict')
            ;
            $table->text('structure_ar');
            $table->boolean('disponibilite');
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
        Schema::dropIfExists('articles');
    }
}
