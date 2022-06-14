<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


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
            // $coins = Coin::paginate($request1->all());
            // dd($coins);
            
            $client = new \GuzzleHttp\Client();
            $request = $client->get(url('/api/allcoins/'.$request1->input('page', 1)));
            $response = $request->getBody()->getContents();            
            $coins = collect(json_decode($response));
            dd($coins);
            $coins = $this->paginate($coins->get('data'),10,$request1->page);
            
            //$coins = Paginator::make($coins, count($coins), 10);
            return view('coin.index', compact('coins'));
            
            
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

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
