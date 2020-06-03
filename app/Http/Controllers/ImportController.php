<?php

namespace App\Http\Controllers;

use App\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    function import(Request $request)
    {
        // try {
        //     Excel::import(new Import, request()->file('file'));
        //     return back()->with('success', 'upload success');
        // }
        // catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        //     $failures = $e->failures();
        //     // dd($failures);
        //     return view('manage.member.import', compact('failures'));
        // }
        $import = new Import();
        $import->import(request()->file('file'));
        $failures = $import->failures();
        if (json_encode($failures,JSON_UNESCAPED_UNICODE) != '[]') {
            return view('manage.member.import', compact('failures'));
        }
        else{
            return back()->with('success', 'upload success');
        }

    }
}
