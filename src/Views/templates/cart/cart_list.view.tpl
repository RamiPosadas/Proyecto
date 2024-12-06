<h1>Carrito de Compras</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{foreach cartItems}}
            <tr>
                <td>{{productId}}</td>
                <td>{{productName}}</td>
                <td>{{productStock}}</td>
                <td>{{productPrice}}</td>
                <td>
                    <a href="index.php?page=Cart-Manage&productId={{productId}}">
                        <i class="fas fa-edit"></i> Ver Detalles
                    </a>
                </td>
            </tr>
            {{endfor cartItems}}
        </tbody>
    </table>
</section>
