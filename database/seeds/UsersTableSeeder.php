<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User')->create([
            'name' => 'Gordana',
            'email' => 'g@gmail.com'
        ]);

        factory('App\User', 5)->create();
    }
}
