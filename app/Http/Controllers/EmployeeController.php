<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::with(['department', 'role', 'shift'])->get();

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
            'firstname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'lastname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'email' => ['required', 'unique:employees,email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'dob' => ['required', 'before:-18 years'],
            'phone' => ['required', 'regex:/((98)|(97))(\d){8}/'],
            'department_id' => ['required', 'exists:departments,id'],
            'role_id' => ['required', 'exists:roles,id'],
            'designation' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'address' => ['required'],
            'image' => ['required', 'image'],
            'citizenship_number' => ['required', 'regex:/^[0-9]{1,}[0-9-]{1,}[0-9]$/'],
            'pan_number' => ['required', 'numeric'],
            'joining_date' => ['required', 'after_or_equal:now'],
            'salary' => ['required', 'numeric', 'gt:0'],
            'shift_id' => ['required'],
        ]);

        $name = Str::random(20);
        $ext = $request->file('image')->extension();

        $image_name = $name . "." . $ext;

        $request->file('image')->storeAs('public/images/employees', $image_name);

        $data['image'] = "images/employees/" . $image_name;

        $data['password'] = bcrypt($request->password);
        $user = User::create([
            'name' => $data['firstname'] . " " . $data['lastname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'Employee',
        ]);

        $data['user_id'] = $user->id;
        Employee::create($data);
        return response()->json(['message' => 'Employee added sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employee->load(['department', 'role', 'shift']);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'firstname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'lastname' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'email' => ['required', 'unique:employees,email,' . $employee->id, 'unique:users,email,' . $employee->user_id],
            'phone' => ['required', 'regex:/((98)|(97))(\d){8}/'],
            'department_id' => ['required', 'exists:departments,id'],
            'role_id' => ['required', 'exists:roles,id'],
            'designation' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'address' => ['required'],
            'citizenship_number' => ['required', 'regex:/^[0-9]{1,}[0-9-]{1,}[0-9]$/'],
            'pan_number' => ['required', 'numeric'],
            'joining_date' => ['required', 'after_or_equal:now'],
            'salary' => ['required', 'numeric', 'gt:0'],
            'shift_id' => ['required'],
        ]);


        if ($request->hasFile('image')) {
            if ($request->image !== $employee->image) {
                $request->validate([
                    'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
                ]);
                $name = Str::random(20);
                $ext = $request->file('image')->extension();

                $image_name = $name . "." . $ext;

                $request->file('image')->storeAs('public/images/employees', $image_name);
                $data['image'] = "images/employees/" . $image_name;
                Storage::delete($employee->image);
            }
        }

        if ($employee->dob !== $request->dob) {
            $request->validate([
                'dob' => ['required', 'before:-18 years'],
            ]);

            $data['dob'] = $request->dob;
        }

        if ($employee->email !== $request->email) {
            $request->validate([
                'email' => ['required', 'unique:employees,email,' . $employee->id, 'unique:users,email,' . $employee->user_id],
            ]);
            $data['email'] = $request->email;
            $userdata['email'] = $request->email;
        }

        $userdata['name'] =  $data['firstname'] . " " . $data['lastname'];
        //getting user id from employee table
        $user = User::find($employee->user_id);
        //assigning email with data['email'] 
        DB::transaction(function () use ($data, $userdata, $user, $employee) {
            $user->update($userdata);
            $employee->update($data);
        });




        // $user = User::find($employee->user_id);
        // $u = ["email" => $data['email']];
        // DB::transaction(function () use ($data, $u, $user, $employee) {
        //     $user->update($u);
        //     $employee->update($data);
        // });


        return response()->json(['message' => 'Employee updated sucessfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        Storage::delete($employee->image);
        return response()->json(['message' => 'Employee deleted sucessfully']);
    }
}
