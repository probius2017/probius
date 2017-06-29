<?php

use App\Models\Bail;
use Illuminate\Database\Seeder;

class BauxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Bail::class, 10)->create();
    }
}
