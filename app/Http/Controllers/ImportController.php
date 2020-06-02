<?php

namespace App\Http\Controllers;

use App\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportController extends Controller
{
    function import(Request $request)
    {
        try {
            Excel::import(new Import, request()->file('file'));
            return back()->with('success', 'upload success');
        }
        catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            // dd($failures);
            return view('manage.member.import', compact('failures'));
        }

        // $import = Excel::import(new Import, request()->file('file'));
        // $failures = $import->failures();
        // if ($failures) {
        //    return view('manage.member.import', compact('failures'));
        // }
        // Excel::import(new Import, request()->file('file'));
        // return back()->with('success', 'upload success');

        // $data = $request->validate([
        //     'file' => ['required','mimes:xls,xlsx'],
        // ]);

        // $path = $request->file('file')->getRealPath();

        // $data = Excel::load($path)->get();

        // if ($data->count() > 0) {
        //     foreach ($data->toArray() as $key => $value) {
        //         foreach ($value as $row) {
        //             $insert_data[] = array(
        //                 'name' => $row['name'],
        //                 'student_id' => $row['student_id'],
        //                 'email' => $row['email'],
        //                 'password' => $row['password'],
        //                 'permission' => $row['permission'],
        //                 'created_at' => now(),
        //             );
        //         }
        //     }
        // }


        // if ($data) {
        //     Excel::import(new Import, request()->file('file'));
        // }
        // else{
        //     return back()->withInput()->with('warning', 'action.input_confirm');
        // }

        // return back()->with('success', 'upload success');
    }
}
