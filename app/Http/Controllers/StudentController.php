<?php

namespace App\Http\Controllers;

use App\Student;
use App\Log;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
}
