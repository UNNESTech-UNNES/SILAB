<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropUnique('barangs_kondisi_barang_unique');
        });
    }

    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->unique('kondisi_barang');
        });
    }
};
