<title>Programación <?php echo($fecha);?></title>




<div class="row" style="width: 100%;margin:10px; text-align:center;">
    <h4 style="margin:10px;font-style:oblique;"> Programación, Tabacos de Oriente </h4>
</div>


<div class="row">
    <div class="col">

        <div style="text-size:20px;margin-bottom:5px;">Fecha: <?php echo($fecha);?></div>

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

                        @foreach($detalles_programaciones as $detalles_programacione)
                        <tr>
                            <td> {{$detalles_programacione->numero_orden}}</td>
                            <td> {{$detalles_programacione->orden}}</td>
                            <td> {{$detalles_programacione->marca}}</td>
                            <td> {{$detalles_programacione->vitola}}</td>
                            <td> {{$detalles_programacione->nombre}}</td>
                            <td> {{$detalles_programacione->capa}}</td>
                            <td> {{$detalles_programacione->tipo_empaque}}</td>
                            <td> {{$detalles_programacione->anillo}}</td>
                            <td> {{$detalles_programacione->cello}}</td>
                            <td> {{$detalles_programacione->upc}}</td>
                            <td> {{$detalles_programacione->saldo}}</td>
                           


                        </tr>
                        @endforeach


                    </tbody>
                 </table>

    </div>

</div>
<!-- FIN DEL TABLA REMISIONES PARAISO -->