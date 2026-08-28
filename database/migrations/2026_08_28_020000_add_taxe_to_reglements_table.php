<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxeToReglementsTable extends Migration
{
    public function up()
    {
        Schema::table('reglements', function (Blueprint $table) {
            $table->double('taxe')->nullable()->after('montant');
        });
    }

    public function down()
    {
        Schema::table('reglements', function (Blueprint $table) {
            $table->dropColumn('taxe');
        });
    }
}
