<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\HospitalFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Bobo',
            'email' => 'bobo.admin@gmail.com',
            'password' => '$2y$12$5x1EFgPdw6HuuqTdcARqYuApneUizEo4PtaW9uhzTNUC.1VSbuyeW',
            'is_admin' => true,
        ]);

        Hospital::factory(30)->create();
        User::factory(10)->create();
        Doctor::factory(30)->create();
        Appointment::factory(30)->create();
    }
}
