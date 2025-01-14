<?php

namespace App\Http\Controllers\cms;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('action', function ($data) {
                    $editUrl        =   route('company.edit', ['company' => $data->id]);
                    $deleteUrl      =   route('company.destroy', ['company' => $data->id]);
                    $btn            =   '<div class="row">';
                    $btn            .=  '<a href="' . $editUrl . '"><i class="fa fa-edit"></i></a>';
                    if ((auth()->user()->hasRole('admin'))) {
                        $btn            .=  '<a style="cursor: pointer;"
                                                            onclick="deleteItem(\'' . $deleteUrl . '\')">
                                                            <i class="fa fa-trash text-danger ml-2"></i>
                                                        </a>';
                    }
                    $btn            .=  '</div>';
                    return $btn;
                })
                ->rawColumns([ 'action'])
                ->make(true);
        }
        return view("cms.company.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']         =   new Company();
        $data['method']         =   'POST';
        $data['url']            =   route('company.store');

        return view('cms.company.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $company                   =   new Company();
        $company->name             =   $request->name;
        $company->email            =   $request->email;
        $company->contact_number   =   $request->contact_number;
        $company->save();

        $data['message']        =   auth()->user()->name . " has created $company->name";
        $data['action']         =   "created";
        $data['module']         =   "company";
        $data['object']         =   $company;
        saveLogs($data);
        Session::flash("success", "Data Created");

        return redirect(route("company.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['object']             =   Company::find($id);
        if (empty($data['object'])) {
            Session::flash("error", "Data Not Found");
            return back();
        }
        $data['url']                =   route("company.update", ['company' => $id]);
        $data['method']             =   "PUT";

        return view("cms.company.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $company                   =   Company::find($id);
        if (empty($company)) {
            Session::flash("error", "Data not found");
            return redirect(route("company.index"));
        }
        $company->name             =   $request->name;
        $company->email            =   $request->email;
        $company->contact_number   =   $request->contact_number;
        $company->update();

        $data['message']        =   auth()->user()->name . " has updated $company->name";
        $data['action']         =   "updated";
        $data['module']         =   "company";
        $data['object']         =   $company;
        saveLogs($data);
        Session::flash("success", "Data Updated");
        return redirect(route("company.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->hasRole('admin'),403);

        $company                =   Company::find($id);
        if (empty($company)) {
            Session::flash("error", "Data not found");
            return back();
        }
        $data['message']        =   auth()->user()->name . " has deleted $company->name";
        $data['action']         =   "deleted";
        $data['module']         =   "company";
        $data['object']         =   $company;
        saveLogs($data);
        $company->delete();
        Session::flash("success", "Data Deleted");
        return response()->json(['message' => 'Data Deleted'], 200);
    }
}
