<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carinfo', function (Blueprint $table) {
            $table->integer('inquiry_id')->unsigned()->nullable();
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
            $table->integer('gear')->default(0);
            $table->integer('transmission')->default(0);
            $table->integer('engine')->default(0);
            $table->integer('rudder')->default(0);
            $table->integer('color')->default(0);
            $table->integer('capacity_from')->default(0);
            $table->integer('capacity_to')->default(0);
            $table->integer('state')->default(0);
            $table->integer('owners')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carinfo');
    }
}
