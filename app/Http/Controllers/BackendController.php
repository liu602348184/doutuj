<?php

namespace App\Http\Controllers;

use App\Face;
use App\Navbar;
use App\Article;
use App\TemplateFace;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	// echo bcrypt("MTk5MzAwMDdsaXU=");die;
        $list = TemplateFace::get()->all();
        $navlist = Navbar::orderBy('sort')->get()->all();
        return view('backend/index', ['tpllist' => $list, 'navlist' => $navlist]);
    }

    public function insert_tplface(Request $request){
        $files = $request->file('templatefaces');

        if (!count($files)) {
            die('缺少文件');
        }
        
        foreach ($files as $key => $file) {
            // $filename = md5_file($file->getRealPath()) . '.' . $file->getClientOriginalExtension();
            // echo $file->getClientOriginalName();
            if($file->getMimeType() != 'image/jpeg'){
                continue;
            }

            // $path = $file->store('templatefaces');
            $path = Storage::disk('public')->putFile('templatefaces', $file);
            $tplface = new TemplateFace();
            $tplface->path = $path;
            $tplface->save();
            // var_dump($store);
            // Storage::put($filename, $file);
        }

        return redirect()->route('backend');
    }

    public function navbar(){
        $list = Navbar::orderBy('sort')->get()->all();
        return view('backend/navbar', ['navlist' => $list]);
    }

    public function create_navbar(Request $request){
        $title = $request->input('title');
        $sort = $request->input('sort');
        $id   = $request->input('id');

        if(!$title){
            \App::abort(400);
        }

        if(!$sort || !is_numeric($sort) || $sort > 100){
            \App::abort(400);
        }

        
        if($id){
            $navbar = Navbar::find($id);
        } else {
            $navbar = new Navbar();
        }

        // $navbar->id = $id;
        $navbar->title = $title;
        $navbar->sort = $sort;

        if($navbar->save()){
            return redirect()->route('navbar');
        } else {
            \App::abort(500);
        }
    }

    public function delete_navbar(Request $request){
        $id = $request->input('id');
        $result = Navbar::where('id', $id)->delete();
        
        if($result){
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function delete_tplface(Request $request){
        $id = $request->input('id');
        $row = TemplateFace::find($id);
        
        if(!$row){
            \App::abort(400);
        }

        if(Storage::disk('public')->delete($row->path)){
            if($row->delete()){
                echo json_encode(['success' => true]);die();
            }
        }

        echo json_encode(['success' => false]);
    }

    public function face($id){
        $navlist = Navbar::orderBy('sort')->get()->all();
        $faces = Face::where('navid', $id)->paginate(15);
        return view('backend/face', ['navlist' => $navlist, 'navid' => $id, 'faces' => $faces]);
    }

    public function create_face(Request $request, $id){
        $files = $request->file('faces');

        if (!count($files)) {
            die('缺少文件');
        }

        $row = Navbar::find($id);

        if(!$row){
            \App::abort(404);
        }

        foreach ($files as $key => $file) {
            // $filename = md5_file($file->getRealPath()) . '.' . $file->getClientOriginalExtension();
            // echo $file->getClientOriginalName();
            $mime = $file->getMimeType();

            if($mime != 'image/jpeg' && $mime != 'image/gif' && $mime != 'image/png'){
                continue;
            }

            $path = Storage::disk('public')->putFile('faces', $file);
            // $path = $file->store('faces');
            
            if($path){
                $face = new Face();
                $face->path = $path;
                $face->navid = $id;
                if(!$face->save()){
                    // return redirect('')
                    \App::abort(500);
                }
            } else {
                \App::abort(500);
            }
        }

        return redirect("backend122/face/{$id}");
    }

    public function delete_face(Request $request){
        $id = $request->input('id');
        $row = Face::find($id);

        if(!$row){
            \App::abort(400);
        }

        if(Storage::disk('public')->delete($row->path)){
            if($row->delete()){
                echo json_encode(['success' => true]);die();
            }
        }

        echo json_encode(['success' => false]);
    }

    public function article(){
        $navlist = Navbar::orderBy('sort')->get()->all();
        $articles = Article::paginate(5);
        return view('backend/article', ['navlist' => $navlist, 'articles' => $articles]);
    }

    public function create_article(Request $request){
        $title = $request->input('title');
        $desc = $request->input('desc');
        $files = $request->file('imgs');

        if(!$title){
            \App::abort(400, "the title was missing");
        }

        if(!$desc){
            \App::abort(400, "the desc was missing");
        }

        if(!count($files)){
            \App::abort(400, "the file was missing");
        }

        $thumb_img = \Image::make($files[0]);
        $thumb_img->widen(100);
        $mime = $files[0]->getMimeType();

        if($mime != 'image/jpeg' && $mime != 'image/gif' && $mime != 'image/png'){
            \App::abort(400, "file is not image");
        }

        $fileext = $files[0]->getClientOriginalExtension();
        $thumb_name = 'thumb/' . md5_file($files[0]->getRealPath()) . "_thumb." . $fileext;
        $res = $thumb_img->save(storage_path('app/public/article/' . $thumb_name));

        if(!$res){
            \App::abort(500);
        }

        $parr = [];

        $zip_name = md5(time() . microtime()) . ".zip";
        $zipper = new \Chumper\Zipper\Zipper();

        foreach ($files as $key => $file) {
            $mime = $file->getMimeType();
            
            if($mime != 'image/jpeg' && $mime != 'image/gif' && $mime != 'image/png'){
                continue;
            }

            $path = Storage::disk('public')->putFile('article', $file);
            $parr[] = $path;

            $zipper->make(storage_path("app/public/download/{$zip_name}"))->add(storage_path("app/public/{$path}"));
        }

        $paths = join(',', $parr);
        $article = new Article();
        $article->paths = $paths;
        $article->thumb = $thumb_name;
        $article->title = $title;
        $article->desc  = $desc;
        $article->zip   = $zip_name;

        if($article->save()){
            $zipper->close();
            return redirect()->route('article');
        }

        \App::abort(500);
    }

    public function delete_article(Request $request){
        $id = $request->input('id');

        if(!is_numeric($id)){
            \App::abort(400);
        }

        $article = Article::find($id);

        if(!$article){
            \App::abort(404);
        }

        $res = Storage::disk('public')->delete('article/' . $article->thumb);

        if(!$res){
            \App::abort(500);
        }

        $paths = $article->paths;
        $parr = explode(',', $paths);

        foreach ($parr as $key => $path) {
            $res = Storage::disk('public')->delete($path);
            if(!$res){
                \App::abort(500);
            }
        }

        $res = Storage::disk('public')->delete('download/' . $article->zip);

        if(!$res){
            \App::abort(500);
        }

        if($article->delete()){
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

    }
}
