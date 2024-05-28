<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TypeAndGenre extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            [
                "id"=>1,
                "genre_name"=>"Action"
            ],
            [
                "id"=>2,
                "genre_name"=>"Fantasy"
            ],
            [
                "id"=>3,
                "genre_name"=>"Romance"
            ],
            [
                "id"=>4,
                "genre_name"=>"Mystery"
            ],
            [
                "id"=>5,
                "genre_name"=>"History"
            ]
        ]);
        DB::table('types')->insert([
            [
                "id"=>1,
                "type_name"=>"Light novel"
            ],
            [
                "id"=>2,
                "type_name"=>"Comic"
            ],
            [
                "id"=>3,
                "type_name"=>"Novel"
            ],
            [
                "id"=>4,
                "type_name"=>"Journal"
            ]
            ]);
    }
}
