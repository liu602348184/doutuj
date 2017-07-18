<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'article';
    protected $fillable = [
        'id', 'paths' ,'thumb', 'title', 'desc', 'zip', 'created_at'
    ];
}
