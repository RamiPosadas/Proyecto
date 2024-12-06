<div class="grid-container">
    <section class="grid1">
        {{if ~mnt_adm}}
        <section class="admin-menu">
            <h2>Menú</h2>
            <ul class="admin-list">
                <li><a href="index.php?page=Purchases-Purchases">Compras</a></li>

                <li><a href="index.php?page=Products-Products">Productos</a></li>
                <li><a href="index.php?page=Purchasedetails-Purchasedetails">Detalle de compras</a></li>
                <li><a href="index.php?page=Roles-Roles">Roles</a></li>
                <li><a href="index.php?page=Usuarios-Usuarios">Usuarios</a></li>
            </ul>
        </section>
        {{endif ~mnt_adm}}

        {{if ~mnt_cln}}
        <h2>Mercado Z</h2>
        <h2>Encuentra todo lo que necesitas en un solo lugar</h2>
        <hr>
        <section class="products-list">
            {{foreach productos}}
            <article id={{productId}}>
                <img src={{productImgUrl}} alt="{{productName}}">
                <h3>{{productName}}</h3>
                <p>{{productDescription}}</p>
                <p class="price">$<span>{{productPrice}}</span></p>
                <form method="POST" action="index.php?page=Inicio-Inicio">
                    <input type="hidden" name="xsxtoken" value="{{~token}}">
                    <input type="hidden" name="productId" value="{{productId}}">
                    <input type="hidden" name="productName" value="{{productName}}">
                    <input type="hidden" name="productDescription" value="{{productDescription}}">
                    <input type="hidden" name="productPrice" value="{{productPrice}}">
                    <label for="productQuantity">Cantidad a comprar:</label>
                    <input type="number" id="productQuantity" name="productQuantity" min="0" placeholder="Cantidad" required>
                    <button type="submit" name="addToCart">Agregar al carrito</button>
                </form>
            </article>
            {{endfor productos}}
        </section>

        <section class="purchases-history">
            <h2>Historial de Compras</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha de Compra</th>
                        <th>ID de Compra</th>
                        <th>Detalles</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{foreach compras}}
                    <tr>
                        <td>{{purchase_date}}</td>
                        <td>{{id_purchase}}</td>
                        <td>{{details}}</td>
                        <td>{{total}}</td>
                    </tr>
                    {{endfor compras}}
                </tbody>
            </table>
        </section>
        {{endif ~mnt_cln}}
    </section>

    <style>
        h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        h2 {
            text-align: center;
        }

        .grid1 {
            padding: 2rem;
        }
        /*Estilos para menu admin*/
        .admin-menu h2 {
            font-size: 3rem;
            margin: 1rem 0;
            text-align: center;
        }

        .admin-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .admin-list li {
            margin: 0.5rem;
            flex: 1 1 30%;
            display: flex;
            justify-content: center;
        }

        .admin-list a {
            display: block;
            width: 100%;
            padding: 1rem;
            background-color: #4a90e2;
            color: white;
            text-align: center;
            border-radius: 10px;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
        }

        .admin-list a:hover {
            background-color: #357ab8;
        }
        

        .hero-banner {
            background-color: #70542f;
            color: white;
            text-align: center;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .hero-banner h2 {
            font-size: 2rem;
            margin: 0;
        }

        .hero-banner p {
            font-size: 1.2rem;
        }

        .hero-banner span {
            font-weight: bold;
            color: #fff;
        }

        .products-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        article {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 1rem;
            max-width: 300px;
            text-align: center;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
            padding: 1rem;
        }

        article:hover {
            transform: translateY(-10px);
        }

        article img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
            margin-bottom: 1rem;
        }

        article h3 {
            font-size: 1.5rem;
            margin: 1rem 0 0.5rem;
            color: #333;
        }

        article p {
            font-size: 1rem;
            color: #666;
            margin: 0.5rem 0;
        }

        article .price {
            font-size: 1.2rem;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form label {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        form input[type="number"] {
            padding: 0.5rem;
            font-size: 1rem;
            margin-bottom: 1rem;
            width: 80%;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        form button {
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        form button:hover {
            background-color: #357ab8;
        }

        /* Estilos para la tabla */
        .purchases-history {
            margin-top: 2rem;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #bdc3c7; 
        }

        th, td {
            padding: 12px;
            text-align: left;
            transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out;
        }

        th {
            background-color: #ecf0f1; 
            color: #2c3e50; 
        }

        tr:nth-child(even) {
            background-color: #ffffff; 
        }

        tr:nth-child(odd) {
            background-color: #f9f9f9; 
        }

        tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.02); 
        }

        @media (max-width: 768px) {
            article {
                flex: 1 1 45%;
            }
        }

        @media (max-width: 480px) {
            article {
                flex: 1 1 100%;
            }
        }
    </style>
</div>