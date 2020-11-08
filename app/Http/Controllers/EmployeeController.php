<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\School;
use App\Models\LeaveCredit;
use App\Models\LeaveCoc;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    //

    public function index()
    {
    

      //  $data = Employee::select('id', 'firstname', 'lastname', 'school_id', 'position_id', 'firstname')
       //     ->with(['school', 'position'])->get();

   
       $data = Employee::select('id', 'firstname', 'lastname', 'school_id', 'position_id', 'firstname')
          ->with(['school', 'position'])->get();

        return Inertia::render('Employees/Index', ['data' => $data]);
    }

    public function create()
    {

        $positions = Position::all();
        $schools = School::all();
        return Inertia::render('Employees/Create', ['schools' => $schools, 'positions' => $positions]);
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

        Employee::updateOrCreate(['id'=>$request->id],$validatedData);

        return redirect()->route('employees')->with('success', 'Employee updated.');
    }

    public function update($id)
    {

        $positions = Position::all();
        $schools = School::all();
        $employee = Employee::find($id);
        return Inertia::render('Employees/Edit', ['schools' => $schools, 'positions' => $positions, 'employee' => $employee]);
    }

    public function delete($id){
        Employee::find($id)->delete();
        return redirect()->route('employees');
    }

    public function show($id){
        $employee = Employee::with('school','position')->find($id);

        $credits = LeaveCredit::where('employee_id',$id)->get();
        $leaves = Leave::where('employee_id',$id)->get();
        $cocs = LeaveCoc::where('employee_id',$id)->get();


        


        return Inertia::render('Employees/Show', ['employee' => $employee, 'credits'=>$credits,'leaves'=>$leaves,'cocs'=>$cocs]);
    }
}
