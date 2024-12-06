<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
        <form class="col-12 col-m-6 offset-m-3 depth-1"
            action="index.php?page=FuncionesRoles-FuncionesRol&mode={{mode}}&rolescod={{rolescod}}" method="POST">
            <input type="hidden" name="rolescod" value="{{rolescod}}">
            <input type="hidden" name="xsrftk" value="{{xsrftk}}">
            <input type="hidden" name="mode" value="{{mode}}">

            <div class="row my-4">
                <label class="col-4" for="prpr">Código:</label>
                <input class="col-8" type="text" name="rolescod" id="rolescod" value="{{rolescod}}" required>
            </div>

            <div class="row my-4">
                <label class="col-4" for="prfe">fncod:</label>
                <input class="col-8" type="text" name="fncod" id="fncod" value="{{fncod}}" required
                    {{isReadOnly}}>
                {{with errors}}
                {{if error_fncod}}
                {{foreach error_fncod}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_fncod}}
                {{endif error_fncod}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prto">fnrolest:</label>
                <input class="col-8" type="text" name="fnrolest" id="fnrolest" value="{{fnrolest}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_fnrolest}}
                {{foreach error_fnrolest}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_fnrolest}}
                {{endif error_fnrolest}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prde">fnexp:</label>
                <input class="col-8" type="date" name="fnexp" id="fnexp" value="{{fnexp}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_fnexp}}
                {{foreach error_fnexp}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_fnexp}}
                {{endif error_fnexp}}
                {{endwith errors}}
            </div>
        
            <div class="row flex-end">
                {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
                {{endifnot isDisplay}}
                <button type="button" onclick="window.location='index.php?page=FuncionesRoles-FuncionesRoles'">
                    <i class="fa-solid fa-xmark"></i>
                    Cancelar
                </button>
            </div>
        </form>
    </section>
</section>