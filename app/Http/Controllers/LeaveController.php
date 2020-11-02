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

     //list of approved records
    public function index()
    {
        $data = Leave::with(['employee.school','employee.position'])
        ->where('leave_status','!=','pending')->get();

        return Inertia::render('Leaves/Index', ['data' => $data]);

    }


    public function approval(){
        $data = Leave::with(['employee.school','employee.position'])
        ->where('leave_status','pending')->get();

        return Inertia::render('Leaves/Approval', ['data' => $data]);
       
    }

    /**
     * Show the form for creating a new resource.
     * show create form
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $employee_leaves = Leave::where('employee_id',$id)->get();
        $employee = Employee::with(['school','position'])->find($id);
        return Inertia::render('Leaves/Create',['employee'=>$employee,'employee_leaves'=>$employee_leaves]);

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
            'vl_balance' => 'required|numeric|min:0|max:999',
            'sl_balance' => 'required|numeric|min:0|max:999',
            'disapproved_reason' => 'nullable',
            'encoded_by' => 'required',
          
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

    public function approve($id,$user,$action){
       $leave =  Leave::find($id);
       $leave->approved_by = $user;
       $leave->leave_status = $action;
       $leave->save();
       return back()->with('success', 'Leave approved successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Leave::destroy($id);

        return back()->with('success', 'Leave deleted successfully.');

    }
}
