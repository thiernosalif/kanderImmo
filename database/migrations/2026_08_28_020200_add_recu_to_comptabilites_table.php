<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecuToComptabilitesTable extends Migration
{
    public function up()
    {
        Schema::table('comptabilites', function (Blueprint $table) {
            $table->string('recu')->nullable()->after('motif');
        });
    }

    public function down()
    {
        Schema::table('comptabilites', function (Blueprint $table) {
            $table->dropColumn('recu');
        });
    }
}
