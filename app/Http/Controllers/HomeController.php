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
        $student_id = [];
        $student_courses = [];
        $student_homeworks = [];
        $students = Student::where('student_id', Auth::user()->student_id)->get();
        foreach ($students as $student) {
            array_push($student_id, $student->id);
        }
        foreach ($students as $student) {
            array_push($student_courses, $student->course);
        }
        $homeworks = DB::table('homeworks')->whereIn('course', $student_courses)->get();
        foreach ($homeworks as $homework) {
            array_push($student_homeworks, $homework->id);
        }
        $uploads = DB::table('uploads')->whereIn('homework_id',$student_homeworks)->whereIn('student_id',$student_id)->get();


        return view('home',compact('students','homeworks','uploads'));
    }
}
