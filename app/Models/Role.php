<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    const ADMIN_ID = 1;
    const CUSTOMER_ID = 2;

    public function users(){
        return $this->hasMany('App\User');
    }

}
