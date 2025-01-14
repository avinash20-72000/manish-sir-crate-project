<?php

namespace App\Http\Controllers\cms;

use App\Models\Crate;
use Illuminate\Http\Request;
use App\Http\Requests\CrateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CrateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Crate::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('action', function ($data) {
                    $editUrl        =   route('crate.edit', ['crate' => $data->id]);
                    $deleteUrl      =   route('crate.destroy', ['crate' => $data->id]);
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
        return view("cms.crate.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']         =   new Crate();
        $data['method']         =   'POST';
        $data['url']            =   route('crate.store');

        return view('cms.crate.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrateRequest $request)
    {
        $crate = Crate::create([
            'barcode'   => $request->barcode,
            'size'      => $request->size,
            'status'    => 'available',
        ]);

        $data['message']        =   auth()->user()->name . " has created $crate->barcode";
        $data['action']         =   "created";
        $data['module']         =   "crate";
        $data['object']         =   $crate;
        saveLogs($data);
        Session::flash('success','New crate created successfully!');

        return back();
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
        $data['object']         =   Crate::find($id);
        if(empty($data['object']))
        {
            Session::flash('error','Data not found!');
            return back();
        }
        $data['method']         =   'PUT';
        $data['url']            =   route('crate.update',['crate'=>$id]);

        return view('cms.crate.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $crate              =       Crate::find($id);
        if(empty($crate))
        {
            Session::flash('error','Data not found!');
            return redirect(route('crate.index'));
        }
        $crate->barcode     =       $request->barcode;
        $crate->size        =       $request->size;
        $crate->update();

        $data['message']        =   auth()->user()->name . " has updated $crate->barcode";
        $data['action']         =   "updated";
        $data['module']         =   "crate";
        $data['object']         =   $crate;
        saveLogs($data);
        Session::flash('success','Crate updated successfully!');

        return redirect(route('crate.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->hasRole('admin'),403);

        $crate                  =   Crate::find($id);
        if (empty($crate)) {
            Session::flash("error", "Data not found");
            return back();
        }
        $data['message']        =   auth()->user()->name . " has deleted $crate->barcode";
        $data['action']         =   "deleted";
        $data['module']         =   "crate";
        $data['object']         =   $crate;
        saveLogs($data);
        $crate->delete();
        Session::flash("success", "Data Deleted");
        return response()->json(['message' => 'Data Deleted'], 200);
    }
}
