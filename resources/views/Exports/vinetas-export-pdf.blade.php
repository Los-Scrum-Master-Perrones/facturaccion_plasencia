<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDF</title>
    <style>
        @page {
            margin-left: 0.5cm;
            margin-right: 0.5cm;
            margin-bottom: 0.5cm;
            margin-top: 0.5cm;
        }
        .container {
            width: 32%;
            float: left;
            padding: 2px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }

        .row {
            display: flex;
            margin-bottom: 10px;
        }

        .column {
            flex: 1;
            margin-right: 10px;
            background-color: lightgray;
            padding: 10px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>
<body>

    @foreach ($vinetas as $key => $vineta )
        <div class="container" style="position: relative; margin: 3px">
            <img src="data:image/png;base64, {{  DNS2D::getBarcodePNG($vineta->id."", 'QRCODE',3.5,3.5) }}" alt="barcode" style="position: absolute; top: 5px; right: 5px;">
            <h8><u>{{ $vineta->modulo }}</u>__<b>Orden:</b><u>{{ $vineta->orden_sistema }}</u> </h8><br>
            <h8><b>FECHA</b></h8><br>
            <h8>___________________</h8><br>
            <h8><b>B</b>__<u>{{ $vineta->codigo_bonchero }}</u>___<b>R</b><u>___{{ $vineta->codigo_rolero }}__</u></h8><br>
            <h8><b>MEDIDA: </b><u>{{ $vineta->vitola }}</u>_<u>{{ $vineta->nombre }}</u></h8><br>
            <h8><b>MARCA: </b><u style="font-size: 0.7em">{{ $vineta->marca }}</u></h8><br>
            <h8><b>TIPO CAPA</b>_<u style="font-size: 0.9em">{{ $vineta->capa }}</u></h8><br>
            <h8><b>PESO</b>_<u>_{{ number_format($vineta->peso,2) }}</u>___</h8><h8><b>PUROS:</b> <u>_{{ $vineta->puros }}_</u> </h8>
            <h8><b>REVISADOR</b><u>_{{ $vineta->revisador }}</u></h8>
        </div>

        @if ((($key+1)%3) == 0)
            <div class="clear"></div>
        @endif

        @if ((($key+1)%21) == 0)
            <div style="page-break-before: always;"></div>
        @endif
    @endforeach




</body>
</html>
