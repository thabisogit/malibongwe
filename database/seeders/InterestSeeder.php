<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\PersonalDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            'Gardening','Animals','Children','Sport','Fishing','Coding','Chess','Concerts','Cosplay','Crafts','Climbing',
            'Debate','Diving','Farming','Film'
        ];

        foreach ($interests as $interest)
        {
            Interest::create([
                'Description'=>$interest
            ]);
        }

        $people = PersonalDetails::all();

        foreach ($people as $person){
//            PersonalDetails::update('in')
        }
    }
}
