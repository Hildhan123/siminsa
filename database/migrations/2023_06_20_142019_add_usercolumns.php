<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsercolumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('kelurahan', function (Blueprint $table) {
        //     $table->foreignId('user_id')->constrained()->onDelete('cascade')->default(1)->after('id');
        // });
        // Schema::table('agendas', function (Blueprint $table) {
        //     $table->foreignId('user_id')->constrained()->onDelete('cascade')->default(1)->after('id');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('kelurahan', function (Blueprint $table) {
        //     $table->dropColumn('user_id');
        // });
        // Schema::table('agendas', function (Blueprint $table) {
        //     $table->dropColumn('user_id');
        // });
    }
}
