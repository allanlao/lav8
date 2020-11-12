<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Training;
use App\Models\Employee;
use Inertia\Inertia;



class TrainingController extends Controller
{
    public function index()
    {
  
    
       $data = Training::with(['employee.school','employee.position'])
        ->get();

        return Inertia::render('Trainings/Index', ['data' => $data]);

    }

    public function create($id)
    {

        $trainings = Training::where('employee_id',$id)->get();
        $employee = Employee::with(['school','position'])->find($id);
        return Inertia::render('Trainings/Create',['employee'=>$employee,'trainings'=>$trainings]);

    }

    public function store(Request $request)
    {
   

        $validatedData = $request->validate([

            'employee_id' => 'required|max:50',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'type' => 'required|max:50',
            'title' => 'required|max:100',
            'sponsor' => 'required|max:100',
          
            'hours' =>  'required|numeric|min:1',
           
            'encoded_by' => 'required',
          
        ]);

       $result =  Training::create($validatedData);
       return back()->with('success', 'Training created successfully.');
     // return Redirect::route('leaves.create');
        
    }



}
