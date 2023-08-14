<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muchos con attachment(inversa)
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }    

    //Relacion uno a muchos con quizzes(inversa)
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }    
    
    //Relacion uno a muchos con variable(inversa)
    public function variables()
    {
        return $this->hasMany(Variable::class);
    }    

    //Relacion uno a muchos con registros(inversa)
    public function registers()
    {
        return $this->hasMany(Register::class);
    }    

    //Relacion muchos a muchos con users
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    //Relacion uno a muchos con user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion uno a muchos con lines
    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    //relacion uno a uno polimorfica
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function getRouteKeyName()   
    {
        return 'slug';
    }

}
