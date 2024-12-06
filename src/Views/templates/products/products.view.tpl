<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de Productos</h2>
        <section class="grid">
            <form action="index.php?page=Products-Products" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por id" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Url</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>
                    {{if mnt_products_new}}
                    <a href="index.php?page=Products-Product&mode=INS">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        &nbsp; Ingresar Nuevos Productos</a>
                    {{endif mnt_products_new}}
                </th>

            </tr>
        </thead>
        <tbody>
            {{foreach products}}
            <tr>
                <td>{{productId}}</td>
                <td>{{productName}}</td>
                <td>{{productDescription}}</td>
                <td>{{productPrice}}</td>
                <td>{{productImgUrl}}</td>
                <td>{{productStock}}</td>
                <td>{{productStatus}}</td>
                <td class="center">
                    <a href="index.php?page=Products-Product&mode=DSP&productId={{productId}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Visualizar
                    </a>
                    &nbsp;
                    {{if ~mnt_products_upd}}
                    <a href="index.php?page=Products-Product&mode=UPD&productId={{productId}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Editar
                    </a>
                    &nbsp;
                    {{endif ~mnt_products_upd}}
                    {{if ~mnt_products_del}}
                    &nbsp;
                    <a href="index.php?page=Products-Product&mode=DEL&productId={{productId}}">
                        <i class="fa-solid fa-trash-can"></i> &nbsp;
                        Eliminar
                    </a>
                    {{endif ~mnt_products_del}}
                </td>
            </tr>
            {{endfor products}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>