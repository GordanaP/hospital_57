<?php

use App\Services\Utilities\Day;
use Illuminate\Database\Seeder;

class WorkingDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Day::all() as $key => $value) {
            factory('App\WorkingDay')->create([
                'index' => $key,
                'name' => $value,
            ]);
        }
    }
}
