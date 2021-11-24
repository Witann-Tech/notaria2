<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formalitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'expedient_id', 'formalitie_type_id', 'user_id'
    ];

    public function type(){
        return $this->belongsTo('App\Models\FormalityType', 'formalitie_type_id', 'id');
    }

    public function status(){
        return $this->belongsTo('App\Models\FormalityTypeStep', 'status_id', 'id');
    }

    public function Expedient(){
        return $this->hasOne(Expedient::class,  'id', 'expedient_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /* public function Responsible(){
        return $this->hasOneThrough(
            User::class, Expedient::class, 'customer_id', 'id', 'expedient_id', 'customer_id'
        );
    }

    public function Customer(){
        return $this->hasOneThrough(
            Customer::class, Expedient::class, 'customer_id', 'id', 'expedient_id', 'customer_id'
        );
    } */

}
