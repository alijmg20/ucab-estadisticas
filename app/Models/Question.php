<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Question extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    public $timestamps = false;
    use SoftDeletes; // Agrega esta línea
    //Relacion uno a muchos con projects(proyectos)
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    //Relacion uno a muchos con opciones(inversa)
    public function choices()
    {
        return $this->hasMany(Choice::class);
    } 
    //Relacion uno a muchos con opciones(inversa)
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
