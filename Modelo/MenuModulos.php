<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuModulos
 * Esta clase sirve para cargar los submenus de las secciones del menu principal
 *
 * @author David
 */
class MenuModulos {

    //put your code here

    public function moduloUsuarios() {
        echo " <ul class='nav nav-tabs nav-justified'>

                    <li><a href='RegistraAdmin.php'>Registrar Administrador</a></li>
                    <li><a href='RegistraProf.php'>Registrar Profesor</a></li>
    
                </ul>";
    }

    public function moduloCatalogos() {
        echo "<ul class='nav nav-tabs nav-justified'>

                    <li><a href='Licenciaturas.php'>Cargar Licenciaturas</a></li>
                    <li><a href='Profesores.php'>Cargar Profesores</a></li>
                    <li><a href='Requerimientos.php'>Cargar Requerimientos</a></li>
             </ul>";
    }
    
    public function moduloRequerimientos() {
        
        echo "<ul class='nav nav-tabs nav-justified'>

                    <li><a href='CreaRequisito.php'>Solicitud a Todas las Licenciaturas</a></li>
                    <li><a href='VistaLicenciaturaR.php'>Solicitud Por Licenciatura</a></li>
                    <li><a href='VistaMaestroR.php'>Solicitud Por Profesor</a></li>
             </ul>";
        
    }

}
