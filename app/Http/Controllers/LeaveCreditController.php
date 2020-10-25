<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Arr;

class LeaveCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $employees = Employee::with('school');

        if ($request->filter != 1) {

            $school_id = $request->school;
            $lastname = $request->lastname;

            $employees = $employees->where('lastname', 'like', $lastname.'%')

                ->when($school_id != 'Any', function ($q) use ($school_id) {
                    return $q->where('school_id', $school_id);
                });

        }

        $employees = $employees->get();

        $schools = School::all();
        $data = "";

        return Inertia::render('LeaveCredits/Index',
            ['data' => $data,
                'schools' => $schools,
                'employees' => $employees,
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $employees = $request->selected;
        $form = $request->form;



        /*$validatedData = $request->validate([

            'year' => 'required|year',
            'month' => 'required|month',
            'credit' => 'required',
         
        ]);*/






        $employees = Arr::pluck( $employees,'id');

        print_r( $form);

        echo $form['credit'] . "sdfdsfdsfds";

        foreach($employees as $employee)
        {
         // print_r($employee);
         // echo $employee . "\n";
        }
        echo "stored";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
