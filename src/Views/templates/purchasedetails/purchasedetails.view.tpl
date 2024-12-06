<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de Purchases</h2>
        <section class="grid">
            <form action="index.php?page=Purchasedetails-Purchasedetails" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por ID" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Iten</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>
                    {{if mnt_purchases_new}}
                    <a href="index.php?page=Purchasedetails-Purchasedetail&mode=INS">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        &nbsp; Nuevo</a>
                </th>
                    {{endif mnt_purchases_new}}
            </tr>
        </thead>
        <tbody>
            {{foreach purchasedetails}}
            <tr>
                <td>{{id_purchase}}</td>
                <td>{{id_item_reference}}</td>
                <td>{{quantity}}</td>
                <td>{{unitary_price}}</td>
                <td class="center">
                    <a href="index.php?page=Purchasedetails-Purchasedetail&mode=DSP&id_purchase={{id_purchase}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Visualizar
                    </a>
                    &nbsp;
                    {{if ~mnt_purchases_upd}}
                    <a href="index.php?page=Purchasedetails-Purchasedetail&mode=UPD&id_purchase={{id_purchase}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Editar
                    </a>
                    &nbsp;
                    {{endif ~mnt_purchases_upd}}
                    {{if ~mnt_purchases_del}}
                    &nbsp;
                    <a href="index.php?page=Purchasedetails-Purchasedetail&mode=DEL&id_purchase={{id_purchase}}">
                        <i class="fa-solid fa-trash-can"></i> &nbsp;
                        Eliminar
                    </a>
                    {{endif ~mnt_purchases_del}}
                </td>
            </tr>
            {{endfor purchasedetails}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>


