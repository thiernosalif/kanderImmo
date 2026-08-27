<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('numero')->unique();
            $table->unsignedBigInteger('proprietaires_id');
            $table->foreign('proprietaires_id')->references('id')
                ->on('proprietaires')
            ;
            $table->unsignedBigInteger('reglements_id');
            $table->foreign('reglements_id')->references('id')
                ->on('reglements')
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
        Schema::dropIfExists('factures');
    }
}
