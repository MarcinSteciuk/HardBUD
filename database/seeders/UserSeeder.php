<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
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
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::upsert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@HardBUD.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('123'),
                    'remember_token' => Str::random(10),
                    'role_id' => 1,
                ],
                [
                    'name' => 'Oferty',
                    'email' => 'oferty@HardBUD.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('123'),
                    'remember_token' => Str::random(10),
                    'role_id' => 2,
                ],
                [
                    'name' => 'Rezerwacje',
                    'email' => 'rezerwacje@HardBUD.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('123'),
                    'remember_token' => Str::random(10),
                    'role_id' => 3,
                ],
            ],
            'name'
        );
    }
}
