<?php

namespace Dao\Roles;

class Roles extends \Dao\Table
{

    public static function createRoles(
        $rolescod,
        $rolesdsc,
        $rolesest
    ) {
        $InsSql = "INSERT INTO roles (rolescod, rolesdsc, rolesest)
         values (:rolescod, :rolesdsc, :rolesest);";
        $insParams = [
            'rolescod' => $rolescod,
            'rolesdsc' => $rolesdsc,
            'rolesest' => $rolesest
        ];

        return self::executeNonQuery($InsSql, $insParams);
    }

    public static function updateRoles(
        $rolescod,
        $rolesdsc,
        $rolesest
    ) {
        $UpdSql = "UPDATE roles set rolesdsc = :rolesdsc, rolesest = :rolesest where rolescod = :rolescod;";
        $updParams = [
            'rolescod' => $rolescod,
            'rolesdsc' => $rolesdsc,
            'rolesest' => $rolesest
        ];

        return self::executeNonQuery($UpdSql, $updParams);
    }

    public static function deleteRoles($rolescod)
    {
        $DelSql = "DELETE from roles where rolescod = :rolescod;";
        $delParams = ['rolescod' => $rolescod];
        return self::executeNonQuery($DelSql, $delParams);
    }

    public static function readAllRoles($filter = '')
    {
        $sqlstr = "SELECT * from roles where rolesdsc like :filter;";
        $params = array('filter' => '%' . $filter . '%');
        return self::obtenerRegistros($sqlstr, $params);
    }

    public static function readRoles($rolescod)
    {
        $sqlstr = "SELECT * from roles where rolescod = :rolescod;";
        $params = array('rolescod' => $rolescod);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
    
}
