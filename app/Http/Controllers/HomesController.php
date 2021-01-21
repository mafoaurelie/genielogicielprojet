<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Apartment;
use App\Payment;

use Illuminate\Support\Facades\Auth;
class HomesController extends Controller
{
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

        $boughtAppartements = Payment::where('buyer_id', $user->id )
                                 ->orWhere('owner_id',$user->id)
                                 ->get();

        foreach ( $boughtAppartements as $aApartment ) {
            $aApartment->apartment = Apartment::find($aApartment->id);
        }

        $ownerItems = Apartment::where('owner_id',$user->id)->get();

        return view('home',compact('ownerItems','boughtAppartements') );
        
    }
    public function home() {
        $statut="accepter";
        $appartements = Apartment::where('statut','=',$statut)->get(); 
        $tags = Tag::all();

        return view('welcomeapa',compact('appartements','tags'));
    }
    /**
     * Retrieve the list of all available cities
     */
    
}
