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
                                        Name
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
                                    <td class="">
                                        {{ $coin->name }}
                                    </td>
                                    <td class="">
                                        {{ $coin->exchange_id }}
                                    </td>
                                    <td class="">
                                        {{ $coin->website }}
                                    </td>                                    
                                </tr>
                                @endforeach                                                       
                            </tbody>
                        </table>
                        <div class="text-center m-3">
                            {{ $coins->links() }}
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
