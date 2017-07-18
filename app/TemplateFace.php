<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateFace extends Model
{
	protected $table = 'template_face';
	
    protected $fillable = [
        'id', 'path',
    ];
}
