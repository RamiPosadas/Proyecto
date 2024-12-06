<?php

namespace Dao\Usuarios;

class Usuarios extends \Dao\Table
{
    public static function createUsuario(
        $email,
        $name,
        $password,
        $fching,
        $passwordest,
        $passwordexp,
        $est,
        $actcod,
        $passwordchg,
        $tipo
    ) {
        $InsSql = "INSERT INTO usuario (useremail, username, userpswd, userfching, userpswdest, userpswdexp, userest, useractcod, userpswdchg, usertipo)
         value (:email, :name, :password, :fching, :passwordest, :passwordexp, :est, :actcod, :passwordchg, :tipo);";
        $insParams = [
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'fching' => $fching,
            'passwordest' => $passwordest,
            'passwordexp' => $passwordexp,
            'est' => $est,
            'actcod' => $actcod,
            'passwordchg' => $passwordchg,
            'tipo' => $tipo
        ];

        return self::executeNonQuery($InsSql, $insParams);
    }

    public static function updateUsuario(
        $id,
        $email,
        $name,
        $password,
        $fching,
        $passwordest,
        $passwordexp,
        $est,
        $actcod,
        $passwordchg,
        $tipo
    ) {
        $UpdSql = "UPDATE usuario set useremail = :email, username = :name, userpswd = :password, userfching = :fching, userpswdest = :passwordest, userpswdexp = :passwordexp, userest = :est, useractcod = :actcod, userpswdchg = :passwordchg, usertipo = :tipo where usercod = :id;";
        $updParams = [
            'id' => $id,
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'fching' => $fching,
            'passwordest' => $passwordest,
            'passwordexp' => $passwordexp,
            'est' => $est,
            'actcod' => $actcod,
            'passwordchg' => $passwordchg,
            'tipo' => $tipo
        ];

        return self::executeNonQuery($UpdSql, $updParams);
    }

    public static function deleteUsuario($id)
    {
        $DelSql = "DELETE from usuario where usercod = :id;";
        $delParams = ['id' => $id];
        return self::executeNonQuery($DelSql, $delParams);
    }

    public static function readAllUsuarios($filter = '')
    {
        $sqlstr = "SELECT * from usuario where username like :filter;";
        $params = array('filter' => '%' . $filter . '%');
        return self::obtenerRegistros($sqlstr, $params);
    }

    public static function readUsuario($id)
    {
        $sqlstr = "SELECT * from usuario where usercod = :id;";
        $params = array('id' => $id);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
}