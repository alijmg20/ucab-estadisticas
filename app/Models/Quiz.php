<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muchos con projects(proyectos)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    //Relacion uno a muchos con preguntas(inversa)
    public function questions()
    {
        return $this->hasMany(Question::class);
    }    

    public function getRouteKeyName()   
    {
        return 'slug';
    }

}
