<?php
date_default_timezone_set('America/Mexico_City');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LicenciaturasControlador
 *
 * @author David
 */
require_once '../Modelo/Consultas.php';
require_once '../Modelo/Datos/Licenciaturas.php';
require_once '../PHPExcel/Classes/PHPExcel/IOFactory.php';

class ControladorLicenciaturas {
    //put your code here
    
    public function cargarLicenciaturas() {
        
        if (isset($_POST["cargarExcel"])) {
            $archivo = $_FILES['file']['tmp_name'];
            //carga la hoja de cálculo
            $objPHPExcel = PHPExcel_IOFactory::load($archivo);

            //Asigno la hoja de calculo activa
            $objPHPExcel->setActiveSheetIndex(0);
            //$objPHPExcel ->setReadDataOnly(true);
            //Obtengo el numero de filas del archivo
            $filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

            for ($i = 3; $i <= $filas; $i++) {
                $licenciatura = new Licenciaturas();
                $licenciatura->setSiglas($objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue());
                $licenciatura->setNombreLicenciatura($objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue());

                $siglas = $licenciatura->getSiglas();
                $nombre = $licenciatura->getNombreLicenciatura();

                $datos = new Consultas();
                $datos->insertarLicenciaturas($siglas, $nombre);
            }
        }
    }
    
    public function mostrarLicenciaturas() {
        $lic = new Consultas();
        $filas = $lic->mostrarLicenciaturas();

        echo "<br>";
        echo "<h3> Lista de Licenciaturas </h3>";
        //echo"<div class='tab'>";
        
        echo"<table class='table table-fixed'> 
                    <tr>
                        <th>Siglas de Licenciatura</th>
                        <th>Nombre de la Licenciatura</th>

                    </tr>";

        foreach ($filas as $fila) {
            echo "<tr>";
            echo "<td>" . $fila['siglas'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";

            echo "</tr>";
        }

        echo"</table>";
        
    }
    
    public function licenciaturaForm() {
        $lic = new Consultas();
        $filas = $lic->mostrarLicenciaturas();
        
        
        foreach ($filas as $fila) {
            
            //echo "<label><input type='radio' name=". $fila['id_lic'] .">".$fila['nombre'] ."</label>";
            //echo"funcion";
            echo "<option value='" . $fila['id_lic'] . "'>" . $fila['nombre'] . "</option>";
        }
        
    }

}
