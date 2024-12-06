<?php
namespace Controllers\Roles;

use \Dao\Roles\Roles as DaoRoles;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Rol extends \Controllers\PrivateController {
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nuevo Rol",
        "UPD" => "Actualizando Rol %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";
    private $rolescod = "";
    private $rolesdsc = "";
    private $rolesest = "";
    private $errors = array();
    private $xsrftk = "";

    public function run(): void {
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

    private function obtenerDatosDelGet() {
        if (isset($_GET["mode"])) {
            $this->mode = $_GET["mode"];
        }
        if (!isset($this->modeDscArr[$this->mode])) {
            throw new \Exception("Modo no valido");
        }
        if (isset($_GET["rolescod"])) {
            $this->rolescod = $_GET["rolescod"];
        }
        if ($this->mode != "INS" && empty($this->rolescod)) {
            throw new \Exception("Código de Rol no válido");
        }
    }

    private function getDatosFromDB() {
        if (!empty($this->rolescod)) {
            $rol = DaoRoles::readRoles($this->rolescod);
            if (!$rol) {
                throw new \Exception("Rol no encontrado");
            }
            $this->rolescod = $rol["rolescod"];
            $this->rolesdsc = $rol["rolesdsc"];
            $this->rolesest = $rol["rolesest"];
        }
    }

    private function obtenerDatosDePost() {
        $tmpRolescod = $_POST["rolescod"] ?? "";
        $tmpRolesdsc = $_POST["rolesdsc"] ?? "";
        $tmpRolesest = $_POST["rolesest"] ?? "";

        $tmpMode = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

        if (Validators::IsEmpty($tmpRolescod)) {
            $this->addError("rolescod", "El código del rol no puede estar vacío", "error");
        }
        $this->rolescod = $tmpRolescod;
        if (Validators::IsEmpty($tmpRolesdsc)) {
            $this->addError("rolesdsc", "La descripción del rol no puede estar vacía", "error");
        }
        $this->rolesdsc = $tmpRolesdsc;
        if (Validators::IsEmpty($tmpRolesest)) {
            $this->addError("rolesest", "El estado del rol no puede estar vacío", "error");
        }
        $this->rolesest = $tmpRolesest;
        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }
    }

    private function procesarAccion() {
        switch ($this->mode) {
            case "INS":
                $insResult = DaoRoles::createRoles(
                    $this->rolescod, 
                    $this->rolesdsc, 
                    $this->rolesest
                );

                $this->validateDBOperation(
                    "Rol insertado correctamente",
                    "Ocurrio un error al insertar el rol",
                    $insResult
                );
                break;
            case "UPD":
                $updResult = DaoRoles::updateRoles(
                    $this->rolescod,
                    $this->rolesdsc,
                    $this->rolesest
                );
                $this->validateDBOperation(
                    "Rol actualizado correctamente",
                    "Ocurrio un error al actualizar el rol",
                    $updResult
                );
                break;
            case "DEL":
                $delResult = DaoRoles::deleteRoles($this->rolescod);
                $this->validateDBOperation(
                    "Rol eliminado correctamente",
                    "Ocurrio un error al eliminar el roles",
                    $delResult
                );
                break;
        }
    }

    private function validateDBOperation($msg, $error, $result) {
        if (!$result) {
            $this->errors["error_general"] = $error;
        } else {
            Site::redirectToWithMsg("index.php?page=Roles-Roles", $msg);
        }
    }

    private function throwError($msg) {
        Site::redirectToWithMsg("index.php?page=Roles-Roles", $msg);
    }

    private function addError($key, $msg, $context = "general") {
        if (!isset($this->errors[$context . "_" . $key])) {
            $this->errors[$context . "_" . $key] = [];
        }
        $this->errors[$context . "_" . $key][] = $msg;
    }

    private function generateXSRFToken() {
        $this->xsrftk = md5(uniqid(rand(), true));
        $_SESSION[$this->name . "_xsrftk"] = $this->xsrftk;
    }

    private function getXSRFToken() {
        if (isset($_SESSION[$this->name . "_xsrftk"])) {
            $this->xsrftk = $_SESSION[$this->name . "_xsrftk"];
        }
    }

    private function compareXSRFToken($postXSFR) {
        return $postXSFR === $this->xsrftk;
    }

    private function showView() {
        $this->generateXSRFToken();
        $viewData = array();
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->rolesdsc);
        $viewData["rolescod"] = $this->rolescod;
        $viewData["rolesdsc"] = $this->rolesdsc;
        $viewData["rolesest"] = $this->rolesest;
        $viewData["errors"] = $this->errors;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("roles/form", $viewData);
    }
}
?>
