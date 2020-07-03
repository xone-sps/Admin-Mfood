<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('queue_number')->nullable();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('queue_numbers', function($table){
            $table->dropForeign(['order_id']);
        });
        Schema::dropIfExists('queue_numbers');
    }
}
