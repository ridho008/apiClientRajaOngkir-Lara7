<?php

use Illuminate\Database\Seeder;
use App\City;
use Illuminate\Support\Facades\Http;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => '9000c3eb2c5a219fded1eb17cce0144f'
         ])->get('https://api.rajaongkir.com/starter/city');
         $cities = $response['rajaongkir']['results'];

         foreach ($cities as $city) {
            $data[] = [
               'id' => $city['city_id'],
               'province_id' => $city['province_id'],
               'type' => $city['type'],
               'city_name' => $city['city_name'],
               'postal_code' => $city['postal_code'],
            ];
         }

         City::insert($data);
    }
}
