<?php

namespace App\Http\Controllers\Assistant;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('assistant.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assistant.customers.create');
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
            'lastname'=>'required',
            'email' => 'required|unique:users,email',
            'birthdate'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'curp'=>'required',
            'rfc'=>'required',
            'job'=>'required',
            'civil_status'=>'required',
        ],[
            'name.required'=>'El campo nombre es requerido',
            'lastname.required'=>'El campo apellidos es requerido',
            'birthdate.required'=>'El campo fecha de nacimiento es requerido',
            'address.required'=>'El campo domicilio es requerido',
            'phone.required'=>'El campo teléfono es requerido',
            'curp.required'=>'El campo CURP es requerido',
            'rfc.required'=>'El campo RFC es requerido',
            'job.required'=>'El campo ocupación es requerido',
            'civil_status.required'=>'El campo estado civil es requerido',
            'email.required'=>'El campo email es requerido',
            'email.unique'=>'Este email ya ha sido registrado',
            'rfc.unique'=>'Este RFC ya ha sido registrado',
            'curp.unique'=>'Esta CURP ya ha sido registrada',
        ]);

        $user = new User();
        $user->rol_id = Role::CUSTOMER_ID;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->lastname = $request->lastname;
        $customer->birthdate = date('Y-m-d', strtotime($request->birthplace));
        $customer->address = $request->adress;
        $customer->phone = $request->phone;
        $customer->curp = $request->curp;
        $customer->rfc = $request->rfc;
        $customer->job = $request->job;
        $customer->civil_status = $request->civil_status;
        $customer->user_id = $user->id;
        if($customer->save()){
            try {
                Mail::to($customer->email)->send(new Welcome($customer));
            } catch (\Throwable $th) {
                
            }
            return redirect('customers')->with('success', 'Cliente creado correctamente');
        }else{
            return redirect('customers')->with('error', 'Hubo un problema, intentelo mas tarde.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('assistant.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'lastname'=>'required',
            'email' => ['required'],
            'birthdate'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'curp'=>['required'],
            'rfc'=>['required'],
            'job'=>'required',
            'civil_status'=>'required',
        ],[
            'name.required'=>'El campo nombre es requerido',
            'lastname.required'=>'El campo apellidos es requerido',
            'birthday.required'=>'El campo fecha de nacimiento es requerido',
            'address.required'=>'El campo domicilio es requerido',
            'phone.required'=>'El campo teléfono es requerido',
            'curp.required'=>'El campo CURP es requerido',
            'rfc.required'=>'El campo RFC es requerido',
            'job.required'=>'El campo ocupación es requerido',
            'civil_status.required'=>'El campo estado civil es requerido',
            'email.required'=>'El campo email es requerido',
            'email.unique'=>'Este email ya ha sido registrado',
            'rfc.unique'=>'Este RFC ya ha sido registrado',
            'curp.unique'=>'Esta CURP ya ha sido registrada',
        ]);

        $customer = Customer::find($id);
        $customer->lastname = $request->lastname;
        $customer->birthdate = date('Y-m-d', strtotime($request->birthdate));
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->curp = $request->curp;
        $customer->rfc = $request->rfc;
        $customer->job = $request->job;
        $customer->civil_status = $request->civil_status;
        $customer->save();

        $user = User::find($customer->user_id);
        $user->name = $request->name;
        $user->save();

        return redirect('/admin/clientes')->with('message', 'Cliente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $user_id = $customer->user_id;
        $customer->delete();
        User::destroy($user_id);
        return redirect('/admin/clientes')->with('message', 'Cliente eliminado correctamente');
    }
}
