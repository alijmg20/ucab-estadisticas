<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariableResponse extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    public function variable()
    {
        return $this->belongsTo(Variable::class);
    }

    public function variableOption()
    {
        return $this->belongsTo(VariableOption::class);
    }

    public function register()
    {
        return $this->belongsTo(Register::class);
    }
}
