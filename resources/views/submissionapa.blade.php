@extends('layouts.app')

@section('content')
<div class="container">
      <div class="py-5 text-center">
        <h2>Soumission de l'appartement</h2>
        <p class="lead"> 
          Utilisé le formulaire ci dessous pour soumettre votre appartement dans la plate-forme.
        </p>
      </div>

      <div class="row"> 
        <div class="col-md-8 offset-md-2">
          <h4 class="mb-3">Informations appartement</h4>

          @if( !empty( $errors ) && sizeof( $errors) > 0 )
            <div class="alert alert-danger">
              Le formulaire contient des erreurs
            </div >
          @endif 

          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div> 
          @endif

          <form class="needs-validation" method="post" action="/apartment/create" enctype="multipart/form-data" novalidate>
            @csrf 
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nom de la l'appartement</label>
                @if( !empty( $request->input('apartmentName')))
                   <input type="text" class="form-control" value="{{ $request->input('apartmentName') }}" id="apartmentName" name="apartmentName" placeholder="appartement de lux" required>
                @else
                   <input type="text" class="form-control" value="{{ old('apartmentName') }}" id="apartmentName" name="apartmentName" placeholder="appartement de lux" required>
                @endif
                <div class="invalid-feedback">
                  {!! $errors->first('apartmentName', '<small class="help-block">:message</small>') !!}
                </div>
              </div>
              <input type="hidden" name="id" value="{{ $request->id }}">

              <div class="col-md-6 mb-3">
                <label for="lastName">Localisation</label>
                @if( !empty( $request->input('localisation')))
                  <input type="text" class="form-control" value="{{  $request->input('localisation')}}" id="localisation" name="localisation" placeholder="place de fete" required>
                @else
                  <input type="text" class="form-control" value="{{ old('localisation') }}" id="localisation" name="localisation" placeholder="place de fete" required>
                @endif 
                <div class="invalid-feedback">
                  {!! $errors->first('localisation', '<small class="help-block">:message</small>') !!}
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="descr">Description</label>
              <div class="input-group">
                @if( !empty( $request->input('descr')))
                  <textarea class="form-control" id="descr"  placeholder="Description de l'appartement" name="descr" required> {{  $request->input('descr') }} </textarea>
                @else
                  <textarea class="form-control" id="descr"  placeholder="Description de l'appartement" name="descr" required> {{ old('descr') }} </textarea>
                @endif 
              </div>
              {!! $errors->first('descr', '<small class="help-block text text-danger">:message</small>') !!}
            </div>

            <div class="mb-3">
              <label for="email">Prix de l'appartement</label>
              @if( !empty($request->input('ppr') ) )
                <input type="number" class="form-control" value="{{ $request->input('ppr') }}" id="ppr" name="ppr">
              @else
               <input type="number" class="form-control" value="{{ old('ppr') }}" id="ppr" name="ppr">
              @endif 
              <div class="invalid-feedback">
                {!! $errors->first('ppr', '<small class="help-block text text-danger">:message</small>') !!}
              </div>
            </div>
  
            <div class="mb-3">
              <label for="email">Nombre de chambres</label>
              @if( !empty( $request->input('ntc')))
              <input type="number" class="form-control" value="{{  $request->input('ntc')}}" id="ntc" name="ntc">
              @else
              <input type="number" class="form-control" value="{{ old('ntc') }}" id="ntc" name="ntc">
              @endif 

              <div class="invalid-feedback text text-danger">
                {!! $errors->first('ntc', '<small class="help-block">:message</small>') !!}
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Nombre de salon</label>
              @if( !empty( $request->input('nbrs')))
                <input type="number" class="form-control" id="nbrs" name="nbrs" value="{{  $request->input('nbrs') }}">
              @else
                <input type="number" class="form-control" id="nbrs" name="nbrs" value="{{  old('nbrs') }}">
              @endif 
              <div class="invalid-feedback text text-danger">
                {!! $errors->first('nbrs', '<small class="help-block">:message</small>') !!}
              </div>
            </div>


            <div class="mb-3">
              <label for="tags">Tags (Veuillez selection les termes qui caractérisent le mieux votre appartement) </label><br/>
                <select name="tags[]" class="form-control selectpicker" multiple title="Choose one of the following...">
                  @foreach( $tags as $aTag)
                    <option value="{{ $aTag->name}}"> {{ $aTag->name }} </option>
                  @endforeach 
                </select>
                {!! $errors->first('tags', '<small class="help-block text text-danger">:message</small>') !!}
            </div>

            <div class="mb-3">
              <label for="tags">Uploadé des images de votre appartement</label><br/>
              <input type="file" class="form-control" name="photos[]" multiple required/>
              {!! $errors->first('photos', '<small class="help-block text text-danger">:message</small>') !!}
            </div>


            <button class="btn btn-primary btn-lg btn-block" type="submit">Soumettre la l'appartement </button>
          </form>
        
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    </script>
    <style>
  .bootstrap-select {
    border: 1px solid black !important;
  }
</style>


@endsection 