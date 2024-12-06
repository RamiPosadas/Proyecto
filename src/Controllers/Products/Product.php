<?php

namespace Controllers\Products;

use \Dao\Products\Products as DaoProducts;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Product extends \Controllers\PrivateController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nuevo",
        "UPD" => "Actualizando %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";
    private $productId=0;
    private $productName="";
    private $productDescription="";
    private $productPrice=0;
    private $productImgUrl="";
    private $productStock=0;
    private $productStatus="";
    private $errors = array();
    private $xsrftk = "";

    public function run(): void
    {
        $this->obtenerDatosDelGet();
        $this->getDatosFromDB();
        if ($this->isPostBack()) {
            $this->obtenerDatosDePost();
            if (count($this->errors) === 0) {
                $this->procesarAccion();
            }
        }
        $this->showView();
    }

    private function obtenerDatosDelGet()
    {
        if (isset($_GET["mode"])) {
            $this->mode = $_GET["mode"];
        }
        if (!isset($this->modeDscArr[$this->mode])) {
            throw new \Exception("Modo no válido");
        }
        if (isset($_GET["productId"])) {
            $this->productId= $_GET["productId"];
        }

        if ($this->mode != "INS" && $this->productId <= 0) {
            throw new \Exception("ID no válido");
        }
    }


    private function getDatosFromDB()
    {
        if($this->productId > 0){
            $products = DaoProducts::obtenerPorId($this->productId);
            if (!$products) {
                throw new \Exception("Producto del bueno no encontrado");
            }
            $this->productName = $products["productName"];
            $this->productDescription = $products["productDescription"];
            $this->productImgUrl = $products["productImgUrl"];
            $this->productStock = $products["productStock"];
            $this->productStatus = $products["productStatus"];
            $this->productPrice = $products["productPrice"];
            
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpName = $_POST["productName"] ?? "";
        $tmpDes = $_POST["productDescription"] ?? "";
        $tmpPrice = $_POST["productPrice"] ?? "";
        $tmpImg = $_POST["productImgUrl"] ?? "";
        $tmStok = $_POST["productStock"] ?? "";
        $tmpStatu = $_POST["productStatus"] ?? "";

        $tmpMode = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

  
        if (Validators::IsEmpty($tmpName)) {
            $this->addError("productName", "El NOMBRE no puede estar vacio", "error");
        }
        $this->productName = $tmpName;

        // Validate and set product description (assuming you need it)
    if (Validators::IsEmpty($tmpDes)) {
        $this->addError("productDescription", "La DESCRIPCIÓN no puede estar vacía", "error");
    }
    $this->productDescription = $tmpDes;

    // Validate and set product price
    if (Validators::IsEmpty($tmpPrice)) {
        $this->addError("productPrice", "El PRECIO no puede estar vacío", "error");
    }
    $this->productPrice = $tmpPrice;

    // Validate and set product image URL
    if (Validators::IsEmpty($tmpImg)) {
        $this->addError("productImgUrl", "La IMAGEN no puede estar vacía", "error");
    }
    $this->productImgUrl = $tmpImg;

    // Validate and set product stock
    if (Validators::IsEmpty($tmStok)) {
        $this->addError("productStock", "El STOCK no puede estar vacío", "error");
    }
    $this->productStock = $tmStok;

    // Validate and set product status
    if (Validators::IsEmpty($tmpStatu)) {
        $this->addError("productStatus", "El ESTADO no puede estar vacío", "error");
    }
    $this->productStatus = $tmpStatu;

    // Validate mode
    if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
        $this->throwError("Ocurrió un error al procesar la solicitud.");
    }
}

private function procesarAccion()
{
    switch ($this->mode) {
        case "INS":
            $insResult = DaoProducts::insertProducts(
                $this->productId,
                $this->productName,
                $this->productDescription,
                $this->productPrice,
                $this->productImgUrl,
                $this->productStock,
                $this->productStatus,
            );
            $this->validateDBOperation(
                "PRODUCTO insertado correctamente",
                "Ocurrio un error al insertar el PRODUCTO",
                $insResult
            );
            break;
        case "UPD":
            $updResult = DaoProducts::updateProducts(
                $this->productId,
                $this->productName,
                $this->productDescription,
                $this->productPrice,
                $this->productImgUrl,
                $this->productStock,
                $this->productStatus,
            );
            $this->validateDBOperation(
                "PRODUCTOS actualizado correctamente",
                "Ocurrio un error al actualizar el PRODUCTO",
                $updResult
            );
            break;
        case "DEL":
            $delResult = DaoProducts::deleteProducts($this->productId);
            $this->validateDBOperation(
                "PRODUCTOS eliminado correctamente",
                "Ocurrio un error al eliminar el PRODUCTOS",
                $delResult
            );
            break;
    }
}

    private function validateDBOperation($msg, $error, $result)
    {
        if (!$result) {
            $this->errors["error_general"] = $error;
        } else {
            Site::redirectToWithMsg(
                "index.php?page=Products-Products",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Products-Products",
            $msg
        );
    }

    private function addError($key, $msg, $context = "general")
    {
        if (!isset($this->errors[$context . "_" . $key])) {
            $this->errors[$context . "_" . $key] = [];
        }
        $this->errors[$context . "_" . $key][] = $msg;
    }

    private function generateXSRFToken()
    {
        $this->xsrftk = md5(uniqid(rand(), true));
        $_SESSION[$this->name . "_xsrftk"] = $this->xsrftk;
    }
    private function getXSRFToken()
    {
        if (isset($_SESSION[$this->name . "_xsrftk"])) {
            $this->xsrftk = $_SESSION[$this->name . "_xsrftk"];
        }
    }
    private function compareXSRFToken($postXSFR)
    {
        return $postXSFR === $this->xsrftk;
    }

    private function showView()
    {
        $this->generateXSRFToken();
        $viewData = array();
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->productId);
        $viewData["productId"] = $this->productId;
        $viewData["productName"] = $this->productName;
        $viewData["productDescription"] = $this->productDescription;
        $viewData["productPrice"] = $this->productPrice;
        $viewData["productImgUrl"] = $this->productImgUrl;
        $viewData["productStock"] = $this->productStock;
        $viewData["productStatus"] = $this->productStatus;
        $viewData["errors"] = $this->errors;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("products/product", $viewData);
    }
}