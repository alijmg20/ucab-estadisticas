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

    public function users()
    {
        return $this->belongsToMany(User::class, 'quiz_user', 'quiz_user_id');
    }

    public function getRouteKeyName()   
    {
        return 'slug';
    }

    public function quizUser()
    {
        return $this->hasMany(QuizUser::class);
    }

}
