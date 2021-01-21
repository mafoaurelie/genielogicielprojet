<?php

namespace App\Http\Controllers;

use App\Tag;
use App\City;
use App\Payment;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user = Auth::user();

        $boughtCities = Payment::where('buyer_id', $user->id )
                                 ->orWhere('owner_id',$user->id)
                                 ->get();

        foreach ( $boughtCities as $aCity ) {
            $aCity->city = City::find($aCity->id);
        }

        $ownerItems = City::where('owner_id',$user->id)->get();
        

        return view('home',compact('ownerItems','boughtCities',) );
    }
 
    /**
     * Retrieve the list of all available cities
     */
    public function home() {
        $statut = "accepter";
        $cities = City::where('statut','=',$statut)->get();
        $tags = Tag::all();

        return view('welcome',compact('cities','tags'));
    }


}
