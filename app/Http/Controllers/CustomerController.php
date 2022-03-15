<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::orderBy('id', 'desc')->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => ['required', 'alpha'],
            'lastname' => ['required', 'alpha'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'address' => ['required'],
            'password' => ['required', 'min:8'],
            'citizenship_number' => ['required', 'integer',  'gt:0', 'digits:10', 'regex:/(\d){10}/'],
        ]);
        $data['password'] = bcrypt($request->password);
        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'Customer',
        ]);
        $data['user_id'] = $user->id;
        Customer::create($data);

        return response()->json(['message' => 'Customer added sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'firstname' => ['required', 'alpha'],
            'lastname' => ['required', 'alpha'],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'address' => ['required'],
            'citizenship_number' => ['required', 'integer',  'gt:0', 'digits:10', 'regex:/(\d){10}/'],
        ]);

        if ($customer->email != $request->email) {
            $data = $request->validate([
                'email' => ['required', 'email', 'unique:customers,email'],
            ]);
        }

        $user = User::find($customer->user_id);
        $u = ['email' => $data['email']];
        DB::transaction(function () use ($user, $u, $data, $customer) {
            $user->update($u);
            $customer->update($data);
        });

        return response()->json(['message' => 'Customer updated sucessfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Customer deleted sucessfully']);
    }
}
