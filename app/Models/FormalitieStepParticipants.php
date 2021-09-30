<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalitieStepParticipants extends Model
{
    protected $fillable = ['formalitie_id', 'step_id', 'user_id', 'customer_id'];
}
