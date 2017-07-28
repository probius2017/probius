<?php

use Illuminate\Database\Seeder;

class TypeSinistresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_sinistre')->insert([

        	['ref' => 'BDG'],
        	['ref' => 'VOL / EFFRACTION'],
        	['ref' => 'CAT NAT'],
        	['ref' => 'RC'],
        	['ref' => 'INCENDIE'],
        	['ref' => 'DOMMAGE'],
        	['ref' => 'CORPORELS'],
        	['ref' => 'ASSISTANCE'],
            ['ref' => 'DDE'],
            ['ref' => 'DOM ELEC'],
            ['ref' => 'RAPATRIEMENT'],
            ['ref' => 'PJ']
        ]);
    }
}
