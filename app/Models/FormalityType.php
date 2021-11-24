<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalityType extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description'];

    public function steps(){
        return $this->hasMany('App\Models\FormalityTypeStep');
    }
}
