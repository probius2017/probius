<?php

use Illuminate\Database\Seeder;

class EvenementsTableSeeder extends Seeder
{
    protected $faker;

    public function __construct(Faker\Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Evenement::class, 10)->create()->each(function ($event){ 

	        $typeEvt = \App\Models\TypeEvenement::create(
	        	[
	        		'event' => $this->faker->jobTitle
	        	]
	        );
            $event->typeEvenements()->attach($typeEvt);

	    
            /*$event->id%2 == 0 ? $event->contrat()->associate($contratCulture->id) : $event->contrat()->associate($contratVac->id);*/

            $event->save();

        });
    }
}
