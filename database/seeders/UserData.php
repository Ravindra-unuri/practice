<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * 
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ravi',
            'email' => 'ravi@gmail.com',
            'password' => 'ravi@gmail.com',
        ]);
        User::create([
            'name' => 'Sidharth',
            'email' => 'sidharth@gmail.com',
            'password' => 'sidharth@gmail.com',
        ]);
        User::create([
            'name' => 'Abhishek',
            'email' => 'abhishek@gmail.com',
            'password' => 'abhishek@gmail.com',
        ]);
        User::create([
            'name' => 'Harsh',
            'email' => 'harsh@gmail.com',
            'password' => 'harsh@gmail.com',
        ]);
        User::create([
            'name' => 'Raghvendra',
            'email' => 'raghvendra@gmail.com',
            'password' => 'raghvendra@gmail.com',
        ]);
        User::create([
            'name' => 'Shivam',
            'email' => 'shivam@gmail.com',
            'password' => 'shivam@gmail.com',
        ]);
    }
}
