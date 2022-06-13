@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Coins</h4>                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Coin
                                    </th>
                                    <th>
                                        Exchange
                                    </th>
                                    <th>
                                        Website
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coins as $coin)
                                <tr>
                                    <td class="py-1">
                                        {{ $coin->name }}
                                    </td>
                                    <td class="py-1">
                                        {{ $coin->exchange_id }}
                                    </td>
                                    <td class="py-1">
                                        {{ $coin->website }}
                                    </td>                                    
                                </tr>
                                @endforeach                                                       
                            </tbody>
                        </table>
                        {{ $coins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
