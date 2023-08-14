<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Choice extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    public $timestamps = false;
    use SoftDeletes; // Agrega esta línea
    //Relacion uno a muchos con projects(proyectos)
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
