<?php

namespace App\Imports;

use App\Models\FamilyImportDTO;
use Maatwebsite\Excel\Concerns\ToModel;

class FamilyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FamilyImportDTO([
            "name"=>$row[0],
            "email"=>$row[1]
        ]);
    }
}
