<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $table = 'homeworks';

    protected $primaryKey = 'id';

    protected $fillable = [
        "course", "subject" , "description", "deadline",
    ];

    public function student()
    {
        return $this->belongsTo('App\Student', 'course', 'course');
    }

    public function uploads()
    {
        return $this->hasMany('App\Upload', 'homework_id', 'id');
    }
}
