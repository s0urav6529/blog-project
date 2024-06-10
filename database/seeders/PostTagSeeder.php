<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 751; $i <= 778; $i++) {

            for ($j = 1; $j <= 3; $j++) {
                $data['post_id'] = $i;
                $data['tag_id'] = random_int(44, 50);

                DB::table('post_tag')->insert($data);
            }
        }
    }
}
