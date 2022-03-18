<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'cpf',
        'author',
        'post',
    ];
    protected $dates = ['data_file'];

    public function images(){
        return $this->hasMany(Image::class);
    }
}
