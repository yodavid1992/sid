<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>
    <head>
        <meta charset="utf-8">
        <title>Sistema de Información Docente</title>
        <link rel="stylesheet" type="text/css" href="Vista/Estilos/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="page-header text-center">
                        <h1>Sistema de Información Docente <small></small></h1>
                    </div>
                    <form class="form-signin" method="post" >
                        <h2 class="form-signin-heading">Iniciar Sesión</h2>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input type="email" name="email" class="form-control" placeholder="Email" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required/>
                            </div>
                        </div>
                        <div class="form-group col-md-5 col-md-offset-">
                            <input type="submit"  name="login" class="btn btn-lg btn-primary btn-block" value="Iniciar Sesión">
                        </div>
                        <div class="form-group col-md-4 col-md-offset-2">
                            <a class="btn btn-lg btn-link" href="Vista/Recuperar.php">Recuperar Contraseña</a>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                            <?php
                require 'Controlador/ControladorUsuarios.php';

                $mvcLogin = new ControladorUsuarios();
                $mvcLogin->login();
                ?>
                
            </div>

        </div>


    </body>
</html>


