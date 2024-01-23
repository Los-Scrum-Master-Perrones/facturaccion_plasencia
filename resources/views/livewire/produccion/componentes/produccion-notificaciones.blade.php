<li class="nav-item">
    <div class="btn-group">
        <a class="nav-link active fs-7 position-relative dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <img width="18" height="18" src="https://img.icons8.com/emoji/48/bell-emoji.png" alt="bell-emoji" />

            <span class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">
                {{ count($ordenes) }}
                <span class="visually-hidden">unread messages</span>
            </span>
        </a>

        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Ordenes Completeadas</a></li>
            <li><a class="dropdown-item" href="#">Asignar Automaticamente</a></li>
            @foreach ($ordenes as $completado)
                <li>
                    <a class="dropdown-item" href="#"
                    @if(isset($completado->ordenes))
                        data-bs-toggle="modal" data-bs-target="#modal_agregar_orden"
                            onclick="cambiarOrden('{{ json_encode($completado) }}')"
                    @else
                        data-bs-toggle="modal" data-bs-target="#modal_agregar_marca "
                    @endif>
                        {{ $completado->orden_sistema . ' - ' . $completado->marca . ' ' . $completado->nombre . ' ' . $completado->vitola . ' - ' . $completado->capa . ' (Parejas: ' . $completado->parejas_pendientes . ')' }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>

<div class="modal fade" id="modal_agregar_orden" tabindex="-1" aria-labelledby="modal_agregar_ordenLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="staticBackdropLabel">Detalles del producto <span style="font-size:10px;" name="clase"
                        id="clase"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <table class="table table-dark" id="tabla">
                                <thead>
                                    <tr>
                                        <th>N#</th>
                                        <th>Orden</th>
                                        <th>Codigo</th>
                                        <th>Marca</th>
                                        <th>Nombre</th>
                                        <th>Vitola</th>
                                        <th>Capa</th>
                                        <th>Pendiente</th>
                                        <th>Restante</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyTabla">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div wire:ignore class="modal fade" id="modal_agregar_marca" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo_ctalogo_productos">Marcas</h5>
                <button id="btn_cerrar" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="catalgo_pendiente">
                    <thead>
                        <tr style="text-align: center">
                            <th style="width: 60px">ID(Agregar)</th>
                            <th>ORDEN</th>
                            <th>FECHA</th>
                            <th>PRODUCTO</th>
                            <th>POR PRODUCIR</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 1em">
                        @foreach ($pendiente_catalogo as $key => $pendiente)
                            <tr>
                                <td>
                                    <a style="text-decoration: none" href="#" data-bs-dismiss="modal"
                                        onclick="agregar_pendiente('{{ $pendiente->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                                            <path
                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z" />
                                            <path
                                                d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777ZM3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4Z" />
                                        </svg>
                                    </a>
                                    {{ ++$key }}
                                </td>
                                <td style="text-align: center">{{ $pendiente->orden_sistema }}</td>
                                <td>{{ $pendiente->fecha_recibido }}</td>
                                <td>{{ $pendiente->producto }}</td>
                                <td style="text-align: center">{{ $pendiente->restantes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID(Agregar)</th>
                            <th>ORDEN</th>
                            <th>FECHA</th>
                            <th>PRODUCTO</th>
                            <th>POR PRODUCIR</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" class="btn btn-success">
                    <span>OK</span>
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function cambiarOrden(params) {
            var datos = JSON.parse(params);
            //alert(JSON.stringify(datos.ordenes[0]));
            var table = document.getElementById("tabla");
            var rowCount = table.rows.length;
            var tableRows = table.getElementsByTagName('tr');

            document.getElementById("clase").innerHTML = "";
            if (rowCount <= 1) {} else {
                for (var x = rowCount - 1; x > 0; x--) {
                    document.getElementById("bodyTabla").innerHTML = "";

                }
            }


            var h3 = `<h5>
                        <strong>
                            (` + datos.codigo_producto + `)
                            ` + datos.marca + `
                            ` + datos.nombre + `
                            ` + datos.vitola + `
                            ` + datos.capa + `
                        </strong>
                    </h5>`;

            document.getElementById("clase").innerHTML += h3.toString();

            tabla_nueva = "";

            var tabla_nueva = "";

            for (var i = 0; i < datos.ordenes[0].length; i++) {

                tabla_nueva += `<tr>
                                        <td>` + (i + 1) + `</td>
                                        <td>` + datos.ordenes[0][i].orden_sistema + `</td>
                                        <td>` + datos.codigo_producto + `</td>
                                        <td>` + datos.marca + `</td>
                                        <td>` + datos.nombre + `</td>
                                        <td>` + datos.vitola + `</td>
                                        <td>` + datos.capa + `</td>
                                        <td>` + datos.ordenes[0][i].pendiente + `</td>
                                        <td>` + datos.ordenes[0][i].restantes + `</td>
                                    </tr>`;

                document.getElementById("bodyTabla").innerHTML += tabla_nueva.toString();

            }



        }

        $(document).ready(function() {
                $('#catalgo_pendiente').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                        "pageLength": 50
                    },
                    scrollY: 320,
                    initComplete: function() {
                        this.api()
                            .columns()
                            .every(function() {
                                let column = this;
                                let title = column.footer().textContent;

                                // Create input element
                                let input = document.createElement('input');
                                input.placeholder = title;
                                input.style.width = "200px";

                                column.footer().replaceChildren(input);

                                // Event listener for user input
                                input.addEventListener('keyup', () => {
                                    if (column.search() !== this.value) {
                                        column.search(input.value).draw();
                                    }
                                });
                            });
                    }
                });
            });
    </script>
@endpush
