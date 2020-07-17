<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatabaseUpdateV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table){
           $table->bigInteger('upper_deck')->default(0);
           $table->bigInteger('lower_deck')->default(0);
        });
        Schema::table('bookings', function (Blueprint $table){
            $table->string('deck', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table){
            $table->dropColumn('upper_deck');
            $table->dropColumn('lower_deck');
        });
        Schema::table('bookings', function (Blueprint $table){
            $table->dropColumn('deck');
        });
    }
}
