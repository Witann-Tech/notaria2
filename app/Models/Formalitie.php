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

    public function Type(){
        return $this->hasOne(FormalitieType::class, "id", "formalitie_type_id");
    }

    public function Expedient(){
        return $this->hasOne(Expedient::class,  'id', 'expedient_id');
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
