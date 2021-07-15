<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Http\Static_Vars_Pendiente;



class PendienteExport implements FromCollection,
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
            'TIPO DE EMPAQUE',
            'PAQUETES',
            'UNIDADES',
            'CODIGO PRECIO',
            'PRECIO',
            'PENDIENTE',
            'SALDO',
            'SALDO ($)',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'R' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_NUMBER,
            'V' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
        ];
    }

    public function collection()
    {
$v1 =  Static_Vars_Pendiente::getcat1s();
$v2 =  Static_Vars_Pendiente::getcat2s();
$v3 =  Static_Vars_Pendiente::getcat3s();
$v4 =  Static_Vars_Pendiente::getcat4s();

$v5 =  Static_Vars_Pendiente::getpresentacions();
$v52 =  Static_Vars_Pendiente::getpresentacions2();
$v53 =  Static_Vars_Pendiente::getpresentacions3();
$v6 =  Static_Vars_Pendiente::getitems();
$v7 =  Static_Vars_Pendiente::getordenes();
$v8 =  Static_Vars_Pendiente::gethons();
$v9 =  Static_Vars_Pendiente::getmarcas();

$v10 =  Static_Vars_Pendiente::getvitolas();
$v11 =  Static_Vars_Pendiente::getnombres();
$v12 =  Static_Vars_Pendiente::getcapas();
$v13 =  Static_Vars_Pendiente::getempaques();
$v14=  Static_Vars_Pendiente::getmeses();

if($v1 == null){ $v1 = "";}else{$v1 = Static_Vars_Pendiente::getcat1s();}
if($v2 == null){ $v2 = "";}else{$v2 = Static_Vars_Pendiente::getcat2s();}
if($v3 == null){ $v3 = "";}else{$v3 = Static_Vars_Pendiente::getcat3s();}
if($v4 == null){ $v4 = "";}else{$v4 = Static_Vars_Pendiente::getcat4s();}

if($v5 == null){ $v5 = "";}else{$v5 = Static_Vars_Pendiente::getpresentacions();}
if($v52 == null){ $v52 = "";}else{$v52 = Static_Vars_Pendiente::getpresentacions2();}
if($v53 == null){ $v53 = "";}else{$v53 = Static_Vars_Pendiente::getpresentacions3();}
if($v6 == null){ $v6 = "";}else{$v6 = Static_Vars_Pendiente::getitems();}
if($v7 == null){ $v7 = "";}else{$v7 = Static_Vars_Pendiente::getordenes();}
if($v8 == null){ $v8 = "";}else{$v8 = Static_Vars_Pendiente::gethons();}
if($v9 == null){ $v9 = "";}else{$v9 = Static_Vars_Pendiente::getmarcas();}

if($v10 == null){ $v10 = "";}else{$v10 = Static_Vars_Pendiente::getvitolas();}
if($v11 == null){ $v11 = "";}else{$v11 =  Static_Vars_Pendiente::getnombres();}
if($v12 == null){ $v12 = "";}else{$v12 = Static_Vars_Pendiente::getcapas();}
if($v13 == null){ $v13 = "";}else{$v13 = Static_Vars_Pendiente::getempaques();}
if($v14 == null){ $v14 = "";}else{$v14 =  Static_Vars_Pendiente::getmeses();}


        $datos_pendienteExcel = DB::select('call buscar_pendiente_excel(:v1,:v2,:v3,:v4,:v5,:v52,:v53, :v6,:v7,:v8,:v9,:v10, :v11,:v12,:v13,:v14)',
        [
            'v1' => $v1,
            'v2' => $v2,
            'v3' => $v3,
            'v4' => $v4,
            'v5' => $v5,
            'v52' => $v52,
            'v53' => $v53,

            'v6' => $v6,
            'v7' => $v7,
            'v8' => $v8,
            'v9' => $v9,
            'v10' => $v10,

            'v11' => $v11,
            'v12' => $v12,
            'v13' => $v13,
            'v14' => $v14
        ]
    );
        return collect( $datos_pendienteExcel);
    }
}
