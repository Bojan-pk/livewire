<?php

namespace App\Imports;

use App\Models\VesCondition;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VesDataImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
{

   /*  if (!isset($row[0])) {
        return null;
    } */
    return new VesCondition([
        'old_ves' => $row['old_ves'],
        'old_alternative' => $row['old_alternative'],
       'old_kind' => $row['old_kind'],
        'old_condition' => $row['old_condition'],
        'ves' => $row['ves'],
        'condition' => $row['condition'],
        'alternative' => $row['alternative']
    ]);
}
}
