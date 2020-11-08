<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveCredit;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LeaveCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $data = LeaveCredit::where('employee_id', $id)->get();

        return Inertia::render('LeaveCredits/Index',
            ['data' => $data, 'id' => $id]);

    }

    public function create($id)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createByGroup(Request $request)
    {
        $employees = Employee::with(['school','credits']);

    

        if ($request->filter != 1 ) {

            $school_id = $request->school;
            $lastname = $request->lastname;

            $employees = $employees->where('lastname', 'like', $lastname . '%')
                

                ->when($school_id != 'Any', function ($q) use ($school_id) {
                    return $q->where('school_id', $school_id);
                });

        }

        $employees = $employees->get();

        $schools = School::all();
        $data = "";

        return Inertia::render('LeaveCredits/CreateByGroup',
            ['data' => $data,
                'schools' => $schools,
                'employees' => $employees,
            ]);

    }

    public function storeOne(Request $request)
    {

      

        $validatedData = $request->validate([

            'employee_id' => 'required|max:50',
            'period' => 'required',
            'leave_type' => 'required|max:50',
            'vl_credit' => 'required|numeric|min:0.1',
            'sl_credit' => 'required|numeric|min:0.1',
            'other_credit' => 'required|numeric|min:0.1',

        ]);

        $model = new LeaveCredit();



        $model->employee_id = $request->employee_id;
        $model->period = $request->period . "-01";
        $model->vl_credit = $request['vl_credit'];
        $model->sl_credit = $request['sl_credit'];
        $model->other_credit = $request['other_credit'];
     
        $model->balance = 0;
        $model->remarks = $request->remarks;
        $model->encoded_by = $request->encoded_by;  

        $model->save();
         

       // $leaveCredit = LeaveCredit::create($validatedData);

      //  return redirect()->route('credits.grp')->with('success', 'Leave credit added successfully.');

         return back()->with('success', 'Leave credit added successfully.');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMany(Request $request)
    {
        //

        $employees = $request->selected;
    


        /*$validatedData = $request->validate([

        'year' => 'required|year',
        'month' => 'required|month',
        'credit' => 'required',

        ]);*/

        $employees = Arr::pluck($employees, 'id');

        $sql_values = null;

        foreach ($employees as $employee) {

            $model = new LeaveCredit();

            $model->employee_id = $employee;
            $model->period = $request['period'];
            $model->vl_credit = $request['vl_credit'];
            $model->sl_credit = $request['sl_credit'];
            $model->other_credit = $request['other_credit'];
            $model->balance = 0;
            $model->remarks = $request['remarks'];
            $model->encoded_by = $request['encoded_by'];
         
            $sql_values .= $this->prepareLeaveModel($model);
            $this->insertLeaveCredits($sql_values);
        }
        return back()->with('success', 'Leave credits added successfully.');

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

    private function prepareLeaveModel($model)
    {
        $v[0] = "'" . $model->period . "-01'";
        $v[1] = "'" . $model->employee_id . "'";
        $v[2] = $model->vl_credit;
        $v[3] = $model->sl_credit;
        $v[4] = $model->other_credit;
        $v[5] = $model->balance;
        $v[6] = "'" . $model->remarks . "'";
        $v[7] = "'" . $model->encoded_by . "'";
        $v[8] = "'" .now() . "'";
       

        $raw_value = implode(",", $v);

        return ',(' . $raw_value . ')';

    }

    private function insertLeaveCredits($sql_values)
    {
        if (!empty($sql_values)) {
            $sql_values = substr($sql_values, 1);
            $sql = 'replace INTO leave_mc (period,
            employee_id,vl_credit,sl_credit,other_credit,balance,remarks,encoded_by,created_at )
             VALUES ' . $sql_values;

            return DB::statement($sql);
        }
    }




    public function summary(){
        $sql= "
        SELECT A.id,A.firstname, A.lastname, B.name, B.division
        ,C.vl_credit
        ,C.sl_credit
        ,C.other_credit
        ,D.tvlwp
        ,D.tslwp
        ,D.tvlwop
        ,D.tslwop
        ,D.tvlo
        ,D.tslo
        
        FROM employees A
        
        left JOIN schools B ON a.school_id = B.id
        
        
        left JOIN (
        
        SELECT employee_id
        ,SUM(vl_credit) AS vl_credit
        ,SUM(sl_credit) AS sl_credit
        ,SUM(other_credit) AS other_credit
        FROM leave_mc 
        GROUP BY employee_id
        
        ) C ON A.id = C.employee_id
        left JOIN (
        
        SELECT employee_id
        ,SUM(IF (type = 'vacation' , total_approved_with_pay ,0)) AS tvlwp
        ,SUM(IF (type = 'sick' , total_approved_with_pay ,0)) AS tslwp
        ,SUM(IF (type = 'vacation' , total_approved_without_pay ,0)) AS tvlwop
        ,SUM(IF (type = 'sick' , total_approved_without_pay ,0)) AS tslwop
        ,SUM(IF (type = 'vacation' , total_approved_others ,0)) AS tvlo
        ,SUM(IF (type = 'sick' , total_approved_others ,0)) AS tslo
        FROM leaves 
        WHERE leave_status = 'approved'
        GROUP BY employee_id
        )   D ON A.id = D.employee_id
        
        GROUP BY A.id
        
        ";

        $result =  DB::select($sql);

        return Inertia::render('LeaveCredits/Summary',
        ['data' => $result,
           
        ]);


    }
}
