<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de usuarios</h2>
        <section class="grid">
            <form action="index.php?page=Usuarios-Usuarios" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por nombre" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Contraseña</th>
                <th>Fecha Ingreso</th>
                <th>Estado Contraseña</th>
                <th>Fecha Expiración Contraseña</th>
                <th>Estado de Usuario</th>
                <th>Actividad</th>
                <th>Contraseña chg</th>
                <th>Tipo de Usuario</th>
                <th>
                    {{if mnt_users_new}}
                    <a href="index.php?page=Usuarios-Usuario&mode=INS">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    &nbsp; Nuevo Usuario</a></th>
                    {{endif mnt_users_new}}
            </tr>
        </thead>
        <tbody>
            {{foreach usuarios}}
                <tr>
                    <td>{{usercod}}</td>
                    <td>{{useremail}}</td>
                    <td><a href="index.php?page=Usuarios-Usuario&mode=DSP&id={{usercod}}"><i class="fa-solid fa-eye"></i> &nbsp;{{username}}</a></td>
                    <td>{{userpswd}}</td>
                    <td>{{userfching}}</td>
                    <td>{{userpswdest}}</td>
                    <td>{{userpswdexp}}</td>
                    <td>{{userest}}</td>
                    <td>{{useractcod}}</td>
                    <td>{{userpswdchg}}</td>
                    <td>{{usertipo}}</td>
                    <td class="center">
                        {{if ~mnt_users_upd}}
                        <a href="index.php?page=Usuarios-Usuario&mode=UPD&id={{usercod}}">
                            <i class="fa-solid fa-pen"></i> &nbsp; Editar
                        </a>
                        &nbsp;
                        {{endif ~mnt_users_upd}}

                        {{if ~mnt_users_del}}
                        &nbsp;
                        <a href="index.php?page=Usuarios-Usuario&mode=DEL&id={{usercod}}">
                            <i class="fa-solid fa-trash-can"></i> &nbsp;
                            Eliminar
                        </a>
                        {{endif ~mnt_users_del}}

                    </td>
                </tr>
            {{endfor usuarios}}

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>