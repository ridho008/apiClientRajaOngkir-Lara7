<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use App\Province;
class ProvinceSeeder extends Seeder
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
         ])->get('https://api.rajaongkir.com/starter/province');
         $provinces = $response['rajaongkir']['results'];

         foreach ($provinces as $province) {
            $data[] = [
               'id' => $province['province_id'],
               'province' => $province['province'],
            ];
         }

         Province::insert($data);
    }
}
