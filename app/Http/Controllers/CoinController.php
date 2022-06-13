<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the coinapi.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request1)
    {
        try {

            $coins = Coin::paginate(10);
            return view('coin.index', compact('coins'));
            // $showEmployeeData = DB::table('employees')->paginate(4); //Query Builder

            // $showEmployeeData = Employee::paginate(4); //Eloquent ORM

            // return view('Employee.view', compact('showEmployeeData'));
            // $client = new \GuzzleHttp\Client();
            // $request = $client->get(url('/api/coinapi'));
            // $response = $request->getBody()->getContents();
            // $response_array = json_decode($response, true);
            // if ($request->getStatusCode() != '200') {
            //     throw new \Exception($response_array['message']);
            // }            
            // $coin_data = $response_array['coindata'];
            // return view('coin', compact('coin_data'));
        } catch (\Exception $e) {
            // return view('error', ['error' => 'Uh oh! ' . $e->getMessage()]);
        }
    }
}
