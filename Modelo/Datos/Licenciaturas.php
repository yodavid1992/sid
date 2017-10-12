<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Licenciaturas
 *
 * @author David
 */
class Licenciaturas {
    //put your code here
    private $siglas;
    private $nombreLicenciatura;
    
    public function getSiglas() {
        return $this->siglas;
    }

    public function getNombreLicenciatura() {
        return $this->nombreLicenciatura;
    }

    public function setSiglas($siglas) {
        $this->siglas = $siglas;
    }

    public function setNombreLicenciatura($nombreLicenciatura) {
        $this->nombreLicenciatura = $nombreLicenciatura;
    }


}
