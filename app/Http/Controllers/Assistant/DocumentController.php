<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::paginate(10);
        return view('assistant.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assistant.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'acceptable_formats'=>'required',
            'expiration_range'=>'required'
        ],[
            'name.required'=>'El nombre es requerido',
            'acceptable_formats.required'=>'Los formatos aceptables son requeridos',
            'expiration_range.required'=>'El limite de caducidad es requerido',
        ]);        
        Document::create($request->all());
        return redirect('/admin/documentos')->with('success', 'Tipo de documento creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('assistant.documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        $document->name = $request->name;
        $document->description = $request->description;
        $document->acceptable_formats = $request->acceptable_formats;
        $document->expiration_range = $request->expiration_range;
        $document->save();
        return redirect('/admin/documentos')->with('message', 'Documento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Document::destroy($id);
        return redirect('/admin/documentos')->with('success', 'Tipo de documento eliminado correctamente');
    }
}
