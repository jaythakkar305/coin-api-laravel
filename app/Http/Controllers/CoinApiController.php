<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Coin;

class CoinApiController extends Controller
{
    private $insertArray;
    public function __construct()
    {
        $this->insertArray = [];
    }
    /**
     * Display a listing of the coinapi.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => ['X-CoinAPI-Key' => config('app.coinapi_key')]]);
            $request = $client->get(config('app.coinapi_endpoint'));
            $response = $request->getBody()->getContents();
            $response_array = json_decode($response, true);
            if ($request->getStatusCode() != '200') {
                throw new \Exception(isset($response_array['message']) ? $response_array['message'] : 'Something went wrong while fetching data from api.');
            }
            $coin_data = json_decode($response);


            $coinsCollection = collect($response_array);
            $coinChunks = $coinsCollection->chunk(10);
            $coinChunks->each(function ($coinchunk, $key) {
                DB::beginTransaction();
                $this->insertArray = [];
                $coinchunk->each(function ($coin, $coinkey) {
                    $coinCollection = collect($coin);
                    $this->insertArray[] = [
                        'asset_id' => $coinCollection->get('name'), 'exchange_id' => $coinCollection->get('exchange_id'), 'website' => $coinCollection->get('website'), 'name' => $coinCollection->get('name'), 'data_start' => $coinCollection->get('data_start'), 'data_end' => $coinCollection->get('data_end'), 'data_quote_start' => $coinCollection->get('data_quote_start'), 'data_quote_end' => $coinCollection->get('data_quote_end'), 'data_symbols_count' => $coinCollection->get('data_symbols_count'), 'volume_1hrs_usd' => $coinCollection->get('volume_1hrs_usd'), 'volume_1day_usd' => $coinCollection->get('volume_1day_usd'), 'volume_1mth_usd' => $coinCollection->get('volume_1mth_usd'), 'json_object' => $coinCollection->toJson()
                    ];
                });
                if (count($this->insertArray) > 0) {
                    Coin::upsert($this->insertArray, ['name','asset_id'], array_keys($this->insertArray[0]));
                }
                DB::commit();
            });            
            return response()->json(['coindata' => $coin_data, 'message' => 'Succesfully fetched'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 201);
        }
    }
}
