<?php

namespace App\Http\Controllers;

use App\City;
use App\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller {
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
            'city_id' => 'required|numeric',
            'paymentMethod'    => 'required|string'
        ]);

        $payment = new Payment([
            'buyer_id' => $request->user()->id,
            'number_of_item' => 1,
            'city_id'   => $request->input('city_id'),
            'amount'    => $request->input('amount'),
            'address'   => $request->input('address').$request->input('name'),
            'method'    => $request->input('paymentMethod'),
            'expires_at' => Carbon::now()->addYear(1)
        ]);

        $city = City::find( $request->input('city_id'));

        if( !$city){
            return back()->with('error','Something went wrong,please try again later.');
        }

        if( $request->user()->id == $city->owner_id ){
            return back()->with('error','Erreur, vous ne pouvez pas achéter votre propre cité.');
        }

        $payment->owner_id = $city->owner_id;

        $city->nbr_free_rooms -= 1;

        $city->save();
        $payment->save();

        return back()->with('success','Payment effectué avec success!');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city) {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city) {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city) {
    }
}


