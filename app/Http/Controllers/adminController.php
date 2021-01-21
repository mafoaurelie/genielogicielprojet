<?php

namespace App\Http\Controllers;
 use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\City;
use App\User;
use App\Apartment;
use Illuminate\Http\Request;
  
class adminController extends Controller
{
    //
    public function destroyuser(Request $request)
     {
         $users=User::findOrFail($request->id);
         $users->delete();
         return back()->with(["success","Suppression reuissie"]);
     }


    public function homeAdminauth(){
       
        $cities = City::all(); 
        $tags = Tag::all();

        return view('welcome',compact('cities','tags'));
    }

    public function home() {
        
        if ( !Auth::check()) {
            return view('auth.login');
        }
        
        $statut = "attente";

        $appartements=Apartment::where('statut','=',$statut)->get();
       
        $cities = City::where('statut','=',$statut)->get();
        $tags = Tag::all();

        return view('Vuadministrateur2',compact('cities','tags','appartements'));
    }
// cette fontion permetttra à notre utilisateur d'effectuer des re
    public function findCriteriat($tag) {
        
        
        $statut = "accepter";

        $appartements=Apartment::where('statut','=',$statut)->get();
       
        $cities = City::where('statut','=',$statut)->get();
        $tags = Tag::all();

        return view('Vuadministrateur',compact('cities','tags','appartements'));
    }

    public function Controleuser()
    {
       $users=User::All();
       return view('Vuadministrationclient',compact('users'));

    }
   
}
