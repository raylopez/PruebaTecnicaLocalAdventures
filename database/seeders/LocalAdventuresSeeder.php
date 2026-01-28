<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalAdventuresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Company
       $company = DB::table('companies')->insert([
            'name' => 'Local Adventures',
            'email' => 'contact@localadventures',
            'address' => 'Avenida la independencia',
            'state' => 'Jalisco',
            'city' => 'Guadalajara',
            'country' => 'Mexico',
            'zip_code' => '21221',
            'phone' => '1346543123',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //Client
        DB::table('clients')->insert([
            'first_name' => 'Eric',
            'last_name' => 'Lopez',
            'email' => 'eric.lopez@gmail.com',
            'address' => 'Calle 71 B',
            'city' => 'Mérida',
            'state' => 'Yucatan',
            'country' => 'Mexico',
            'zip_code' => '20100',
            'phone' => '9999999999',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'company_id' => 1
        ]);
    }
}
