<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('means_of_id')->nullable();
            $table->string('id_key')->nullable();
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
            $table->dropColumn('dob');
            $table->dropColumn('address');
            $table->dropColumn('means_of_id');
            $table->dropColumn('id_key');
        });
    }
}
