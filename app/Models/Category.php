<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function posts(){
        return $this->hasMany(Post::class);
       } 
       public function category(){
        return $this->belongsTo(Category::class);
       } 
       public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
       } 


}