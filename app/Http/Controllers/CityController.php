<?php

namespace App\Http\Controllers;

use App\Tag;
use App\City;
use App\File;
use App\User;
use App\Apartment;
use App\CityTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CityController extends Controller {
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
            'cityName' => 'required|string',
            'localisation' => 'required|string',
            'descr' => 'required',
            'ppr' => 'required|numeric',
            'ntc' => 'required|numeric',
            'nfr' => 'required|numeric',
            'nbr' => 'required|numeric', // Number Of Busy rooms
            'tags' => 'present',
            'photos' => 'required',
            'photos.*' => 'mimes:png,jpeg,jpg'
        ]);
        
        $city = null;
        if( !empty($request->input('id'))){
            $city = City::find( $request->input('id'));

            $data = [
                'name' => $request->input('cityName'),
                'description' => $request->input('descr'),
                'localisation' => $request->input('localisation'),
                'nbr_rooms' => $request->input('ntc'),
                'nbr_free_rooms' => $request->input('nfr'),
                'price_per_rooms' => $request->input('ppr'),
                'owner_id' => $request->user()->id,
            ];

            $city->update($data);

        }else {
            $city = new City([
                'name' => $request->input('cityName'),
                'description' => $request->input('descr'),
                'localisation' => $request->input('localisation'),
                'nbr_rooms' => $request->input('ntc'),
                'nbr_free_rooms' => $request->input('nfr'),
                'price_per_rooms' => $request->input('ppr'),
                'owner_id' => $request->user()->id,
            ]);
            $city->save();
        }
        

        $cityId = $city->id;  

        $tags =  $request->input('tags');

        foreach ( $tags as $enteredTags) {
            $tagExists = Tag::whereName($enteredTags)
                            ->first();

            if ($tagExists ) {
                CityTags::create([
                    'city_id' => $cityId,
                    'tag_id' => $tagExists->id,
                ]);
            }
        }

        $tags = Tag::all();

        if($request->hasfile('photos')){
            foreach($request->file('photos') as $file){
                $extension = $file->extension() ?: 'png';

                $destinationPath =  'storage/images/'.$cityId;
                $safeName = 'city_' . str_random(20) . '.' . $extension;

                while (file_exists($destinationPath . $safeName)) {
                    $safeName = 'city_' . str_random(20) . '.' . $extension;
                }
                
                $file->move($destinationPath, $safeName); 

                $file = new File([
                    'city_id' => $cityId,
                    'path' => $destinationPath.'/'.$safeName,
                    'description' => 'This is the default description'
                ]);

                $file->save();

            }
        }else{
            return back()->with('error','Something went wrong,please try again later');
        }

        return back()->with('success', 'Soumission bien prise en compte !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function submission(Request $request) {
        if ( !Auth::check()) {
            return view('auth.login');
        }

        $city = null;
        $tags = Tag::all();
        if( !empty( $request->get('id'))) {
            $city = City::find( $request->get('id'));

            if( !$city ){
                abort(404);
            } 
        }
        $tags = Tag::all();

        if( $city ){
            $request->request->add(['descr'=> $city->description ]);
            $request->request->add(['cityName'=> $city->name ]);
            $request->request->add(['localisation'=> $city->localisation ]);
            $request->request->add(['ppr'=> $city->price_per_rooms ]);
            $request->request->add(['ntc'=> $city->nbr_rooms ]);
            $request->request->add(['nfr'=> $city->nbr_free_rooms ]);
            $request->request->add(['id'=> $city->id ]);
            $request->request->add(['nbr'=>$city->nbr_rooms - $city->nbr_free_rooms ]);
        }
  //      dd( $request );
        return view('submission',compact('tags','request'));
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
        $city = City::findOrFail($city);
         $city->statut = "accepter";
         $city->save();

     }

    /**
     * Get the details 
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function details(int $id) {
        $city = City::find($id);   
        // SELECT * from cities where id=$id,
        
        if (!$city) {
            abort(404);
        }

        $tags = $city->getTags();
        $files = $city->files();

        $owner = User::find($city->owner_id);

        return view('details',compact('tags','files','owner','city'));
    }

    /**
     * Get cities matching the given tags id 
     * @param Array $tagIds
     */

     public function filter(Request $request){
        
        $elems = $request->input("elem");
        $cities = City::all();
        $notNullIds = [];

        foreach( $elems as $elem ){
            if( $elem !=null && $elem != -1 ){
                array_push($notNullIds,(int) $elem);
            }
        }
    
        $result = [];
        $matchAll = true;

        foreach( $cities as $city ){

            foreach( $notNullIds as $anId ){

                 $cityTagExists = CityTags::where([ 'city_id' => $city->id,
                                                    'tag_id' => $anId ])->first();
                
                 if( !$cityTagExists ){

                    error_log( $city->id." ".$anId );
                     $matchAll = false;
                     break;
                 }
                
            }

            if( $matchAll ){
                $city->images = $city->files()->get();
                $city->tags   = $city->getTags();
            
                array_push($result,$city );
            }

            $matchAll = true;
        
        }
        $responsePayload = [
            "status" => "success",
            "data"  => $result 
        ];

        if( empty( $result) ){
            $responsePayload['status'] = 'failed';
        }
        return $responsePayload;
     }

     public function destroy(Request $request)
     {
         $city=City::findOrFail($request->id);
         $city->delete();
         return back();
     }

     public function valide($id)
     {
        $city=City::find($id);
        $city->statut="accepter";
        $city->update();

        $statut = "attente";

        $appartements=Apartment::where('statut','=',$statut)->get();
       
        $cities = City::where('statut','=',$statut)->get();
        $tags = Tag::all();

       return back();
        
     }

     public function valideApartment($id)
     {
        $apartment=Apartment::find($id);
        $apartment->statut="accepter";
        $apartment->update();

       return back();
        
     }
     public function destroyApartement(Request $request)
     {
         $apartment=Apartment::findOrFail($request->id);
         $apartment->delete();
         return back();
     }
  
// public function FindCity($tag)
// {
//     $tags= Tag::find('city_id')->where('name','=',$tag->name);
//     $cityid= CityTag::find('city_id')->where('tag_id','=',$tag->id);
//     $city= City::where('id','=',$cityid);
// }



    }