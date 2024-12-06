<?php

namespace Controllers\Usuarios;

use \Dao\Usuarios\Usuarios as DaoUsuarios;

const SESSION_USUARIOS_SEARCH = "usuarios_search_data";
const USERS_NEW = "mnt_users_new";
const USERS_UPD = "mnt_users_upd";
const USERS_DEL = "mnt_users_del";

class Usuarios extends \Controllers\PrivateController{
    public function run(): void{
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if($this->isPostBack()){
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]); 
        }
        $viewData["usuarios"] = DaoUsuarios::readAllUsuarios($viewData["search"]);
        $viewData["total"] = count($viewData["usuarios"]);

        $viewData[USERS_NEW] = $this->isFeatureAutorized(USERS_NEW);
        $viewData[USERS_UPD] = $this->isFeatureAutorized(USERS_UPD);
        $viewData[USERS_DEL] = $this->isFeatureAutorized(USERS_DEL);

        \Views\Renderer::render("usuarios/lista", $viewData);
    }

    private function getSearchData()
    {
        if (isset($_POST["search"])) {
            return $_POST["search"];
        }
        return "";
    }

    private function getSessionSearchData()
    {
        if (isset($_SESSION[SESSION_USUARIOS_SEARCH])) {
            return $_SESSION[SESSION_USUARIOS_SEARCH];
        }
        return "";
    }

    private function setSessionSearchData($search)
    {
        $_SESSION[SESSION_USUARIOS_SEARCH] = $search;
    }
}