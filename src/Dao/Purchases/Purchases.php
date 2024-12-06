<?php

namespace Dao\Purchases;

use Dao\Table;

class Purchases extends Table
{
    public static function getPurchase($filter = '')
    {
        $sqlstr = "SELECT * FROM purchase WHERE id_purchase like :filter;";
        $params = array('filter' => '%' . $filter . '%');
        $registros = self::obtenerRegistros($sqlstr, $params);
        return $registros;
    }

    public static function getPurchaseByUserCount($usercod)
    {
        $sqlstr = "SELECT count(*)  FROM purchase as purchase INNER JOIN usuario as usuario ON usuario.usercod = purchase.usercod  where usuario.usercod = :usercod ORDER BY purchase_date, total DESC";
        $params = ['usercod' => $usercod];
        $registros = self::obtenerUnRegistro($sqlstr, $params);
        return $registros;
    }

    public static function getPurchaseByUser($usercod)
    {
        $sqlstr = "SELECT purchase.*  FROM purchase as purchase INNER JOIN usuario as usuario ON usuario.usercod = purchase.usercod  where usuario.usercod = :usercod ORDER BY purchase_date, total DESC";
        $params = ['usercod' => $usercod];
        $registros = self::obtenerRegistros($sqlstr, $params);
        return $registros;
    }
    
    public static function obtenerPorId($id)
    {
        $sqlstr = "SELECT * FROM purchase WHERE id_purchase = :id";
        $params = ['id' => $id];
        $registros = self::obtenerUnRegistro($sqlstr, $params);
        return $registros;
    }
    
    public static function insertPurchase($id_purchase, $purchase_date, $total, $details, $usercod, $payments)
    {
        $sqlstr = "INSERT INTO purchase (id_purchase, purchase_date, total, details, usercod, payments) VALUES (:id_purchase , :purchase_date , :total , :details , :usercod , :payments)";
        $params = ['id_purchase' => $id_purchase, 'purchase_date' => $purchase_date, 'total' => $total, 'details' => $details, 'usercod' => $usercod, 'payments' => $payments];
        $registros = self::executeNonQuery($sqlstr, $params);
        return $registros;
    }

    public static function updatePurchase($id_purchase, $purchase_date, $total, $details, $usercod, $payments)
    {
        $sqlstr = "UPDATE purchase SET id_purchase = :id_purchase, purchase_date = :purchase_date, total = :total, details = :details, usercod = :usercod, payments = :payments WHERE id_purchase = :id_purchase";
        $params = ['id_purchase' => $id_purchase, 'purchase_date' => $purchase_date, 'total' => $total, 'details' => $details, 'usercod' => $usercod, 'payments' => $payments];
        $registros = self::executeNonQuery($sqlstr, $params);
        return $registros;
    }

    public static function deletePurchase($id)
    {
        $sqlstr = "DELETE  FROM purchase WHERE id_purchase = :id";
        $params = ['id' => $id];
        $registros = self::executeNonQuery($sqlstr, $params);
        return $registros;
    }

}