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
            <?php
            require '../Modelo/MenuModulos.php';
            $modulo = new MenuModulos();
            $modulo->moduloRequerimientos();
            ?>
            <div class="col-md-12"> 
                <div class="form-group col-md-10 col-md-offset-1">
                    <h2 class="">Requerimiento Por Licenciatura</h2>
                    <blockquote>
                        <p>En esta opción, se selecciona el requerimiento y licenciatura</p>
                    </blockquote>
                </div>
            </div>

            <div id="login-form">
                <form method="post" autocomplete="off">
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-tasks"></span></span>
                            <select id="licenciaturas" name="requerimiento" class="form-control">

                                <?php
                                require_once '../Controlador/ControladorRequerimientos.php';
                                $req = new ControladorRequerimientos();
                                $req->requerimientosForm();
                                ?>

                            </select>

                        </div>

                    </div>


                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                            <select id="licenciaturas" name="licenciatura" class="form-control">

                                <?php
                                require_once '../Controlador/ControladorLicenciaturas.php';
                                $licenciatura = new ControladorLicenciaturas();
                                $licenciatura->licenciaturaForm();
                                ?>

                            </select>

                        </div>

                    </div>
                    <div class="form-group col-md-10 col-md-offset-1">
                        <input type="submit" name="creaSolicitud" class="btn btn-lg btn-primary btn-block" value="Crear y Enviar Solicitudes"/>
                    </div>




                </form>
            </div>
            <div class="col-md-6 col-md-offset-3" >
                <?php
                require '../Controlador/ControladorSolicitudes.php';
                $sol = new ControladorSolicitudes();
                $sol->solicitudLicenciatura();
                ?>

            </div>


        </div>
    </body>
</html>
