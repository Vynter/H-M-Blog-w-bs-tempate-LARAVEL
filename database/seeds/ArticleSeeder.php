<?php

use App\User;



use Faker\Factory;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('fr_FR');


        $data = [];

        $users = User::pluck('id')->toArray();

        for ($i = 1; $i <= 100; $i++) {

            //vu que le slug c'est le meme que le titire donc on fait ce qui suit
            $title = $faker->sentence(rand(6, 10));

            array_push($data, [
                'title' => $title,
                'sub_title' => $faker->sentence(rand(10, 15)),
                'slug' => Str::slug($title),
                'body' => $faker->realText(4000),
                'published_at' => $faker->dateTime(),
                'user_id' => $faker->randomElement($users)
            ]);
        }


        DB::table('articles')->insert($data);
    }
}