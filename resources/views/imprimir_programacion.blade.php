<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<title>Programación </title>

<div class="row" style="width: 100%;margin:10px; text-align:center;">
    <h4 style="margin:10px;font-style:oblique;"> Programación, Tabacos de Oriente </h4>
</div>


<div class="row">
    <div class="col">

        <div style="text-size:20px;margin-bottom:5px;">Fecha:</div>

        <table class="table table-light" id="editable" style="font-size:10px;m">
                    <thead>
                        <tr style="font-size:16px; text-align:center;">
                            <th># ORDEN</th>
                            <th style=" text-align:center;">ORDEN</th>
                            <th style=" text-align:center;">MARCA</th>
                            <th style=" text-align:center;">VITOLA</th>
                            <th style=" text-align:center;">NOMBRE</th>
                            <th style=" text-align:center;">CAPA</th>
                            <th style=" text-align:center;">TIPO DE EMPAQUE</th>
                            <th style=" text-align:center;">ANILLO</th>
                            <th style=" text-align:center;">CELLO</th>
                            <th style=" text-align:center;">UPC</th>
                            <th style=" text-align:center;">SALDO</th>


                        </tr>
                    </thead>
                    <tbody>

                        @foreach($depros as $depro)
                        <tr>
                            <td> {{$depro->numero_orden}}</td>
                            <td> {{$depro->orden}}</td>
                            <td> {{$depro->marca}}</td>
                            <td> {{$depro->vitola}}</td>
                            <td> {{$depro->nombre}}</td>
                            <td> {{$depro->capa}}</td>
                            <td> {{$depro->tipo_empaque}}</td>
                            <td> {{$depro->anillo}}</td>
                            <td> {{$depro->cello}}</td>
                            <td> {{$depro->upc}}</td>
                            <td> {{$depro->saldo}}</td>
                           


                        </tr>
                        @endforeach


                    </tbody>
                 </table>

    </div>

</div>


</body>
</html>
