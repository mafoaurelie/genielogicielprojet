<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\Payments;
use Illuminate\Http\Request;
use Carbon\Carbon;



class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $request->validate([
            'amount' => 'required|numeric',
            'apartment_id' => 'required|numeric',
            'paymentMethod'    => 'required|string'
        ]);

        $payment = new Payments([
            'buyer_id' => $request->user()->id,
            'number_of_item' => 1,
            'apartment_id'   => $request->input('apartment_id'),
            'amount'    => $request->input('amount'),
            'address'   => $request->input('address').$request->input('name'),
            'method'    => $request->input('paymentMethod'),
            'expires_at' => Carbon::now()->addYear(1)
        ]);

        $apartment = Apartment::find( $request->input('apartment_id'));

        if( !$apartment){
            return back()->with('error','Something went wrong,please try again later.');
        }

        if( $request->user()->id == $apartment->owner_id ){
            return back()->with('error','Erreur, vous ne pouvez pas achéter votre propre appartement.');
        }

        $payment->owner_id = $apartment->owner_id;

        $apartment->nbr_living_rooms -= 1;

        $apartment->save();
        $payment->save();

        return back()->with('success','Payment effectué avec success!');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment) {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment) {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment) {
    }
}
