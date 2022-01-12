


<!-- INICIO DEL MODAL VER DETALLE PRODUCTO -->

<form action="{{Route('detalle_producto')}} "   method="POST" name="formde"id=" formde" >
    <div class="modal fade" role="dialog" id="modal_ver_detalle_producto" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-size:20px; width:3000px; text-align:center; font:bold" class="" id="staticBackdropLabel">Detalles del producto</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                
                    <div class="card-body">
                   
                        <div class="row">
                        @foreach($producto_unico as $producto_uni)
                           <h3>{{$producto_uni->item}} </h3>
                        @endforeach
                        </div>

                      

                <div class="modal-footer">
                   


                </div>
            </div>

            <input name="item_detalle" id="item_detalle"  value+="" hidden > </input>
        </div>
    </div>

</form>
<!-- FIN DEL MODAL VER DETALLE PRODUCTO -->