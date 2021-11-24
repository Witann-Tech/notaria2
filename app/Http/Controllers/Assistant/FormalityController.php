<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Formalitie;
use App\Models\FormalityType;
use App\Models\User;
use Illuminate\Http\Request;

class FormalityController extends Controller
{
    public function index(){
        $formalities = Formalitie::paginate(10);
        return view('assistant.formalities.index', compact('formalities'));
    }
    
    public function create()
    {
        $users = User::where('rol_id', 2)->get();
        $types = FormalityType::all();
        return view('assistant.formalities.create', compact('types', 'users'));
    }
    public function store(Request $request){
        $formalityType = FormalityType::find($request->formalitie_type_id);
        $formality = new Formalitie();
        $formality->name = $request->name;
        $formality->description = $request->name;
        $formality->user_id = $request->user_id;
        $formality->formalitie_type_id = $request->formalitie_type_id;
        $formality->status_id = $formalityType->steps[0]->id;
        $formality->expedient_id = 1;
        $formality->save();

        return redirect('/admin/tramites')->with('success', 'Tramite guardado correctamente');

    }
    
    public function edit($id)
    {
        $formality = Formalitie::find($id);
        $users = User::where('rol_id', 2)->get();
        $types = FormalityType::all();
        return view('assistant.formalities.edit', compact('formality', 'types', 'users'));
    }

    public function update(Request $request, $id)
    {
        $formality = Formalitie::find($id);
        $formality->name = $request->name;
        $formality->description = $request->name;
        $formality->user_id = $request->user_id;
        $formality->formalitie_type_id = $request->formalitie_type_id;
        $formality->status_id = $request->status_id;
        $formality->save();

        return redirect('/admin/tramites')->with('success', 'Tramite actualizado correctamente');
    }
}
