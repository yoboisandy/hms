<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Department::with('employees', 'roles')->get();

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
            'name' => ['required', 'unique:departments,name'],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        DB::transaction(function () use ($data, $request) {
            $dept = Department::create($data);
            $dept->roles()->sync($request->roles);
        });


        return response()->json(['message' => 'Department added sucessfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {

        $department->load('roles');
        return response()->json($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:departments,name,' . $department->id],
            'roles' => ['required', 'array'],
            // 'roles.*' => ['exists:roles,id'],
        ]);

        DB::transaction(function () use ($data, $request, $department) {
            $department->update([
                "name" => $request->name
            ]);
            $department->roles()->sync($request->roles);
        });

        return response()->json(['message' => 'Department updated sucessfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json(['message' => 'Department deleted sucessfully']);
    }
}
