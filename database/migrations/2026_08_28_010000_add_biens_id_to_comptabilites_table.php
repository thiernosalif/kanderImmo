<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiensIdToComptabilitesTable extends Migration
{
    public function up()
    {
        Schema::table('comptabilites', function (Blueprint $table) {
            // bigInteger (signé), pas unsignedBigInteger : biens.id est un bigint signé
            // dans ce schéma existant (voir articles.biens_id qui référence déjà biens.id
            // avec succès) — un type unsigned casse la création de la clé étrangère (errno 150).
            $table->bigInteger('biens_id')->nullable()->after('users_id');
            $table->foreign('biens_id')->references('id')->on('biens');
        });
    }

    public function down()
    {
        Schema::table('comptabilites', function (Blueprint $table) {
            $table->dropForeign(['biens_id']);
            $table->dropColumn('biens_id');
        });
    }
}
