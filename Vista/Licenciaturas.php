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
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
            $modulo ->moduloCatalogos();
            
            ?>
            <br>
            <div class="col-md-6 col-md-offset-3">

                <fieldset class="form-group">
                    <legend class="sch  ">Importar Licenciaturas</legend>
                    <h3><span class="label label-success">Seleccionar Archivo</span></h3>

                    <form method="post" class="form-group" enctype="multipart/form-data">

                        <input type="file" name="file" value="file" class="custom-file-input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <input type="submit" class="btn btn-success" name="cargarExcel" value="Subir" id="upload_btn" data-loading-text="Loading...">

                    </form>

                </fieldset>
                
                

            </div>
            <br>
            <div class="col-md-6 col-md-offset-3" >
                <?php
                require '../Controlador/ControladorLicenciaturas.php';
                $lic = new ControladorLicenciaturas();
                $lic->cargarLicenciaturas();
                $lic->mostrarLicenciaturas();
                ?>
            </div>
        </div>
    </body>
</html>
