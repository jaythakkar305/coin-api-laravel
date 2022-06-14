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
            $client = new \GuzzleHttp\Client();
            $request = $client->get(url('/api/allcoins/'.$request1->input('page', 1)));
            $response = $request->getBody()->getContents();            
            $coins = collect(json_decode($response));
            $coins = $this->paginate($coins->get('data'),10,$request1->page,$coins->get('total'));
            return view('coin.index', compact('coins'));                        
        } catch (\Exception $e) {
            // return view('error', ['error' => 'Uh oh! ' . $e->getMessage()]);
        }
    }

    public function paginate($items, $perPage = 5, $page = null, $total = 0, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $total, $perPage, $page, $options);
    }
}
