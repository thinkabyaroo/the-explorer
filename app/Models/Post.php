<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function galleries(){
        return $this->hasMany(Gallery::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'category_posts')->withPivot("id","created_at");
    }

}
