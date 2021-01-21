@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
        <div id="filter-panel" class="filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- <form class="form-inline" role="form">
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
                            <button type="submit" class="btn btn-default filter-col">
                                Search  <span class="fa fa-search"></span>
                            </button>  
                        </div>
                    </form> -->
                </div>
            </div>
        </div>
	</div>
</div>

<div class="container mt-5">
 
<h3 class="text text-info mb-5"> Liste des appartements disponibles </h3>

<div class="row"> 
    <div class="col-md-9"> 
        <div class="row" id="updatableDiv">
            
        @if( empty( $appartements ) || sizeof($appartements) == 0)
            <h6>Aucun appartement pour le moment veuillez vous connecté pour en soumettre un.</h6>
        @else
            @foreach( $appartements as $apartment )
            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" style="height:200px" src="{{ url($apartment->files()->get()[0]->path) }}" alt="the image alt text here">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $apartment->name }}</h5>
                        <p class="card-text text-left">@if( strlen($apartment->description) > 50 ) {{ substr( $apartment->description,0,50 ) }} @else {{ $apartment->description }} @endif </p>
                        <a href="/detailsapa/{{ $apartment->id }}" class="btn btn-warning">More info</a>
                    </div>
                    <div class="card-footer">
                        @foreach( $apartment->getTags() as $aTag)
                            <a data-id="{{ $aTag->id }}"  class="post-tag" title="{{ $aTag->description }}" style="margin:5px">
                                <i class="fa fa-tag"></i> {{ $aTag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        @endif 

        </div>
    </div>
    <div class="col-md-3">
        <aside>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Liste des tags </h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">

                    @foreach( $tags as $tag)

                        <a data-id="{{ $tag->id }}" href="/#{{str_replace(' ','',$tag->name) }} " class="post-tag" title="{{ $tag->description }}" style="margin:5px"> 
                            <i class="fa fa-tag"></i> {{ $tag->name }}
                        </a>
                    @endforeach 
                  </div>
                  <!-- <div class="card-footer">
                    This is standard card footer
                  </div> -->
                </div>
        </aside>
    </div>  
</div>
 
@endsection 