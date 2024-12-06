<?php
namespace Controllers\Products;

use \Dao\Products\Products as DaoProducts;

const SESSION_PRODUCTS_SEARCH = "products_search_data";
const PRODUCTS_NEW = "mnt_products_new";
const PRODUCTS_UPD = "mnt_products_upd";
const PRODUCTS_DEL = "mnt_products_del";

class Products extends \Controllers\PrivateController
{
    public function run(): void{
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }
        $viewData["products"] = DaoProducts::readAll($viewData["search"]);        
        $viewData["total"] = count($viewData["products"]);

        $viewData[PRODUCTS_NEW] = $this->isFeatureAutorized(PRODUCTS_NEW);
        $viewData[PRODUCTS_UPD] = $this->isFeatureAutorized(PRODUCTS_UPD);
        $viewData[PRODUCTS_DEL] = $this->isFeatureAutorized(PRODUCTS_DEL);

        \Views\Renderer::render("products/products", $viewData);
    }
    private function getSearchData(){
        if (isset($_POST["search"])) {
            return $_POST["search"];
        }
        return "";
    }
    private function getSessionSearchData(){
        if (isset($_SESSION[SESSION_PRODUCTS_SEARCH])) {
            return $_SESSION[SESSION_PRODUCTS_SEARCH];
        }
        return "";
    }
    private function setSessionSearchData($search){
        $_SESSION[SESSION_PRODUCTS_SEARCH] = $search;
    }
}