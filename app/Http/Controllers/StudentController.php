<?php

namespace App\Http\Controllers;

use App\Student;
use App\Log;
use App\Course;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_students = Student::paginate();
        return view('manage.student.index',compact('all_students'));
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $student_id = $request->student_id;
        $course = $request->course;

        $students_search = Student::when($name, function ($q) use ($name) {
            return $q->where('name', 'like', '%' . $name . '%');
        })
        ->when($student_id, function ($q) use ($student_id) {
            return $q->where('student_id', 'like', '%' . $student_id . '%');
        })
        ->when($course, function ($q) use ($course) {
            return $q->where('course', 'like', '%' . $course . '%');
        })
        ->paginate()
        ->appends($request->all());

        return view('manage.student.search', compact('students_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', 'action.permission.deny');
        }
        $all_courses = Course::all();
        return view('manage.student.create',compact('all_courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', 'action.permission.deny');
        }

        $error = 0;
        $student = new Student;

        $data = $request->validate([
            'name' => 'required',
            'student_id' => 'required',
            'course' => 'required',
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            $student->$key = strip_tags(clean($data[$key]));
            if ($student->$key == '') {
                $error += 1;
            }
        }

        if ($error == 0) {
            // 寫入log
            Log::write_log('students',$request->all());
            $student->save();
        }
        else{
            return back()->withInput()->with('warning', 'action.input_confirm');
        }

        return back()->with('success', 'action.create_success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }
        $student = Student::where('id',$id)->first();
        $all_courses = Course::all();
        return view('manage.student.edit',compact('student','all_courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }
        $error = 0;
        $student = Student::where('id',$id)->first();

        $data = $request->validate([
            'name' => ['required'],
            'student_id' => ['required'],
            'course' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            $student->$key = strip_tags(clean($data[$key]));
            if ($student->$key == '') {
                $error += 1;
            }
        }

        if ($error == 0 && $data) {
            // 寫入log
            Log::write_log('students',$request->all());
            $student->save();
        }
        else{
            return back()->withInput()->with('warning', 'action.input_confirm');
        }

        return back()->with('success', 'action.update_success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', 'action.permission.deny');
        }
        // 寫入log
        Log::write_log('students',student::where('id', $id)->first());
        Student::destroy($id);
        return back()->with('success','action.delete_success');
    }

    // 學生上傳
    function import(Request $request)
    {
        $import = new StudentImport();
        $import->import(request()->file('file'));
        $failures = $import->failures();
        if (json_encode($failures,JSON_UNESCAPED_UNICODE) != '[]') {
            // 寫入log
            Log::write_log('students', 'students', 'action.import.failed');
            return view('manage.student.import', compact('failures'));
        }
        else{
            // 寫入log
            Log::write_log('students', 'students', 'action.import.success');
            return back()->with('success', 'action.import.success');
        }
    }
}
