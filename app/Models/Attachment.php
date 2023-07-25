<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muchos con projects(proyectos)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

}
