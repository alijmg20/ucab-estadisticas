<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    
    //Relacion uno a muchos con projects(proyectos)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    //relacion uno a muchos con Data(datos)
    public function data()
    {
        return $this->hasMany(Data::class);
    }

}
