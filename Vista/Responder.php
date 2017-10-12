<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
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
        <div class="col-md-10 col-md-offset-1 table-responsive">


            <?php
            require '../Controlador/ControladorSolicitudes.php';
            $mostrar = new ControladorSolicitudes();
            $mostrar->solicitudReceptor();
            ?>

        </div>
    </div>

</body>
</html>
