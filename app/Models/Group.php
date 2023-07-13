<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    
    //Relacion uno a muchos inversa
    public function variable()
    {
        return $this->belongsTo(Variable::class);
    }

}
