<?php

namespace App;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class Import implements ToModel, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        return new User([
           'name'           => $row[0],
           'student_id'     => $row[1],
           'email'          => $row[2],
           'password'       => Hash::make($row[3]),
           'permission'     => $row[4],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'unique:users,student_id',
            '2' => 'unique:users,email',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '1.unique' => '學號重複',
            '2.unique' => '信箱重複',
        ];
    }
}
