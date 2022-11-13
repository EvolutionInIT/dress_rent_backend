<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dress')->insert([
//            'title'       => Str::title('Hello bro'),
//            'description' => Str::title('Who are you'),
//            'user_id'     => 1,
//            'category_id' => 1,
        ]);
    }
}
