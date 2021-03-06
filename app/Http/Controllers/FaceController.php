<?php

namespace App\Http\Controllers;

use App\Face;
use App\Navbar;
use Illuminate\Http\Request;

class FaceController extends Controller
{
    private $news;
    public function __construct(){
        $this->news = \App\Article::orderBy('id', 'desc')->limit(10)->get()->all();
    }

    public function facelist($navid){
    	$navs = Navbar::orderBy('sort')->limit(5)->get();

    	$current = $this->nav_ishit($navs, $navid);

    	if(!$current){
    		\App::abort(404);
    	}
    	
    	$facelist = Face::where('navid', $navid)->orderBy('id', 'desc')->paginate(16);

    	return view('facelist', [
    		'navs' => $navs, 
    		'facelist' => $facelist,
    		'navid' => $navid,
    		'subtitle' => $current->title,
            'news' => $this->news,
            'title' => $current->title
    	]);
    }

    private function nav_ishit($navs, $navid){
    	if(!is_numeric($navid)){
    		return false;
    	}

    	foreach ($navs as $key => &$nav) {
    		if($nav->id == $navid){
    			return $nav;
    		}
    	}
    	
    	return false;
    }
}
