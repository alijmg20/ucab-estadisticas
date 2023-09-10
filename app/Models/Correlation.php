<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correlation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function variables()
    {
        return $this->belongsToMany(Variable::class, 'correlation_variable');
    }
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}