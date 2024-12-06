<section class="grid">
    <section class="row my-4">
        <form class="col-12 col-m-6 offset-m-3 depth-1"
            action="index.php?page=Purchasedetails-Purchasedetail&mode={{mode}}&id_purchase={{id_purchase}}" method="POST">
            <input type="hidden" name="id_purchase" value="{{id_purchase}}">
            <input type="hidden" name="xsrftk" value="{{xsrftk}}">
            <input type="hidden" name="mode" value="{{mode}}">

            <div class="row my-4">
                <label class="col-4" for="prpr">Código:</label>
                <input class="col-8" type="text" name="id_purchase" id="prpr" value="{{id_purchase}}">
            </div>

            <div class="row my-4">
                <label class="col-4" for="prfe">Item:</label>
                <input class="col-8" type="text" name="id_item_reference" id="prfe" value="{{id_item_reference}}" required
                    {{isReadOnly}}>
                {{with errors}}
                {{if error_id_item_reference}}
                {{foreach error_id_item_reference}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_id_item_reference}}
                {{endif error_id_item_reference}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prto">Cantidad:</label>
                <input class="col-8" type="text" name="quantity" id="prto" value="{{quantity}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_quantity}}
                {{foreach error_quantity}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_quantity}}
                {{endif error_quantity}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prde">Precio Unitario:</label>
                <input class="col-8" type="text" name="unitary_price" id="prde" value="{{unitary_price}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_unitary_price}}
                {{foreach error_unitary_price}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_unitary_price}}
                {{endif error_unitary_price}}
                {{endwith errors}}
            </div>

            <div class="row flex-end">
                {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
                {{endifnot isDisplay}}
                <button type="button" onclick="window.location='index.php?page=Purchasedetails-Purchasedetails'">
                    <i class="fa-solid fa-xmark"></i>
                    Cancelar
                </button>
            </div>
        </form>
    </section>
</section>
</form>