<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();

            $table->string('motif');
            $table->text('description');
            $table->unsignedBigInteger('locataires_id');
            $table->foreign('locataires_id')->references('id')
                ->on('locataires')
                ->onDelete('cascade')

            ;
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
        Schema::dropIfExists('reclamations');
    }
}
