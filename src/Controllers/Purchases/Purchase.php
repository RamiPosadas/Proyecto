<?php

namespace Controllers\Purchases;

use \Dao\Purchases\Purchases as DaoPurchases;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Purchase extends \Controllers\PrivateController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nuevo",
        "UPD" => "Actualizando %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";

    private $id_purchase = "";
    private $purchase_date = "";
    private $total = 0.00;
    private $details = "";
    private $usercod = "";
    private $payments = "";

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
        if (isset($_GET["id_purchase"])) {
            $this->id_purchase = $_GET["id_purchase"];
        }

        if ($this->mode != "INS" && empty($this->id_purchase)) {
            throw new \Exception("ID no válido");
        }
    }


    private function getDatosFromDB()
    {
        if (!empty($this->id_purchase)) {
            $purchases = DaoPurchases::obtenerPorId($this->id_purchase);
            if (!$purchases) {
                throw new \Exception("Purchase no encontrado");
            }
            $this->id_purchase = $purchases["id_purchase"];
            $this->purchase_date = $purchases["purchase_date"];
            $this->total = $purchases["total"];
            $this->details = $purchases["details"];
            $this->usercod = $purchases["usercod"];
            $this->payments = $purchases["payments"];
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpid = $_POST["id_purchase"] ?? "";
        $tmpdate = $_POST["purchase_date"] ?? "";
        $tmptotal = $_POST["total"] ?? "";
        $tmpdetails = $_POST["details"] ?? "";
        $tmpuser = $_POST["usercod"] ?? "";
        $tmppayments = $_POST["payments"] ?? "";

        $tmpMode = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

    
        if (Validators::IsEmpty($tmpid)) {
            $this->addError("id_purchase", "El ID no puede estar vacio", "error");
        }
        $this->id_purchase = $tmpid;


        if (Validators::IsEmpty($tmpdate)) {
            $this->addError("purchase_date", "La fecha no puede estar vacia", "error");
        }
        $this->purchase_date = $tmpdate;

        /*total*/
        if (Validators::IsEmpty($tmptotal)) {
            $this->addError("total", "El total no puede estar vacio", "error");
        }
        $this->total = $tmptotal;

        /*details */
        if (Validators::IsEmpty($tmpdetails)) {
            $this->addError("details", "Los detalles no pueden estar vacios", "error");
        }
        $this->details = $tmpdetails;

        /*usercod */
        if (Validators::IsEmpty($tmpuser)) {
            $this->addError("usercod", "El usuario no puede estar vacio", "error");
        }
        $this->usercod = $tmpuser;

        /*payments */
        if (Validators::IsEmpty($tmppayments)) {
            $this->addError("payments", "El payment no pueden estar vacio", "error");
        }
        $this->payments = $tmppayments;


        /*Modo */
        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $insResult = DaoPurchases::insertPurchase(
                    $this->id_purchase,
                    $this->purchase_date,
                    $this->total,
                    $this->details,
                    $this->usercod,
                    $this->payments
                );
                $this->validateDBOperation(
                    "Insertado correctamente",
                    "Ocurrio un error al insertar",
                    $insResult
                );
                break;

            case "UPD":
                $updResult = DaoPurchases::updatePurchase(
                    $this->id_purchase,
                    $this->purchase_date,
                    $this->total,
                    $this->details,
                    $this->usercod,
                    $this->payments
                );
                $this->validateDBOperation(
                    "Actualizado correctamente",
                    "Ocurrio un error al actualizar",
                    $updResult
                );
                break;

            case "DEL":
                $delResult = DaoPurchases::deletePurchase($this->id_purchase);
                $this->validateDBOperation(
                    "Eliminado correctamente",
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
                "index.php?page=Purchases-Purchases",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Purchases-Purchases",
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
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->id_purchase);

        $viewData["id_purchase"] = $this->id_purchase;
        $viewData["purchase_date"] = $this->purchase_date;
        $viewData["total"] = $this->total;
        $viewData["details"] = $this->details;
        $viewData["usercod"] = $this->usercod;
        $viewData["payments"] = $this->payments;

        $viewData["errors"] = $this->errors;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("purchases/purchase", $viewData);
    }
}