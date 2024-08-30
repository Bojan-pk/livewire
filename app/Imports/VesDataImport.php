<?php

namespace App\Imports;

use App\Models\VesCondition;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VesDataImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row[0])) {
            return null;
        } elseif (strlen($row[0]) > 5 || strlen($row[1]) > 5 || ($row[0] == 1 && $row[1] == 2)) {
            return null;
        }

        return new VesCondition([
            'rb' => $row[0],
            'old_ves' => $row[1] . $row[2] . $row[3],
            'old_alternative' => $row[4],
            'old_kind' => $row[5],
            'old_condition' => $row[6],
            'ves' => $row[7] . $row[8] . $row[9] . $row[10] . $row[11],
            'condition' => $row[12],
            'alternative' => $row[13]
        ]);
    }
}
