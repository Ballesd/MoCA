<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ResultExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class ExportExcelController extends Controller
{
    
    public function exportExcel(Request $request)
    {

        $moca_id = $request->moca_id;
        $user_id = $request->user_id;

        $user = User::find($user_id);

        $user_name = $user->name;
        $user_lastname = $user->lastname;

        $name = $user_lastname . '_' . $user_name;
        return Excel::download(new ResultExport($moca_id, $user_id), $name . '.xlsx');

    }
}
