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
                'name' => 'pendiente'
            ]
        );
        DB::table('pagos')->insert(
            [
                'name' => 'pagado'
            ]
        );
        DB::table('pagos')->insert(
            [
                'name' => 'enviado'
            ]
        );
    }
}
