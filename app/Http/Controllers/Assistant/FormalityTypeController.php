<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\FormalityType;
use App\Models\FormalityTypeStep;
use App\Models\FormalityTypeStepDocument;
use App\Models\FormalityTypeStepParticipant;
use App\Models\User;

class FormalityTypeController extends Controller
{
    public function index()
    {
        $formalities = FormalityType::paginate(10);
        return view('assistant.formalityTypes.index', compact('formalities'));
    }

    public function create()
    {
        $documents = Document::all();
        $participants = User::where('rol_id', 2)->get();
        return view('assistant.formalityTypes.create', compact('documents', 'participants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required'=>'El nombre es requerido',
            'description.required'=>'La descripción es requerida',
        ]);

        $formalityType = new FormalityType();
        $formalityType->name = $request->name;
        $formalityType->description = $request->description;
        $formalityType->save();

        /*foreach ($request->step_name as $key => $sname) {
            $fStep = new FormalityTypeStep();
            $fStep->formality_type_id = $formalityType->id;
            $fStep->name = $request->step_name[$key];
            $fStep->description = $request->step_description[$key];
            $fStep->days = $request->step_days[$key];
            $fStep->save();

            if ($request->step_documents[$key] !== NULL) {
                $docs = explode(",", $request->step_documents[$key]);
                foreach ($docs as $doc) {
                    $fDoc = new FormalityTypeStepDocument();
                    $fDoc->formality_type_step_id = $fStep->id;
                    $fDoc->document_id = $doc;
                    $fDoc->save();
                }
            }

            if ($request->step_participants[$key] !== NULL) {
                $parts = explode(",", $request->step_participants[$key]);
                foreach ($parts as $part) {
                    $fPart = new FormalityTypeStepParticipant();
                    $fPart->formality_type_step_id = $fStep->id;
                    $fPart->participant_id = $part;
                    $fPart->save();
                }
            }
        }*/

        return redirect('/admin/tipos-de-tramites/'.$formalityType->id.'/etapas')->with("success", "Tipo de tramite creado correctamente.");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'step_name' => 'required|array',
            'step_description' => 'required|array',
            'step_days' => 'required|array',
        ], []);

        $formalityType = FormalityType::findOrFail($id);
        $formalityType->name = $request->name;
        $formalityType->description = $request->description;
        $formalityType->save();

        foreach ($formalityType->steps as $step) {

            try {
                if ($step->documents()->exists())
                    $step->documents()->delete();

                if ($step->participants()->exists())
                    $step->participants()->delete();
            } catch (\Throwable $th) {
                //throw $th;
            }


            $step->delete();
        }

        foreach ($request->step_name as $key => $sname) {
            $fStep = new FormalityTypeStep();
            $fStep->formality_type_id = $formalityType->id;
            $fStep->name = $request->step_name[$key];
            $fStep->description = $request->step_description[$key];
            $fStep->days = $request->step_days[$key];
            $fStep->save();

            if ($request->step_documents[$key] !== NULL) {
                $docs = explode(",", $request->step_documents[$key]);
                foreach ($docs as $doc) {
                    $fDoc = new FormalityTypeStepDocument();
                    $fDoc->formality_type_step_id = $fStep->id;
                    $fDoc->document_id = $doc;
                    $fDoc->save();
                }
            }

            if ($request->step_participants[$key] !== NULL) {
                $parts = explode(",", $request->step_participants[$key]);
                foreach ($parts as $part) {
                    $fPart = new FormalityTypeStepParticipant();
                    $fPart->formality_type_step_id = $fStep->id;
                    $fPart->participant_id = $part;
                    $fPart->save();
                }
            }
        }

        return redirect('/admin/tipos-de-tramites')->with("success", "Tipo de tramite actualizado correctamente.");
    }

    public function edit($id)
    {
        $formality = FormalityType::findOrfail($id);
        $documents = Document::all();
        $participants = User::where('rol_id', 2)->get();
        return view('assistant.formalityTypes.edit', compact('formality', 'documents', 'participants'));
    }
}
