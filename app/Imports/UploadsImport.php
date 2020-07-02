<?php

namespace App\Imports;

use App\Upload;
use App\Enum;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class UploadsImport implements ToModel, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public $data;
    public $rows = 1;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rows;
        $student = DB::table('students')->where('student_id', $row[0])->get();
        $homework = DB::table('homeworks')->where('subject', $row[1])->get();
        $upload = Upload::where('student_id', $student[0]->id)->where('homework_id', $homework[0]->id)->get();
        if ($student->isNotEmpty() && $homework->isNotEmpty()) {
            $upload = Upload::where('student_id', $student[0]->id)->where('homework_id', $homework[0]->id)->get();
        }
        else {
            return NULL;
        }  
        if ($upload->isNotEmpty()) {
            return Upload::updateOrCreate(array('student_id' => $student[0]->id, 'homework_id' => $homework[0]->id), array('grade' => $row[2]));
        } 
        else {
            $this->data = $row[0].$row[1].'no';
            return NULL;
        } 
    }

    public function rules(): array
    {
        // $student = DB::table('students')->where('student_id', $row['student_id'])->first();
        // $homework = DB::table('homeworks')->where('subject', $row['homework_id'])->first();

        return [
            '0' => ['required', 'exists:students,student_id'],
            '1' => ['required', 'exists:homeworks,subject'],
            '2' => ['required'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.exists' => 'action.import.not_exist2',
            '1.exists' => 'action.import.not_exist3',
        ];
    }
}
