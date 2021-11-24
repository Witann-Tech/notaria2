<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalityTypeStepParticipantDocument extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function document()
    {
        return $this->belongsTo('App\Models\Document');
    }
}
