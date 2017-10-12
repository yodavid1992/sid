<?php
session_start();
if (empty($_GET['id'])) {
    header('Location: ../index.php');
}

if (empty($_GET['val'])) {
    header('Location: ../index.php');
}
$idUs = $_GET['id'];
$tokenPassword = $_GET['val'];


require_once '../Modelo/Consultas.php';
$datos = new Consultas();
?>

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
        <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="Estilos/css/bootstrap.css">
        <link rel="stylesheet" href="Estilos/css/menu.css">
        <link rel="stylesheet" href="mobirise/style.css">

    </head>
    </head>
    <body>
        <div class="container">
            <div id="login-form">
                <?php
                if (!$datos->verificaSolicitudPassword($idUs, $tokenPassword)) {
                    echo "<div class='alert alert-danger'><strong>Error!</strong>Error en los datos para recuperar contraseña</div>";
                } else {
                    ?>

                    <form method="post" autocomplete="off">
                        <div class="col-md-10 col-md-offset-1"> 
                            <div class="form-group">
                                <h2 class="">Nueva Contraseña</h2>
                            </div>
                        </div>

                        <div class="form-group col-md-10 col-md-offset-1">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="password" class="form-control"placeholder="Password" required/>
                            </div>
                        </div>

                        <div class="form-group col-md-10 col-md-offset-1">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="confirmaPassword" class="form-control"placeholder="Confirmar Password" required/>
                            </div>
                        </div>

                        <div class="form-group col-md-10 col-md-offset-1">
                            <input type="submit" name="newPassword" class="btn btn-lg btn-primary btn-block" value="Guardar Nueva Contraseña"/>
                        </div>

                    </form>
                </div>
                <?php
            }
            ?>

            <div class="col-md-6 col-md-offset-3 table-responsive" >
                <?php
                require '../Controlador/ControladorUsuarios.php';
                $datosU = new ControladorUsuarios();
                $datosU->recuperaPassword();
                ?>
            </div>

        </div>
    </body>
</html>
