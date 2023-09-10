<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function variables()
    {
        return $this->hasMany(Variable::class);
    }

    public function correlations()
    {
        return $this->hasMany(Correlation::class);
    }

    public function registers()
    {
        return $this->hasMany(Register::class);
    }
    
}
