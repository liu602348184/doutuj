<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TemplateFace;
use App\CreateFace;

class CreateController extends Controller
{
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
        $navlist = \App\Navbar::orderBy('sort')->get()->all();
        $news = \App\Article::orderBy('id', 'desc')->limit(8)->get()->all();
        $hot = \App\Article::orderBy('like', 'desc')->limit(8)->get()->all();
        $hot_tags = \App\Article::hot_tags();
        $createlist = CreateFace::orderBy('id', 'desc')->limit(10)->get()->all();

        return view('createface', [
            'tpllist' => $list, 
            'news' => $news, 
            'hot' => $hot, 
            'navs' => $navlist, 
            'hot_tags' => $hot_tags,
            'createlist' => $createlist,
            'title' => '在线生成表情包'
        ]);
    }

    public function download($id){
        $row = CreateFace::where('id', $id)->first();

        if(!$row){
            \App::abort(400);
        }

        $file = storage_path('app/public/' . $row->path);
        return response()->download($file);
    }

    public function createface(Request $request){
        $tplid = $request->input('tplid');

        if(!$tplid){
            \App::abort(400);
        }

        $phrase = $request->input('phrase');

        if(!$phrase){
            \App::abort(400);
        }

        $row = TemplateFace::where('id', $tplid)->first();
        // $img = \Image::make(storage_path('app/public') . "/" . $row->path);
        $img = imagecreatefromstring(file_get_contents(storage_path("app/public/{$row->path}")));
        $font = public_path("fonts/simhei.ttf");
        $black = imagecolorallocate($img, 0x00, 0x00, 0x00);
        $width = imagesx($img); 
        $center = ($width / 2 ) - (int)(mb_strlen($phrase) * 25 / 2);
        // var_dump(mb_strlen($phrase) * 25);die;
        imagefttext($img, 20, 0, $center, 280, $black, $font, $phrase);
        // $img->text($phrase, 150, 280, function($font) {
        //     $font->file(public_path('fonts') . '\simhei.ttf');
        //     $font->size(20);
        //     $font->color('#000000');
        //     $font->align('center');
        //     $font->valign('bottom');
        // });


        $filename = 'createface/' . md5(time() . microtime() . $phrase) . ".jpg";
        imagejpeg($img, storage_path("app/public/{$filename}"));
        // $img->save(storage_path('app/public') . '/' . $filename);
        $createface = new CreateFace();
        $createface->tplid = $tplid;
        $createface->phrase = $phrase;
        $createface->path = $filename;
       
        if($createface->save()){
            $data = [
                'success' => true,
                'id' => $createface->id,
                'path' => $createface->path
            ];

            echo json_encode($data);
        } else {
            json_encode(['success' => false]);
        }
    }
}
