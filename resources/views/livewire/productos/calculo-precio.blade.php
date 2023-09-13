<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="form-floating">
                <select wire:model='precio_nuevo.id_vitola' class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option>Seleccione</option>
                  @foreach ($vitolas as $vitola)
                    <option value="{{  $vitola->id_vitola }}">{{  $vitola->vitola }}</option>
                  @endforeach
                </select>
                <label for="floatingSelect">Vitolas</label>
            </div>
        </div>
        <div class="col-5">
            <div class="form-floating">
                <select wire:model='precio_nuevo.id_marca_precio' class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option>Seleccione</option>
                  @foreach ($marcas as $marca)
                    <option value="{{  $marca->id }}">{{  $marca->codigo.'-'.$marca->marca }}</option>
                  @endforeach
                </select>
                <label for="floatingSelect">Marcas</label>
              </div>
        </div>
        <div class="col-4"></div>
    </div>
    <br>
    <div class="row text-center">
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.salario_directo' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Salario Directo</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.salario_empaque' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Salario Empaque</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.costos_indirectos' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Costos Indirectos</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.material_empaque' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Material de Empaque</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.porcentaje_costo_social' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Costo Social(%)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.porcentaje_salario_indirecto' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Salario Indirecto(%)</label>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.capa_lbs' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Capa (LBS/MILLAR)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.capa_lbs_costo' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Capa ($ Costo)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.banda_lbs' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Banda (LBS/MILLAR)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.banda_lbs_costo' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Banda (Costo$)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.tripa_lbs' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Tripa (LBS/MILLAR)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.tripa_lbs_costo' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Tripa ($ Costo)</label>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.porcentaje_gasto_admin' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Gasto Adminitración (%)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input wire:model='precio_nuevo.porcentaje_utilidad' type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
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
</div>

