<?php

namespace Controllers;

use Dao\Cart\Cart;
use Views\Renderer;

class CartController
{
    public function run(): void
    {
        $cartItems = Cart::getProductosDisponibles();
        $viewData = [
            "cartItems" => $cartItems,
        ];
        Renderer::render('sales/cart_list', $viewData);
    }

    public function manageCart(): void
    {
        $productId = $_GET['productId'] ?? null;
        if ($productId) {
            $productDetails = Cart::getProducto($productId);
            $viewData = [
                "product" => $productDetails[0] ?? [],
            ];
            Renderer::render('sales/cart_form', $viewData);
        } else {
            header("Location: index.php?page=Cart");
        }
    }
}
?>
