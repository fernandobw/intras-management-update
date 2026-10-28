<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSipgoToVdyviK2UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vdyvi_k2_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_sipgo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vdyvi_k2_users', function (Blueprint $table) {
            $table->dropColumn('id_sipgo');
        });
    }
}
