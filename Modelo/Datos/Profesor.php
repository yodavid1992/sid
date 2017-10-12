<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profesor
 *
 * @author David
 */
class Profesor {
    //put your code here
    private $licenciatura;
    private $gradoEstudios;
    private $nombre;
    private $apellidos;
    private $email;
    private $telefono;
    private $password;
    
    public function getLicenciatura() {
        return $this->licenciatura;
    }

    public function getGradoEstudios() {
        return $this->gradoEstudios;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setLicenciatura($licenciatura) {
        $this->licenciatura = $licenciatura;
    }

    public function setGradoEstudios($gradoEstudios) {
        $this->gradoEstudios = $gradoEstudios;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setPassword($password) {
        $this->password = $password;
    }


}
