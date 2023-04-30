<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        
        DB::table('users')->insert([
            'name' => 'Briedis',
            'email' => 'briedis@gmail.com',
            'role' => 1,
            'password' => Hash::make('123'),
        ]);
        foreach(range(1,20) as $_){
            DB::table('hts')->insert([
                'text' => $faker->word,
            ]);
        }
        foreach(range(1, 10) as $k => $_){
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->firstName . '@gmail.com',
                'role' => 10,
                'password' => Hash::make('123'),
            ]);
            DB::table('histories')->insert([
                'user_id' => $k + 1,
                'story' => $faker->text(150),
                'need_money' => rand(100000, 5000000) / 100,
                'is_money' => 0,
                'approved' => 0
            ]);
        }

    }
}
