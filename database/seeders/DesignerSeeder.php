<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('designers')->insert([
            ['designer' => 'A.L.C', 'created_at' => Carbon::now()],
            ['designer' => 'Adrianna Papell', 'created_at' => Carbon::now()],
            ['designer' => 'Dear Frances', 'created_at' => Carbon::now()],
            ['designer' => 'Exhibit', 'created_at' => Carbon::now()],
            ['designer' => 'Friederich Herman', 'created_at' => Carbon::now()]
        ]);
    }
}
