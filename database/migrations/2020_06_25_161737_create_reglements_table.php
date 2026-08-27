<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('locataires_id');
            $table->foreign('locataires_id')->references('id')
                ->on('locataires')
                ->onDelete('cascade')
                ->onUpdate('restrict')
            ;
            $table->unsignedBigInteger('articles_id');
            $table->foreign('articles_id')->references('id')
                ->on('articles')
                ->onDelete('restrict')
                ->onUpdate('restrict')
            ;
            $table->string('mois_paie');
            $table->double('montant');
            $table->string('transactionReference');
            $table->string('mode_reglement');
            $table->double('avance')->nullable();
            $table->double('complement')->nullable();
            $table->double('acompte')->nullable();
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
        Schema::dropIfExists('reglements');
    }
}
