<?php
namespace Controllers\Funciones;

use \Dao\Funciones\Funciones as DaoFunciones;

const SESSION_FUNCIONES_SEARCH = "funciones_search_data";
const FUNCIONES_NEW = "mnt_funciones_new";
const FUNCIONES_UPD = "mnt_funciones_upd";
const FUNCIONES_DEL = "mnt_funciones_del";

class Funciones extends \Controllers\PrivateController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }
        $viewData["funciones"] = DaoFunciones::readAllFunciones($viewData["search"]);
        $viewData["total"] = count($viewData["funciones"]);

        $viewData[FUNCIONES_NEW] = $this->isFeatureAutorized(FUNCIONES_NEW);
        $viewData[FUNCIONES_UPD] = $this->isFeatureAutorized(FUNCIONES_UPD);
        $viewData[FUNCIONES_DEL] = $this->isFeatureAutorized(FUNCIONES_DEL);

        \Views\Renderer::render("funciones/lista", $viewData);
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
        if (isset($_SESSION[SESSION_FUNCIONES_SEARCH])) {
            return $_SESSION[SESSION_FUNCIONES_SEARCH];
        }
        return "";
    }

    private function setSessionSearchData($search)
    {
        $_SESSION[SESSION_FUNCIONES_SEARCH] = $search;
    }
}