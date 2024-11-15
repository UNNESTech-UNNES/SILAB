<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleRequestColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('request_role', ['peminjam', 'pemilik'])->nullable();
            $table->enum('status_request', ['pending', 'disetujui', 'ditolak'])
                  ->default('pending')
                  ->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('permissions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['request_role', 'status_request']);
        });
    }
}