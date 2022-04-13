<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function index()
    {
        $data = Customer::orderBy('id', 'desc')->get();
        return response()->json($data);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'lastname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'phone' => ['required', 'integer', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'address' => ['required'],
            'password' => ['required', 'min:8'],
            'citizenship_number' => ['required',  'regex:/^[0-9]{1,}[0-9-]{1,}[0-9]$/'],
        ]);
        $data['password'] = bcrypt($request->password);
        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['firstname'] . " " . $data['lastname'],
                'email' => $data['email'],
                'password' =>  $data['password'],
                'role' => 'Customer',
            ]);
            $data['user_id'] = $user->id;
            Customer::create($data);
        });

        return response()->json(['message' => 'Customer added sucessfully']);
    }


    public function show(Customer $customer)
    {
        return response()->json($customer);
    }


    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'firstname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'lastname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'phone' => ['required', 'integer', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'address' => ['required'],
            'citizenship_number' => ['required',  'regex:/^[0-9]{1,}[0-9-]{1,}[0-9]$/'],
        ]);


        if ($customer->email !== $request->email) {
            $request->validate([
                'email' => ['required', 'email', 'unique:customers,email,' . $customer->id]
            ]);
            $data['email'] = $request->email;
            $userdata['email'] = $request->email;
        }

        $userdata['name'] =  $data['firstname'] . " " . $data['lastname'];


        $user = User::find($customer->user_id);
        DB::transaction(function () use ($user, $userdata, $data, $customer) {
            $user->update($userdata);
            $customer->update($data);
        });

        return response()->json(['message' => 'Customer updated sucessfully']);
    }


    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Customer deleted sucessfully']);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'firstname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'lastname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'phone' => ['required', 'integer', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'address' => ['required'],
            'password' => ['required', 'min:8'],
            'citizenship_number' => ['required',  'regex:/^[0-9]{1,}[0-9-]{1,}[0-9]$/'],
        ]);
        $data['password'] = bcrypt($request->password);
        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['firstname'] . " " . $data['lastname'],
                'email' => $data['email'],
                'password' =>  $data['password'],
                'role' => 'Customer',
            ]);
            $data['user_id'] = $user->id;
            Customer::create($data);
        });

        return response()->json(['message' => 'Customer added sucessfully']);
    }
}
