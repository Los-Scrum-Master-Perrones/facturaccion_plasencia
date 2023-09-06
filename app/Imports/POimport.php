<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;

use Maatwebsite\Excel\Concerns\Importable;


class POimport implements ToModel
{
    use Importable;

    protected $hon;

    public function __construct(string $hon)
    {
        $this->hon = $hon;
    }

    public function model(array $row)
    {
        try {
            DB::beginTransaction();
        $item=$row[0];
        if($row[0] != 'Item No.       ' && $row[0] !=null){

            if (is_int($row[0])) {
                $item = str_pad($row[0], 8, "0", STR_PAD_LEFT);
            }

            $catalogo = DB::table('clase_productos')->
            where('item', '=', $item)->first();
            $orden = explode('.',$this->hon);
            if ($catalogo==null) {
                $clase = DB::table('clase_productos')->insert([
                    'item'=> $item,
                    'cantidad_bulto'=> 0,
                    'id_marca'=> 1450,
                ]);
            }
            
            $insercion = DB::table('po')->insert([
                'item'=> $item,
                'hon'=> $orden[0],
                'cantidad'=> $row[2],
            ]);

        }
        DB::commit();
        }catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
