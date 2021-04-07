<?php

namespace App\Imports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class VehiclesImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {

    	return new Vehicle([
            'registration_number' => $row[0],
            'brand' => $row[1],
            'model' => $row[2],
            'type' => $row[3],
            'fuel_type' => $row[4],
            'year' => (int)$row[5],
            'doors' =>(int)$row[6],
            'is_active' => (String)$row[7],
    	]);
    }
}