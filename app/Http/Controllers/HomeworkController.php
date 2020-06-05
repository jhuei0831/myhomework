<?php

namespace App\Http\Controllers;

use App\Homework;
use App\Log;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_homeworks = Homework::paginate();
        return view('manage.homework.index',compact('all_homeworks'));
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
        return view('manage.homework.create',compact('all_courses'));
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
        $homework = new Homework;

        $data = $request->validate([
            'course' => ['required'],
            'subject' => ['required'],
            'description' => ['required'],
            'deadline' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $key != 'description') {
                $homework->$key = strip_tags(clean($data[$key]));
                if ($homework->$key == '') {
                    $error += 1;
                }
            }
        }

        $homework->description = clean($request->input('description'));

        if ($error == 0 && $data) {
            // 寫入log
            Log::write_log('homeworks',$request->all());
            $homework->save();
        }
        else{
            return back()->withInput()->with('warning', 'action.input_confirm');
        }

        return back()->with('success', 'action.create_success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }
        $homework = Homework::where('id',$id)->first();
        $all_courses = Course::all();
        return view('manage.homework.edit',compact('homework','all_courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }
        $error = 0;
        $homework = Homework::where('id',$id)->first();

        $data = $request->validate([
            'course' => ['required'],
            'subject' => ['required'],
            'description' => ['required'],
            'deadline' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $key != 'description') {
                $homework->$key = strip_tags(clean($data[$key]));
                if ($homework->$key == '') {
                    $error += 1;
                }
            }
        }

        $homework->description = clean($request->input('description'));

        if ($error == 0) {
            // 寫入log
            Log::write_log('homeworks',$request->all());
            $homework->save();
        }
        else{
            return back()->withInput()->with('warning', 'action.input_confirm');
        }

        return back()->with('success', 'action.update_success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', 'action.permission.deny');
        }
        // 寫入log
        Log::write_log('homeworks',Homework::where('id', $id)->first());
        Homework::destroy($id);
        return back()->with('success','action.delete_success');
    }
}
