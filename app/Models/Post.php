<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;

    //habiltar asigncion masiva 
    protected $fillable = ['title','content','image','user_id'];

     //realcion una a muchos  inversa

     public function user(){
        return $this->belongsTo(User::class);
    }
}
