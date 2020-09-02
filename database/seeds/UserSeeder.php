<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');


        $data = [];
        //$user= User::pluck('id')->toArray();
        for ($i = 1; $i <= 5; $i++) {
            array_push($data, [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt(123456),
                //'user_id' => $faker->randomElements($user),
            ]);
        }


        DB::table('users')->insert($data);
    }
}