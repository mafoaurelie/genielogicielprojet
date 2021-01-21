@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Mes soumissions cites</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( !empty($ownerItems))
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Nom</th>
                                <th>Localisation</th>
                                <th>Price (cfa)</th>
                                <th>Chbres vides</th>
                                <th>Chbres occup.</th>
                                <th>Date creation</th>
                                <th>Actions</th>
                            </tr>
                                
                            @foreach ( $ownerItems as $ownedItems )
                                <tr>
                                    <td>{{ $ownedItems->name }}</td>
                                    <td>{{ $ownedItems->localisation }}</td>
                                    <td>{{ $ownedItems->price_per_rooms }}</td>
                                    <td>{{ $ownedItems->nbr_free_rooms }}</td>
                                    <td>{{ $ownedItems->nbr_rooms - $ownedItems->nbr_free_rooms }}</td>
                                    <td> {{ $ownedItems->created_at }}</td>
                                    <td> 
                                        <a class="btn btn-info btn-sm" href="/submission?id={{ $ownedItems->id }}">Modifier</a> 
                                        <a  class="btn btn-danger btn-sm" href="/supprimer/{{ $ownedItems->id }}" class="btn btn-warning"><i class="fas fa-trash-alt">Supprimer</i></a>
                                        <!-- <button class="btn btn-danger btn-sm" onclick="$('#citydestroy').trigger('submit');" >Supprimer</button>
                                        <form action="{{route('city.destroy')}}" method="post" id="citydestroy">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$ownedItems->id}}">
                                        </form>
                                    </td> -->
                                </tr>
                            @endforeach
                        </table>

                        @else 
                        Rien à affiché pour le moment!
                    @endif 
                </div>
            </div>
        </div>
    </div>

   
    <div class="row justify-content-center mt-5">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Chambres que j'ai payé </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( !empty( $boughtCities) )
                        <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Localisation</th>
                                    <th>Price</th>
                                    <th>Date </th>
                                    <th>Expire en </th>
                                </tr>


                                @foreach ( $boughtCities as $ownedItems )
                                    <tr>
                                        <td>{{ $ownedItems->city->name }}</td>
                                        <td> {{$ownedItems->city->description}}  </td>
                                        <td>{{ $ownedItems->city->localisation }}</td>
                                        <td> CFA {{ $ownedItems->city->price_per_rooms }}</td>
                                        <td> {{ $ownedItems->created_at }}</td>
                                        @php 
                                            $today = Carbon\Carbon::today();
                                            $expires = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ownedItems->expires_at);
                                        @endphp 
                                        <td> 
                                            @if( $today == $expires )
                                                <span class="badge badge-danger">Expiré</span>
                                            @else  
                                             {{ $ownedItems->expires_at }}
                                            @endif 
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    @else 
                       Rien à affiché pour le moment! 
                    @endif 
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Mes soumissions appartements</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( !empty($ownerItem))
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Nom</th>
                                <th>Localisation</th>
                                <th>Price (cfa)</th>
                                <th>Chbres</th>
                                <th>salon</th>
                                <th>Date creation</th>
                                <th>Actions</th>
                            </tr>
                                
                            @foreach ( $ownerItems as $ownedItems )
                            
                                <tr>
                                    <td>{{ $ownedItems->name }}</td>
                                    <td>{{ $ownedItems->localisation }}</td>
                                    <td>{{ $ownedItems->price_apartment }}</td>
                                    <td>{{ $ownedItems->nbr_living_rooms }}</td>
                                    <td>{{ $ownedItems->nbr_rooms }}</td>
                                    <td> {{ $ownedItems->created_at }}</td>
                                    <td> 
                                        <a class="btn btn-info btn-sm" href="/submissionapa?id={{ $ownedItems->id }}">Modifier</a> 
                                        <a class="btn btn-danger btn-sm" href="#">Supprimer</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        @else 
                        Rien à affiché pour le moment!
                    @endif 
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center mt-5">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">appartement que j'ai payé </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( !empty( $boughtAppartements) )
                        <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Localisation</th>
                                    <th>Price</th>
                                    <th>Date </th>
                                    <th>Expire en </th>
                                </tr>


                                @foreach ( $boughtAppartements as $ownedItems )
                                    <tr>
                                        <td>{{ $ownedItems->apartment->name }}</td>
                                        <td> {{$ownedItems->apartment->description}}  </td>
                                        <td>{{ $ownedItems->apartment->localisation }}</td>
                                        <td> CFA {{ $ownedItems->apartment->price_apartment }}</td>
                                        <td> {{ $ownedItems->created_at }}</td>
                                        @php 
                                            $today = Carbon\Carbon::today();
                                            $expires = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ownedItems->expires_at);
                                        @endphp 
                                        <td> 
                                            @if( $today == $expires )
                                                <span class="badge badge-danger">Expiré</span>
                                            @else  
                                             {{ $ownedItems->expires_at }}
                                            @endif 
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    @else 
                       Rien à affiché pour le moment! 
                    @endif 
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Historique des payments</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nom cité</th>
                                    <th>Price</th>
                                    <th>Quantité</th>
                                    <th>Direction</th>
                                    <th>Date</th>
                                    <th>Expire en</th>
                                </tr>
                                @foreach ( $boughtCities as $history )
                                    <tr>
                                        <td>{{ $history->city->name }}</td> 
                                        <td> CFA {{ $ownedItems->city->price_per_rooms }}</td>
                                        <td> 1 </td>
                                        <td>
                                             @if( $history->city->owner_id == auth()->user()->id )
                                                <span class="badge badge-info">Recepteur payment</span>
                                             @else 
                                                <span class="badge badge-danger">Payment Location</span>
                                            @endif 
                                        </td>
                                        <td> {{ $ownedItems->created_at }}</td>

                                        @php 
                                            $today = Carbon\Carbon::today(); // Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ownedItems->created_at);
                                            $expires = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ownedItems->expires_at);
                                        @endphp 
                                        <td> 
                                            @if( $today == $expires))
                                                <span class="badge badge-danger">Expiré</span>
                                            @else  
                                             {{ $ownedItems->expires_at }}
                                            @endif 
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                     
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
