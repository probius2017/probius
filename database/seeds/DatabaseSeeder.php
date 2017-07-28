<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AntennesTableSeeder::class);
        $this->call(AssodepTableSeeder::class);
        $this->call(MarquesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ModelesTableSeeder::class);
        $this->call(GarantiesTableSeeder::class);
        $this->call(ContratVTableSeeder::class);
        $this->call(VehiculesTableSeeder::class);
        $this->call(BauxTableSeeder::class);
        $this->call(StructuresTableSeeder::class);
        $this->call(LocauxTableSeeder::class);
        $this->call(AlgecosTableSeeder::class);
            // pour les logements ici 
        $this->call(ContratsTableSeeder::class);
        $this->call(ChambresFroidesTableSeeder::class);
        $this->call(TypeSinistresTableSeeder::class);
        $this->call(SinistresTableSeeder::class);
        $this->call(Type_evenementsTableSeeder::class);
        $this->call(EvenementsTableSeeder::class);
        $this->call(ChampsUpdateTableSeeder::class);
        
    }
}
