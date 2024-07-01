<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = array(
            array('id' => '1', 'name' => 'Chattagram', 'url' => 'www.chittagongdiv.gov.bd'),
            array('id' => '2', 'name' => 'Rajshahi', 'url' => 'www.rajshahidiv.gov.bd'),
            array('id' => '3', 'name' => 'Khulna', 'url' => 'www.khulnadiv.gov.bd'),
            array('id' => '4', 'name' => 'Barisal', 'url' => 'www.barisaldiv.gov.bd'),
            array('id' => '5', 'name' => 'Sylhet', 'url' => 'www.sylhetdiv.gov.bd'),
            array('id' => '6', 'name' => 'Dhaka', 'url' => 'www.dhakadiv.gov.bd'),
            array('id' => '7', 'name' => 'Rangpur', 'url' => 'www.rangpurdiv.gov.bd'),
            array('id' => '8', 'name' => 'Mymensingh', 'url' => 'www.mymensinghdiv.gov.bd')
        );

        DB::table('divisions')->insert($divisions);
    }
}
