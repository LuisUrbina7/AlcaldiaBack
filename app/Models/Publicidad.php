<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    use HasFactory;
    protected $table = 'publicidades';
    protected $fillable = [
        'responsable',  'enlace','banner','fecha','idUsuario'
    ];
    public function Usuarios(){
        return $this->belongsTo(User::class,'idUsuario');
    }
}
