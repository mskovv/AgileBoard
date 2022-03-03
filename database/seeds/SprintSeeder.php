<?php

use App\Sprint;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sprint::create([
            'sprintId' => '20-20',
            'week' => 20,
            'year' => 2020,
        ]);
    }
}
