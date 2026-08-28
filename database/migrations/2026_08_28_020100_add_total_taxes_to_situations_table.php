<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalTaxesToSituationsTable extends Migration
{
    public function up()
    {
        Schema::table('situations', function (Blueprint $table) {
            $table->decimal('total_taxes', 12, 2)->default(0)->after('total_encaisse');
        });
    }

    public function down()
    {
        Schema::table('situations', function (Blueprint $table) {
            $table->dropColumn('total_taxes');
        });
    }
}
