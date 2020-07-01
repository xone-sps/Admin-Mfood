<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->float('amount', 15, 2);
            $table->float('price', 15, 2);
            $table->bigInteger('product_type_id')->unsigned()->nullable();
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->bigInteger('restaurant_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_type_id')
                ->references('id')
                ->on('product_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('unit_id')
                ->references('id')
                ->on('units')
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
        Schema::table('products', function($table){
            $table->dropForeign(['product_type_id']);
            $table->dropForeign(['unit_id']);
            $table->dropForeign(['restaurant_id']);
        });
        Schema::dropIfExists('products');
    }
}
