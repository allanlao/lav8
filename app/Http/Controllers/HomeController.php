<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = Employee::select('id', 'firstname', 'lastname', 'school_id', 'position_id', 'firstname')
            ->with(['school', 'position'])->get();

        return Inertia::render('Home/Index', ['data' => $data]);
    }
}
