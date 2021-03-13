<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\City;
use App\Province;
class GetApiController extends Controller
{
   public function index(Request $request)
   {
      if($request->origin && $request->destination && $request->weight && $request->courier) {
         $origin = $request->origin;
         $destination = $request->destination;
         $weight = $request->weight;
         $courier = $request->courier;

         $response = Http::asForm()->withHeaders([
            'key' => '9000c3eb2c5a219fded1eb17cce0144f'
         ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
         ]);
         $cekOngkir = $response['rajaongkir']['results'][0]['costs'];
      } else {
         $origin = '';
         $destination = '';
         $weight = '';
         $courier = '';
         $cekOngkir = null;
      }
      
      $province = Province::all();
      return view('ongkir', compact('province', 'cekOngkir'));
   }

   public function ajax($id)
   {
      $cities = City::where('province_id', $id)->pluck('city_name', 'id');
      return json_encode($cities);
   }
}
