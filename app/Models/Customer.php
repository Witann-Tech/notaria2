<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "customers";
    protected $fillable = [
        'id',
        'lastname',
        'birthplace',
        'birthdate',
        'adress',
        'phone',
        'curp',
        'rfc',
        'job',
        'civil_status',
        'user_id'
    ];

    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
