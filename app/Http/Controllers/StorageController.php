<?php

namespace App\Http\Controllers;

// use App\TemplateFace;
// use App\CreateFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function __construnc(){

    }

    public function tplface($id){
    	$row = \App\TemplateFace::where('id', $id)->first();

    	if(!$row){
    		\App::abort(404, 'source not found');
    	}

    	$file = Storage::get($row->path);
    	echo $file;
    }

    public function createface($id){
        $row = \App\CreateFace::where('id', $id)->first();

        if(!$row){
            \App::abort(404, 'source not found');
        }

        $file = Storage::get($row->path);
        echo $file;
    }

    public function face($id){
        $row = \App\Face::where('id', $id)->first();

        if(!$row){
            \App::abort(404, 'source not found');
        }

        $file = Storage::get($row->path);
        echo $file;
    }
}
