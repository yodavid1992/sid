<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="Estilos/css/bootstrap.css">
        <link rel="stylesheet" href="Estilos/css/menu.css">
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
            <div class="col-md-7 col-md-offset-3 table-responsive">

                <?php
                require '../Controlador/ControladorUsuarios.php';
                $datos = new ControladorUsuarios();
                $datos->mostrarUsuarios()
                //$da ->
                // include 'Navegacion.php';
                ?>

            </div>
            <div class="col-md-7 col-md-offset-3">
                <?php
                $datos->deleteUsuario();
                ?>
            </div>
        </div>

    </body>
</html>
