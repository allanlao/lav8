<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Training;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrainingController extends Controller
{
    public function index(Request $request)
    {

        $level = $request->level;
        $type = $request->type;
        $sponsor = $request->sponsor;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $title = $request->title;
        $employee_id = $request->employee_id;
     


        $data = Training::with(['employee.school', 'employee.position'])
            ->when($level != null, function ($q) use ($level) {
                return $q->where('level', $level);
            })
            ->when($type != null, function ($q) use ($type) {
                return $q->where('type', $type);
            })
            ->when($sponsor != null, function ($q) use ($sponsor) {
                return $q->where('sponsor', $sponsor);
            })
            ->when($title != null, function ($q) use ($title) {
                return $q->where('title','like', $title .'%');
            })
            ->when($date_from != null, function ($q) use ($date_from) {
                return $q->where('date_from','>=' ,$date_from);
            })
            ->when($employee_id != null, function ($q) use ($employee_id) {
                return $q->where('employee_id',$employee_id);
            })
          


            ->get();


        $employees = Employee::orderBy('lastname')->get(['id','firstname','lastname']);    

        return Inertia::render('Trainings/Index', ['data' => $data,'employees'=>$employees]);

    }

    public function create($id)
    {

        $trainings = Training::where('employee_id', $id)->get();
        $employee = Employee::with(['school', 'position'])->find($id);
        return Inertia::render('Trainings/Create', ['employee' => $employee, 'trainings' => $trainings]);

    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            
            'employee_id' => 'required|max:50',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'type' => 'required|max:50',
            'level' => 'required|max:50',
            'title' => 'required|max:100',
            'sponsor' => 'required|max:100',

            'hours' => 'required|numeric|min:1',

            'encoded_by' => 'required',

        ]);

        $result = Training::updateOrCreate(['id'=> $request->id],$validatedData);
        return back()->with('success', 'Training created successfully.');
        // return Redirect::route('leaves.create');

    }

    public function destroy($id)
    {
        $res = Training::destroy($id);

        return back()->with('success', 'Training deleted successfully.');

    }

   



}
