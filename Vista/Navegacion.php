<?php
session_start();

require_once '../Modelo/Consultas.php';

if (!isset($_SESSION['id_user'])) {
    header("location: ../index.php");
}
$idUser = $_SESSION['id_user'];
$tipoUser = $_SESSION['tipo_user'];

$nombre = new Consultas();
?>

<nav>

    <ul>
        <li><a href="Template.php"> <span class="glyphicon glyphicon-home"></span>Inicio</a></li>
        <?php
            if($tipoUser == "administrador"){
                
            
            
            ?>
        <li><a href="Licenciaturas.php"><span class="glyphicon glyphicon-list-alt"></span>Catálogos</a>
            
            


        </li>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span>Administración de Usuarios <i class=" glyphicon glyphicon-menu-down"></i></a>
            <ul class="children">
                <li><a href="RegistraAdmin.php"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Usuario</a></li>
                <li><a href="Administrar.php"><span class="glyphicon glyphicon-edit"></span>Lista de Usuarios</a></li>
            </ul>

        </li>
        <li><a href="#"><span class="glyphicon glyphicon-file"></span>Solicitud de Requerimientos <i class="glyphicon glyphicon-menu-down"></i></a>
            <ul class="children">
                <li><a href="CreaRequisito.php"><span class="glyphicon glyphicon-new-window"></span>Nueva Solicitud</a></li>
                <li><a href="Historial.php"><span class="glyphicon glyphicon-bookmark"></span>Historial de Solicitudes</a></li>
            </ul>
        </li>
        <?php
            }
            else {
        ?>
        <li class="submenu"><a href="#"><span class="glyphicon glyphicon-file"></span>Solicitudes de Requerimientos <i class="glyphicon glyphicon-menu-down"></i></a>
            <ul class="children">
                <li><a href="Responder.php"><i class="fa fa-file-archive-o"></i>Ver Requerimientos</a></li>
                
            </ul>
        </li>
        <?php
            }
        ?>
        
        
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $nombre->getNameUser($idUser); ?> <i class="glyphicon glyphicon-menu-down"></i></a>
            <ul class="children">
                <?php
                echo "<li><a href='Perfil.php?id=" . $idUser . "'><span class='glyphicon glyphicon-edit'></span>Modificar Perfil" . "</a>";
                ?>

                <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>Cerrar Sesión</a></li>

            </ul>

        </li>

    </ul>
</nav>