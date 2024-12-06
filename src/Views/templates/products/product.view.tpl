<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
        <form class="col-12 col-m-6 offset-m-3 depth-1"
            action="index.php?page=Products-Product&mode={{mode}}&productId={{productId}}" method="POST">
            <input type="hidden" name="productId" value="{{productId}}">
            <input type="hidden" name="xsrftk" value="{{xsrftk}}">
            <input type="hidden" name="mode" value="{{mode}}">

            <div class="row my-4">
                <label class="col-4" for="productId">Codigo:</label>
                <input class="col-8" type="text" name="productId" id="productId" value="{{productId}}" required
                    {{isReadOnly}}>
                {{with errors}}
                {{if error_productId}}
                {{foreach error_productId}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_productId}}
                {{endif error_productId}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="productName">Nombre:</label>
                <input class="col-8" type="text" name="productName" id="productName" value="{{productName}}" required
                    {{isReadOnly}}>
                {{with errors}}
                {{if error_productName}}
                {{foreach error_productName}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_productName}}
                {{endif error_productName}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="productDescription">Descripcion:</label>
                <input class="col-8" type="text" name="productDescription" id="productDescription"
                    value="{{productDescription}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_productDescription}}
                {{foreach error_productDescription}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_productDescription}}
                {{endif error_productDescription}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="productPrice">Precio:</label>
                <input class="col-8" type="text" name="productPrice" id="productPrice" value="{{productPrice}}"
                    required {{isReadOnly}}>
                {{with errors}}
                {{if error_productPrice}}
                {{foreach error_productPrice}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_productPrice}}
                {{endif error_productPrice}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="productImgUrl">ImgUrl:</label>
                <input class="col-8" type="text" name="productImgUrl" id="productImgUrl" value="{{productImgUrl}}"
                    required {{isReadOnly}}>
                {{with errors}}
                {{if error_productImgUrl}}
                {{foreach error_productImgUrl}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_productImgUrl}}
                {{endif error_productImgUrl}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="productStock">Stock:</label>
                <input class="col-8" type="text" name="productStock" id="productStock" value="{{productStock}}"
                    required {{isReadOnly}}>
                {{with errors}}
                {{if error_productStock}}
                {{foreach error_productStock}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_productStock}}
                {{endif error_productStock}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="productStatus">Estado:</label>
                <input class="col-8" type="text" name="productStatus" id="productStatus" value="{{productStatus}}"
                    required {{isReadOnly}}>
                {{with errors}}
                {{if error_productStatus}}
                {{foreach error_productStatus}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_productStatus}}
                {{endif error_productStatus}}
                {{endwith errors}}
            </div>

            <div class="row flex-end">
                {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
                {{endifnot isDisplay}}
                <button type="button" onclick="window.location='index.php?page=Products-Products'">
                    <i class="fa-solid fa-xmark"></i>
                    Cancelar
                </button>
            </div>
        </form>
    </section>
</section>