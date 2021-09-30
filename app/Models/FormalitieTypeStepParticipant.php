<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalitieTypeStepParticipant extends Model
{
    protected $fillable = ['quantity', 'step_id', 'participant_type_id', 'formalitie_type_id'];
    
    public function Participants() {
        return $this->belongsTo(ParticipantType::class, "participant_type_id");
    }
}
