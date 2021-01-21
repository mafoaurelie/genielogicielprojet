<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    protected $guarded = [];
    
    public function files(){
        return $this->hasMany('App\File');
    }

    public function tags(){
        return $this->hasMany('App\CityTags');
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
