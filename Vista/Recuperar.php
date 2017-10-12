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
                <form method="post" autocomplete="off">
                    <div class="col-md-7 col-md-offset-3"> 
                        <div class="form-group">
                            <h2 class="">Email de Recuperación</h2>
                        </div>
                    </div>

                    
                    <div class="form-group col-md-7 col-md-offset-3">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email" class="form-control"placeholder="Email" required/>
                        </div>
                    </div>

                    <div class="form-group col-md-7 col-md-offset-3">
                        <input type="submit" name="recuperar" class="btn btn-lg btn-primary btn-block" value="Enviar Solicitud"/>
                    </div>

                </form>
            </div>
            <div class="col-md-7 col-md-offset-3">
                
                <?php
                require '../Controlador/ControladorUsuarios.php';
                $datos = new ControladorUsuarios();
                $datos->correoPassword();
                ?>
                
            </div>
        </div>
        
            
            
    </body>
</html>
