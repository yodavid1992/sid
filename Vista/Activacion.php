<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Activación de Cuenta</title>
        <link rel="stylesheet" type="text/css" href="Estilos/css/bootstrap.css">
        <link rel="stylesheet" href="Estilos/css/font-awesome.css">
        <link rel="stylesheet" href="Estilos/css/font-awesome.min.css">
        <link rel="stylesheet" href="Estilos/css/menu.css">

    </head>
    <body>
        <div class="container">
        <?php
        // put your code here
        //echo "activacion";
        require '../Controlador/ControladorUsuarios.php';
        $activa = new ControladorUsuarios();
        $activa ->activarCuenta();
        
        ?>
        </div>
    </body>
</html>
