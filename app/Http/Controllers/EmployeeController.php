<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveCoc;
use App\Models\LeaveCredit;
use App\Models\Position;
use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    //

    public function index()
    {

        $positions = Position::orderBy('name')->get();
        $schools = School::orderBy('name')->get();
        $data = Employee::orderBy('lastname')->with(['school', 'position'])->get();

        return Inertia::render('Employees/Index', ['data' => $data, 'schools' => $schools, 'positions' => $positions]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'id' => 'required|max:100',
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'nullable|max:50',
            'gender' => 'nullable',
            'birthday' => 'nullable|date',
            'civil_status' => 'nullable',
            'school_id' => 'required',
            'gsis_no' => 'nullable',
            'tin' => 'nullable',
            'position_id' => 'required',
            'email' => 'nullable|max:50|email',
            'employment_status' => 'required',
            'entrance_to_duty' => 'nullable:date',
            'mobile' => 'nullable',
            'gender' => 'required',
            'birthday' => 'nullable|date',

        ]);

        Employee::updateOrCreate(['id' => $request->id], $validatedData);
        return back()->with('success', 'Employee created/updated successfully.');

    }

    public function destroy($id)
    {
        try {
            Employee::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {

        }

        return back()->with('success', 'Employee deleted successfully.');

    }

    public function show($id)
    {
        $employee = Employee::with('school', 'position')->find($id);

        $credits = LeaveCredit::where('employee_id', $id)->get();
        $leaves = Leave::where('employee_id', $id)->get();
        $cocs = LeaveCoc::where('employee_id', $id)->get();

        return Inertia::render('Employees/Show', ['employee' => $employee, 'credits' => $credits, 'leaves' => $leaves, 'cocs' => $cocs]);
    }
}
