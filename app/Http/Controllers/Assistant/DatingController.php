<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Dating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DatingController extends Controller
{
    public function index()
    {
        $datings = Dating::paginate(10);
        return view('assistant.dating.index', compact('datings'));
    }

    public function create()
    {
        $users = User::where('rol_id', 2)->get();
        return view('assistant.dating.create', compact('users'));
    }

    public function store(Request $request)
    {
        $customer = Customer::where('user_id',$request->user_id)->first();
        $dating = new Dating();
        $dating->dating_time = $request->dating_time;
        $dating->name = $request->name;
        $dating->description = $request->description;
        $dating->customer_id = $customer->id;
        $dating->save();

        return redirect('/admin/citas')->with('success', 'Cita creada correctamente');
    }

    public function edit($id)
    {
        $users = User::where('rol_id', 2)->get();
        $date = Dating::find($id);
        return view('assistant.dating.edit', compact('users', 'date'));
    }

    public function update(Request $request, $id)
    {
        $dating = Dating::find($id);
        $dating->customer_id = $request->user_id;
        $dating->dating_time = Carbon::parse($request->dating_time)->format('Y-m-d\TH:i');
        $dating->name = $request->name;
        $dating->description = $request->description;
        $dating->save();

        return redirect('/admin/citas')->with('success', 'Cita actualizada correctamente');
    }
}
