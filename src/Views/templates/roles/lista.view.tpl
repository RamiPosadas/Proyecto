<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de Roles</h2>
        <section class="grid">
            <form action="index.php?page=Roles-Roles" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por nombre" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>
                    {{if mnt_roles_new}}
                    <a href="index.php?page=Roles-Rol&mode=INS">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    &nbsp; Nuevo Rol</a></th>
                    {{endif mnt_roles_new}}
            </tr>
        </thead>
        <tbody>
            {{foreach roles}}
                <tr>
                    <td>{{rolescod}}</td>
                    <td><a href="index.php?page=Roles-Rol&mode=DSP&rolescod={{rolescod}}"><i class="fa-solid fa-eye"></i> &nbsp;{{rolesdsc}}</a></td>
                    <td>{{rolesest}}</td>
                    <td class="center">
                        {{if ~mnt_roles_upd}}
                        <a href="index.php?page=Roles-Rol&mode=UPD&rolescod={{rolescod}}">
                            <i class="fa-solid fa-pen"></i> &nbsp; Editar
                        </a>
                        &nbsp;
                        {{endif ~mnt_roles_upd}}
                        {{if ~mnt_roles_del}}
                        &nbsp;
                        <a href="index.php?page=Roles-Rol&mode=DEL&rolescod={{rolescod}}">
                            <i class="fa-solid fa-trash-can"></i> &nbsp;
                            Eliminar
                        </a>
                        {{endif ~mnt_roles_del}}
                    </td>
                </tr>
            {{endfor roles}}

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>