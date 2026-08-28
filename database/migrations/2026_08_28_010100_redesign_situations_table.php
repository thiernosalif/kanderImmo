<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RedesignSituationsTable extends Migration
{
    public function up()
    {
        Schema::table('situations', function (Blueprint $table) {
            $table->dropForeign(['reglements_id']);
            $table->dropColumn('reglements_id');

            $table->string('mois')->after('proprietaires_id');
            $table->unsignedSmallInteger('annee')->after('mois');
            $table->decimal('total_encaisse', 12, 2)->default(0)->after('annee');
            $table->decimal('total_depenses', 12, 2)->default(0)->after('total_encaisse');
            $table->decimal('commission_taux', 5, 2)->default(9)->after('total_depenses');
            $table->decimal('commission_montant', 12, 2)->default(0)->after('commission_taux');
            $table->decimal('montant_net', 12, 2)->default(0)->after('commission_montant');
        });

        Schema::create('situation_reglement', function (Blueprint $table) {
            $table->id();
            // bigInteger (signé) : toutes les clés de ce schéma existant sont des
            // bigint signés, pas unsigned (voir reglements.id, situations.id...).
            $table->bigInteger('situations_id');
            $table->foreign('situations_id')->references('id')->on('situations')->onDelete('cascade');
            $table->bigInteger('reglements_id');
            $table->foreign('reglements_id')->references('id')->on('reglements');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('situation_reglement');

        Schema::table('situations', function (Blueprint $table) {
            $table->dropColumn([
                'mois', 'annee', 'total_encaisse', 'total_depenses',
                'commission_taux', 'commission_montant', 'montant_net',
            ]);
            $table->bigInteger('reglements_id')->nullable();
            $table->foreign('reglements_id')->references('id')->on('reglements');
        });
    }
}
