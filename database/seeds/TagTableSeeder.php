<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $tag = new Tag([
            'name' => '100m campus',
            'description' => 'Situé à 100m du Campus'
        ]);

        $tag->save(); 

        $tag = new Tag([
            'name' => 'très distant du campus',
            'description' => 'Situé à une grande distance par rapport au campus'
        ]);

        $tag->save(); 

        $tag = new Tag([
            'name' => 'très distant du marhcé',
            'description' => 'Situé à une grande distance par rapport au marché'
        ]);

        $tag->save(); 

        $tag = new Tag([
            'name' => 'piscine',
            'description' => 'Cité avec piscine'
        ]);

        $tag->save(); 
        $tag = new Tag([
            'name' => 'cuisine',
            'description' => 'Chambre avec cuisine'
        ]);

        $tag->save(); 
        
        $tag = new Tag([
            'name' => 'carreaux',
            'description' => 'Chambre avec carreaux'
        ]);

        $tag->save(); 
        $tag = new Tag([
            'name' => 'balcon',
            'description' => 'Chambre avec balcon'
        ]);

        $tag->save(); 
        $tag = new Tag([
            'name' => 'Douche interne',
            'description' => 'Chambre avec douche interne'
        ]);

        $tag->save(); 
        $tag = new Tag([
            'name' => 'compteur',
            'description' => 'Compteur individuel'
        ]);

        $tag->save(); 
        $tag = new Tag([
            'name' => 'étage',
            'description' => 'cité en étage'
        ]);

        $tag->save(); 

       
        
    }
}
