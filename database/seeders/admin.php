<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        'Bagumbayan',
        'Bambang',
        'Calzada',
        'Central Bicutan',
        'Central Signal Village',
        'Fort Bonifacio',
        'Hagonoy',
        'Ibayo-Tipas',
        'Katuparan',
        'Ligid-Tipas',
        'Lower Bicutan',
        'Maharlika Village',
        'Napindan',
        'New Lower Bicutan',
        'North Daang Hari',
        'North Signal Village',
        'Palingon',
        'Pinagsama',
        'San Miguel',
        'Santa Ana',
        'South Daang Hari',
        'South Signal Village',
        'Tanyag',
        'Tuktukan',
        'Upper Bicutan',
        'Ususan',
        'Wawa',
        'Western Bicutan',
        ];
               
        foreach ($data as $key => $value) {
            $zname_clean = preg_replace('/\s*/', '', $value);
            $brgy = strtolower($zname_clean);
            User::create([
            'name' => 'brgy',
            'email' => $brgy.'@taguig.gov.ph',
            'password' => Hash::make("admin"),
            'type' => 'brgy',
            'assigned' => $value,
        ]);

        }

        User::create([
            'name' => 'admin',
            'email' => 'admin@taguig.gov.ph',
            'password' => Hash::make("admin"),
            'type' => 'admin',
            'assigned' => 'admin',
        ]);

    }
}
