<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //User::truncate();

        $user = new User([
            'email' => 'test@email.com',
            'name' => 'jean du pont',
            'password' => bcrypt('password'),
            'email_verified_at' => Carbon::now(),
        ]);
        $user->save();
        $user = new User([
            'email' => 'test1@email.com',
            'name' => 'marc dubois',
            'password' => bcrypt('password'),
            'email_verified_at' => Carbon::now(),
        ]);
        $user->save();
    }
}
