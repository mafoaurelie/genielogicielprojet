<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Apartment;
use App\City;
use App\Filess;
use App\User;
use App\ApartmentTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;




class AppartementController extends Controller
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
            'apartmentName' => 'required|string',
            'localisation' => 'required|string',
            'descr' => 'required',
            'ppr' => 'required|numeric',
            'ntc' => 'required|numeric',
            'nbrs' => 'required|numeric', // Numbre de salon
            'tags' => 'present',
            'photos' => 'required',
            'photos.*' => 'mimes:png,jpeg,jpg'
        ]);
        
        $apartment = null;
        if( !empty($request->input('id'))){
            $apartment = Apartment::find( $request->input('id'));

            $data = [
                'name' => $request->input('apartmentName'),
                'description' => $request->input('descr'),
                'localisation' => $request->input('localisation'),
                'nbr_rooms' => $request->input('ntc'),
                'nbr_living_rooms' => $request->input('nbrs'),
                'price_apartment' => $request->input('ppr'),
                
            ];

            $apartment->update($data);

        }else {
            $apartment = new Apartment([
                'name' => $request->input('apartmentName'),
                'description' => $request->input('descr'),
                'localisation' => $request->input('localisation'),
                'nbr_rooms' => $request->input('ntc'),
                'nbr_living_rooms' => $request->input('nbrs'),
                'price_apartment' => $request->input('ppr'),
                'owner_id' => $request->user()->id,
            ]);
            $apartment->save();
        }
        

        $apartmentId = $apartment->id;  

        $tags =  $request->input('tags');

        foreach ( $tags as $enteredTags) {
            $tagExists = Tag::whereName($enteredTags)
                            ->first();

            if ($tagExists ) {
                ApartmentTags::create([
                    'apartment_id' => $apartmentId,
                    'tag_id' => $tagExists->id,
                ]);
            }
        }

        $tags = Tag::all();

        if($request->hasfile('photos')){
            foreach($request->file('photos') as $file){
                $extension = $file->extension() ?: 'png';

                $destinationPath =  'storage/images/'.$apartmentId;
                $safeName = 'apartment_' . str_random(20) . '.' . $extension;

                while (file_exists($destinationPath . $safeName)) {
                    $safeName = 'apartment_' . str_random(20) . '.' . $extension;
                }
                
                $file->move($destinationPath, $safeName); 

               
                $file = new Filess([

                    'apartment_id'=> $apartmentId,
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
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function submission(Request $request) {
        if ( !Auth::check()) {
            return view('auth.login');
        }

        $apartment = null;

        if( !empty( $request->get('id'))) {
            $apartment = Apartment::find( $request->get('id'));

            if( !$apartment ){
                abort(404);
            } 
        }
        $tags = Tag::all();

        if( $apartment ){
            $request->request->add(['descr'=> $apartment->description ]);
            $request->request->add(['apartmentName'=> $apartment->name ]);
            $request->request->add(['localisation'=> $apartment->localisation ]);
            $request->request->add(['ppr'=> $apartment->price_apartment ]);
            $request->request->add(['ntc'=> $apartment->nbr_rooms ]);
            $request->request->add(['nbrs'=> $apartment->nbr_living_rooms ]);
            $request->request->add(['id'=> $apartment->id ]);
         
        }
  //      dd( $request );
        // return view('submission',compact('tags','request'));
        return view('submissionapa',compact('tags','request'));
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
    // public function update(Request $request,Apartment $apartment) {
    // }

    /**
     * Get the details 
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function detailsapa(int $id) {
        $apartment = Apartment::find($id);   
        // SELECT * from cities where id=$id,
        
        if (!$apartment) {
            abort(404);
        }

        $tags = $apartment->getTags();
        $filess = $apartment->files();
        
        $owner = User::find($apartment->owner_id);

        return view('detailsapa',compact('tags','filess','owner','apartment'));
    }

    /**
     * Get appartements matching the given tags id 
     * @param Array $tagIds
     */

     public function filter(Request $request){
        
        $elems = $request->input("elem");
        $appartements = Apartment::all();
        $notNullIds = [];

        foreach( $elems as $elem ){
            if( $elem !=null && $elem != -1 ){
                array_push($notNullIds,(int) $elem);
            }
        }
    
        $result = [];
        $matchAll = true;

        foreach( $appartements as $apartment ){

            foreach( $notNullIds as $anId ){

                 $apartmentTagExists = ApartmentTags::where([ 'apartment_id' => $apartment->id,
                                                    'tag_id' => $anId ])->first();
                
                 if( !$apartmentTagExists ){

                    error_log( $apartment->id." ".$anId );
                     $matchAll = false;
                     break;
                 }
                
            }

            if( $matchAll ){
                $apartment->images = $apartment->files()->get();
                $apartment->tags   = $apartment->getTags();
            
                array_push($result,$apartment );
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
     public function home() {
         
        $appartements = Apartment::All(); 
        $tags = Tag::all();

        return view('welcomeapa',compact('appartements ','tags'));
    }
    public function destroy(Request $request)
    {
        $city=Apartment::findOrFail($request->id);
        $city->delete();
        return back()->with(["success","Suppression reuissie"]);
    }


     public function valide(Request $request,$id)
     {
      
        $apartment=Apartment::find($id);
        $apartment->statut="accepter";
        $apartment->update();

        $statut = "attente";

        $appartements=Apartment::where('statut','=',$statut)->get();
       
        $cities = City::where('statut','=',$statut)->get();
        $tags = Tag::all();

       return back();
        
     }
    
}
