<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalityTypeStepDocument extends Model
{
    //use HasFactory;

    protected $fillable = ["formality_type_step_id","document_id"];
}
