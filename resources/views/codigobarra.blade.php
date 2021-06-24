<div xmlns:wire="http://www.w3.org/1999/xhtml">
<title></title>
   <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hola</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('css/tabla.js') }}"></script>
    @livewireStyles
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/jsbarcode/3.3.20/JsBarcode.all.min.js" >
<script src="JsBarcode.all.min.js"></script>

</head>


<button onclick="esto()">pa</button>
<script type="text/javascript">
function esto(){
    
JsBarcode("#pharmacode", "12345", {format: "pharmacode"});
}
</script>

<svg id="pharmacode"></svg>


<table class="table table-light"
style="font-size:10px;">
<thead>
<tr>
<th>Código</th>
<th>Descripción</th>
<th>Lote origen</th>
<th>Lote Destino</th>
<th>Cantidad</th>
<th>Costo Unitario</th>
<th>Subtotal</th>
<th>Barra_Subtotal</th>
</tr>
</thead>
<tbody>
@foreach($cajas as $caja)

        <tr>
        <td>{{$caja->codigo}}</td>
        <td>{{$caja->descripcion}}</td>
        <td>{{$caja->lote_origen}}</td>
        <td>{{$caja->lote_destino}}</td>
        <td>{{$caja->cantidad}}</td>
        <td>{{$caja->costo_u}}</td>
        <td>{{$caja->subtotal}}</td>
        <td> 	
            <svg class="barcode"
            jsbarcode-format="upc"
            jsbarcode-value="1234"
            jsbarcode-textmargin="0"
            jsbarcode-fontoptions="bold">
            </svg> 
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>  