<?php

namespace App\Http\Controllers\Assistant;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DataTables\CustomersDataTable;
use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use Illuminate\Support\Facades\Redirect;

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
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomer $request)
    {
        $user = new User();
        $user->rol_id = Role::CUSTOMER_ID;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($user->email);
        $user->save();

        $customer = new Customer();
        $customer->lastname = $request->lastname;
        $customer->birthplace = $request->birthplace;
        $customer->birthdate = $request->birthdate;
        $customer->adress = $request->adress;
        $customer->phone = $request->phone;
        $customer->curp = $request->curp;
        $customer->rfc = $request->rfc;
        $customer->job = $request->job;
        $customer->civil_status = $request->civil_status;
        $customer->user_id = $user->id;
        $customer->save();
        return redirect('customers')->with('message', 'Cliente creado correctamente');
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
        $customer = Customer::with('user')->where('id', $id)->first();
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomer $request, $id)
    {
        $customer = Customer::find($id);
        $customer->lastname = $request->lastname;
        $customer->birthplace = $request->birthplace;
        $customer->birthdate = $request->birthdate;
        $customer->adress = $request->adress;
        $customer->phone = $request->phone;
        $customer->curp = $request->curp;
        $customer->rfc = $request->rfc;
        $customer->job = $request->job;
        $customer->civil_status = $request->civil_status;
        $customer->save();
        $user = User::find($customer->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('customers')->with('message', 'Cliente actualizado correctamente');
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
        return redirect('customers')->with('message', 'Cliente eliminado correctamente');
    }
}
