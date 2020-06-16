<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = [];
        $students = Student::where('student_id', Auth::user()->student_id)->get('course');
        foreach ($students as $key => $value) {
            array_push($courses, $value->course);
        }
        $homeworks = DB::table('homeworks')
            ->leftJoin('uploads', 'homeworks.id', '=', 'uploads.homework_id')
            ->whereIn('course', $courses)
            ->where('uploads.student_id', '2')
            ->get();

        return view('home',compact('courses','homeworks'));
    }
}
