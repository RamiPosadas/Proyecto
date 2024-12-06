<?php

namespace Controllers\Funciones;

use \Dao\Funciones\Funciones as DaoFunciones;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Funcion extends \Controllers\PrivateController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nueva Funcion",
        "UPD" => "Actualizando Funcion %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";

    private $fncod = "";
    private $fndsc = "";
    private $fnest = "";
    private $fntyp = "";

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
        if (isset($_GET["fncod"])) {
            $this->fncod = $_GET["fncod"];
        }
        if ($this->mode != "INS" && empty($this->fncod)) {
            throw new \Exception("ID no válido");
        }
    }
    

    private function getDatosFromDB()
    {
        if (!empty($this->fncod)) {
            $funcion = DaoFunciones::readFuncion($this->fncod);
            if (!$funcion) {
                throw new \Exception("Funcion no encontrado");
            }
            $this->fncod = $funcion["fncod"];
            $this->fndsc = $funcion["fndsc"];
            $this->fnest = $funcion["fnest"];
            $this->fntyp = $funcion["fntyp"];
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpCod = $_POST["fncod"] ?? "";
        $tmpDsc = $_POST["fndsc"] ?? "";
        $tmpEst = $_POST["fnest"] ?? "";
        $tmpTyp = $_POST["fntyp"] ?? "";

        $tmpMode = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }
        /*Codigo */
        if (Validators::IsEmpty($tmpCod)) {
            $this->addError("fncod", "El codigo no puede estar vacio", "error");
        }
        $this->fncod = $tmpCod;
        /*Descripcion */
        if (Validators::IsEmpty($tmpDsc)) {
            $this->addError("fndsc", "La descripcion no puede estar vacio", "error");
        }
        $this->fndsc = $tmpDsc;
        /*Estado*/
        if (Validators::IsEmpty($tmpEst)) {
            $this->addError("fnest", "El estado no puede estar vacio", "error");
        }
        $this->fnest = $tmpEst;
        /*Tipo */
        if (Validators::IsEmpty($tmpTyp)) {
            $this->addError("fntyp", "El tipo no puede estar vacio", "error");
        }
        $this->fntyp = $tmpTyp;
        /*Modo */
        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $insResult = DaoFunciones::createFuncion(
                    $this->fncod,
                    $this->fndsc,
                    $this->fnest,
                    $this->fntyp
                );
                $this->validateDBOperation(
                    "Funcion insertada correctamente",
                    "Ocurrio un error al insertar la funcion",
                    $insResult
                );
                break;
            case "UPD":
                $updResult = DaoFunciones::updateFuncion(
                    $this->fncod,
                    $this->fndsc,
                    $this->fnest,
                    $this->fntyp
                );
                $this->validateDBOperation(
                    "Funcion actualizada correctamente",
                    "Ocurrio un error al actualizar la funcion",
                    $updResult
                );
                break;
            case "DEL":
                $delResult = DaoFunciones::deleteFuncion($this->fncod);
                $this->validateDBOperation(
                    "Funcion eliminada correctamente",
                    "Ocurrio un error al eliminar la funcion",
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
                "index.php?page=Funciones-Funciones",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Funciones-Funciones",
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
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->fndsc);
        $viewData["fncod"] = $this->fncod;
        $viewData["fndsc"] = $this->fndsc;
        $viewData["fnest"] = $this->fnest;
        $viewData["fntyp"] = $this->fntyp;
        $viewData["errors"] = $this->errors;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("funciones/form", $viewData);
    }
}
