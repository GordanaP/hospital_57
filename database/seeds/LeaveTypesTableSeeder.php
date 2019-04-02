<?php

use Illuminate\Database\Seeder;

class LeaveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Annual leave', 'Sick leave', 'Maternity', 'Training',
        'Bereavement', 'Family', 'Unpaid', 'Other'];

        foreach ($names as $name) {
            factory('App\LeaveType')->create([
                'name' => $name
            ]);
        }
    }
}
