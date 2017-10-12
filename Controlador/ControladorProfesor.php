<?php
date_default_timezone_set('America/Mexico_City');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorProfesor
 *
 * @author David
 */
require_once '../Modelo/Consultas.php';
require_once '../PHPExcel/Classes/PHPExcel/IOFactory.php';
require_once '../Modelo/Datos/Profesor.php';
require_once '../Modelo/Seguridad.php';

class ControladorProfesor {
    //put your code here
    
    
    public function catalogoProfesor() {
        
        
         if(isset($_POST["cargarExcel"])){
            $archivo = $_FILES['file']['tmp_name'];
            //carga la hoja de cálculo
            $objPHPExcel = PHPExcel_IOFactory::load($archivo);
            
            //Asigno la hoja de calculo activa
            $objPHPExcel->setActiveSheetIndex(0);
            //$objPHPExcel ->setReadDataOnly(true);
            //Obtengo el numero de filas del archivo
            $filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
            
            for ($i = 3; $i <= $filas; $i++) {
                $profesor = new Profesor();
                $profesor ->setLicenciatura($objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue());
                $profesor ->setGradoEstudios($objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue());
                $profesor ->setNombre($objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue());
                $profesor ->setApellidos($objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue());
                $profesor ->setEmail($objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue());
                $profesor ->setPassword($objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue());
                $profesor ->setTelefono($objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue());
                
                $licenciatura = $profesor ->getLicenciatura();
                $gradoEstudios = $profesor ->getGradoEstudios();
                $nombre = $profesor ->getNombre();
                $apellidos = $profesor ->getApellidos();
                $email = $profesor ->getEmail();
                $password = $profesor ->getPassword();
                $telefono = $profesor ->getTelefono();
                
                //echo $licenciatura."<br>".$gradoEstudios."<br>".$nombre."<br>".$apellidos."<br>".$email."<br>".$password."<br>".$telefono."<br";
                #LA VARIABLE TOKEN SE USA PARA CIFRAR LA CONTRASEÑA Y CREAR UN TOKEN DE LA CUENTA QUE FUNCIONARA COMO UN ID UNICO DE LA MISMA
                $token = new Seguridad();
                $idCuenta = $token ->generaIdCuenta();
                $pwdCifrada = $token ->cifrarPassword($password);
                
                $datos = new Consultas();
                $idLicenciatura = $datos ->getIdLicenciatura($licenciatura);
                
                //echo "<br>".$id."<br>".$licenciatura."<br>".$gradoEstudios."<br>".$nombre."<br>".$apellidos."<br>".$email."<br>".$password."<br>".$telefono;
                $datos ->registroProfesores($gradoEstudios, $nombre, $apellidos, $email, $telefono);
                $registro = $datos ->registroUsuarios($nombre, $apellidos, $email, $idCuenta, $pwdCifrada, "profesor");
                
                $idMaestro = $datos ->getIdProfesor($email);
                $idUser = $datos ->getIdUsuario($email);
                
                $datos ->relacionMaestroUser($idUser, $idMaestro);
                $datos ->relacionMaestroLicenciatura($idMaestro, $idLicenciatura);
                
                if($registro) {
                require_once '../Modelo/Email.php';
                
                $sendEmail = new Email();
                $nameFull = $nombre.$apellidos;
                $enviar = $sendEmail ->sendEmail($sendEmail ->asuntoActivacion(), $sendEmail ->cuerpoActivacion($sendEmail ->getUrl($idUser, $idCuenta), $nameFull, $email, $password), $email, $nameFull);
                if($enviar) {
                    echo "<div class='alert alert-success'><strong>Profesores registrados!</strong> Se ha enviado exitosamente el correo. Por favor revise su bandeja de entrada para activar su cuenta</div>";
                } else {
                     echo "<div class='alert alert-danger'><strong>Error!</strong> Error al enviar el email activación</div>";
                    
                }
            }
                
                
                
            }
        }
        
    }
    
    public function registrarProfesor() {
        
        if (isset($_POST["nombre"])) {
            
            $profesor = new Profesor();
            $profesor ->setLicenciatura($_POST["licenciatura"]);
            $profesor ->setGradoEstudios($_POST["gradoEstudios"]);
            $profesor ->setNombre($_POST["nombre"]);
            $profesor ->setApellidos($_POST["apellidos"]);
            $profesor ->setEmail($_POST["email"]);
            $profesor ->setTelefono($_POST["telefono"]);
            $profesor ->setPassword($_POST["password"]);
            $confirmar = $_POST["confirmaPassword"];
            
            $idLicenciatura = $profesor ->getLicenciatura();
            $gradoEstudios = $profesor ->getGradoEstudios();
            $nombre = $profesor ->getNombre();
            $apellidos = $profesor ->getApellidos();
            $email = $profesor ->getEmail();
            $telefono = $profesor ->getTelefono();
            $password = $profesor ->getPassword();
            
            $validaciones = new Seguridad();
            
            if(!$validaciones ->compararPassword($password, $confirmar)) {
                echo"Verificar la contraseña, no coinciden los campos";
            }
            
            $pwdCifrada = $validaciones ->cifrarPassword($password);
            $idCuenta = $validaciones ->generaIdCuenta();
            
            $datos = new Consultas();
                
            $datos ->registroProfesores($gradoEstudios, $nombre, $apellidos, $email, $telefono);
            $registro = $datos ->registroUsuarios($nombre, $apellidos, $email, $idCuenta, $pwdCifrada, "profesor");
                
            $idMaestro = $datos ->getIdProfesor($email);
            $idUser = $datos ->getIdUsuario($email);
               
            $datos ->relacionMaestroUser($idUser, $idMaestro);
            $datos ->relacionMaestroLicenciatura($idMaestro, $idLicenciatura);
            
            if ($registro) {
                require_once '../Modelo/Email.php';

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
    
    public function mostrarMaestros() {
        $profesores = new Consultas();
        $filas = $profesores ->mostrarProfesores();

        echo "<br>";
        echo "<h3> Lista de Profesores </h3>";
        echo"<table class='table table-fixed'> 
                    <tr>
                        <th>Grado de Estudios</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Telefono</th>

                    </tr>";
        if ($filas <= 0) {
            echo "<tr>"
            . "<td><div class='alert alert-info'><strong>Vacio!</strong> Aún no hay profesores registrados</div></td>"
            . "</tr>";
        } else {
            
        

        foreach ($filas as $fila) {
            echo "<tr>";
            echo "<td>" . $fila['grado'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellidos'] . "</td>";
            echo "<td>" . $fila['email'] . "</td>";
            echo "<td>" . $fila['telefono'] . "</td>";

            echo "</tr>";
        }
        }

        echo"</table>";
    }
    
    public function mostrarMaestroForm(){
        $profesores = new Consultas();
        $filas = $profesores ->mostrarProfesores();
        
        echo "<h3> Lista de Profesores </h3>";
        echo "<tr>";
        echo "<th> </th>";
        echo "</tr>";
        
        
        echo"<table class='table'>";
        
        foreach ($filas as $profesor) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='maestro[]' value='" . $profesor['id_maestro'] . "'/>".$profesor['grado']." ". $profesor['nombre'] . " " . $profesor['apellidos'];
            echo "</tr>";
        }
        
        echo "</table>";
        echo "</div>";
    }
    
}
