<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../Vista/Estilos/css/bootstrap.css">
        <link rel="stylesheet" href="../Vista/Estilos/css/font-awesome.css">
        <link rel="stylesheet" href="../Vista/Estilos/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Vista/Estilos/css/menu.css">

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
            <div class="col-md-6 col-md-offset-3">
                
                <fieldset class="form-group">
                    <legend class="sch  ">Cargar Archivo de Requerimiento</legend>
                    <h3><span class="label label-success">Seleccionar Archivo (2MB)</span></h3>

                    <form method="post" class="form-group" enctype="multipart/form-data">

                        <input type="file" name="file" value="file" class="custom-file-input" accept="application/pdf">
                        <input type="submit" class="btn btn-success" name="archivoRequerimiento" value="Subir" id="upload_btn" data-loading-text="Loading...">

                    </form>

                </fieldset>
                
                
                
                
            </div>
            
            <div class="col-md-6 col-md-offset-3">
                <a href="Responder.php">Regresar a la Lista de Requerimientos</a>
                </div>
            <div class="col-md-6 col-md-offset-3">
            <?php
                require '../Controlador/ControladorArchivo.php';
                        $archivo = new ControladorArchivo();
                        $archivo ->subirArchivos();
                ?>
            </div>
        </div>
        
    </body>
</html>
