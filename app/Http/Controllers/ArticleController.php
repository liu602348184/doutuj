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
		
        $article->show();
		$paths = $article->paths;
		$parr = explode(',', $paths);
		$next = Article::where('id', '<', $id)->orderBy('id', 'desc')->limit(1)->get()->first();
		$pre = Article::where('id', '>', $id)->orderBy('id')->limit(1)->get()->first();
		$news = \App\Article::orderBy('id', 'desc')->limit(10)->get()->all();
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

    public function thumbs_up(Request $request){
        $id = $request->input('id');

        if($request->session()->get('thumbs_up', false)){
            $thumbs_up = $request->session()->get('thumbs_up');
            
            if(isset($thumbs_up[$id])){
                echo json_encode(['success' => false, 'msg' => '你已经顶过了']);
                die;
            }
        }

        $article = Article::find($id);

        if(!$article){
            \App::abort(400);
        }

        $article->like += 1;
        
        if($article->save()){
            $request->session()->put('thumbs_up', ["{$id}" => true]);
            echo json_encode(['success' => true, 'like' => $article->like]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
