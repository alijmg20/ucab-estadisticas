<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combination extends Model
{
    use HasFactory;

    public function variables()
    {
        return $this->belongsToMany(Variable::class, 'combination_variable');
    }
}
