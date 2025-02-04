<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [
        'id','created_at','updated_at'
    ];
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class);
       }

       public function category(){
        return $this->belongsTo(Category::class);
       }


       public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);

       }
       public function image(){
        return $this->morphOne(Image::class,'imageable');
       }
}


