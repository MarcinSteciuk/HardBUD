<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Room;
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
        Room::truncate();
        Offer::truncate();
        Schema::enableForeignKeyConstraints();
        Offer::upsert(
            [
                [
                    'name' => 'BETONIARKA MIESZALNIK RIWALL PRO 220L 1500W 230V',
                    'description' => 'ETONIARKA ŻELIWNA MODEL JS200 200l POJEMNOŚCI ZASYPOWEJ, 220L POJEMNOŚCI CAŁKOWITEJ. NAJMOCNIEJSZA - 1500W 230V MIESZALNIK PRO CZESKIEJ MARKI RIWALL',
                    'image' => 'betoniarka.jpg',
                    'place' => "Kraków",
                    'picup' => 'Osobisty',
                    'user_id' => 2,
                ],
                [
                    'name' => 'Domek nad jeziorem',
                    'description' => 'Niesamowity domek nad jeziorem. Super widok z każdego balkonu. Do okoła znajduje się wiele szlaków turystycznych oraz zabytków. Pełne wyposażenie.',
                    'image' => '(2).jpg',
                    'place' => "Zakopane",
                    'accommodationType' => 'Kwatera prywata',
                    'user_id' => 2,
                ]
            ],
            'name'
        );
    }
}
