<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\FormalityType;
use App\Models\FormalityTypeStep;
use App\Models\FormalityTypeStepParticipant;
use App\Models\FormalityTypeStepParticipantDocument;
use Illuminate\Http\Request;

class FormalityTypeStepController extends Controller
{
    public function index($formalityId)
    {
        $documents = Document::all();
        $formality = FormalityType::find($formalityId);
        return view('assistant.formalityTypeSteps.create', compact('formality', 'documents'));
    }

    public function store(Request $request, $formalityId)
    {
        $formality = FormalityType::find($formalityId);

        $step = new FormalityTypeStep();
        $step->formality_type_id = $formalityId;
        $step->name = $request->name;
        $step->description = $request->description;
        $step->days = $request->limit_days;
        $step->save();

        foreach ($request->participants as $key => $participant) {
            $part = new FormalityTypeStepParticipant();
            $part->formality_type_id = $formalityId;
            $part->formality_type_step_id = $step->id;
            $part->name = $participant;
            $part->save();
            
            $docs = explode(",", $request->documents[$key]);
            foreach ($docs as $doc) {
                $document = new FormalityTypeStepParticipantDocument();
                $document->formality_type_step_id = $step->id;
                $document->formality_type_step_participant_id = $part->id;
                $document->document_id = $doc;
                $document->save();
            }
        }
        return response()->json(["all"=>$request->all()], 200);
    }

    public function show(Request $request, $formalityId, $id)
    {
        if($request->wantsJson()){
            $step = FormalityTypeStep::where('id', $id)->with('participants')->first();
            foreach ($step->participants as $key => $participant) {
                $participant->documents;
            }
            return response()->json(["step"=>$step],200);
        }
    }

    public function update(Request $request, $formalityId, $id)
    {
        $formality = FormalityType::find($formalityId);

        $step = FormalityTypeStep::find($id);
        $step->name = $request->name;
        $step->description = $request->description;
        $step->days = $request->limit_days;
        $step->save();

        if($step->participants()->exists())
        {
            foreach ($step->participants as $key => $parti) {
                $parti->documents()->delete();
            }
            $parti->delete();
        }

        foreach ($request->participants as $key => $participant) {
            $part = new FormalityTypeStepParticipant();
            $part->formality_type_id = $formalityId;
            $part->formality_type_step_id = $step->id;
            $part->name = $participant;
            $part->save();
            
            $docs = explode(",", $request->documents[$key]);
            foreach ($docs as $doc) {
                $document = new FormalityTypeStepParticipantDocument();
                $document->formality_type_step_id = $step->id;
                $document->formality_type_step_participant_id = $part->id;
                $document->document_id = $doc;
                $document->save();
            }
        }
        return response()->json(["all"=>$request->all()], 200);

    }
}
