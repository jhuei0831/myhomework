<?php

namespace App\Http\Controllers;

use ZipArchive;
use File;
use App\Upload;
use App\Log;
use App\Student;
use App\Homework;
use App\Imports\UploadImport;
use App\Exports\UploadsExport;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploads = Upload::paginate();
        return view('manage.upload.index',compact('uploads'));
    }

    public function search(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', 'action.permission.deny');
        }

        $student = $request->student_id;
        $homework = $request->homework;

        $student_id = DB::table('students')->where('student_id', 'like', '%' . $student . '%')->first();
        $homework_id = DB::table('homeworks')->where('subject', 'like', '%' . $homework . '%')->first();

        $uploads_search = Upload::when($student, function ($q) use ($student_id, $student) {
            return $q->where('student_id', 'like', '%' . (empty($student_id)?$student:$student_id->id) . '%');
        })
        ->when($homework, function ($q) use ($homework_id, $homework) {
            return $q->where('homework_id', 'like', '%' . (empty($homework_id)?$homework:$homework_id->id) . '%');
        })
        ->paginate()
        ->appends($request->all());

        return view('manage.upload.search', compact('uploads_search','student_id','homework_id'));
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
    public function store(Request $request, $id, $student_id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        //
    }

    public function upload(Request $request, $id, $student_id)
    {
        if (!Auth::check()) {
            return back()->with('warning', 'action.permission.deny');
        }
        $homework = Homework::where('id',$id)->first();
        $student = Student::where('id', $student_id)->first();
        $is_upload = Upload::where('student_id',$student_id)->where('homework_id',$id)->first();
        

        if ($is_upload) {
            $upload = $is_upload;
        }
        else {
            $upload = new Upload;
        } 

        $data = $request->validate([
            'file' => ['required', 'mimes:pdf'],
        ]);

        // 逐筆進行htmlpurufier 並去掉<p></p>
        
        if (!$data) {
            return back()->with('warning', 'action.upload.failed');
        }
        elseif ($homework->deadline <= now()) {
            return back()->with('error', 'action.upload.genius');
        }
        else {
            $file = $request->file('file');
            $name = $student->student_id;
            $folder = '/uploads/homework/'.$homework->subject;
            $filePath = $name . '.' . $file->getClientOriginalExtension();
            $this->uploadOne($file, $folder, 'public', $name);
            $upload->file = $filePath;
            $upload->student_id = $student_id;
            $upload->homework_id = $id;
            $upload->updated_at = now();

            Log::write_log('uploads', $upload);
            $upload->save();
            return back()->with('success', 'action.upload.success');
        }      
    }

    public function zip($folder)
    {
        $zip = new ZipArchive;
        $fileName = $folder.'.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path('storage/uploads/homework/'.$folder));
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        return response()->download(public_path($fileName));
    }

    public function export($homework) 
    {
        $homework_id = DB::table('homeworks')->where('subject', $homework)->first();
        if (isset($homework_id->id)) {
            Log::write_log('uploads', $homework, 'action.export.success');

            return Excel::download(new UploadsExport($homework_id->id), 'Excel-reports.xlsx');
        }
        else{
            Log::write_log('uploads', $homework, 'action.export.failed');
            return redirect('manage/upload')->with('error', 'action.upload.genius');
        }
    }

    public function import(Request $request)
    {
        $import = new UploadImport();
        $import->import(request()->file('file'));
        $failures = $import->failures();
        if (json_encode($failures, JSON_UNESCAPED_UNICODE) != '[]') {
            // 寫入log
            Log::write_log('students', 'students', 'action.import.failed');
            return view('manage.student.import', compact('failures'));
        } else {
            // 寫入log
            Log::write_log('students', 'students', 'action.import.success');
            return back()->with('success', 'action.import.success');
        }
    }
}
