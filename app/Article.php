<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'article';
    protected $fillable = [
        'id', 'paths', 'thumb', 'title', 'desc', 'zip', 'tags', 'like', 'show', 'created_at'
    ];

    public function tags(){
    	$tags = [];

    	if($this->tags){
    		$tags = $this->tags = explode(',', $this->tags);
    	}
    	// $this->tags = $tags;
    	return $tags;
    }

    public function show(){
    	$this->show += 1;
    	$this->save();
    }

    public static function hot_tags(){
        $hots = \App\Article::orderBy('show', 'desc')->limit(20)->get()->all();

        $arr = [];

        foreach ($hots as $key => $value) {
            if(!$value->tags){
                continue;
            }

            $tags = explode(',', $value->tags);
            $arr = array_merge($arr, $tags);
        }

        $arr = array_flip(array_flip($arr));

        return $arr;
    }
}
