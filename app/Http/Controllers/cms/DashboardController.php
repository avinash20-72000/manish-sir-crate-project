<?php

namespace App\Http\Controllers\cms;

use App\Models\Crate;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['crateStats']     =   Crate::selectRaw("
                                        COUNT(*) as total,
                                        SUM(CASE WHEN status = 'available' THEN 1 ELSE 0 END) as available,
                                        SUM(CASE WHEN status = 'assign' THEN 1 ELSE 0 END) as assigned
                                    ")->first();

        $data['companies']      =   Company::whereHas('crateTransfers')->withCount(['crateTransfers'])->get();

        return view('cms.dashboard',$data);
    }
}
