<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = $this->command->getOutput()->ask('How many users you want to seed?', 100);
        $password = $this->command->getOutput()->ask('Whitch password you want yo add','12345678');

        $faker = Factory::create();
        $this->command->getOutput()->progressStart($amount);

        for( $i = 0; $i < $amount; $i++ )
        {
            User::create([
                'name' =>  $faker->name,
                'email' => $faker->email,
                'password' => Hash::make($password)
            ]);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }

}
