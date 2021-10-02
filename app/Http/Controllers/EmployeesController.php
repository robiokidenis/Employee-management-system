<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class EmployeesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //    return Employees::first()->company->name;
        if (request()->ajax()) {
            $employee = Employees::get();
            return DataTables()->of($employee)
                ->addIndexColumn()
                ->addColumn('full_name', function ($data) {
                    return $data->full_name;
                })
                ->addColumn('company', function ($data) {
                    return $data->companies_id ? '<a href="#" class="view-company" data-id="' . $data->companies_id . '">' . $data->company->name . '</a>' : '-';
                })
                ->addColumn('action', function ($data) {
                    return '<span class="badge bg-success edit-employees" data-id="' . $data->id . '">Edit</span> <span class="badge bg-danger delete-employees" data-id="' . $data->id . '">Delete</span>';
                })
                ->rawColumns(['action', 'company', 'logo'])
                ->make(true);
        }
        $companies =  Companies::limit(100)->get(); //protect brute forces using limit
        return view('employees', ['companies' => $companies]);
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
    public function store(EmployeeRequest $request)
    {
        if ($request->ajax()) {
            $request->validated();
            $employee=   Employees::updateOrCreate([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'companies_id' => $request->company,
            ]);
            $employee->company->notify(new \App\Notifications\notifNewEmployee($employee->company));
            return $employee;
            return response()->json(['succes' => 'stored'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    return Employees::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        if ($request->ajax()) {
            $request->validated();
            $employes=Employees::findOrFail($id);
            return   $employes->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'companies_id' => $request->company,
            ]);
            return response()->json(['success' => 'Stored'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Employees::findOrFail($id)->delete();
    }
}
