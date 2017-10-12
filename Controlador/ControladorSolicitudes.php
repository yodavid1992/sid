<?php

date_default_timezone_set('America/Mexico_City');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.


  /**
 * Description of ControladorSolicitudes
 *
 * @author David
 */

if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
}
require_once '../Modelo/Consultas.php';
require_once '../Modelo/Datos/Solicitud.php';
require_once '../Modelo/Email.php';

class ControladorSolicitudes {

    public function creaSolicitud() {

        if (!empty($_POST["creaSolicitud"])) {
            #LA VARIABLE IDUSER TRAE EL ID DEL USUARIO ADMINISTRADOR, MAS NO DE LA TABLA ADMINISTRADOR, HACER OTRA CONSULTA
            $idUser = $_SESSION['id_user'];

            $idRequerimiento = $_POST["requerimiento"];

            $datos = new Consultas();

            $solicitud = new Solicitud();
            $solicitud->setRequerimiento($datos->getNameRequerimiento($idRequerimiento));
            $solicitud->setEmisor($datos->getNameUser($idUser));
            $solicitud->setFechaCreacion(date("Y.m.d H:i:s"));

            $profesores = $datos->mostrarProfesores();

            foreach ($profesores as $profesor) {
                $nombreProfesor = $profesor['nombre'] . " " . $profesor['apellidos'];
                $solicitud->setReceptor($nombreProfesor);
                $fechaCreacion = $solicitud->getFechaCreacion();

                # "------------------------------------------------PRUEBA SOLICITUD-----------";

                $idAdministrador = $datos->getIdAdmin($idUser);
                $requerimiento = $solicitud->getRequerimiento();
                $emisor = $solicitud->getEmisor();
                $receptor = $solicitud->getReceptor();

                $idProfesor = $profesor['id_maestro'];
                $email = $profesor['email'];
                $idLicenciatura = $datos->getIdLic($idProfesor);

                $registro = $datos->registraSolicitud($requerimiento, $emisor, $receptor, $fechaCreacion, $idAdministrador, $idRequerimiento);

                #"------------------------------------------------PRUEBA RELACION SOLICITUD PROFESOR-----------";

                $idSolicitud = $datos->getIdSolicitud($receptor);
                $datos->relacionSolicitudProfesor($idSolicitud, $idAdministrador, $idProfesor, $idLicenciatura);

                if ($registro) {
                    $sendEmail = new Email();
                    $enviar = $sendEmail->sendEmail($sendEmail->asuntoSolicitud(), $sendEmail->cuerpoSolicitud($receptor, $requerimiento), $email, $receptor);
                    if ($enviar) {
                        echo "<div class='alert alert-success'><strong>Solicitudes Creadas!</strong> Se ha enviado exitosamente el correo para la solicitud de requerimiento</div>";
                    } else {
                        echo "<div class='alert alert-danger'><strong>Error de Solicitud!</strong> Error al enviar el correo de solicitud de requerimientos</div>";
                    }
                }
            }
            echo "<div class='alert alert-success'><strong>Solicitudes Creadas!</strong> Solicitud guardada correctamente</div>";
        }
    }

    public function solicitudLicenciatura() {

        if (!empty($_POST["creaSolicitud"])) {

            $idUser = $_SESSION['id_user'];

            $idRequerimiento = $_POST["requerimiento"];
            $idLicenciatura = $_POST["licenciatura"];
            //echo "id lic".$idLicenciatura;

            $datos = new Consultas();

            $solicitud = new Solicitud();

            $solicitud->setRequerimiento($datos->getNameRequerimiento($idRequerimiento));
            $solicitud->setEmisor($datos->getNameUser($idUser));
            $solicitud->setReceptor($datos->getProfesorLicenciatura($idLicenciatura));
            $solicitud->setFechaCreacion(date("Y.m.d H:i:s"));


            # "------------------------------------------------PRUEBA SOLICITUD-----------";
            $requerimiento = $solicitud->getRequerimiento();
            $emisor = $solicitud->getEmisor();
            $receptor = $solicitud->getReceptor();
            $fechaCreacion = $solicitud->getFechaCreacion();
            $idAdministrador = $datos->getIdAdmin($idUser);
            $idProfesor = $datos->getIdMaestro($idLicenciatura);
            $email = $datos->getEmail($idProfesor);

            $registro = $datos->registraSolicitud($requerimiento, $emisor, $receptor, $fechaCreacion, $idAdministrador, $idRequerimiento);


            #"------------------------------------------------PRUEBA RELACION SOLICITUD PROFESOR-----------";

            $idSolicitud = $datos->getIdSolicitud($receptor);
            $datos->relacionSolicitudProfesor($idSolicitud, $idAdministrador, $idProfesor, $idLicenciatura);

            if ($registro) {
                $sendEmail = new Email();
                $enviar = $sendEmail->sendEmail($sendEmail->asuntoSolicitud(), $sendEmail->cuerpoSolicitud($receptor, $requerimiento), $email, $receptor);
                if ($enviar) {
                    echo "<div class='alert alert-success'><strong>Solicitudes Creadas!</strong> Se ha enviado exitosamente el correo para la solicitud de requerimiento</div>";
                } else {
                    echo "<div class='alert alert-danger'><strong>Error de Solicitud!</strong> Error al enviar el correo de solicitud de requerimientos</div>";
                }
            }

            echo "<div class='alert alert-success'><strong>Solicitudes Creadas!</strong> Solicitud guardada correctamente</div>";
        }
    }

    public function solicitudProfesor() {
        if (!empty($_POST["creaSolicitud"])) {
            $idUser = $_SESSION['id_user'];

            $idRequerimiento = $_POST["requerimiento"];
            $profesores = $_POST['maestro']; #funciona como el idprofesor

            $datos = new Consultas();

            $solicitud = new Solicitud();
            $solicitud->setRequerimiento($datos->getNameRequerimiento($idRequerimiento));
            $solicitud->setEmisor($datos->getNameUser($idUser));
            $solicitud->setFechaCreacion(date("Y.m.d H:i:s"));

            foreach ($profesores as $profesor) {

                $solicitud->setReceptor($datos->getNameProfesor($profesor));

                $requerimiento = $solicitud->getRequerimiento();
                $emisor = $solicitud->getEmisor();
                $receptor = $solicitud->getReceptor();
                $fechaCreacion = $solicitud->getFechaCreacion();

                $idAdministrador = $datos->getIdAdmin($idUser);
                $idLicenciatura = $datos->getIdLic($profesor);
                $email = $datos->getEmail($profesor);

                # "------------------------------------------------PRUEBA SOLICITUD-----------";
                $registro = $datos->registraSolicitud($requerimiento, $emisor, $receptor, $fechaCreacion, $idAdministrador, $idRequerimiento);

                #"------------------------------------------------PRUEBA RELACION SOLICITUD PROFESOR-----------";

                $idSolicitud = $datos->getIdSolicitud($receptor);
                $datos->relacionSolicitudProfesor($idSolicitud, $idAdministrador, $profesor, $idLicenciatura);

                if ($registro) {
                    $sendEmail = new Email();
                    $enviar = $sendEmail->sendEmail($sendEmail->asuntoSolicitud(), $sendEmail->cuerpoSolicitud($receptor, $requerimiento), $email, $receptor);
                    if ($enviar) {
                    echo "<div class='alert alert-success'><strong>Solicitudes Creadas!</strong> Se ha enviado exitosamente el correo para la solicitud de requerimiento</div>";
                } else {
                    echo "<div class='alert alert-danger'><strong>Error de Solicitud!</strong> Error al enviar el correo de solicitud de requerimientos</div>";
                }
                }
            }
            echo "<div class='alert alert-success'><strong>Solicitudes Creadas!</strong> Solicitud guardada correctamente</div>";
        }
    }

    public function solicitudesEmisor() {

        $idUser = $_SESSION['id_user'];

        $datos = new Consultas();
        $emisor = $datos->getNameUser($idUser);

        $sol = $datos->mostrarSolicitudesEmisor($emisor);
        echo "<h3>Historial de Solicitudes</h3>";
        echo "<table class='table'>
                <thead>
                     <tr>
                         <th>Fecha de Creación</th>
                         <th>Nombre del Requerimiento</th>
                         <th>Nombre del Solicitante</th>
                         <th>Nombre del Profesor</th>
                         <th>Fecha de Respuesta</th>
                         <th>Archivo de Requerimiento</th>
                         
                         
                    </tr>
            
                </thead>";

        if ($sol <= 0) {
            echo "<tr>";
            echo "<td>No hay solicitudes</td>";
            echo "</tr>";
        } else {
            foreach ($sol as $solicitudes) {
                echo "<tr>";
                echo "<td>" . $solicitudes['fecha_creacion'] . "</td>";
                echo "<td>" . $solicitudes['nombre_req'] . "</td>";
                echo "<td>" . $solicitudes['emisor'] . "</td>";
                echo "<td>" . $solicitudes['receptor'] . "</td>";
                //echo "<td>" . $solicitudes['fecha_respuesta'] . "</td>";
                //echo "<td>" . $solicitudes['nombre_archivo'] . "</td>";

                if ($solicitudes['fecha_respuesta'] <= 0) {
                    echo "<td>Sin respuesta</td>";
                } else {
                    echo "<td>" . $solicitudes['fecha_respuesta'] . "</td>";
                }

                if (empty($solicitudes['nombre_archivo'])) {
                    echo "<td>Sin respuesta</td>";
                } else {
                    //echo "<td>archivo</td>";
                    echo "<td><a href='../archivos/" . $solicitudes['nombre_archivo'] . "?id=" . $solicitudes['id_solicitud'] . "'>" . $solicitudes['nombre_archivo'] . "</a></td>";
                }


                echo"</tr>";
            }
        }

        echo"</table>";
    }

    public function solicitudReceptor() {

        $idUser = $_SESSION['id_user'];

        $datos = new Consultas();
        $receptor = $datos->getNameUser($idUser);


        $sol = $datos->mostrarSolicitudesReceptor($receptor);
        echo "<h3>Lista de Solicitudes Requeridas</h3>";
        echo "<table class='table'>
                <thead>
                     <tr>
                         <th>Fecha de Creación</th>
                         <th>Nombre del Requerimiento</th>
                         <th>Nombre del Solicitante</th>
                         <th>Fecha de Respuesta</th>
                         <th>Archivo de Requerimiento</th>
                         
                    </tr>
            
                </thead>";

        if ($sol <= 0) {
            echo "<tr>";
            echo "<td>No hay solicitudes</td>";
            echo "</tr>";
        } else {
            foreach ($sol as $solicitudes) {
                echo "<tr>";
                echo "<td>" . $solicitudes['fecha_creacion'] . "</td>";
                echo "<td>" . $solicitudes['nombre_req'] . "</td>";
                echo "<td>" . $solicitudes['emisor'] . "</td>";
                
                if($solicitudes['fecha_respuesta'] <= 0){
                    echo "<td> Sin Respuesta";
                } else {
                    echo "<td>" . $solicitudes['fecha_respuesta'] . "</td>";
                    
                }

                if (empty($solicitudes['nombre_archivo'])) {
                    echo "<td> <a href='../Vista/Upload.php?idS=" . $solicitudes['id_solicitud'] . "'>Subir Archivo</a></td>";
                } else {
                    
                    echo "<td><a href='../archivos/" . $solicitudes['nombre_archivo'] . "?id=" . $solicitudes['id_solicitud'] . "'>" . $solicitudes['nombre_archivo'] . "</a></td>";
                }

                echo"</tr>";
            }
        }

        echo"</table>";
    }

}
