<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert
           ([[
                'title' => 'Fjallraven',
                'image_url' => 'https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]])
    }
}    