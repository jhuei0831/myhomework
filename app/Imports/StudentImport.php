<?php

namespace App\Imports;

use App\Student;
use App\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class StudentImport implements ToModel, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name' => $row[0],
            'student_id' => $row[1],
            'course' => $row[2],
        ]);
    }

    public function rules(): array
    {
        $course = [];
        $courses = Course::all();
        foreach ($courses as $key => $value) {
            array_push($course, $value->name);
        }

        return [
            '0' => ['required'],
            '1' => ['required','unique:students,student_id'],
            '2' => ['required',Rule::in($course)],
        ];
    }

    public function customValidationMessages()
    {
        $course = [];
        $courses = Course::all();
        foreach ($courses as $key => $value) {
            array_push($course, $value->name);
        }

        return [
            '1.unique' => 'action.import.id_duplicate',
            '2.in'     => 'action.import.not_exist',
        ];
    }
}
