<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'title' => 'ペスト',
            'price' => 400,
            'image' => 'public/images/X81Gu6IxVr4C0ZTBsKfGRlk9mddfGslFBVB6JJPQ.jpeg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        DB::table('products')->insert($param);

        $param = [
            'title' => '堕落論',
            'price' => 300,
            'image' => 'public/images/uoKsz7DTc134xGHkBtR73ubdCLuFGBEu9ctW7uT7.jpeg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        DB::table('products')->insert($param);
    }
}
