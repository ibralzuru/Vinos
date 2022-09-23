<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pagos')->insert(
            [
                'name' => 'paypal'
            ]
        );
        DB::table('pagos')->insert(
            [
                'name' => 'tarjeta'
            ]
        );
        
    }
}
