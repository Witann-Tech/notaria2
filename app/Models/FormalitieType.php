<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalitieType extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description'];

    public function Steps(){
        return $this->hasMany('App\Models\FormalitieTypeSteps');
    }
}
