<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    //Relacion uno a muchos inversa
    public function data()
    {
        return $this->belongsTo(Data::class);
    }

}
