<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        // create admin
        App\User::create([
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => 'admin@admin.com',
            'phone_number' => $faker->phoneNumber,
            'branch' => 'btech',
            'password' => Hash::make('123456'),
            'university_id' => 1,
            'is_admin' => 1,
        ]);
    }
}
