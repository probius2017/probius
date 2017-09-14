<?php

use Illuminate\Database\Seeder;

class EvenementsTableSeeder extends Seeder
{
    /*protected $faker;

    public function __construct(Faker\Generator $faker)
    {
        $this->faker = $faker;
    }*/

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Evenement::class, 10)->create();
    }
}
