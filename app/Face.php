<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    protected $table = 'face';
	protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'path' ,'navid', 'title', 'desc'
    ];
}
