<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->float('total', 15, 2);
            $table->bigInteger('cashier_id')->unsigned()->nullable();
            $table->bigInteger('restaurant_id')->unsigned()->nullable();
            $table->enum('status_payment', ['pending', 'success', 'reject'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cashier_id')
                ->references('id')
                ->on('cashiers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
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
        Schema::table('orders', function($table){
            $table->dropForeign(['cashier_id']);
            $table->dropForeign(['restaurant_id']);
        });
        Schema::dropIfExists('orders');
    }
}
