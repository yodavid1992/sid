<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Template
 *
 * @author David
 */
class ControladorTemplate {
    //put your code here
    public function getLogin() {
        
        include 'Vista/Login.php';
    }
    
    public function getMenuAdmin() {

    	include '../Vista/Navegacion.php';
        
    }
    
    public function getMenuProfesor() {
        
        include '../Vista/NavegacionA.php';
    }
    
    public function getMenuCatalogos(){
        
        include '../Vista/ModulosCatalogos.php';
    }
    #funcion de administrador de usuarios
    public  function getMenuUsuarios() {
        
    }
    
   
}
