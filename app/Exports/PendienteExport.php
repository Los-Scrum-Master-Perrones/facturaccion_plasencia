<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;



class PendienteExport implements FromCollection,
                                ShouldAutoSize,
                                WithHeadings,
                                WithStrictNullComparison,
                                WithColumnFormatting
{

    public $nom;
    public $fede;
    public $feha;

    public $cat;
    public $item;
    public $pres;
    public $orden;
    public $marca;
    public $vito;
    public $capa;
    public $empa;
    public $hon;




    
    function __construct($nom,$fede,$fecha) {
        $this->nom = $nom;
        $this->fede = $fede;
        $this->feha = $fecha;
  
    }

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
            'FACTURA',
            'ENVIADO MES',
            'SALDO',
            'TIPO DE EMPAQUE',
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
        $datos_pendiente = \DB::select('call buscar_pendiente(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
        [
            'fede' =>  $this->fede,
            'cat' =>  $this->cat,
            'item' =>  $this->item,
            'pres' =>  $this->pres,
            'orden' =>  $this->orden,
            'marca' =>  $this->marca,
            'vito' =>  $this->vito,
            'nom' =>  $this->nom,
            'capa' =>  $this->capa,
            'empa' =>  $this->empa,
            'hon' =>  $this->hon
        ]
    );

        return collect($datos_pendiente);
    }
}
