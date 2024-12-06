<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de Purchases</h2>
        <section class="grid">
            <form action="index.php?page=Purchases-Purchases" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por ID" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Detalles</th>
                <th>Codigo del Usuario</th>
                <th>Pagos</th>
                <th>
                    {{if mnt_purchases_new}}
                    <a href="index.php?page=Purchases-Purchase&mode=INS">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        &nbsp; Nuevo Purchase</a></th>
                    {{endif mnt_purchases_new}}
            </tr>
        </thead>
        <tbody>
            {{foreach purchases}}
            <tr>
                <td>{{id_purchase}}</td>
                <td>{{purchase_date}}</td>
                <td>{{total}}</td>
                <td>{{details}}</td>
                <td>{{usercod}}</td>
                <td>{{payments}}</td>
                <td class="center">
                    <a href="index.php?page=Purchases-Purchase&mode=DSP&id_purchase={{id_purchase}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Visualizar
                    </a>
                    &nbsp;

                    {{if ~mnt_purchases_upd}}
                    <a href="index.php?page=Purchases-Purchase&mode=UPD&id_purchase={{id_purchase}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Editar
                    </a>
                    &nbsp;
                    {{endif ~mnt_purchases_upd}}

                    {{if ~mnt_purchases_del}}
                    &nbsp;
                    <a href="index.php?page=Purchases-Purchase&mode=DEL&id_purchase={{id_purchase}}">
                        <i class="fa-solid fa-trash-can"></i> &nbsp;
                        Eliminar
                    </a>
                    {{endif ~mnt_purchases_del}}

                </td>
            </tr>
            {{endfor purchases}}

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>