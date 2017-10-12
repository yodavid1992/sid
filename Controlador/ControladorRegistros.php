<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorRegistros
 *
 * @author David
 */
require_once '../Modelo/Consultas.php';
require_once '../Modelo/Seguridad.php';
require_once '../Modelo/Email.php';

class ControladorRegistros {

    //put your code here

    public function registraAdministrador() {
        require_once '../Modelo/Datos/Administrador.php';

        if (isset($_POST["nombre"])) {


            $administrador = new Administrador();
            $administrador->setNombre($_POST['nombre']);
            $administrador->setApellidos($_POST['apellidos']);
            $administrador->setCargo($_POST['puesto']);
            $administrador->setEmail($_POST['email']);
            $administrador->setTelefono($_POST['telefono']);
            $administrador->setPassword($_POST["password"]);
            $confirmar = $_POST["confirmaPassword"];

            $nombre = $administrador->getNombre();
            $apellidos = $administrador->getApellidos();
            $cargo = $administrador->getCargo();
            $email = $administrador->getEmail();
            $telefono = $administrador->getTelefono();
            $password = $administrador->getPassword();

            $validaciones = new Seguridad();

            if (!$validaciones->compararPassword($password, $confirmar)) {
                echo"Verificar la contraseña, no coinciden los campos";
            }

            $pwdCifrada = $validaciones->cifrarPassword($password);
            $idCuenta = $validaciones->generaIdCuenta();


            $datos = new Consultas();
            $datos->registrarAdministrador($nombre, $apellidos, $cargo, $email, $telefono);
            $registro = $datos->registroUsuarios($nombre, $apellidos, $email, $idCuenta, $pwdCifrada, "administrador");

            $idAdmin = $datos->getIdAdministrador($email);
            $idUser = $datos->getIdUsuario($email);

            $datos->relacionAdminUser($idAdmin, $idUser);

            if ($registro) {
                

                $sendEmail = new Email();
                $nameFull = $nombre . $apellidos;
                $enviar = $sendEmail->sendEmail($sendEmail->asuntoActivacion(), $sendEmail->cuerpoActivacion($sendEmail->getUrl($idUser, $idCuenta), $nameFull, $email, $password), $email, $nameFull);
                if ($enviar) {
                    echo "<div class='alert alert-success'><strong>Proceso Correcto!</strong> Se ha enviado exitosamente el correo. Por favor revise su bandeja de entrada para activar su cuenta</div>";
                } else {
                    echo "<div class='alert alert-danger'><strong>Error!</strong> Error al enviar el email activación</div>";
                }
            }
        }
    }

    public function mostrarAdministradores() {
        $administradores = new Consultas();
        $filas = $administradores->mostrarAdministrador();

        echo "<br>";
        echo "<h3> Lista de Administradores </h3>";
        //echo"<div class='tab'>";
        echo"<table class='table'> 
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Puesto</th>
                        <th>Email</th>
                        <th>Telefono</th>

                    </tr>";
        if ($filas <= 0) {
            echo "<tr>"
            . "<td>No se han registrado usuarios</td>"
            . "</tr>";
        } else {
            foreach ($filas as $fila) {
                echo "<tr>";

                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['apellidos'] . "</td>";
                echo "<td>" . $fila['cargo'] . "</td>";
                echo "<td>" . $fila['email'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";

                echo "</tr>";
            }
        }

        echo"</table>";
    }

    
    
    

}
