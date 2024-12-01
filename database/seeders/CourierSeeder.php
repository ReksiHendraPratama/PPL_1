<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couriers = [
            ['code' => 'jne', 'name' => 'JNE (Jalur Nugraha Ekakurir)', 'unique_code' => 'JNE'],
            ['code' => 'tiki', 'name' => 'TIKI (Titipan Kilat)', 'unique_code' => 'TIK'],
            ['code' => 'pos', 'name' => 'POS Indonesia', 'unique_code' => 'POS'],
        ];

        DB::table('couriers')->insert($couriers);
    }
}
