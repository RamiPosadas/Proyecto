<?php

namespace Dao\Funciones;

class Funciones extends \Dao\Table
{
    public static function createFuncion(
        $fncod,
        $fndsc,
        $fnest,
        $fntyp
    ) {
        $InsSql = "INSERT INTO funciones (fncod, fndsc, fnest, fntyp)
         value (:fncod, :fndsc, :fnest, :fntyp);";
        $insParams = [
            'fncod' => $fncod,
            'fndsc' => $fndsc,
            'fnest' => $fnest,
            'fntyp' => $fntyp
        ];

        return self::executeNonQuery($InsSql, $insParams);
    }

    public static function updateFuncion(
        $fncod,
        $fndsc,
        $fnest,
        $fntyp
    ) {
        $UpdSql = "UPDATE funciones set fndsc = :fndsc, fnest = :fnest, fntyp = :fntyp where fncod = :fncod;";
        $updParams = [
            'fncod' => $fncod,
            'fndsc' => $fndsc,
            'fnest' => $fnest,
            'fntyp' => $fntyp
        ];

        return self::executeNonQuery($UpdSql, $updParams);
    }

    public static function deleteFuncion($fncod)
    {
        $DelSql = "DELETE from funciones where fncod = :fncod;";
        $delParams = ['fncod' => $fncod];
        return self::executeNonQuery($DelSql, $delParams);
    }

    public static function readAllFunciones($filter = '')
    {
        $sqlstr = "SELECT * from funciones where fndsc like :filter;";
        $params = array('filter' => '%' . $filter . '%');
        return self::obtenerRegistros($sqlstr, $params);
    }
    

    public static function readFuncion($fncod)
    {
        $sqlstr = "SELECT * from funciones where fncod = :fncod;";
        $params = array('fncod' => $fncod);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
}
