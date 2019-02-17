<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * The tables that should be seeded.
     *
     * @var array
     */
    protected $tables = [
        'users', 'doctors', 'patients', 'working_days', 'absences', 'appointments'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        $this->call(UsersTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(WorkingDaysTableSeeder::class);
        $this->call(AbsencesTableSeeder::class);
        $this->call(AppointmentsTableSeeder::class);
    }

    /**
     * Truncate the tables.
     *
     * @return void
     */
    protected function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table)
        {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
