<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            [
                'name' => 'AUCTION_OPEN_DATA',
                'param' => '05.08.2019 08:00:00',
            ],
            [
                'name' => 'AUCTION_CLOSED_DATA',
                'param' => '09.08.2019 16:00:00',
            ],
            [
                'name' => 'TIME_CONFIRMATION',
                'param' => '1',
            ]
        ]);
    }
}
