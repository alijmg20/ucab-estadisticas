<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function file()
    {
        return $this->belongsTo(Variable::class);
    }

    public function graphicType()
    {
        return $this->belongsTo(Graphictype::class);
    }

    public function variableType()
    {
        return $this->belongsTo(Variabletype::class);
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }

    public function frequencies()
    {
        return $this->hasMany(frequency::class);
    }

    public function sensibilities(){
        return $this->hasMany(Sensibility::class);
    }
}
