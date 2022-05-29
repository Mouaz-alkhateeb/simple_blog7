<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   // protected $guarded = [];
    protected $fillable = ['title', 'body','path'];
    public function comments()
    {
      return $this->hasMany('App\Comment')->orderBy('created_at');
    }
    public function category()
    {
      return $this->belongsTo('App\Category');
    }
    public function likes()
    {
      return $this->hasMany('App\Like');
    }
    
}
