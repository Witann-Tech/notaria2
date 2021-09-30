<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalitieStep extends Model
{
    protected $fillable = ['formalitie_id', 'formalitie_type_step_id', 'step_status_id'];

    public function Formalitie() {
        return $this->belongsTo(Formalitie::class);
    }

    public function Step(){
        return $this->hasOne(FormalitieTypeSteps::class, 'id', 'formalitie_type_step_id');
    }

    public function Status(){
        return $this->hasOne(StepStatus::class, 'id', 'step_status_id');
    }
}
