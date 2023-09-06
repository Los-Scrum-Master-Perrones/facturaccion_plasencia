<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <ul class="nav justify-content-center">
        @if(auth()->user()->rol == -1)

        @else
            <li class="nav-item">
                <a style="color:#E5B1E2; font-size:12px;" href=""><strong>Reporte Diarios</strong></a>
            </li>
        @endif
        <li class="nav-item">
            <a style="color:white; font-size:12px;"
                href="{{ route('programacionterminado') }}"><strong>Programaciones</strong></a>
        </li>
    </ul>




    <div style="width:100%;">

        <div class="row" style="width:100%;">

            <div class="col-sm-1" style="text-align:right;">
            </div>
            <div class="col-sm-3" style="text-align:right;">
                    <h4 style="color:#ffffff;" id="contenedor" name="contenedor" value="" wire:model="titulo"><strong>
                            {{ $titulo}}</strong></h4>
            </div>
        </div>
    </div>

    <div style="width:100%; padding-left:20px; padding-right:10px;">
    <input name="busqueda" id="busqueda" class=" form-control" wire:model="busqueda"
                            placeholder="Buscar por item O marca" style="width:350px;">
    </div>



    


    <div style="width:100%; padding-left:25px; padding-right:10px;">
        <div class="row">
            <div class="col-sm-3" style="padding-left:0px;   font-size:10px;  ">
                <div wire:change='tama' id="tabla_materiales2" class="table-responsive">
                    <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px;">
                        <table class="table table-light" id="editable" style="font-size:10px;">
                            <thead>
                                <tr style="text-align:center;">
                                    <th style=" text-align:center;">#-No.</th>
                                    <th hidden style=" text-align:center;">ID</th>
                                    <th style=" text-align:center;">FECHA</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($programaciones as $i => $programacion)
                                    <tr>
                                        <td> {{ $i+1 }}</td>
                                        <td hidden> {{ $programacion->id }}</td>
                                        <td> {{ $programacion->fecha }}

                                            <div class="row">
                                                <div class="col-sm-1" style="text-align:right;">
                                                    <a style=" width:10px; height:10px;" onClick="limpiartable()"
                                                        wire:click='ver({{ $programacion->id }})'>
                                                        <button style="background: none; color: inherit;   border: none;  padding: 0;
                                                font: inherit;  cursor: pointer; outline: inherit;">

                                                            <abbr title="Mostrar detalles de la programación"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="currentColor"
                                                                    class="bi bi-eye-fill" viewBox="0 0 16 16"
                                                                    style="color:black;">
                                                                    <path
                                                                        d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                    <path
                                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                </svg>
                                                            </abbr>

                                                        </button>
                                                    </a>
                                                </div>
                                                
                                                <div class="col-sm-1" style="text-align:right;">
                                                <form method="post" action="{{route("programacionterminadoreporteremision")}}">
                                                @csrf
                                                <input type="hidden" name="fecha" value="{{$programacion->fecha}}">
                                                        <button style="background: none; color: inherit;   border: none;  padding: 0;
                                                font: inherit;  cursor: pointer; outline: inherit;" type="submit">
                                                            <abbr title="Generar Remision">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 
                                                                1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 
                                                                0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                            </svg>
                                                            </abbr>

                                                        </button>
                                                </form>
                                                </div>


                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-9" style="padding-left:0px;   font-size:10px;  ">
                <div wire:change='tama' id="tabla_materiales" class="table-responsive">
                    <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px; height:100%;">
                        <table class="table table-light" id="editable" style="font-size:10px;">
                            <thead>
                                <tr style=" text-align:center;">
                                    <th># ORDEN</th>
                                    <th style=" text-align:center;">ORDEN</th>
				                    <th style=" text-align:center;">ITEM</th>
                                    <th style=" text-align:center;">MARCA</th>
                                    <th style=" text-align:center;">VITOLA</th>
                                    <th style=" text-align:center;">NOMBRE</th>
                                    <th style=" text-align:center;">CAPA</th>
                                    <th style=" text-align:center;">TIPO DE EMPAQUE</th>
                                    <th style=" text-align:center;">CANTIDAD</th>

                                </tr>
                            </thead>
                            <tbody id="tablechange">

                                @php
                                $Tlistos=0;
                                @endphp
                                @foreach($detalles_programaciones as $detalles_programacione)
                                    <tr>
                                        @php
                                            $Tlistos=$Tlistos+$detalles_programacione->cantidad;
                                        @endphp
                                        <td> {{ $detalles_programacione->numero_orden }}</td>
                                        <td> {{ $detalles_programacione->orden }}</td>
					                    <td> {{ $detalles_programacione->item }}</td>
                                        <td> {{ $detalles_programacione->marca }}</td>
                                        <td> {{ $detalles_programacione->vitola }}</td>
                                        <td> {{ $detalles_programacione->nombre }}</td>
                                        <td> {{ $detalles_programacione->capa }}</td>
                                        <td> {{ $detalles_programacione->tipo_empaque }}</td>
                                        <td>{{  $detalles_programacione->cantidad }}</td>
                                        <td style="text-align:center;">                                        
                                    </tr>
                                @endforeach

                                <tr>
                                    <td style="text-align:center;" colspan="8"> 
                                    <FONT SIZE=3 for="" style="font-family: fantasy;" class="form-label">
                                                                                TOTAL
                                        </FONT></td>
                                    <td><b> {{$Tlistos}}</b></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>

    </div>


    @push('scripts')
        <script type="text/javascript">
            function mostrarMaterial(v){
                @this.materiales = v;
            }

            function updatelisto() {
            @this.updatelistos(
                document.getElementById("pa_id").value,
                document.getElementById("pa_cantidad").value,
                document.getElementById("pa_item").value,
                document.getElementById("pa_id_programacion").value,
                document.getElementById("pa_numero_orden").value,
                document.getElementById("pa_orden").value
            );

            $('#pa_cantidad').val('');
        }

            function cargardatos(pa_id, pa_item, pa_id_programacion,pa_numero_orden,pa_orden)
            {
                $('#pa_id').val(pa_id);
                $('#pa_item').val(pa_item);
                $('#pa_id_programacion').val(pa_id_programacion);
                $('#pa_numero_orden').val(pa_numero_orden);
                $('#pa_orden').val(pa_orden);
            }
            

            function limpiartable(){
                $('#tablechange').empty();
            }

            window.addEventListener('tamanio_tabla', event => {
                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
                $('#tabla_materiales2').css('height', ($('#bos').height() - 180));
            });





            $(document).ready(function () {

                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
                $('#tabla_materiales2').css('height', ($('#bos').height() - 180));

            });

            function datos_modal_actualizar(id,
                id_pendiente,
                saldo,
                cant_cajas_necesarias,
                cant_cajas
            ) {

                $('#id_detalle').val(id);
                $('#id_pendiente').val(id_pendiente);
                $('#saldo').val(saldo);
                $('#saldo_pen').val(saldo);
                $('#cajas_viejas').val(cant_cajas_necesarias);
                $('#cant_cajas').val(cant_cajas);

            }
        </script>
    @endpush

</div>
