<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name", "student_id" , "course",
    ];

    public function homeworks()
    {
        return $this->hasMany('App\Homework', 'course', 'course');
    }

    public function uploads()
    {
        return $this->hasMany('App\Upload', 'student_id', 'id');
    }

}
