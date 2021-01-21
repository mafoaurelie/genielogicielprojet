<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
  
    protected $guarded = [];
    
    public function files(){
        return $this->hasMany('App\Filess');
        
    }

    public function tags(){
        return $this->hasMany('App\ApartmentTags');
    }

    public function getTags(){
        $tags = $this->tags()->get();

        $tagsRes = [];
        $i  = 0; 
        foreach( $tags as $aTag){
            $found = Tag::find($aTag->tag_id);
            if( $found ){
                $tagsRes[$i++] =$found;
            }
        }
        return $tagsRes;
    }
}
