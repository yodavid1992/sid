<?php

date_default_timezone_set('America/Mexico_City');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorArchivo
 *
 * @author David
 */
if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
}
require_once '../Modelo/Consultas.php';
require_once '../Modelo/Datos/Solicitud.php';

class ControladorArchivo {

    //put your code here
    public function subirArchivos() {

        $ruta = "../archivos/";
        if (isset($_POST["archivoRequerimiento"])) {
            $idSolicitud = $_GET['idS'];
            

            $solicitud = new Solicitud();
            $solicitud->setArchivo($_FILES['file']['name']);
            $solicitud->setFechaRespuesta(date("Y.m.d H:i:s"));

            $nameFile = $solicitud->getArchivo();
            $fechaRespuesta = $solicitud->getFechaRespuesta();
            $archivo = $ruta . $nameFile;
            if (!file_exists($ruta)) {
                mkdir($ruta);
            }

            $result = move_uploaded_file($_FILES['file']['tmp_name'], $archivo);
            //echo $nameFile;

            if ($result) {
                $update = new Consultas();
                $update->saveFile($fechaRespuesta, $nameFile, $idSolicitud);
                echo "<div class='alert alert-success'><strong>Archivo guardado!</strong> Se ha guardado su archivo correctamente</div>";
                //header("location: ../Vista/Responder.php");
            } else {
                echo "<div class='alert alert-danger'><strong>Error!</strong> No se guardo su archivo, por favor reintentelo</div>";
            }
        }
    }

}
