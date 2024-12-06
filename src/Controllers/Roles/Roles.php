<?php


namespace Controllers\Roles;

use \Dao\Roles\Roles as DaoRoles;

const SESSION_ROLES_SEARCH = "roles_search_data";
const ROLES_NEW = "mnt_roles_new";
const ROLES_UPD = "mnt_roles_upd";
const ROLES_DEL = "mnt_roles_del";

class Roles extends \Controllers\PrivateController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }
        $viewData["roles"] = DaoRoles::readAllRoles($viewData["search"]);
        $viewData["total"] = count($viewData["roles"]);

        $viewData[ROLES_NEW] = $this->isFeatureAutorized(ROLES_NEW);
        $viewData[ROLES_UPD] = $this->isFeatureAutorized(ROLES_UPD);
        $viewData[ROLES_DEL] = $this->isFeatureAutorized(ROLES_DEL);

        \Views\Renderer::render("roles/lista", $viewData);
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
        if (isset($_SESSION[SESSION_ROLES_SEARCH])) {
            return $_SESSION[SESSION_ROLES_SEARCH];
        }
        return "";
    }

    private function setSessionSearchData($search)
    {
        $_SESSION[SESSION_ROLES_SEARCH] = $search;
    }
}