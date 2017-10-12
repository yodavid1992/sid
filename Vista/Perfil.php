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
        <link rel="stylesheet" href="Estilos/css/font-awesome.css">
        <link rel="stylesheet" href="Estilos/css/font-awesome.min.css">
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
            <div id="login-form">
                <form method="post" autocomplete="off">
                    <div class="col-md-10 col-md-offset-1"> 
                        <div class="form-group">
                            <h2 class="">Actualizar Contraseña</h2>
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
                        <input type="submit" name="cambiaPassword" class="btn btn-lg btn-primary btn-block" value="Guardar Cambios"/>
                    </div>

                </form>
            </div>

            <div class="col-md-6 col-md-offset-3 table-responsive" >
                <?php
                require '../Controlador/ControladorUsuarios.php';
                $update = new ControladorUsuarios();
                $update ->cambiarPassword();
                ?>
            </div>

        </div>
    </body>
</html>

