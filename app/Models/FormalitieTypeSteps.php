<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalitieTypeSteps extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'formalitie_type_id',
        'days',
        'min_days',
        'max_days',
        'aprobation_type_id'
    ];

    public function Documents() {
        return $this->hasManyThrough(
            Document::class,
            FormalityTypeStepDocument::class,
            'formality_type_step_id',
            'id',
            'id',
            'document_id'
        );
    }

    public function Aprobation() {
        return $this->belongsTo(AprobationType::class, "aprobation_type_id");
    }

    public function Participants() {
        return $this->hasManyThrough(
            ParticipantType::class,
            FormalitieTypeStepParticipant::class,
            'step_id',
            'id',
            'id',
            'participant_type_id'
        );
    }

}
