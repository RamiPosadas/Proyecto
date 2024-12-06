<?php

namespace Dao\FuncionesRoles;

use Dao\Table;

class FuncionesRoles extends Table
{
    public static function getFuncionesRoles($filter = '')
    {
        $sqlstr = "SELECT * FROM funciones_roles WHERE fncod like :filter;";
        $params = array('filter' => '%' . $filter . '%');
        $registros = self::obtenerRegistros($sqlstr, $params);
        return $registros;
    }
        
    public static function obtenerPorId($fncod)
    {
        $sqlstr = "SELECT * FROM funciones_roles WHERE fncod = :fncod";
        $params = ['fncod' => $fncod];
        $registros = self::obtenerUnRegistro($sqlstr, $params);
        return $registros;
    }
    
    public static function insertFuncionesRoles($rolescod, $fncod, $fnrolest, $fnexp)
    {
        $sqlstr = "INSERT INTO funciones_roles (rolescod, fncod, fnrolest, fnexp ) VALUES (:rolescod , :fncod , :fnrolest , :fnexp)";
        $params = ['rolescod' => $rolescod, 'fncod' => $fncod, 'fnrolest' => $fnrolest, 'fnexp' => $fnexp];
        $registros = self::executeNonQuery($sqlstr, $params);
        return $registros;
    }

    public static function updateFuncionesRoles($rolescod, $fncod, $fnrolest, $fnexp)
    {
        $sqlstr = "UPDATE funciones_roles SET rolescod = :rolescod, fncod = :fncod, fnrolest = :fnrolest, fnexp = :fnexp WHERE rolescod = :rolescod";
        $params = ['rolescod' => $rolescod, 'fncod' => $fncod, 'fnrolest' => $fnrolest, 'fnexp' => $fnexp];
        $registros = self::executeNonQuery($sqlstr, $params);
        return $registros;
    }

    public static function deleteFuncionesRoles($fncod)
    {
        $sqlstr = "DELETE  FROM funciones_roles WHERE fncod = :fncod";
        $params = ['fncod' => $fncod];
        $registros = self::executeNonQuery($sqlstr, $params);
        return $registros;
    }

}