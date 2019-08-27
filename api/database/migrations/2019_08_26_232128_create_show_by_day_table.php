<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowByDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_by_day', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('show_date');
            $table->smallInteger('capacity');
            $table->smallInteger('tickets_available');
            $table->smallInteger('discount_percentage');
            $table->bigInteger('show_id')->unsigned();
            
            $table->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show_by_day');
    }
}
