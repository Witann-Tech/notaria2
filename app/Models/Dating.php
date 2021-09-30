<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dating extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="datings";

    protected $fillable = [
        'id',
        'name',
        'description',
        'customer_id',
        'dating_time'
    ];

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
}
