@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">

    <div class="container">
        <div class="row">
            <div id="filter-panel" class="filter-panel">
                <div class="panel panel-default">
                    <div class="panel-body">
<!------------------------------- Gestion de la barre de recherche------------------------------------>

                        <form class="form-inline" role="form" method="get" >
                            <div class="form-group">
                                <label class="filter-col" style="margin-right:0;" for="pref-perpage">Rows per page:</label>
                                <select id="pref-perpage" class="form-control">
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="9" selected="selected">9</option>
                                </select>                                
                            </div>  
                            <div class="form-group">
                                <label class="filter-col" style="margin-right:0;" for="pref-search">Search:</label>
                                <input type="text" class="form-control input-sm" id="pref-search">
                            </div> 
                            <div class="form-group">
                                <label class="filter-col" style="margin-right:0;" for="pref-orderby">Order by:</label>
                                <select id="pref-orderby" class="form-control">
                                    <option>Descendent</option>
                                </select>                                
                            </div>  
                            <div class="form-group">    
                                <div class="checkbox" style="margin-left:10px; margin-right:10px;">
                                    <label><input type="checkbox"> Ingested</label>
                                </div>
                                <div class="checkbox" style="margin-left:10px; margin-right:10px;">
                                    <label><input type="checkbox"> Automated</label>
                                </div>
                                <button type="submit" class="btn3">
                                    Search  <span class="fa fa-search"></span>
                                </button>  
                            </div>
                        </form> 
<!------------------------------------------ en recherche ------------------------------------------>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container mt-5">
 
<h3 class="text text-info mb-5" align="center"> Cité disponibles </h3>

<div class="row">         
        @if( empty( $cities ) || sizeof($cities) == 0)
            <h6>Aucune cité pour le moment veuillez vous connecté pour en soumettre une.</h6>
        @else
            @foreach( $cities as $city )
            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" style="height:200px" src="{{ url($city->files()->get()[0]->path) }}" alt="the image alt text here">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $city->name }}</h5>
                        <p class="card-text text-left">@if( strlen($city->description) > 50 ) {{ substr( $city->description,0,50 ) }} @else {{ $city->description }} @endif </p>
                        <a href="/details/{{ $city->id }}" class="btn btn-warning">More info</a>
                    </div>
                    <div class="card-footer">
                        @foreach( $city->getTags() as $aTag)
                            <a data-id="{{ $aTag->id }}"  class="post-tag" title="{{ $aTag->description }}" style="margin:5px">
                                <i class="fa fa-tag"></i> {{ $aTag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        @endif 

        
 
@endsection 