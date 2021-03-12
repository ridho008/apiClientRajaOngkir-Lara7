<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class GetApiController extends Controller
{
   public function index()
   {
      $response = Http::withHeaders([
         'key' => '9000c3eb2c5a219fded1eb17cce0144f'
      ])->get('https://api.rajaongkir.com/starter/city');
      return $response['rajaongkir']['results'];
   }
}
