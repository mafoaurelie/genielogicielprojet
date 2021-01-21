<?php

use App\File;
use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $file = new File([
            'city_id' => 1,
            'path' => 'storage/images/1/01.jpg',
            'description' => 'This is a short description'
        ]);

        $file->save();
        $file = new File([
            'city_id' => 1,
            'path' => 'storage/images/1/02.jpg',
            'description' => 'This is a short description'
        ]);

        $file->save();

        $file = new File([
            'city_id' => 2,
            'path' => 'storage/images/2/01.jpg',
            'description' => 'This is a short description'
        ]);

        $file->save();

        $file = new File([
            'city_id' => 3,
            'path' => 'storage/images/3/01.jpg',
            'description' => 'This is a short description'
        ]);

        $file->save();
        $file = new File([
            'city_id' => 3,
            'path' => 'storage/images/3/02.jpg',
            'description' => 'This is a short description'
        ]);

        $file->save();
    }
}
