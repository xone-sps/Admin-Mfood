<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCustomerTypeToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement("ALTER TABLE `users` CHANGE `user_type` `user_type` ENUM('Admin', 'Restaurant', 'Waiter', 'Kitchen', 'Cashier', 'Customer') DEFAULT 'Admin';");
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
            DB::statement("ALTER TABLE `users` CHANGE `user_type` `user_type` ENUM('Admin', 'Restaurant', 'Waiter', 'Kitchen', 'Cashier') DEFAULT  'Admin';");
        });
    }
}
