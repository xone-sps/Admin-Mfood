<?php

use App\models\unit;
use Illuminate\Database\Seeder;

class SeederData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        unit::create(['unit' => 'ຖ້ວຍ']);
        unit::create(['unit' => 'ຈານ']);
        unit::create(['unit' => 'ອັນ']);
        unit::create(['unit' => 'ໜ່ວຍ']);
    }
}
