<div class="container-fluid">
    <div class="row" wire:ignore>
        <div class="col-3">
            <div class="form-floating">
                <select wire:model='precio_nuevo.id_vitola' class="form-select" id="floatingSelect22"
                    aria-label="Floating label select example">
                    <option>Seleccione</option>
                    @foreach ($vitolas as $vitola)
                        <option value="{{ $vitola->id_vitola }}">{{ $vitola->vitola }}</option>
                    @endforeach
                </select>
                <label for="floatingSelect">Vitolas</label>
            </div>
        </div>
        <div class="col-5">
            <div class="form-floating">
                <select wire:model='precio_nuevo.id_marca_precio' class="form-select" id="floatingSelect223"
                    aria-label="Floating label select example">
                    <option>Seleccione</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->codigo . '-' . $marca->marca }}</option>
                    @endforeach
                </select>
                <label for="floatingSelect">Marcas</label>
            </div>
        </div>
        <div class="col-2">

        </div>
        <div class="col-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Calcular Precio
            </button>
        </div>
    </div>
    <br>
    <div class="row text-center">
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.salario_directo' type="number" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Salario Directo</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.salario_empaque' type="number" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Salario Empaque</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.costos_indirectos' type="number" class="form-control"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Costos Indirectos</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.material_empaque' type="number" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Material de Empaque</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.porcentaje_costo_social' type="number" class="form-control"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Costo Social(%)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.porcentaje_salario_indirecto' type="number" class="form-control"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Salario Indirecto(%)</label>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.capa_lbs' type="number" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Capa (LBS/MILLAR)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.capa_lbs_costo' type="number" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Capa ($ Costo)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.banda_lbs' type="number" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Banda (LBS/MILLAR)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.banda_lbs_costo' type="number" class="form-control"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Banda (Costo$)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.tripa_lbs' type="number" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Tripa (LBS/MILLAR)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.tripa_lbs_costo' type="number" class="form-control"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Tripa ($ Costo)</label>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.porcentaje_gasto_admin' type="number" class="form-control"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Gasto Adminitración (%)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.porcentaje_utilidad' type="number" class="form-control"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Utilidad (%)</label>
            </div>
        </div>
        <div class="col">
        </div>
        <div class="col">
        </div>
        <div class="col">
        </div>
        <div class="col">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">SALARIOS DIRECTO</span>
                </div>
                <input type="text" class="form-control" style="text-align: right"
                    wire:model='precio_nuevo.salario_directo' readonly placeholder="Username" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">COSTO SOCIAL
                        {{ $precio_nuevo->porcentaje_costo_social }}%</span>
                </div>
                @php
                    $costo_socila_dolar = ($precio_nuevo->porcentaje_costo_social / 100) * $precio_nuevo->salario_directo;
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($costo_socila_dolar, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">TOTAL</span>
                </div>
                @php
                    $s_directo_mas_costo_social = $costo_socila_dolar + $precio_nuevo->salario_directo;
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($s_directo_mas_costo_social, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">SALARIO INDIRECTOS
                        {{ $precio_nuevo->porcentaje_salario_indirecto }}%</span>
                </div>
                @php
                    $tota_salario_indirecto_empaque = $s_directo_mas_costo_social * ($precio_nuevo->porcentaje_salario_indirecto / 100);
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($tota_salario_indirecto_empaque, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">SALARIO EMPAQUE</span>
                </div>
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($precio_nuevo->salario_empaque, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">TOTAL</span>
                </div>
                @php
                    $total_costos1 = $precio_nuevo->salario_empaque + $tota_salario_indirecto_empaque + $s_directo_mas_costo_social;
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($total_costos1, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">COSTOS INDIRECTOS (PRODUCCION Y EMPAQUE)</span>
                </div>
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($precio_nuevo->costos_indirectos, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">MATERIAL DE EMPAQUE</span>
                </div>
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($precio_nuevo->material_empaque, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">TOTAL</span>
                </div>
                @php
                    $total_costos2 = $total_costos1 + $precio_nuevo->material_empaque + $precio_nuevo->costos_indirectos;
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($total_costos2, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">CAPA</span>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($precio_nuevo->capa_lbs, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">LBS/MILLAR</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($precio_nuevo->capa_lbs_costo, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">COSTO$</label>
                </div>
                @php
                    $totallbscosto_capa = $precio_nuevo->capa_lbs * $precio_nuevo->capa_lbs_costo;
                @endphp
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($totallbscosto_capa, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">LBS/COSTO$</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">BANDA</span>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($precio_nuevo->banda_lbs, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">LBS/MILLAR</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($precio_nuevo->banda_lbs_costo, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">COSTO$</label>
                </div>
                @php
                    $totallbscosto_banda = $precio_nuevo->banda_lbs * $precio_nuevo->banda_lbs_costo;
                @endphp
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($totallbscosto_banda, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">LBS/COSTO$</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">TRIPA</span>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($precio_nuevo->tripa_lbs, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">LBS/MILLAR</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($precio_nuevo->tripa_lbs_costo, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">COSTO$</label>
                </div>
                @php
                    $totallbscosto_tripa = $precio_nuevo->tripa_lbs * $precio_nuevo->tripa_lbs_costo;
                @endphp
                <div class="form-floating">
                    <input type="text" class="form-control" style="text-align: right" readonly
                        placeholder="Username" value="{{ number_format($totallbscosto_tripa, 2) }}"
                        aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingInput">LBS/COSTO$</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">TOTAL</span>
                </div>
                @php
                    $total_costos3 = $totallbscosto_tripa + $totallbscosto_banda + $totallbscosto_capa + $total_costos2;
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($total_costos3, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">GASTOS DE ADMINISTRACION
                        {{ $precio_nuevo->porcentaje_gasto_admin }}%</span>
                </div>
                @php
                    $total_gastos_admon = $total_costos3 * ($precio_nuevo->porcentaje_gasto_admin / 100);
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($total_gastos_admon, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">COSTO DE VENTA</span>
                </div>
                @php
                    $total_costo_venta = $total_costos3 + $total_gastos_admon;
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($total_costo_venta, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">UTILIDAD
                        {{ $precio_nuevo->porcentaje_utilidad }}%</span>
                </div>
                @php
                    $utilidad_total = ($precio_nuevo->porcentaje_utilidad / 100) * $total_costo_venta;
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($utilidad_total, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">PRECIO DE VENTA</span>
                </div>
                @php
                    $precio_venta = $utilidad_total + $total_costo_venta;
                @endphp
                <input type="text" class="form-control" style="text-align: right" readonly placeholder="Username"
                    value="{{ number_format($precio_venta, 2) }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</div>
