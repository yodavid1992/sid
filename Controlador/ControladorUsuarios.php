<?php
date_default_timezone_set('America/Mexico_City');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorUsuarios
 *
 * @author David
 */
class ControladorUsuarios {

    public function login() {
        require_once 'Modelo/Consultas.php';

        if (!empty($_POST["login"])) {

            require_once 'Modelo/Datos/Usuarios.php';


            $usuario = new Usuarios();
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword($_POST["password"]);

            #LA VARIABLE USER, REPRESENTA EL EMAIL
            $user = $usuario->getEmail();
            $password = $usuario->getPassword();

            #LA VARIABLE LOGIN, REPRESENTA EL TIPO DE USUARIO QUE ES (ADMIN,PROFESOR) PARA SER USADA EN PRIVILEGIOS Y REEDIRECCIONE AL MENU DEL TIPO DE USUARIO
            $datos = new Consultas();
            $login = $datos->login($user, $password);
            $fecha = date("Y.m.d H:i:s");

            if ($login) {
                $idUser = $datos->getIdUsuario($user);
                $datos ->lastSesion($idUser, $fecha);

                require_once 'Modelo/Seguridad.php';

                $sesion = new Seguridad();
                $sesion->privilegios($login, $idUser);
               
                
                /*$idUser = $datos->getIdUsuario($user);
                $datos ->lastSesion($idUser, $fecha);

                require_once 'Modelo/Seguridad.php';

                $sesion = new Seguridad();
                $sesion->privilegios($login, $idUser);*/

                //$sesion = new Seguridad();
                //$sesion -> privilegios($login, $idUser);
            } else {
                /*$idUser = $datos->getIdUsuario($user);
                $datos ->lastSesion($idUser, $fecha);

                require_once 'Modelo/Seguridad.php';

                $sesion = new Seguridad();
                $sesion->privilegios($login, $idUser);*/
                echo "<div class='alert alert-warning'><strong>Error!</strong>  en el usuario o contraseña</div>";
            }
        }
    }

    public function mostrarUsuarios() {
        require_once '../Modelo/Consultas.php';

        $usuarios = new Consultas();
        $filas = $usuarios->mostrarUsuarios();

        echo "<br>";
        echo "<h3> Lista de Usuarios </h3>";
        echo"<table class='table'> 
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Tipo de Usuario</th>
                       

                    </tr>";

        foreach ($filas as $fila) {
            echo "<tr>";

            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellidos'] . "</td>";
            echo "<td>" . $fila['email'] . "</td>";
            echo "<td>" . $fila['tipo_user'] . "</td>";
            echo"<td><a href='../Vista/Administrar.php?idU=" . $fila['id_user'] . "&em=" . $fila['email'] . "'><button class='btn btn-lg btn-primary btn-block'>Eliminar</button></td>";


            echo "</tr>";
        }

        echo"</table>";
    }

    public function cambiarPassword() {
        require_once '../Modelo/Consultas.php';
        require_once '../Modelo/Datos/Usuarios.php';
        require_once '../Modelo/Seguridad.php';

        if (!empty($_POST["cambiaPassword"])) {
            $idUser = $_GET['id'];
            $confirma = $_POST["confirmaPassword"];

            $usuario = new Usuarios();
            $usuario->setPassword($_POST["password"]);

            $password = $usuario->getPassword();

            $valida = new Seguridad();
            if (!$valida->compararPassword($password, $confirma)) {
                echo"Verificar la contraseña, no coinciden los campos";
            }

            $pwdCifrada = $valida->cifrarPassword($password);

            $datos = new Consultas();
            $update = $datos->updatePassword($idUser, $pwdCifrada);

            if ($update) {
                echo "<div class='alert alert-success'><strong>Proceso Correcto!</strong> Contraseña Cambiada</div>";
            } else {

                echo "<div class='alert alert-danger'><strong>Error!</strong> Error al actualizar la contraseña</div>";
            }
        }
    }

    public function activarCuenta() {
        require_once '../Modelo/Consultas.php';
        $activar = new Consultas();

        if (isset($_GET['id']) and isset($_GET['val'])) {
            $idUser = $_GET['id'];
            //echo $id;
            $idCuenta = $_GET['val'];

            $activar->activacion($idUser, $idCuenta);
            if ($activar) {
                echo "<div class='alert alert-success'><strong>Proceso Correcto!</strong>Usuario Activado</div>";
            } else {
                echo "<div class='alert alert-danger'><strong>Error!</strong>Error al activar la cuenta</div>";
            }
        }
    }

    public function deleteUsuario() {
        require_once '../Modelo/Consultas.php';

        $registro = new Consultas();

        if (isset($_GET["idU"]) and isset($_GET['em'])) {
            $idUser = $_GET["idU"];
            $email = $_GET['em'];

            $registro->deleteUsuario($idUser, $email);
            echo "<div class='alert alert-success'><strong>Proceso Correcto!</strong>Usuario Eliminado</div>";
        }
    }

    public function correoPassword() {
        require_once '../Modelo/Consultas.php';
        require_once '../Modelo/Datos/Usuarios.php';
        require_once '../Modelo/Email.php';
        require_once '../Modelo/Seguridad.php';

        if (!empty($_POST["recuperar"])) {

            $usuario = new Usuarios();
            $usuario->setEmail($_POST["email"]);

            $datos = new Consultas();
            $emailUser = $usuario->getEmail();
            $idUser = $datos->getIdUsuario($usuario->getEmail());

            $nombre = $datos->getNameUser($idUser);

            $valida = new Seguridad();
            $tokenPassword = $valida->generaIdCuenta(); //genera el token para la contraseña

            $email = new Email();
            $asunto = $email->asuntoPassword();
            $url = $email->urlPassword($idUser, $tokenPassword);
            $cuerpo = $email->cuerpoPassword($url);
            $registro = $datos ->solicitudPassword($idUser, $tokenPassword);
            $enviar = $email->sendEmail($asunto, $cuerpo, $emailUser, $nombre);
            if ($registro) {
                if($enviar){
                    echo "<div class='alert alert-success'><strong>Proceso Correcto!</strong>Se ha enviado exitosamente el correo. Por favor revise su bandeja de entrada</div>";
                } else {
                    echo "<div class='alert alert-danger'><strong>Error!</strong>Error al enviar el email de recuperación</div>";
                    
                }
            } else {
                echo "error";
            }
        }
    }

    public function recuperaPassword() {
        require_once '../Modelo/Consultas.php';
        require_once '../Modelo/Datos/Usuarios.php';
        require_once '../Modelo/Seguridad.php';

        if (!empty($_POST["newPassword"])) {

            $datos = new Consultas();

            $idUser = $_GET['id'];
            $tokenPassword = $_GET['val'];
            $confirma = $_POST["confirmaPassword"];
            
            $usuario = new Usuarios();
            $usuario->setPassword($_POST["password"]);
            $password = $usuario->getPassword();

            $valida = new Seguridad();
            if (!$valida->compararPassword($password, $confirma)) {
                echo"Verificar la contraseña, no coinciden los campos";
            }
            $pwdCifrada = $valida->cifrarPassword($password);

            $registro = $datos->recoveryPassword($idUser, $tokenPassword, $pwdCifrada);
            if ($registro) {
                echo "<div class='alert alert-success'><strong>Contraseña Guardada!</strong>Se ha cambiado exitosamente su contraseña</div>";
            } else {
                echo "<div class='alert alert-danger'><strong>Error!</strong>Error cambiar contraseña</div>";
            }
        }
    }

}
