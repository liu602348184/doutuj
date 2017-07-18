<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    protected $table = 'navbar';
	protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'title' ,'sort'
    ];
}
