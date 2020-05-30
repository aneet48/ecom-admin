<?php

use App\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $branch = ['btech', 'bca', 'ba', 'bba'];

        for ($i = 0; $i < 50; $i++) {
            $university = University::all()->random(1)->first();
            App\User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'branch' => $branch[array_rand($branch)],
                'password' => Hash::make(Str::random(10)),
                'university_id' => $university->id,
            ]);
        }

    }
}
