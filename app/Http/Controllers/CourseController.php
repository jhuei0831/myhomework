<?php

namespace App\Http\Controllers;

use App\Course;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_courses = Course::paginate();
        return view('manage.course.index',compact('all_courses'));
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
        return view('manage.course.create');
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
        $course = new Course;

        $data = $request->validate([
            'name' => ['required'],
            'teacher' => ['required'],
            'description' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            $course->$key = strip_tags(clean($data[$key]));
            if ($course->$key == '') {
                $error += 1;
            }
        }

        if ($error == 0) {
            // 寫入log
            Log::write_log('courses',$request->all());
            $course->save();
        }
        else{
            return back()->withInput()->with('warning', 'action.input_confirm');
        }

        return back()->with('success', 'action.create_success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }
        $course = Course::where('id',$id)->first();
        return view('manage.course.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }
        $error = 0;
        $course = Course::where('id',$id)->first();

        $data = $request->validate([
            'name' => ['required'],
            'teacher' => ['required'],
            'description' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            $course->$key = strip_tags(clean($data[$key]));
            if ($course->$key == '') {
                $error += 1;
            }
        }

        if ($error == 0 && $data) {
            // 寫入log
            Log::write_log('courses',$request->all());
            $course->save();
        }
        else{
            return back()->withInput()->with('warning', 'action.input_confirm');
        }

        return back()->with('success', 'action.update_success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', 'action.permission.deny');
        }
        // 寫入log
        Log::write_log('courses',Course::where('id', $id)->first());
        course::destroy($id);
        return back()->with('success','action.delete_success');
    }
}
