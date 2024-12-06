<?php
namespace Controllers\Purchasedetails;


use Dao\Purchasedetails\Purchasedetails as DAOPurchasedetail;

const SESSION_PURCHASEDETAILS_SEARCH = "purchasedetails_search_data";
const PURCHASES_NEW = "mnt_purchases_new";
const PURCHASES_UPD = "mnt_purchases_upd";
const PURCHASES_DEL = "mnt_purchases_del";

class Purchasedetails extends \Controllers\PrivateController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }
        $viewData["purchasedetails"] = DAOPurchasedetail::getPurchasedetail($viewData["search"]);
        $viewData["total"] = count($viewData["purchasedetails"]);

        $viewData[PURCHASES_NEW] = $this->isFeatureAutorized(PURCHASES_NEW);
        $viewData[PURCHASES_UPD] = $this->isFeatureAutorized(PURCHASES_UPD);
        $viewData[PURCHASES_DEL] = $this->isFeatureAutorized(PURCHASES_DEL);

        \Views\Renderer::render("purchasedetails/purchasedetails", $viewData);
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
        if (isset($_SESSION[SESSION_PURCHASEDETAILS_SEARCH])) {
            return $_SESSION[SESSION_PURCHASEDETAILS_SEARCH];
        }
        return "";
    }

    private function setSessionSearchData($search)
    {
        $_SESSION[SESSION_PURCHASEDETAILS_SEARCH] = $search;
    }
}