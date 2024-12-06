<?php

namespace Controllers\Inicio;

use Utilities\Security;
use Views\Renderer;
use Dao\Products\Products as DaoProducts;
use Dao\Purchases\Purchases as DAOCompras;

const ADM = "mnt_adm";
const CLN = "mnt_cln";

class Inicio extends \Controllers\PrivateController
{
    public function run(): void
    {
        $viewData = [];
        $viewData['productos'] = DaoProducts::getProducts();
        $viewData['compras'] = DAOCompras::getPurchaseByUser(Security::getUserId());
        
        $viewData[ADM] = $this->isFeatureAutorized(ADM);
        $viewData[CLN] = $this->isFeatureAutorized(CLN);

        Renderer::render("inicio/inicio", $viewData);
    }

}
/*
Aqui estaria el carrito :D
*/