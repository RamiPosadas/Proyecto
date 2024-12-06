<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
        <form class="col-12 col-m-6 offset-m-3 depth-1"
            action="index.php?page=Purchases-Purchase&mode={{mode}}&id_purchase={{id_purchase}}" method="POST">
            <input type="hidden" name="id_purchase" value="{{id_purchase}}">
            <input type="hidden" name="xsrftk" value="{{xsrftk}}">
            <input type="hidden" name="mode" value="{{mode}}">

            <div class="row my-4">
                <label class="col-4" for="prpr">Código:</label>
                <input class="col-8" type="text" name="id_purchase" id="prpr" value="{{id_purchase}}">
            </div>

            <div class="row my-4">
                <label class="col-4" for="prfe">Fecha:</label>
                <input class="col-8" type="date" name="purchase_date" id="prfe" value="{{purchase_date}}" required
                    {{isReadOnly}}>
                {{with errors}}
                {{if error_purchase_date}}
                {{foreach error_purchase_date}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_purchase_date}}
                {{endif error_purchase_date}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prto">Total:</label>
                <input class="col-8" type="text" name="total" id="prto" value="{{total}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_total}}
                {{foreach error_total}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_total}}
                {{endif error_total}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prde">Detalles:</label>
                <input class="col-8" type="text" name="details" id="prde" value="{{details}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_details}}
                {{foreach error_details}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_details}}
                {{endif error_details}}
                {{endwith errors}}
            </div>
            <div class="row my-4">
                <label class="col-4" for="prcd">Codigo del Usuario:</label>
                <input class="col-8" type="text" name="usercod" id="prcd" value="{{usercod}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_usercod}}
                {{foreach error_usercod}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_usercod}}
                {{endif error_usercod}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prpay">Payments:</label>
                <input class="col-8" type="text" name="payments" id="prpay" value="{{payments}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_payments}}
                {{foreach error_payments}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_payments}}
                {{endif error_payments}}
                {{endwith errors}}
            </div>

            <div class="row flex-end">
                {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
                {{endifnot isDisplay}}
                <button type="button" onclick="window.location='index.php?page=Purchases-Purchases'">
                    <i class="fa-solid fa-xmark"></i>
                    Cancelar
                </button>
            </div>
        </form>
    </section>
</section>