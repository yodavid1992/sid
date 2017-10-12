<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Requerimientos
 *
 * @author David
 */
class Requerimientos {
    //put your code here
    
    private $nombreRequerimiento;
    private $descripcion;
    
    public function getNombreRequerimiento() {
        return $this->nombreRequerimiento;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setNombreRequerimiento($nombreRequerimiento) {
        $this->nombreRequerimiento = $nombreRequerimiento;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }


}
