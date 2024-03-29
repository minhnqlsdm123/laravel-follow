<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::create();

        $limit=10;
        for ($i=0;$i<$limit;$i++){
            DB::table('posts')->insert([
               'name'=>$faker->name,
                'description'=>$faker->unique()->word,
                'content'=>$faker->sentence
            ]);
        }
    }
}
