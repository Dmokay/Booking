<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_id')->nullable();
            $table->string('request_id')->nullable();
            $table->string('names')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('id_number')->nullable();
            $table->integer('status')->default(0);
            //$table->string('seat')->nullable();
            $table->timestamps();
        });

        Schema::table('bookings', function (Blueprint $table){
            $table->string('location')->nullable();
            $table->string('id_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_bookings');
        Schema::table('bookings', function (Blueprint $table){
            $table->dropColumn('location');
            $table->dropColumn('id_number');
        });
    }
}
