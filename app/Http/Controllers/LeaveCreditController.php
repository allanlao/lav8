<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\School;
use App\Models\LeaveCredit;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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

     
    
        $sql_values = null;


       $id = $form['year'] . "-" . date('m',strtotime($form['month']));
       
      
        foreach($employees as $employee)
        {

            $model = new LeaveCredit();
            $model->id = $id . "-" .  $employee;
            $model->employee_id = $employee;
            $model->credit = $form['credit'];
            $model->balance = 0;
            $model->remarks = $form['remarks'];

                     
            $sql_values .= $this->prepareLeaveModel($model);
            $this->insertLeaveCredits( $sql_values);
        }
        return redirect()->route('credit');

      
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


    
    private function prepareLeaveModel($model){
        $v[0] =  "'" . $model->id . "'";
        $v[1] =  "'" . $model->employee_id . "'";
        $v[2] =  $model->credit;
        $v[3] =  $model->balance;
        $v[4] =   "'" . $model->remarks . "'";

      
        $raw_value = implode(",", $v);

    

        return ',(' . $raw_value . ')';

    }


    private function insertLeaveCredits($sql_values){
        if (!empty($sql_values)) {
            $sql_values = substr($sql_values, 1);
            $sql = 'replace INTO leave_mc (id,
            employee_id,credit,balance,remarks )
             VALUES ' . $sql_values;
         
            return DB::statement($sql);
        }
    }
}
