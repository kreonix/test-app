<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('products')->insert([
            'name' => str_random(10),
            'price' => mt_rand(1,10000),
            'rating' => mt_rand(1,10),
        ]);
    }
}
