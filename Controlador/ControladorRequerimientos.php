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
require_once '../Modelo/Datos/Requerimientos.php';

class ControladorRequerimientos {
    //put your code here
    
    public function catalogoRequerimientos() {
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
                $requerimiento = new Requerimientos();
                $requerimiento ->setNombreRequerimiento($objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue());
                $requerimiento ->setDescripcion($objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue());

                $nombre = $requerimiento ->getNombreRequerimiento();
                $descripcion = $requerimiento->getDescripcion();

                $datos = new Consultas();
                $datos->insertarRequerimientos($nombre, $descripcion);
            }
        }
    }
    
    public function mostrarRequerimiento() {
        $requerimiento = new Consultas();
        $filas = $requerimiento ->mostrarRequerimientos();

        echo "<br>";
        echo "<h3> Lista de Requerimientos </h3>";
        echo"<table class='table'> 
                    <tr>
                        <th>Nombre del Requerimiento</th>
                        <th>Descripción del Requerimiento</th>

                    </tr>";

        foreach ($filas as $fila) {
            echo "<tr>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['descripcion'] . "</td>";

            echo "</tr>";
        }

        echo"</table>";
        //echo "        </div>";
    
    }
    
    public function requerimientosForm() {
        $req = new Consultas();
        $filas = $req ->mostrarRequerimientos();
        foreach ($filas as $fila) {
            
            echo "<option value='" . $fila['id_req'] . "'>" . $fila['nombre'] . "</option>";
        }
    }
}
