<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Http\Static_Vars_PendienteEmpaque;



class PendienteEmpaqueExport implements FromCollection,
                                ShouldAutoSize,
                                WithHeadings,
                                WithStrictNullComparison,
                                WithColumnFormatting
{

 

    public function headings(): array
    {
        return [
            'CATEGORIA',
            'ITEM',
            'ORDEN DEL SISTEMA',
            'OBSERVACÓN',
            'PRESENTACIÓN',
            'MES',
            'ORDEN',
            'MARCA',
            'VITOLA',
            'NOMBRE',
            'CAPA',
            'ANILLO',
            'CELLO',
            'UPC',
            'PENDIENTE',
            'SALDO',
            'TIPO DE EMPAQUE',
            'PAQUETES',
            'UNIDADES',
            'CODIGO PRECIO',
            'PRECIO',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function collection()
    {
$v1 =  Static_Vars_PendienteEmpaque::gete_cat1s();
$v2 =  Static_Vars_PendienteEmpaque::gete_cat2s();
$v3 =  Static_Vars_PendienteEmpaque::gete_cat3s();
$v4 =  Static_Vars_PendienteEmpaque::gete_cat4s();

$v5 =  Static_Vars_PendienteEmpaque::gete_items();
$v6 =  Static_Vars_PendienteEmpaque::gete_ordenes();
$v7 =  Static_Vars_PendienteEmpaque::gete_hons();
$v8 =  Static_Vars_PendienteEmpaque::gete_marcas();

$v9 =  Static_Vars_PendienteEmpaque::gete_vitolas();
$v10 =  Static_Vars_PendienteEmpaque::gete_nombres();
$v11 =  Static_Vars_PendienteEmpaque::gete_capas();
$v12 =  Static_Vars_PendienteEmpaque::gete_empaques();
$v13=  Static_Vars_PendienteEmpaque::gete_meses();

if($v1 == null){ $v1 = "";}else{$v1 = Static_Vars_PendienteEmpaque::gete_cat1s();}
if($v2 == null){ $v2 = "";}else{$v2 = Static_Vars_PendienteEmpaque::gete_cat2s();}
if($v3 == null){ $v3 = "";}else{$v3 = Static_Vars_PendienteEmpaque::gete_cat3s();}
if($v4 == null){ $v4 = "";}else{$v4 = Static_Vars_PendienteEmpaque::gete_cat4s();}

if($v5 == null){ $v5 = "";}else{$v5 = Static_Vars_PendienteEmpaque::gete_items();}
if($v6 == null){ $v6 = "";}else{$v6 = Static_Vars_PendienteEmpaque::gete_ordenes();}
if($v7 == null){ $v7 = "";}else{$v7 = Static_Vars_PendienteEmpaque::gete_hons();}
if($v8 == null){ $v8 = "";}else{$v8 = Static_Vars_PendienteEmpaque::gete_marcas();}

if($v9 == null){ $v9 = "";}else{$v9 = Static_Vars_PendienteEmpaque::gete_vitolas();}
if($v10 == null){ $v10 = "";}else{$v10 =  Static_Vars_PendienteEmpaque::gete_nombres();}
if($v11 == null){ $v11 = "";}else{$v11 = Static_Vars_PendienteEmpaque::gete_capas();}
if($v12 == null){ $v12 = "";}else{$v12 = Static_Vars_PendienteEmpaque::gete_empaques();}
if($v13 == null){ $v13 = "";}else{$v13 =  Static_Vars_PendienteEmpaque::gete_meses();}


        $datos_pendienteExcel = DB::select('call buscar_pendiente_empaque_excel2(:v1,:v2,:v3,:v4,:v5, :v6,:v7,:v8,:v9,:v10, :v11,:v12,:v13)',
        [            
            'v1' => $v1,
            'v2' => $v2,
            'v3' => $v3,
            'v4' => $v4,

            'v5' => $v5,            
            'v6' => $v6,
            'v7' => $v7,
            'v8' => $v8,

            'v9' => $v9,
            'v10' => $v10,            
            'v11' => $v11,
            'v12' => $v12,
            'v13' => $v13,
        ]
    );
        return collect( $datos_pendienteExcel);
    }
}
