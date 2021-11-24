<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalityTypeStepParticipant extends Model
{
    public $timestamps = false;

    protected $fillable = ['quantity', 'step_id', 'participant_type_id', 'formality_type_id'];
    
    /*public function Participants() {
        return $this->belongsTo(ParticipantType::class, "participant_type_id");
    }*/

    public function documents()
    {
        return $this->hasMany('App\Models\FormalityTypeStepParticipantDocument', 'formality_type_step_participant_id', 'id');
    }
}
