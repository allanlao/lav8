<?php

namespace App\Http\Controllers;

use App\Models\LeaveCoc;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeaveCocController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = LeaveCoc::with(['employee.school','employee.position'])
        ->where('coc_status','!=','pending')->get();

        return Inertia::render('LeaveCocs/Index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

       $data =  LeaveCoc::where('employee_id',$id)->get();
        return Inertia::render('LeaveCocs/Create', ['id' => $id, 'data'=> $data]);

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
            'description' => 'required|max:50',
            'date_issued' => 'required|date',
            'type' => 'required',
            'osr_from' => 'date',
            'osr_to' => 'date',
            'hours' => 'required|numeric',

        ]);



        $row = LeaveCoc::latest('id')->first();

        $lastBalance = 0;
        if ($row != null) {
            $lastBalance = $row->balance;
        }

        $coc = new LeaveCoc;
        $coc->employee_id = $request->employee_id;
        $coc->description = $request->description;
        $coc->date_issued = $request->date_issued;
        $coc->type = $request->type;
        $coc->osr_from = $request->osr_from;
        $coc->osr_to = $request->osr_to;
        $coc->hours = $request->hours;
        $coc->balance = $lastBalance + $request->hours;
        $coc->coc_status = "pending";
        $coc->encoded_by =$request->encoded_by;
        

        $coc->save();

        return redirect()->route('create_coc',['id'=> $request->employee_id])->with('success', 'COC updated.');
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

    public function approve($id,$user,$action){
        $model =  LeaveCoc::find($id);
        $model->approved_by = $user;
        $model->coc_status = $action;
        $model->save();
        return back()->with('success', 'COC/CTO approved successfully.');
 
     }

     
    public function approval(){
        $data = LeaveCoc::with(['employee.school','employee.position'])
        ->where('coc_status','pending')->get();

        return Inertia::render('LeaveCocs/Approval', ['data' => $data]);
       
    }
 

}
