<?php

namespace Controllers\Usuarios;

use \Dao\Usuarios\Usuarios as DaoUsuarios;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Usuario extends \Controllers\PrivateController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nuevo Usuario",
        "UPD" => "Actualizando Usuario %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";

    private $id = 0;
    private $useremail = "";
    private $username = "";
    private $userpswd = "";
    private $userfching = "";
    private $userpswdest = "";
    private $userpswdexp = "";
    private $userest = "";
    private $useractcod = "";
    private $userpswdchg = "";
    private $usertipo = "";

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
            throw new \Exception("Modo no valido");
        }
        if (isset($_GET["id"])) {
            $this->id = intval($_GET["id"]);
        }
        if ($this->mode != "INS" && $this->id <= 0) {
            throw new \Exception("ID no valido");
        }
    }

    private function getDatosFromDB()
    {
        if ($this->id > 0) {
            $usuario = DaoUsuarios::readUsuario($this->id);
            if (!$usuario) {
                throw new \Exception("Usuario no encontrado");
            }
            $this->useremail = $usuario["useremail"];
            $this->username = $usuario["username"];
            $this->userpswd = $usuario["userpswd"];
            $this->userfching = $usuario["userfching"];
            $this->userpswdest = $usuario["userpswdest"];
            $this->userpswdexp = $usuario["userpswdexp"];
            $this->userest = $usuario["userest"];
            $this->useractcod = $usuario["useractcod"];
            $this->userpswdchg = $usuario["userpswdchg"];
            $this->usertipo = $usuario["usertipo"];
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpEmail = $_POST["email"] ?? "";
        $tmpName = $_POST["name"] ?? "";
        $tmpPswd = $_POST["password"] ?? "";
        $tmpFching = $_POST["fching"] ?? "";
        $tmpPswdest = $_POST["passwordest"] ?? "";
        $tmpPswdexp = $_POST["passwordexp"] ?? "";
        $tmpEst = $_POST["est"] ?? "";
        $tmpActcod = $_POST["actcod"] ?? "";
        $tmpPswdchg = $_POST["passwordchg"] ?? "";
        $tmpTipo = $_POST["tipo"] ?? "";
        $tmpMode = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

        if (Validators::IsEmpty($tmpName)) {
            $this->addError("name", "El nombre no puede estar vacio", "error");
        }
        $this->username = $tmpName;


        if (Validators::IsEmpty($tmpEmail)) {
            $this->addError("email", "El email no puede estar vacio", "error");
        } 
        $this->useremail = $tmpEmail;

        if (Validators::IsEmpty($tmpPswd)) {
            $this->addError("password", "La contraseña no puede estar vacía", "error");
        } 
        $this->userpswd = $tmpPswd;

        if (Validators::IsEmpty($tmpFching)) {
            $this->addError("fching", "La fecha no puede estar vacia", "error");
        } 
        $this->userfching = $tmpFching;

        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

        if (Validators::IsEmpty($tmpPswdest)) {
            $this->addError("passwordest", "La fecha de emisión no puede estar vacia", "error");
        } 
        $this->userpswdest = $tmpPswdest;

        if (Validators::IsEmpty($tmpPswdexp)) {
            $this->addError("passwordexp", "La fecha de expiracion no puede estar vacia", "error");
        } 
        $this->userpswdexp = $tmpPswdexp;

        if (Validators::IsEmpty($tmpEst)) {
            $this->addError("est", "El estado no puede estar vacio", "error");
        } 
        $this->userest = $tmpEst;

        if (Validators::IsEmpty($tmpActcod)) {
            $this->addError("actcod", "La actividad no puede estar vacia", "error");
        } 
        $this->useractcod = $tmpActcod;

        if (Validators::IsEmpty($tmpPswdchg)) {
            $this->addError("passwordchg", "La contraseña no puede estar vacia", "error");
        } 
        $this->userpswdchg = $tmpPswdchg;

        if (Validators::IsEmpty($tmpTipo)) {
            $this->addError("tipo", "El tipo no puede estar vacio", "error");
        } elseif (!in_array($tmpTipo, ["NOR", "CON", "CLI"])) {
            $this->addError("tipo", "El tipo no es valido", "error");
        }
        $this->usertipo = $tmpTipo;

    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $insResult = DaoUsuarios::createUsuario(
                    $this->useremail,
                    $this->username,
                    $this->userpswd,
                    $this->userfching,
                    $this->userpswdest,
                    $this->userpswdexp,
                    $this->userest,
                    $this->useractcod,
                    $this->userpswdchg,
                    $this->usertipo
                );
                $this->validateDBOperation(
                    "Usuario insertado correctamente",
                    "Ocurrio un error al insertar el usuario",
                    $insResult
                );
                break;
            case "UPD":
                $updResult = DaoUsuarios::updateUsuario(
                    $this->id,
                    $this->useremail,
                    $this->username,
                    $this->userpswd,
                    $this->userfching,
                    $this->userpswdest,
                    $this->userpswdexp,
                    $this->userest,
                    $this->useractcod,
                    $this->userpswdchg,
                    $this->usertipo
                );
                $this->validateDBOperation(
                    "Usuario actualizado correctamente",
                    "Ocurrio un error al actualizar el usuario",
                    $updResult
                );
                break;
            case "DEL":
                $delResult = DaoUsuarios::deleteUsuario($this->id);
                $this->validateDBOperation(
                    "Usuario eliminado correctamente",
                    "Ocurrio un error al eliminar el usuario",
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
                "index.php?page=Usuarios-Usuarios",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Usuarios-Usuarios",
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
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->username);
        $viewData["id"] = $this->id;
        $viewData["email"] = $this->useremail;
        $viewData["name"] = $this->username;
        $viewData["password"] = $this->userpswd;
        $viewData["fching"] = $this->userfching;
        $viewData["passwordest"] = $this->userpswdest;
        $viewData["passwordexp"] = $this->userpswdexp;
        $viewData["est"] = $this->userest;
        $viewData["actcod"] = $this->useractcod;
        $viewData["passwordchg"] = $this->userpswdchg;
        $viewData["tipo" . $this->usertipo] = "selected";
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("usuarios/form", $viewData);
    }

}