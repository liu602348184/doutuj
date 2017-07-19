<?php

namespace App\Http\Controllers;

use App\Navbar;
use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	private $navs;
    public function __construct(){
        $this->navs = Navbar::orderBy('sort')->get()->all();
    }

    public function index(){
    	$articles = Article::orderBy('id', 'desc')->paginate(10);
        return view('article', ['navs' => $this->navs, 'articles' => $articles, 'title' => '表情包下载']);
    }

    public function detail($id){
		$article = Article::find($id);

		if(!$article){
			\App::abort(404);
		}   
		
		$paths = $article->paths;
		$parr = explode(',', $paths);
		$next = Article::where('id', '<', $id)->orderBy('id', 'desc')->limit(1)->get()->first();
		$pre = Article::where('id', '>', $id)->orderBy('id')->limit(1)->get()->first();
		$news = \App\Article::orderBy('id', 'desc')->get()->all();
		// var_dump($pre->title, $next->title);
    	return view("detail", [
    		'navs' => $this->navs, 
    		'article' => $article, 
    		'paths' => $parr,
    		'pre' => $pre,
    		'next' => $next,
    		'news' => $news,
            'title' => $article->title
    	]);
    }
}
