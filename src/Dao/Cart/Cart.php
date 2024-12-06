<?php

namespace Dao\Cart;

class Cart extends \Dao\Table
{
    public static function savePurchase($purchase)
    {
        $sql = "INSERT INTO purchase (id_purchase, purchase_date, total, details, usercod, payments) 
                VALUES (:id_purchase, :purchase_date, :total, :details, :usercod, :payments)";
        return self::executeNonQuery($sql, $purchase);
    }
}
