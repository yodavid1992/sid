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
            $modulo ->moduloRequerimientos();
            
            ?>

            <div id="login-form">

                <form method="post" autocomplete="off" onsubmit=" return validarRegistro()">
                    <div class="col-md-12"> 
                        <div class="form-group col-md-10 col-md-offset-1">
                            <h2 class="">Requerimiento Para Todas Las Licenciaturas</h2>
                            <blockquote>
                                <p>En esta opción solo se selecciona el requerimiento que será enviada a todas los profesores de todas las licenciaturas</p>
                            </blockquote>
                        </div>
                    </div>
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-tasks"></span></span>
                            <select id="licenciaturas" name="requerimiento" class="form-control">
                                
                                <?php
                                require '../Controlador/ControladorRequerimientos.php';
                                $req = new ControladorRequerimientos();
                                $req->requerimientosForm();
                                ?>

                            </select>

                        </div>

                    </div>
                    <div class="form-group col-md-10 col-md-offset-1">
                        <input type="submit" name="creaSolicitud" class="btn btn-lg btn-primary btn-block" value="Crear y Enviar Solicitudes"/>
                    </div>
                    

                </form>
            </div>
            
            
        </div>
        <br>
        <div class="col-md-7 col-md-offset-3" >
            <?php
                    
                    require '../Controlador/ControladorSolicitudes.php';
                    $sol = new ControladorSolicitudes();
                    $sol ->creaSolicitud();
                    ?>
            
        </div>
    </body>
</html>
