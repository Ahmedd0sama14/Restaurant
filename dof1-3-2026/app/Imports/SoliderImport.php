<?php

namespace App\Imports;

use App\Models\Solider;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoliderImport implements ToCollection , WithHeadingRow
{
   public function collection(Collection $rows)
{

    foreach ($rows as $row) {
        if (empty($row['military_number'])) {
            continue;  
        }

        Solider::updateOrCreate(
            [  'military_number' => $row['military_number'] ],
            [
                'name' => $row['name'],
                'rank' => $row['rank'],
                'national_id' => $row['national_id'],
                'transfer_order' => $row['transfer_order'],

                'triple_1' => $row['triple_1'],
                'triple_2' => $row['triple_2'],
                'triple_3' => $row['triple_3'],

                'recruitment_date' => !empty($row['recruitment_date'])
                    ? Date::excelToDateTimeObject($row['recruitment_date'])
                    : null,

                'release_date' => !empty($row['release_date'])
                    ? Date::excelToDateTimeObject($row['release_date'])
                    : null,

                'center' => $row['center'],
                'governorate' => $row['governorate'],
                'height' => $row['height'],
                'weight' => $row['weight'],
                'boot_size' => $row['boot_size'],
                'overall_size' => $row['overall_size'],
            ]
        );
    }
}

}
