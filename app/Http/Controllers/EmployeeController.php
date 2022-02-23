<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



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
        dd($data);
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
            'email' => ['required', 'unique:employees,email'],
            'password' => ['required', 'min:8'],
            'dob' => ['required'],
            'phone' => ['required'],
            'department_id' => ['required'],
            'role_id' => ['required'],
            'designation' => ['required', 'alpha'],
            'address' => ['required',],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'citizenship_number' => ['required'],
            'pan_number' => ['required'],
            'joining_date' => ['required', 'before_or_equal:now'],
            'salary' => ['required', 'numeric'],
            'shift_id' => ['required'],
        ]);

        $name = Str::random(20);
        $ext = $request->file('image')->extension();

        $image_name = $name . "." . $ext;

        $data['image'] = $request->file('image')->storeAs('public/images/employees', $image_name);

        $data['password'] = bcrypt($request->password);

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
            'firstname' => ['required', 'alpha'],
            'lastname' => ['required', 'alpha'],
            'email' => ['required', 'unique:employees,email'],
            'password' => ['required', 'min:8'],
            'dob' => ['required'],
            'phone' => ['required'],
            'department_id' => ['required'],
            'role_id' => ['required'],
            'designation' => ['required', 'alpha'],
            'address' => ['required'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'citizenship_number' => ['required'],
            'pan_number' => ['required'],
            'joining_date' => ['required', 'before_or_equal:now'],
            'salary' => ['required', 'numeric'],
            'shift_id' => ['required'],
        ]);

        $name = Str::random(20);
        $ext = $request->file('image')->extension();

        $image_name = $name . "." . $ext;

        $data['image'] = $request->file('image')->storeAs('public/images/employees', $image_name);


        $data['password'] = bcrypt($request->password);

        $employee->update($data);

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

        return response()->json(['message' => 'Employee deleted sucessfully']);
    }
}
