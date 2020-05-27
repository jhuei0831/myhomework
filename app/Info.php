<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'infos';

    protected $primaryKey = 'id';

    protected $fillable = [
        "title", "content" , "editor", "sort", "is_open", "is_sticky",
    ];
}
