<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckOngkirController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $title = 'Checkout Form';
        $user = User::find(auth()->user()->id);
        $provinces = Province::pluck('name', 'province_id');
        return view('pesan/konfirmasi', compact('provinces','title','user'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_ongkir(Request $request)
    {
       
        // Set default values if not provided in the request
        // $origin = $request->has('city_origin')  $request->city_origin ;
        // $weight = $request->has('weight') ? $request->weight : '100';
        // $courier = $request->has('courier') ? $request->courier : 'jne';
        $defaultCityOrigin = '62';
$defaultWeight = '100';
$defaultCourier = 'jne';

    $cost = RajaOngkir::ongkosKirim([

        'origin' => $request->city_origin ?? $defaultCityOrigin,
        'weight' => $request->weight ?? $defaultWeight,
        'courier' => $request->courier ?? $defaultCourier,
            // 'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            // 'weight'        => $request->weight, // berat barang dalam gram
            // 'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }

}
