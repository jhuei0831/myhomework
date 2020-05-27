<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configs';

    protected $primaryKey = 'id';

    protected $fillable = [
        "app_name", "font_family", "font_size", "font_weight", "background",
        "background_color", "navbar_bcolor", "navbar_wcolor", "navbar_size", "is_open",
    ];
}
