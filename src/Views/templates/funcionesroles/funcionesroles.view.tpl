<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de Funciones_Roles</h2>
        <section class="grid">
            <form action="index.php?page=FuncionesRoles-FuncionesRoles" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por ID" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Rolescod</th>
                <th>fncod</th>
                <th>fnrolest</th>
                <th>fnexp</th>
                <th><a href="index.php?page=FuncionesRoles-FuncionesRol&mode=INS">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        &nbsp; Nuevo Rol</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach funciones_roles}}
            <tr>
                <td>{{rolescod}}</td>
                <td>{{fncod}}</td>
                <td>{{fnrolest}}</td>
                <td>{{fnexp}}</td>
                <td class="center">
                    <a href="index.php?page=FuncionesRoles-FuncionesRol&mode=DSP&rolescod={{rolescod}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Visualizar
                    </a>
                    &nbsp;
                    &nbsp;
                    <a href="index.php?page=FuncionesRoles-FuncionesRol&mode=UPD&rolescod={{rolescod}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Editar
                    </a>
                    &nbsp;
                    &nbsp;
                    <a href="index.php?page=FuncionesRoles-FuncionesRol&mode=DEL&rolescod={{rolescod}}">
                        <i class="fa-solid fa-trash-can"></i> &nbsp;
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor funciones_roles}}

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>