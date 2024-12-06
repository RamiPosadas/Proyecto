<?php

namespace Controllers\FuncionesRoles;

use \Dao\FuncionesRoles\FuncionesRoles as DaoFuncionesRoles;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class FuncionesRol extends \Controllers\PublicController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nueva Funcion del Rol",
        "UPD" => "Actualizando Funciones Roles %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";

    private $rolescod = "";
    private $fncod = "";
    private $fnrolest = "";
    private $fnexp = "";
 
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
        if (isset($_GET["rolescod"])) {
            $this->rolescod = $_GET["rolescod"];
        }

        if ($this->mode != "INS" && empty($this->rolescod)) {
            throw new \Exception("ID no válido");
        }
    }


    private function getDatosFromDB()
    {
        if (!empty($this->rolescod)) {
            $funciones_roles = DaoFuncionesRoles::obtenerPorId($this->rolescod);
            if (!$funciones_roles) {
                throw new \Exception("funcion rol no encontrado");
            }
            $this->fncod = $funciones_roles["fncod"];
            $this->fnrolest = $funciones_roles["fnrolest"];
            $this->fnexp = $funciones_roles["fnexp"];
        
        }

    }

    private function obtenerDatosDePost()
    {
        $tmpid = $_POST["rolescod"] ?? "";
        $tmpcod = $_POST["fncod"] ?? "";
        $tmprolest = $_POST["fnrolest"] ?? "";
        $tmpexp = $_POST["fnexp"] ?? "";
       

        $tmpMode = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }


        if (Validators::IsEmpty($tmpid)) {
            $this->addError("rolescod", "El ID no puede estar vacio", "error");
        }
        $this->rolescod = $tmpid;

  
        if (Validators::IsEmpty($tmpcod)) {
            $this->addError("fncod", "La descrpicion no puede estar vacia", "error");
        }
        $this->fncod = $tmpcod;


        /*total*/
        if (Validators::IsEmpty($tmprolest)) {
            $this->addError("fnrolest", "El est no puede estar vacio", "error");
        }
        $this->fnrolest = $tmprolest;

        /*details */
        if (Validators::IsEmpty($tmpexp)) {
            $this->addError("fnexp", "Los tipos no pueden estar vacios", "error");
        }
        $this->fnexp = $tmpexp;

        /*Modo */
        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $insResult = DaoFuncionesRoles::insertFuncionesRoles(
                    $this->rolescod,
                    $this->fncod,
                    $this->fnrolest,
                    $this->fnexp
                   
                );
                $this->validateDBOperation(
                    "Funcion Rol insertado correctamente",
                    "Ocurrio un error al insertar la funcion",
                    $insResult
                );
                break;

            case "UPD":
                $updResult = DaoFuncionesRoles::updateFuncionesRoles(
                    $this->rolescod,
                    $this->fncod,
                    $this->fnrolest,
                    $this->fnexp
                );
                $this->validateDBOperation(
                    "Funcion Rol actualizado correctamente",
                    "Ocurrio un error al actualizar la Funcion",
                    $updResult
                );
                break;

            case "DEL":
                $delResult = DaoFuncionesRoles::deleteFuncionesRoles($this->rolescod);
                $this->validateDBOperation(
                    "Funcion eliminado correctamente",
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
                "index.php?page=FuncionesRoles-FuncionesRoles",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=FuncionesRoles-FuncionesRoles",
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
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->rolescod);

        $viewData["rolescod"] = $this->rolescod;
        $viewData["fncod"] = $this->fncod;
        $viewData["fnrolest"] = $this->fnrolest;
        $viewData["fnexp"] = $this->fnexp;
       

        $viewData["errors"] = $this->errors;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("funcionesroles/funcionesrol", $viewData);
    }
}


