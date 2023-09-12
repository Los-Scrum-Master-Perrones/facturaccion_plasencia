 <table class="table table-light" style="font-size:10px;">
     <thead style="position: static;">
         <tr style="font-size:16px; text-align:center;">
             <th style=" text-align:center;">#</th>
             <th style=" text-align:center;">Codigo</th>
             <th style=" text-align:center;">Marcas</th>
             <th style=" text-align:center;">Nombre</th>
             <th style=" text-align:center;">Vitolas</th>
             <th style=" text-align:center;">Capas</th>
             <th style=" text-align:center;">Tipo de Empaque</th>
             <th style=" text-align:center;">Precio ({{ Carbon\Carbon::now()->format('Y') }})</th>
         </tr>
     </thead>

     <tbody>
         @php
         $count = 1;
         @endphp
         @foreach ($prodcutosPrecio as $key => $prodPrecio)
         <tr>
             <td>{{ $count }}</td>
             <td>{{ $prodPrecio->codigo }}</td>
             <td>{{ $prodPrecio->marca }}</td>
             <td>{{ $prodPrecio->nombre }}</td>
             <td>{{ $prodPrecio->vitola }}</td>
             <td>{{ $prodPrecio->capa }}</td>
             <td>{{ $prodPrecio->tipo_empaque }}</td>
             <td style="text-align: right">
                 {{ '$ ' . number_format($prodPrecio->precio, 2) }}
             </td>
         </tr>
         @php
         $count++;
         @endphp
         @endforeach
     </tbody>
 </table>
