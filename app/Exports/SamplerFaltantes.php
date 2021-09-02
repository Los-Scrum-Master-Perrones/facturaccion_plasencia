<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class SamplerFaltantes  implements FromCollection,
ShouldAutoSize,
WithHeadings,
WithStrictNullComparison
{
    public function headings(): array
    {
        return [
            'N#',
            'Categoria',
            'Item',
            'Descripción',
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $cajas_export = DB::select('select * from item_faltantes');
        return collect($cajas_export);
    }
}
