<?php

namespace App\Imports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\ToModel;

class MenuImport implements ToModel
{
    protected $resturantId;
    public function __construct($resturantId)
    {
        $this->resturantId = $resturantId;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Menu([
            'restaurant_id' => $this->resturantId,
            'item' => $row[0],
            'price' => floatval($row[1]),
        ]);
    }
}
