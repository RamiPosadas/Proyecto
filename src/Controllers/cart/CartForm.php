<?php

namespace Controllers\Cart;

use Dao\Cart\Cart;
use Views\Renderer;

class CartForm
{
    public function run()
    {
        $viewData = [];
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $purchase = [
                "id_purchase" => uniqid(),
                "purchase_date" => date("Y-m-d"),
                "total" => $_POST["total"] ?? 0.00,
                "details" => $_POST["details"] ?? "",
                "usercod" => $_POST["usercod"] ?? "guest",
                "payments" => $_POST["payments"] ?? "",
            ];

            $result = Cart::savePurchase($purchase);
            if ($result) {
                $viewData["success"] = "Compra guardada exitosamente.";
            } else {
                $viewData["error"] = "No se pudo guardar la compra. Inténtalo de nuevo.";
            }
        }

        Renderer::render("cart/cart_form", $viewData);
    }
}
