<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads';

    protected $primaryKey = 'id';

    protected $fillable = [
        "student_id", "homework_id" , "file", "grade"
    ];

    public function student()
    {
        return $this->hasOne('App\Student', 'id', 'student_id');
    }

    public function homework()
    {
        return $this->hasOne('App\Homework', 'id', 'homework_id');
    }
}
