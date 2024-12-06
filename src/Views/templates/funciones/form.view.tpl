<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
    <form class="col-12 col-m-6 offset-m-3 depth-1" action="index.php?page=Funciones-Funcion&mode={{mode}}&fncod={{fncod}}" method="POST" >
        <input type="hidden" name="fncod" value="{{fncod}}">
        <input type="hidden" name="xsrftk" value="{{xsrftk}}">
        <input type="hidden" name="mode" value="{{mode}}">
        
        <div class="row my-4">
            <label class="col-4" for="fnfn">Código:</label>
            <input class="col-8" type="text" name="fncod" id="fnfn" value="{{fncod}}" required {{isReadOnly}}>
        </div>

        <div class="row my-4">
            <label class="col-4" for="fndesc">Descripción:</label>
            <input class="col-8" type="text" name="fndsc" id="fndesc" value="{{fndsc}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_dsc}}
                    {{foreach error_dsc}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_dsc}}
                {{endif error_dsc}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="fnesta">Estado:</label>
            <input class="col-8" type="text" name="fnest" id="fnesta" value="{{fnest}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_est}}
                    {{foreach error_est}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_est}}
                {{endif error_est}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="fntip">Tipo:</label>
            <input class="col-8" type="text" name="fntyp" id="fntip" value="{{fntyp}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_typ}}
                    {{foreach error_typ}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_typ}}
                {{endif error_typ}}
            {{endwith errors}}
        </div>
        <div class="row flex-end">
            {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
            {{endifnot isDisplay}}
            <button type="button" onclick="window.location='index.php?page=Funciones-Funciones'">
                <i class="fa-solid fa-xmark"></i>
                Cancelar
            </button>
        </div>
    </form>
    </section>
</section>