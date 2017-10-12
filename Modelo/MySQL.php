<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQL
 *
 * @author David
 */
class MySQL {
    //put your code here
    public function getConexion() {
        
        try {
            $conexion = new PDO("mysql:host = localhost; dbname = tesis", "root", "yodavid1992", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $conexion;
        } catch (Exception $ex) {

            return die("error" . $ex->getMessage());
        }
    }

}
