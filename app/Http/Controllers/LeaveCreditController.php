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
        $employees = Employee::with('school');

        if ($request->filter != 1) {

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
            'credit' => 'required|numeric|min:0.1',

        ]);

        $model = new LeaveCredit();



        $model->employee_id = $request->employee_id;
        $model->period = $request->period . "-01";
        $model->credit = $request->credit;
        $model->type = $request->leave_type;
        $model->balance = 0;
        $model->remarks = $request->remarks;

        $model->save();
         

       // $leaveCredit = LeaveCredit::create($validatedData);

       // return redirect()->route('credits-index')->with('success', 'Leave credit created.');

         return back()->with('success', 'User created successfully.');

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
        $form = $request->form;

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
            $model->period = $form['period'];
            $model->credit = $form['credit'];
            $model->balance = 0;
            $model->remarks = $form['remarks'];

            $sql_values .= $this->prepareLeaveModel($model);
            $this->insertLeaveCredits($sql_values);
        }
        return redirect()->route('create-credit');

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
        $v[2] = $model->credit;
        $v[3] = $model->balance;
        $v[4] = "'" . $model->remarks . "'";

        $raw_value = implode(",", $v);

        return ',(' . $raw_value . ')';

    }

    private function insertLeaveCredits($sql_values)
    {
        if (!empty($sql_values)) {
            $sql_values = substr($sql_values, 1);
            $sql = 'replace INTO leave_mc (period,
            employee_id,credit,balance,remarks )
             VALUES ' . $sql_values;

            return DB::statement($sql);
        }
    }
}
