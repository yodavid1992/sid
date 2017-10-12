<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

?>
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
            $modulo ->moduloUsuarios();
            
            ?>
            <div id="login-form">
                <form method="post" autocomplete="off" onsubmit=" return validarRegistro()">
                    <div class="col-md-10 col-md-offset-1"> 
                        <div class="form-group">
                            <h2 class="">Registrar Profesor</h2>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group ">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                            <select id="licenciaturas" name="licenciatura" class="form-control">
                                <?php
                                require '../Controlador/ControladorLicenciaturas.php';
                                $lic = new ControladorLicenciaturas();
                                $lic ->licenciaturaForm();
                                
                               
                                ?>
                                
                            </select>
                            
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-education"></span></span>
                            <input type="text" name="gradoEstudios" id="grado" class="form-control"placeholder="Grado de Estudios" required/>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="nombre" id="nombre" class="form-control"placeholder="Nombre Completo" required/>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="apellidos" id="apellidos" class="form-control"placeholder="Apellidos" required/>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email" id="email" class="form-control"placeholder="Email" required/>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                            <input type="tel" name="telefono" id="tel"class="form-control"placeholder="10 digitos" required/>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="password" id="password" class="form-control"placeholder="Password" required/>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="confirmaPassword" id="confirma" class="form-control"placeholder="Confirmar Password" required/>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10 col-md-offset-1">
                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Registrar Profesor"/>
                    </div>
                        
                </form>
                
            </div>
            
            <div class="col-md-6 col-md-offset-3 table-responsive" >
                <?php
                require '../Controlador/ControladorProfesor.php';
                $registro = new ControladorProfesor();
                $registro->registrarProfesor();
                
                ?>
            </div>
            <div class="col-md-6 col-md-offset-3 table-responsive" >
                <?php
                
                $registro ->mostrarMaestros();
                ?>
            </div>
        </div>
        
        
    </body>
</html>
