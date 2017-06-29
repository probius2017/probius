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

        	['reference' => 'VOl'],
        	['reference' => 'BDG / EFFRACTION'],
        	['reference' => 'CAT NAT'],
        	['reference' => 'RC'],
        	['reference' => 'INCENDIE'],
        	['reference' => 'DOMMAGE'],
        	['reference' => 'CORPORELS'],
        	['reference' => 'ASSISTANCE'],
            ['reference' => 'DDE'],
            ['reference' => 'DOM ELEC'],
            ['reference' => 'RAPATRIEMENT'],
            ['reference' => 'PJ']
        ]);
    }
}
