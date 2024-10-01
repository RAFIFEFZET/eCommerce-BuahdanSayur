<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Carts;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data provinsi dari RajaOngkir
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_BASE_URL') . '/province');

        $provinces = $response['rajaongkir']['results'];

        // Mengambil data keranjang berdasarkan customer yang login
        $customer = Auth::guard('web')->user();
        $cartItems = $customer ? Carts::where('customer_id', $customer->id)->with('product')->get() : collect();

        return view('checkout.index', compact('cartItems', 'customer', 'provinces'));
    }

    public function getCity(Request $request)
    {
        $provinceId = $request->province_id;

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_BASE_URL') . '/city', [
            'province' => $provinceId
        ]);

        if ($response->successful()) {
            $cities = $response['rajaongkir']['results'];
            return response()->json($cities);
        } else {
            return response()->json(['error' => 'Failed to fetch cities'], 500);
        }
    }

    public function getShippingCost(Request $request)
    {
        $cityId = $request->city_id;
        $weight = 1000; // Berat dalam gram
        $courier = 'jne'; // Kurir yang digunakan (jne, pos, tiki, etc.)

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->post(env('RAJAONGKIR_BASE_URL') . '/cost', [
            'origin' => 23, // ID kota asal
            'destination' => $cityId,
            'weight' => $weight,
            'courier' => $courier
        ]);

        if ($response->successful()) {
            $costs = $response['rajaongkir']['results'][0]['costs'];
            return response()->json($costs);
        } else {
            return response()->json(['error' => 'Failed to fetch shipping cost'], 500);
        }
    }
}
