<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtColumnToAdminTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return config('admin.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = [
            config('admin.database.users_table'),
            config('admin.database.roles_table'),
            config('admin.database.permissions_table'),
            config('admin.database.menu_table'),
            config('admin.database.operation_log_table'),
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->timestamp('deleted_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            config('admin.database.users_table'),
            config('admin.database.roles_table'),
            config('admin.database.permissions_table'),
            config('admin.database.menu_table'),
            config('admin.database.operation_log_table'),
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('deleted_at');
            });
        }
    }
}