<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Fuvarozo;
use App\Models\Jarmu;
use App\Models\Munka;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin
        $admin = Fuvarozo::create([
            'nev' => 'Admin User',
            'email' => 'admin@fuvarozo.hu',
            'jelszo' => Hash::make('password'),
        ]);

        // Create drivers
        $driver1 = Fuvarozo::create([
            'nev' => 'Kovács János',
            'email' => 'kovacs@fuvarozo.hu',
            'jelszo' => Hash::make('password'),
        ]);

        $driver2 = Fuvarozo::create([
            'nev' => 'Nagy Péter',
            'email' => 'nagy@fuvarozo.hu',
            'jelszo' => Hash::make('password'),
        ]);

        // Create vehicles
        Jarmu::create([
            'marka' => 'Mercedes',
            'tipus' => 'Sprinter',
            'rendszam' => 'ABC-123',
            'fuvarozo_id' => $driver1->id,
        ]);

        Jarmu::create([
            'marka' => 'Ford',
            'tipus' => 'Transit',
            'rendszam' => 'XYZ-789',
            'fuvarozo_id' => $driver2->id,
        ]);

        // Create jobs
        Munka::create([
            'indulas' => 'Budapest, Váci út 1.',
            'erkezes' => 'Debrecen, Piac utca 15.',
            'cimzett_neve' => 'Szabó István',
            'cimzett_telefonszama' => '+36301234567',
            'status' => 'kiosztva',
            'fuvarozo_id' => $driver1->id,
        ]);

        Munka::create([
            'indulas' => 'Szeged, Kossuth tér 2.',
            'erkezes' => 'Pécs, Rákóczi út 10.',
            'cimzett_neve' => 'Kiss Anna',
            'cimzett_telefonszama' => '+36307654321',
            'status' => 'folyamatban',
            'fuvarozo_id' => $driver2->id,
        ]);

        Munka::create([
            'indulas' => 'Győr, Aradi utca 5.',
            'erkezes' => 'Sopron, Fő tér 8.',
            'cimzett_neve' => 'Tóth Gábor',
            'cimzett_telefonszama' => '+36209876543',
            'status' => 'kiosztva',
            'fuvarozo_id' => null, // Unassigned
        ]);
    }
}