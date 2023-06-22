<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','slug','status'];

    //Relacion uno a muchos con projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function image(){
        return $this->morphOne(image::class,'imageable');
    }

    public function getRouteKeyName()   
    {
        return 'slug';
    }

}
