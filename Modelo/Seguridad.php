<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seguridad
 *
 * @author David
 */
class Seguridad {
    //put your code here
    
    public function cifrarPassword($password) {
        $newPass = password_hash($password, PASSWORD_DEFAULT);
        return $newPass;
    }
    
    public function compararPassword($password1, $password2) {
        if(strcmp($password1, $password2) !== 0) {
            return false;
        }else {
            return true;
        }
    }
    
    public function generaIdCuenta() {
        $idCuenta = md5(uniqid(mt_rand(), false));
        return $idCuenta;
    }

    public function privilegios($tipoUser, $idUser) {
        switch ($tipoUser){
            case 'profesor':
                
                session_start();
                $_SESSION['id_user']=$idUser;
                $_SESSION['tipo_user']=$tipoUser;
                header("location: Vista/Template.php");
                break;
            case 'administrador':
                
                session_start();
                $_SESSION['id_user']=$idUser;
                $_SESSION['tipo_user']=$tipoUser;
                
                header("location: Vista/Template.php");
                
                break;
                
        }
    }
    
   
    
}
