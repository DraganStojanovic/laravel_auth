<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = $this->command->getOutput()->ask('Enter your email address');

        if ($email === null)
        {
            $this->command->getOutput()->error('Please enter a valid email address');
            return; // Stoping code to continue
        }

        $password = $this->command->getOutput()->ask('Enter your password');

        if ($password === null)
        {
            $this->command->getOutput()->error('Please enter a valid password');
            return; // Stoping code to continue
        }

        $username = $this->command->getOutput()->ask('Enter your username');;

        if ($username === null)
        {
            $this->command->getOutput()->error('Please enter user name');
            return; // Stoping code to continue
        }

        $user = User::where(['email' => $email])->first();
        if($user instanceof User)
        {
            $this->command->getOutput()->error('User already exists');
            return; // Stoping code to continue
        }

        User::create([
            'email' => $email,
            'name' =>  $username,
            'password' => Hash::make($password)
        ]);
    }
}
