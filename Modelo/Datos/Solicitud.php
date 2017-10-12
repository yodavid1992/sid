<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Solicitud
 *
 * @author David
 */
class Solicitud {
    //put your code here
    private $requerimiento;
    private $emisor;
    private $receptor;
    private $fechaCreacion;
    private $fechaRespuesta;
    private $archivo;
    
    public function getRequerimiento() {
        return $this->requerimiento;
    }

    public function getEmisor() {
        return $this->emisor;
    }

    public function getReceptor() {
        return $this->receptor;
    }

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    public function getFechaRespuesta() {
        return $this->fechaRespuesta;
    }

    public function getArchivo() {
        return $this->archivo;
    }

    public function setRequerimiento($requerimiento) {
        $this->requerimiento = $requerimiento;
    }

    public function setEmisor($emisor) {
        $this->emisor = $emisor;
    }

    public function setReceptor($receptor) {
        $this->receptor = $receptor;
    }

    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function setFechaRespuesta($fechaRespuesta) {
        $this->fechaRespuesta = $fechaRespuesta;
    }

    public function setArchivo($archivo) {
        $this->archivo = $archivo;
    }


}
