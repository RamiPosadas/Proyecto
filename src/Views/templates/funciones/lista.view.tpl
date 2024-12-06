<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de Funciones</h2>
        <section class="grid">
            <form action="index.php?page=Funciones-Funciones" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por descripcion" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>
                    {{if mnt_funciones_new}}
                    <a href="index.php?page=Funciones-Funcion&mode=INS">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        &nbsp; Nueva Funcion</a>
                </th>
                {{endif mnt_funciones_new}}
            </tr>
        </thead>
        <tbody>
            {{foreach funciones}}
            <tr>
                <td>{{fncod}}</td>
                <td><a href="index.php?page=Funciones-Funcion&mode=DSP&fncod={{fncod}}"><i
                            class="fa-solid fa-eye"></i> &nbsp;{{fndsc}}</a></td>
                <td>{{fnest}}</td>
                <td>{{fntyp}}</td>
                <td class="center">

                    {{if ~mnt_funciones_upd}}
                    <a href="index.php?page=Funciones-Funcion&mode=UPD&fncod={{fncod}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Editar
                    </a>
                    &nbsp;
                    {{endif ~mnt_funciones_upd}}
                    {{if ~mnt_funciones_del}}
                    &nbsp;
                    <a href="index.php?page=Funciones-Funcion&mode=DEL&fncod={{fncod}}">
                        <i class="fa-solid fa-trash-can"></i> &nbsp;
                        Eliminar
                    </a>
                    {{endif ~mnt_funciones_del}}
                </td>
            </tr>
            {{endfor funciones}}

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>