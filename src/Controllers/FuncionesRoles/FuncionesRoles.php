<?php
namespace Controllers\FuncionesRoles;

use \Dao\FuncionesRoles\FuncionesRoles as DaoFuncionesRoles;

const SESSION_FUNCIONESROLES_SEARCH = "funcionesroles_search_data";

class FuncionesRoles extends \Controllers\PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }
        $viewData["funciones_roles"] = DaoFuncionesRoles::getFuncionesRoles($viewData["search"]);
        $viewData["total"] = count($viewData["funciones_roles"]);

        \Views\Renderer::render("funcionesroles/funcionesroles", $viewData);
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
        if (isset($_SESSION[SESSION_FUNCIONESROLES_SEARCH])) {
            return $_SESSION[SESSION_FUNCIONESROLES_SEARCH];
        }
        return "";
    }

    private function setSessionSearchData($search)
    {
        $_SESSION[SESSION_FUNCIONESROLES_SEARCH] = $search;
    }
}
