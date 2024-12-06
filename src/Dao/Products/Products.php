<?php

namespace Dao\Products;

use Dao\Table;

class Products extends Table
{

        private $productId;
        private $productName;
        private $productDescription;
        private $productPrice;
        private $productImgUrl;
        private $productStock;
        private $productStatus;


        public static function getProducts()
        {
                $sqlstr = "SELECT * FROM products ORDER BY productPrice DESC, ProductName ASC; ";
                $params = [];
                $registros = self::obtenerRegistros($sqlstr, $params);
                return $registros;
        }

        public static function insertProducts($productId, $productName, $productDescription, $productPrice, $productImgUrl, $productStock, $productStatus)
        {

                $sqlstr = "INSERT INTO products (productId, productName, productDescription, productPrice, productImgUrl, productStock, productStatus) VALUES (:productId , :productName , :productDescription , :productPrice , :productImgUrl , :productStock , :productStatus)";
                $params = ['productId' => $productId, 'productName' => $productName, 'productDescription' => $productDescription, 'productPrice' => $productPrice, 'productImgUrl' => $productImgUrl, 'productStock' => $productStock, 'productStatus' => $productStatus];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;

        }

        public static function updateProducts($productId, $productName, $productDescription, $productPrice, $productImgUrl, $productStock, $productStatus)
        {

                $sqlstr = "UPDATE products SET productId = :productId, productName = :productName, productDescription = :productDescription, productPrice = :productPrice, productImgUrl = :productImgUrl, productStock = :productStock, productStatus = :productStatus WHERE productId = :productId";
                $params = ['productId' => $productId, 'productName' => $productName, 'productDescription' => $productDescription, 'productPrice' => $productPrice, 'productImgUrl' => $productImgUrl, 'productStock' => $productStock, 'productStatus' => $productStatus];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;

        }

        public static function obtenerPorId($id)
        {
                $sqlstr = "SELECT * FROM products WHERE productId = :id";
                $params = ['id' => $id];
                $registros = self::obtenerUnRegistro($sqlstr, $params);
                return $registros;
        }

        public static function deleteProducts($id)
        {
                $sqlstr = "DELETE  FROM products WHERE productId = :id";
                $params = ['id' => $id];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function readAll($filter = '')
        {
                $sqlstr = "SELECT * from products where productId like :filter;";
                $params = array('filter' => '%' . $filter . '%');
                return self::obtenerRegistros($sqlstr, $params);
        }

}