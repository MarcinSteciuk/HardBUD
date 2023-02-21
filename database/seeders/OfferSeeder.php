<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        Offer::truncate();
        Schema::enableForeignKeyConstraints();
        Offer::upsert(
            [
                [
                    'name' => 'Betoniarka 100 litrów',
                    'description' => 'Dane techniczne:

                    Pojemność: 100 litrów
                    Zasilanie: 230 V
                ',
                    'image' => '(1).jpg',
                    'place' => "Kraków",
                    'accommodationType' => 'osobisty',
                    'user_id' => 2,
                ],
                [
                    'name' => 'Gwoździarka',
                    'description' => 'Dane techniczne:

                    Zakres gwoździ: 50-90 mm
                    Dł. gwoździ pierścieniowych: 50-70 mm
                    Podłoże: drewno
                    Wymiary [mm]: 367 x 372 x 108
                    Typ pojemnika z gazem: GP1
                    Waga: 3.4 kg
                    Pojemność magazynku: 60 gwoździ
                    Poziom hałasu: 94 dB
                    Ilość mocowań na pojemniku gaz. :ok.1200 strzałów
                ',
                    'image' => '(2).jpg',
                    'place' => "Zakopane",
                    'accommodationType' => 'osobisty',
                    'user_id' => 2,
                ]
            ],
            'name'
        );
    }
}
