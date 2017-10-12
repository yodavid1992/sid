<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio-Sistema de Información Docente</title>
        <link rel="stylesheet" type="text/css" href="Estilos/css/bootstrap.css">
        <link rel="stylesheet" href="Estilos/css/menu.css">
        <link rel="stylesheet" href="mobirise/style.css">

    </head>
    <body>
        <header>


            <?php
            // put your code here
            require '../Controlador/ControladorTemplate.php';
            $nav = new ControladorTemplate();

            $nav->getMenuAdmin();
            // include 'Navegacion.php';
            ?>

        </header>

        <div class="container">
            <div class="col-md-7 col-md-offset-3">
                <h3>Bienvenido al Sistema de Información Docente</h3>
                <br>
                <div class="col-md-6 col-md-offset-2">
                    <img src="Estilos/images/1.png" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                </div>
            </div>
        </div>

        <script src="Estilos/js/validacion.js"></script>    
    </body>


</html>
