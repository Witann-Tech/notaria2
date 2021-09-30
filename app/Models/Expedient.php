<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedient extends Model
{
    //use HasFactory;
    protected $fillable = ['description', 'user_id', 'customer_id'];

    public function User(){
        return $this->hasOne(User::class, "id");
    }

    public function Customer(){
        return $this->hasOne(Customer::class, 'id');
    }

    public function CustomerUserInfo(){//TODO: verificar que esta relacion este bien  
        return $this->hasOneThrough(
            User::class, Customer::class, 'user_id', 'id', 'id', 'user_id'
        );
    }
}
