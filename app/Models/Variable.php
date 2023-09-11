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
        return $this->belongsTo(File::class);
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
        return $this->hasMany(Frequency::class);
    }

    public function sensibilities(){
        return $this->hasMany(Sensibility::class);
    }

    public function options()
    {
        return $this->hasMany(VariableOption::class);
    }

    public function variableResponses()
    {
        return $this->hasMany(VariableResponse::class);
    }

    public function correlations()
    {
        return $this->belongsToMany(Correlation::class, 'correlation_variable');
    }

}
