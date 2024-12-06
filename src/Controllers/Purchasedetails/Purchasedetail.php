<?php

namespace Controllers\Purchasedetails;

use Views\Renderer;
use Dao\Purchasedetails\Purchasedetails as DAOPurchasedetail;
use Utilities\Site;
use Utilities\Validators;

class Purchasedetail extends \Controllers\PrivateController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Creando",
        "UPD" => "Editando %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";

    private $id_purchase = "";
    private $id_item_reference = "";
    private $quantity = 0;
    private $unitary_price = 0.00;
    private $errors = [];
    private $xsrftk = "";
    private $viewData = [];


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

        if ($this->mode != "INS" && !isset($_GET["id_purchase"])) {
            throw new \Exception("ID no válido");
        }

        if (isset($_GET["id_purchase"])) {
            $this->id_purchase = $_GET["id_purchase"];
        }
    }

    private function getDatosFromDB()
    {
        if (!empty($this->id_purchase)) {
            $purchasedetail = DAOPurchasedetail::obtenerPorId($this->id_purchase);
            if (!$purchasedetail) {
                throw new \Exception("Purchasedetail no encontrado");
            }
            $this->id_purchase = $purchasedetail["id_purchase"];
            $this->id_item_reference = $purchasedetail["id_item_reference"];
            $this->quantity = $purchasedetail["quantity"];
            $this->unitary_price = $purchasedetail["unitary_price"];
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpid_purchase = $_POST["id_purchase"] ?? "";
        $tmpid_item_reference = $_POST["id_item_reference"] ?? "";
        $tmpquantity = $_POST["quantity"] ?? "";
        $tmpunitary_price = $_POST["unitary_price"] ?? "";
        $tmpMode = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

        // id_purchase
        if (Validators::IsEmpty($tmpid_purchase)) {
            $this->addError("id_purchase", "El ID de compra no puede estar vacío", "error");
        }
        $this->id_purchase = $tmpid_purchase;

        // id_item_reference
        if (Validators::IsEmpty($tmpid_item_reference)) {
            $this->addError("id_item_reference", "La referencia del ítem no puede estar vacía", "error");
        }
        $this->id_item_reference = $tmpid_item_reference;

        // quantity
        if (Validators::IsEmpty($tmpquantity)) {
            $this->addError("quantity", "La cantidad no puede estar vacía", "error");
        }
        $this->quantity = $tmpquantity;

        // unitary_price
        if (Validators::IsEmpty($tmpunitary_price)) {
            $this->addError("unitary_price", "El precio unitario no puede estar vacío", "error");
        }
        $this->unitary_price = $tmpunitary_price;

        // Mode
        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }
        $this->mode = $tmpMode;
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $insResult = DAOPurchasedetail::insertPurchasedetail(
                    $this->id_purchase,
                    $this->id_item_reference,
                    $this->quantity,
                    $this->unitary_price
                );
                $this->validateDBOperation(
                    "creada exitosamente",
                    "Ocurrio un error",
                    $insResult
                );
                break;

            case "UPD":
                $updResult = DAOPurchasedetail::updatePurchasedetail(
                    $this->id_purchase,
                    $this->id_item_reference,
                    $this->quantity,
                    $this->unitary_price
                );
                $this->validateDBOperation(
                    "actualizada exitosamente",
                    "Ocurrio un error al actualizar",
                    $updResult
                );
                break;

            case "DEL":
                $delResult = DAOPurchasedetail::deletePurchasedetail($this->id_purchase);
                $this->validateDBOperation(
                    "eliminada exitosamente",
                    "Ocurrio un error al eliminar",
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
                "index.php?page=Purchasedetails-Purchasedetails",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Purchasedetails-Purchasedetails",
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
        $this->viewData["mode"] = $this->mode;
        $this->viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->id_purchase);

        $this->viewData["id_purchase"] = $this->id_purchase;
        $this->viewData["id_item_reference"] = $this->id_item_reference;
        $this->viewData["quantity"] = $this->quantity;
        $this->viewData["unitary_price"] = $this->unitary_price;

        $this->viewData["errors"] = $this->errors;
        $this->viewData["xsrftk"] = $this->xsrftk;
        $this->viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $this->viewData["isDisplay"] = $this->mode == "DSP";

        Renderer::render("purchasedetails/purchasedetail", $this->viewData);
    }
}