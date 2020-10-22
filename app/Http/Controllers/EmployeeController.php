<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Models\Employee;
use App\Models\Position;
use App\Models\School;

class EmployeeController extends Controller
{
    //

    public function index()
    {
        //$data = Employee::with('schools','positions')->get();

      /*  $data = Employee::select('id', 'firstname', 'lastname', 'school_id','firstname')
            ->with(['school' => function ($query) {
            $query->select('id', 'name');
        }])->get();*/

        $data = Employee::select('id', 'firstname', 'lastname', 'school_id','position_id','firstname')
            ->with(['school','position'])->get();

     //  dd($data);
        return Inertia::render('Employees/Index',['data'=>$data]);
    }

    public function create()
    {

        $positions = Position::all();
        $schools = School::all();
        return Inertia::render('Employees/Create',['schools'=>$schools,'positions'=>$positions]);
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
                'gender' => 'nullable',
                'birthday' => 'nullable|date',  

            ]); 

            Employee::create($validatedData);
            

            return redirect()->route('employees');
    }
}

