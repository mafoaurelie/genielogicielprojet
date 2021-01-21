@extends('layouts.app')

@section('content')

<div class="container">
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Images de l'appartement</span>
          </h4>
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset( $apartment->files()->get()[0]->path ) }}" alt="First slide" style="border-radius:4px">
                </div>
               @foreach( $apartment->files()->get() as $file )
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="{{ asset( $file->path ) }}" alt="First slide" style="border-radius:4px">
                    </div>
                @endforeach 
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        </div>
        <div class="col-md-8 order-md-1">
          <h1 class="mb-3">Details de l'appartement</h1>
            <div class="text-mute">
                <h4>Description</h4>
                <p class="text-muted">
                    {{ $apartment->description }}
                </p>
            </div>
            <div class="text-mute">
                <h4>Localisation</h4>
                <p class="text-muted">
                    Situé à: <b> {{ $apartment->localisation }} </b>
                </p>
            </div>
            <div class="text-mute">
                <h4>Propriétaire </h4>
                <p class="text-muted">
                    Propriétaire :<b> {{ strtoupper($owner->name) }} </b>
                </p>
            </div>
            <div class="text-mute">
                <h4>Nombre d'appartements </h4>
                <p class="text-muted">
                    <b> {{ strtoupper($apartment->nbr_living_rooms ) }} appartements </b>
                </p>
            </div>
            <div class="text-mute">
                <h4>Prix </h4>
                <p class="text-muted">
                   Prix de l'appartement :<b> CFA {{ strtoupper($apartment->price_apartment) }} </b>
                </p>
            </div>
            <div class="text-mute">
                <h4> Tags associés </h4>
                <p class="text-muted">
                         @php
                            $i = 0;
                         @endphp
                        @foreach( $apartment->getTags() as $aTag)
                            <a href="/#{{ str_replace(' ','',$aTag->name) }}" class="post-tag" title="{{ $aTag->description }}">
                                <i class="fa fa-tag"></i> {{ $aTag->name }}
                            </a>
                        @endforeach
                </p>
            </div>

            <h4 class="mt-5"> Payment  </h4>

            @if(session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
                </div> 
             @endif
            @if(session('error'))
                <div class="alert alert-danger">
                {{ session('error') }}
                </div> 
             @endif

            <form class="form-check" method="post" action="/payment/store">
                @csrf 
                <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="paymentMethod" value="creditCard" type="radio" class="custom-control-input" checked required>
                    <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="paymentMethod" value="mobileMoney" type="radio" class="custom-control-input" required>
                    <label class="custom-control-label" for="debit">Mobile Money</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="paypal" name="paymentMethod" value="paypal" type="radio" class="custom-control-input" required>
                    <label class="custom-control-label" for="paypal">Paypal</label>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Nom sur la carte/ Nom </label>
                    <input type="text" class="form-control" id="cc-name" name="name" value="@auth {{ Auth::user()->name }} @endauth" placeholder="Votre nom" required>

                    <small class="text-muted">Nom complet sur la carte</small>
                    <div class="invalid-feedback">
                        Name on card is required
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number / Numéro de téléphone </label>
                    <input type="text" class="form-control" name="address" placeholder="" required>
                    <div class="invalid-feedback">
                        Credit card number is required
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6 mb-6">
                    <label for="cc-expiration">Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount" value="{{ $apartment->price_apartment }}" readonly>
                    <input type="hidden" value="{{ $apartment->id }}" name="apartment_id">
                </div>

                </div>
                <hr class="mb-4">
                @if( $apartment->nbr_living_rooms == 0)
                <div class="alert alert-info">
                    Désolé plus de chambres libres
                </div>
            @else
                @guest 
                 <button type="button" class="btn btn-primary btn-md" onclick="window.location.replace('/login')">Se connecter et payer</button>
                @else
                 <button class="btn btn-primary btn-md" type="submit">Payer maintenant</button>
                @endauth 
            @endif 
              
             </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

@endsection 
