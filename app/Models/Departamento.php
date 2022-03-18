<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
class Departamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cpf',
        'user',
        'descricao',
        'dt_cadastro',
        'departamento',
        
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }
}
