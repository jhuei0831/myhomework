<?php

namespace App\Imports;

use App\Upload;
use Maatwebsite\Excel\Concerns\ToModel;

class UploadsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Upload([
            //
        ]);
    }
}
