<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function file(){
        return $this->belongsTo(File::class);
    }

    public function variableResponses()
    {
        return $this->hasMany(VariableResponse::class);
    }

}
