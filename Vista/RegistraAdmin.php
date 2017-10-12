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
            
            ?>
        </header>

        <div class="container">
            <?php
            require '../Modelo/MenuModulos.php';
            $modulo = new MenuModulos();
            $modulo ->moduloUsuarios();
            
            ?>
            
            
            <div id="login-form">
                <form method="post" autocomplete="off">
                    <div class="col-md-10 col-md-offset-1"> 
                        <div class="form-group">
                            <h2 class="">Registrar Administrador</h2>
                        </div>
                    </div>

                    <div class="form-group col-md-10 col-md-offset-1 ">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="nombre" class="form-control"placeholder="Nombre Completo" required/>
                        </div>
                    </div>

                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="apellidos" class="form-control"placeholder="Apellidos" required/>
                        </div>
                    </div>

                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                            <input type="text" name="puesto" class="form-control"placeholder="Puesto" required/>
                        </div>
                    </div>

                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email" class="form-control"placeholder="Email" required/>
                        </div>
                    </div>

                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                            <input type="tel" name="telefono" class="form-control"placeholder="10 digitos" required/>
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
                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Registrar Administrador"/>
                    </div>

                </form>
            </div>
            
            
            

            <div class="col-md-6 col-md-offset-3 table-responsive" >
                <?php
                require '../Controlador/ControladorRegistros.php';
                $registro = new ControladorRegistros();
                $registro->registraAdministrador();
                
                ?>
            </div>
            <div class="col-md-6 col-md-offset-3 table-responsive" >
                <?php
                
                $registro ->mostrarAdministradores();
                ?>
            </div>

        </div>
    </body>
</html>

