<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Leave;
use App\Models\Employee;
use Inertia\Inertia;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //list records
    public function index()
    {
        $data = Leave::all();

        return Inertia::render('Leaves/Index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     * show create form
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $employee = Employee::with(['school','position'])->find($id);
        return Inertia::render('Leaves/Create',['employee'=>$employee]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   

        $validatedData = $request->validate([

            'employee_id' => 'required|max:50',
            'date_filed' => 'required|date',
            'type' => 'required|max:50',
            'location' => 'required|max:50',
            'location_type' => 'required',
            'total_days' =>  'required|numeric|min:1',
            'inclusive_dates' => 'required|max:50',
            'commutation' => 'required',
           
            'total_approved_with_pay' => 'required|numeric|min:0',
            'total_approved_without_pay' => 'required|numeric|min:0',
            'total_approved_others' => 'required|numeric|min:0',
            'vl_balance' => 'required|numeric|min:0',
            'sl_balance' => 'required|numeric|min:0',
            'disapproved_reason' => 'nullable',
            'encoded_by' => 'nullable',
          
        ]);

       $result =  Leave::create($validatedData);
       return back()->with('success', 'Leave created successfully.');
     // return Redirect::route('leaves.create');
        
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
