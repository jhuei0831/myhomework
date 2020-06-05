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
}
