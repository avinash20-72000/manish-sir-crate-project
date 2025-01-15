<?php

namespace App\Http\Controllers\cms;

use App\Models\Crate;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CrateTransfer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CrateTransferController extends Controller
{

    public function crateTransferForm()
    {
        $data['companies']      =   Company::pluck('name','id')->toArray();
        $data['crates']         =   Crate::where('status','available')->pluck('barcode', 'id')->toArray();

        return view('cms.crateTransfer.transferForm',$data);
    }

    public function crateTransferStore(Request $request)
    {
        $request->validate([
            'company_id'    => 'required|exists:companies,id',
            'crate_ids'     => 'required|array|min:1',
            'crate_ids.*'   => 'exists:crates,id',
        ]);

        $companyId          =   $request->company_id;
        $crateIds           =   $request->crate_ids;

        foreach ($crateIds as $crateId) {
            Crate::where('id', $crateId)->update(['status' => 'assign']);

            CrateTransfer::create([
                'company_id' => $companyId,
                'crate_id' => $crateId,
                'transfer_date'=>now()
            ]);
        }

        return redirect()->back()->with('success', 'Crates successfully assigned to the company!');

    }

    public function crateReceiveForm()
    {
        return view('cms.crateTransfer.receiveForm');
    }

    public function crateReceive(Request $request)
    {
        $request->validate([
            'barcode'      => 'required',
        ]);

        $barcode            =   $request->barcode;
        $crate              =   Crate::where('barcode', $barcode)->first();
        if(empty($crate))
        {
            Session::flash('error','Data Not Found');
            return back();
        }
        $crate->update(['status' => 'available']);

        $crateTransfer      =   CrateTransfer::where('crate_id',$crate->id)->first();
        if(empty($crateTransfer))
        {
            Session::flash('error','Data Not Found');
            return back();
        }
        $crateTransfer->delete();

        Session::flash('success','Data Updated');

        return back();
    }


}
