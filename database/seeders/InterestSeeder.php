<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Interest;
use App\Models\PersonalDetails;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class InterestSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            'Gardening','Animals','Children','Sport','Fishing','Coding','Chess','Concerts','Cosplay','Crafts','Climbing',
            'Debate','Diving','Farming','Film'
        ];

        $people = PersonalDetails::all();

        foreach ($people as $person){
            $num_of_interest = rand(3,12);
            $randomInterests = Arr::random($interests, $num_of_interest);

            foreach ($randomInterests as $interest)
            {
                $stored_interest = Interest::create([
                    'name'=>$interest,
                    'user_id'=>$person->id
                ]);

                $num_of_docs = rand(0,3);

                if($interest == 'Gardening' || $interest == 'Animals' ||$interest == 'Children'){
                    for ($x = 0; $x <= $num_of_docs; $x++) {
                        Document::create([
                            'path'=>$this->faker->filePath(),
                            'interest_id'=>$stored_interest->id
                        ]);
                    }
                }

            }
        }
    }
}
