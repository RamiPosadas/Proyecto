<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
    <form class="col-12 col-m-6 offset-m-3 depth-1" action="index.php?page=Usuarios-Usuario&mode={{mode}}&id={{id}}" method="POST" >
        <input type="hidden" name="id" value="{{id}}">
        <input type="hidden" name="xsrftk" value="{{xsrftk}}">
        <input type="hidden" name="mode" value="{{mode}}">
        <div class="row my-4">
            <label class="col-4" for="id">Código:</label>
            <input class="col-8" type="text" name="id" id="id" value="{{id}}" readonly>
        </div>
        <div class="row my-4">
            <label class="col-4" for="email">Correo:</label>
            <input class="col-8" type="text" name="email" id="email" value="{{email}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_email}}
                    {{foreach error_email}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_email}}
                {{endif error_email}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="name">Nombre:</label>
            <input class="col-8" type="text" name="name" id="username" value="{{name}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_name}}
                    {{foreach error_name}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_name}}
                {{endif error_name}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="password">Contraseña:</label>
            <input class="col-8" type="text" name="password" id="password" value="{{password}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_password}}
                    {{foreach error_password}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_password}}
                {{endif error_password}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="fching">Fecha Ingreso:</label>
            <input class="col-8" type="text" name="fching" id="fching" value="{{fching}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_fching}}
                    {{foreach error_fching}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_fching}}
                {{endif error_fching}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="passwordest">Estado de Contraseña:</label>
            <input class="col-8" type="text" name="passwordest" id="passwordest" value="{{passwordest}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_passwordest}}
                    {{foreach error_passwordest}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_passwordest}}
                {{endif error_passwordest}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="passwordexp">Fecha de expiración:</label>
            <input class="col-8" type="text" name="passwordexp" id="passwordexp" value="{{passwordexp}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_passwordexp}}
                    {{foreach error_passwordexp}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_passwordexp}}
                {{endif error_passwordexp}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="est">Estado de usuario:</label>
            <input class="col-8" type="text" name="est" id="est" value="{{est}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_est}}
                    {{foreach error_est}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_est}}
                {{endif error_est}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="actcod">Actividad:</label>
            <input class="col-8" type="text" name="actcod" id="actcod" value="{{actcod}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_actcod}}
                    {{foreach error_actcod}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_actcod}}
                {{endif error_actcod}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="passwordchg">Contraseña chg:</label>
            <input class="col-8" type="text" name="passwordchg" id="passwordchg" value="{{passwordchg}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_passwordchg}}
                    {{foreach error_passwordchg}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_passwordchg}}
                {{endif error_passwordchg}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="tipo">Tipo:</label>
            <select class="col-8" name="tipo" id="tipo" required {{if isReadOnly}} readonly disabled {{endif isReadOnly}}>
                <option value="NOR" {{usuNOR}}>Normal</option>
                <option value="CON" {{usuCON}}>Consultor</option>
                <option value="CLI" {{usuCLI}}>Cliente</option>
            </select>
            {{with errors}}
                {{if error_tipo}}
                    {{foreach error_tipo}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_tipo}}
                {{endif error_tipo}}
            {{endwith errors}}
        </div>
        <div class="row flex-end">
            {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
            {{endifnot isDisplay}}
            <button type="button" onclick="window.location='index.php?page=Usuarios-Usuarios'">
                <i class="fa-solid fa-xmark"></i>
                Cancelar
            </button>
        </div>
    </form>
    </section>
</section>