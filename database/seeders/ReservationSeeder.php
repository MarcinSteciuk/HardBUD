<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Reservation::truncate();
        Schema::enableForeignKeyConstraints();

        Reservation::upsert(
            [
                [
                    'date_from' => '2022-08-09',
                    'date_to' => '2022-08-18',
                    'equipment_id' => 1,
                    'user_id' => 3,
                    'price' => 2000,
                ],
            ],
            'date_form'
        );
    }
}
