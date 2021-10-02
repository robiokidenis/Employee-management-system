<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use  Yajra\DataTables\DataTablesServiceProvider;

class CompaniesController extends Controller
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
        //
        if (request()->ajax()) {
            $companies = Companies::get();
            return DataTables()->of($companies)
                ->addIndexColumn()
                ->editColumn('website', function ($data) {
                    return $data->website ? '<a target="_blank" href=' . $data->website . '>' . $data->website . '</a>' : '';
                })
                ->editColumn('logo', function ($data) {
                    return $data->logo ? '<img src="' . asset('storage/' . $data->logo) . '" class="img-thumbnail" width="100px" height="100px" alt="company logo">' : '';
                })
                ->addColumn('action', function ($data) {
                    return '<span class="badge bg-success edit-companies" data-id="' . $data->id . '">Edit</span> <span class="badge bg-danger delete-companies" data-id="' . $data->id . '">Delete</span>';
                })
                ->rawColumns(['action', 'website', 'logo'])
                ->make(true);
        }
        return view('companies');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        if ($request->ajax()) {
            $request->validated();
            $imageName = null;
            if ($request->file('image')) {
                $imagePath = $request->file('image');
                $imageName = time() . '.' . $imagePath->getClientOriginalExtension(); // $imagePath->getClientOriginalName();
                $imagePath->storeAs('public/', $imageName);
            }
            return   Companies::updateOrCreate([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $imageName,

            ]);
            return response()->json(['sucess' => 'product created'], 201);
        }
        // return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Companies::findOrFail($id);
            return response()->json(['data' => $data]);
        }
        return abort(403, 'Unauthorized action.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, $id)
    {

        if ($request->ajax()) {
            $request->validated();
            $companies = Companies::findOrFail($id);
            $imageName = $companies->logo;
            if ($request->file('image')) {
                if (Storage::exists('public/' .  $imageName)) {
                    Storage::delete('public/' .  $imageName);
                }
                $imagePath = $request->file('image');
                $imageName = time() . '.' . $imagePath->getClientOriginalExtension(); // $imagePath->getClientOriginalName();
                $imagePath->storeAs('public/', $imageName);
            }
            return  $companies->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'website' => $request->website,
                    'logo' => $imageName,
                ]
            );
            return response()->json(['sucess' => 'product updated'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Companies::findOrFail($id);
        if (Storage::exists('public/' . $company->logo)) {
            Storage::delete('public/' . $company->logo);
        }

        $company->delete();
        return $company;
    }
}
