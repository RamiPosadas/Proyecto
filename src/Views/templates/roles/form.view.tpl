<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
    <form class="col-12 col-m-6 offset-m-3 depth-1" action="index.php?page=Roles-Rol&mode={{mode}}&rolescod={{rolescod}}" method="POST" >
        <input type="hidden" name="rolescod" value="{{rolescod}}">
        <input type="hidden" name="xsrftk" value="{{xsrftk}}">
        <input type="hidden" name="mode" value="{{mode}}">
        <div class="row my-4">
            <label class="col-4" for="rolescod">Código:</label>
            <input class="col-8" type="text" name="rolescod" id="rolescod" value="{{rolescod}}" required {{isReadOnly}}>
        </div>
    
        <div class="row my-4">
            <label class="col-4" for="name">Nombre:</label>
            <input class="col-8" type="text" name="rolesdsc" id="rolesdsc" value="{{rolesdsc}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_name}}
                    {{foreach error_name}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_name}}
                {{endif error_name}}
            {{endwith errors}}
        </div>
        
        <div class="row my-4">
            <label class="col-4" for="rolesest">Estado de Rol:</label>
            <input class="col-8" type="text" name="rolesest" id="rolesest" value="{{rolesest}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_rolesest}}
                    {{foreach error_rolesest}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_rolesest}}
                {{endif error_rolesest}}
            {{endwith errors}}
        </div>

        <div class="row flex-end">
            {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
            {{endifnot isDisplay}}
            <button type="button" onclick="window.location='index.php?page=Roles-Roles'">
                <i class="fa-solid fa-xmark"></i>
                Cancelar
            </button>
        </div>
    </form>
    </section>
</section>