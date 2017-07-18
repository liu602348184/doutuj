<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateFace extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'create_face';
    protected $fillable = [
        'id', 'tplid' ,'path',
    ];
}
