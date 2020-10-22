<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //

    public function index()
    {
        $data = Employee::all();

     //  dd($data);
        return Inertia::render('Employees/Index',['data'=>$data]);
    }

    public function create()
    {
        return Inertia::render('Employees/Create');
    }

    public function store()
    {
   
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ]);
    

        return Redirect::route('employees')->with('success', 'Organization created.');
    }
}

