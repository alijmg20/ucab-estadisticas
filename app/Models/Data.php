<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $fillable = ['value','register_id','project_id','variable_id'];
    public $timestamps = false;
    
    //Relacion uno a muchos con Variable(inversa)
    public function variable()
    {
        return $this->belongsTo(Variable::class);
    }

    //Relacion uno a muchos con register(inversa)
    public function register()
    {
        return $this->belongsTo(Register::class);
    }

}
