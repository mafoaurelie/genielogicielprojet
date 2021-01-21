<?php

use App\Tag;
use App\City;
use App\CityTags;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $city = new City([
        //     'name' => 'Cité des anges',
        //     'owner_id' => 1,
        //     'localisation' => 'Rue de la joie',
        //     'nbr_rooms' => 22,
        //     'description' => 'L\'enfer c\'est ici ',
        //     'nbr_free_rooms' => 12, 
        //     'price_per_rooms' => 2500000, 
        // ]);
        // $city->save(); 

        // $city = new City([
        //     'name' => 'Wamba',
        //     'owner_id' => 1,
        //     'localisation' => 'Entree Campus',
        //     'nbr_rooms' => 50,
        //     'description' => 'Cité des sorciers mais il y fait bon vivre',
        //     'nbr_free_rooms' => 10, 
        //     'price_per_rooms' => 300000, 
        // ]);

        // $city->save(); 
        
        // $city = new City([
        //     'name' => 'Tala',
        //     'owner_id' => 1,
        //     'localisation' => 'Sonel',
        //     'description' => 'Cité maudite située après la sonel',
        //     'nbr_rooms' => 10, 
        //     'nbr_free_rooms' => 3, 
        //     'price_per_rooms' => 150000, 
        // ]);

        // $city->save(); 

        //$this->bindTags();
    }

    public function bindTags(){

        $tags = Tag::all()->toArray();


        $rand = rand( 0,100);
        $i = 0;
    

        $cityTags = new CityTags();

        while( $i < 5 ){
            
            $cityTags->city_id = 3;
            $cityTags->tag_id = $tags[$i]['id'];
            $cityTags->save();
            $i++;   

        }

    }
}
