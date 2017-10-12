<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Consultas
 *
 * @author David
 */
require 'MySQL.php';

class Consultas extends MySQL {

    public function registroUsuarios($nombre, $apellidos, $email, $idCuenta, $password, $tipo) {
        $stm = "INSERT INTO tesis.usuarios (nombre,apellidos,email, token_user, password, tipo_user) "
                . "VALUES (:nombre,:apellidos, :email, :token_user, :password, :tipo_user)";
        //NOTA en la base de datos token_user hace referencia a idCuenta
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":token_user", $idCuenta);
            $sql->bindParam(":password", $password);
            $sql->bindParam(":tipo_user", $tipo);
            $sql->execute();


            return true;
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al registrar al usuario</div>" . $ex->getMessage());
        }
    }

    public function registroProfesores($gradoEstudios, $nombre, $apellidos, $email, $telefono) {
        $stm = "INSERT INTO tesis.maestros (grado, nombre, apellidos, email, telefono) VALUES (:grado, :nombre, :apellidos, :email, :telefono)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":grado", $gradoEstudios);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":telefono", $telefono);
            $sql->execute();

            return true;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al registrar al profesor</div>" . $ex->getMessage());
        }
    }

    public function registrarAdministrador($nombre, $apellidos, $cargo, $email, $telefono) {
        $stm = "INSERT INTO tesis.administradores (nombre, apellidos, cargo, email, telefono) VALUES (:nombre, :apellidos, :cargo, :email, :telefono)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":cargo", $cargo);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":telefono", $telefono);
            $sql->execute();
            return true;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al registrar al administrador</div>" . $ex->getMessage());
        }
    }
    
    public function validaUsuario($email) {
        $stm = "SELECT email FROM tesis.usuarios WHERE email = :email";
        try {
             $sql = MySQL::getConexion()->prepare($stm);
             $sql->bindParam(":email", $email);
             $sql->execute();
             $rows = $sql->fetch();
             
             if($rows > 0) {
                 return true;
             } else {
                 return false;
                 
             }
            
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al obtener al usuario</div>" . $ex->getMessage());
        }
    }

    public function mostrarProfesores() {
        $rows = null;
        $stm = "SELECT * FROM tesis.maestros";
        try {

            $sql = MySQL::getConexion()->prepare($stm);
            $sql->execute();
            while ($result = $sql->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al mostrar a los profesores</div>" . $ex->getMessage());
        }
    }

    public function mostrarAdministrador() {
        $rows = null;
        $stm = "SELECT * FROM tesis.administradores";
        try {

            $sql = MySQL::getConexion()->prepare($stm);
            $sql->execute();
            while ($result = $sql->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al mostrar a los administradores</div>" . $ex->getMessage());
        }
    }

    public function relacionMaestroUser($idUser, $idMaestro) {
        $stm = "INSERT INTO tesis.relacion_maestros_usuarios (id_maestro, id_user) VALUES (:id_maestro, :id_user)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_maestro", $idMaestro);
            $sql->bindParam(":id_user", $idUser);
            $sql->execute();

            return true;
        } catch (Exception $ex) {
            return die("error" . $ex->getMessage());
        }
    }

    public function relacionAdminUser($idAdmin, $idUser) {
        $stm = "INSERT INTO tesis.relacion_administradores_usuarios (id_admin, id_user) VALUES (:id_admin, :id_user)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_admin", $idAdmin);
            $sql->bindParam(":id_user", $idUser);
            $sql->execute();

            return true;
        } catch (Exception $ex) {
            return die("error" . $ex->getMessage());
        }
    }

    public function getIdAdmin($idUser) {
        $stm = "SELECT id_admin from tesis.relacion_administradores_usuarios WHERE id_user = :id_user";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_user", $idUser);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $idAdmin = $rows['id_admin'];
                return $idAdmin;
            }
        } catch (Exception $ex) {
            return die("error" . $ex->getMessage());
        }
    }
    
    public function getIdLic($idMaestro) {
        $stm = "SELECT id_lic FROM tesis.relacion_maestro_licenciatura WHERE id_maestro = :id_maestro";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_maestro", $idMaestro);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $idLic = $rows['id_lic'];
                return $idLic;
            }
            
        } catch (Exception $ex) {
            
            return die("error al obtener el id de la licenciatura" . $ex->getMessage());
            
        }
    }
    
    public function getIdMaestro($idLicenciatura) {
        $stm = "SELECT id_maestro FROM tesis.relacion_maestro_licenciatura WHERE id_lic = :id_lic";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_lic", $idLicenciatura);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $idMaestro = $rows['id_maestro'];
                return $idMaestro;
            }
            
        } catch (Exception $ex) {
            
            return die("error al obtener el id del maestro" . $ex->getMessage());
            
        }
        
    }

    public function relacionMaestroLicenciatura($idMaestro, $idLicenciatura) {
        $stm = "INSERT INTO tesis.relacion_maestro_licenciatura (id_maestro, id_lic) VALUES (:id_maestro, :id_lic)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_maestro", $idMaestro);
            $sql->bindParam(":id_lic", $idLicenciatura);
            $sql->execute();

            return true;
        } catch (Exception $ex) {
            return die("error" . $ex->getMessage());
        }
    }

    public function getIdUsuario($email) {

        $stm = "SELECT id_user FROM tesis.usuarios WHERE email = :email";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":email", $email);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $idUser = $rows['id_user'];
                return $idUser;
            }
        } catch (Exception $ex) {
            return die("error" . $ex->getMessage());
        }
    }

    public function getIdProfesor($email) {
        $stm = "SELECT id_maestro FROM tesis.maestros WHERE email = :email";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":email", $email);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $idMaestro = $rows['id_maestro'];
                return $idMaestro;
            }
        } catch (Exception $ex) {

            return die("error" . $ex->getMessage());
        }
    }

    public function getIdAdministrador($email) {

        $stm = "SELECT id_admin FROM tesis.administradores WHERE email = :email";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":email", $email);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $idAdmin = $rows['id_admin'];
                return $idAdmin;
            }
        } catch (Exception $ex) {

            return die("error" . $ex->getMessage());
        }
    }

    #METODO PARA INICIAR SESION, REGRESANDO EL TIPO DE USUARIO, PARA EL ACCESO, ES DECIR, CONTROL DE PRIVILEGIOS

    public function login($email, $password) {

        $stm = "SELECT email, password, activacion, tipo_user FROM tesis.usuarios WHERE email = :email";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":email", $email);
            $sql->execute();
            $rows = $sql->fetch();
            if ($rows > 0) {

                if ($rows['activacion'] == 0) {
                    return die("<div class='alert alert-warning'><strong>Activar Cuenta!</strong> Por favor active su cuenta para ingresar al sistema</div>");
                } else {
                    $passwordDB = $rows['password'];
                    //$validaPass = strcmp($password, $passwordDB);

                    if (strcmp($password, $passwordDB) !== 0) {
                        //return false;
                        
                        return $tipoUser = $rows['tipo_user'];
                    } else {
                        //return $tipoUser = $rows['tipo_user'];
                        return false;
                    }
                }
                
            } else {
                return die("<div class='alert alert-danger'><strong>Error de Usuario!</strong> El usuario no existe</div>");
            }
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error de Usuario!</strong> Error al iniciar sesión</div>" . $ex->getMessage());
        }
    }
    public function solicitudPassword($idUser, $tokenPassword) {
        $stm = "UPDATE tesis.usuarios SET token_password = :token_password WHERE id_user = :id_user"; 
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_user", $idUser);
            $sql ->bindParam(":token_password", $tokenPassword);
            $sql->execute();
            return true;
            
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al actualizar el token</div>" . $ex->getMessage());
            
        }
        
    }
    
    public function verificaSolicitudPassword($idUser, $tokenPassword) {
        $stm = "SELECT activacion FROM tesis.usuarios WHERE id_user=:id_user AND token_password = :token_password";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_user", $idUser);
            $sql->bindParam(":token_password", $tokenPassword);
            $sql->execute();
            $rows = $sql->fetch();
            if ($rows > 0) {
                if ($rows['activacion'] == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al actualizar el token</div>" . $ex->getMessage());
        }
    }
    
    public function lastSesion($idUser, $fechaSesion) {
        $stm = "UPDATE tesis.usuarios set ultima_sesion = :ultima_sesion WHERE id_user= :id_user";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":ultima_sesion", $fechaSesion);
            $sql->bindParam(":id_user", $idUser);
            $sql->execute();
            return true;
            
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al actualizar la fecha de sesión</div>" . $ex->getMessage());

        }
        
    }
    

    #METODO PARA RECUPERAR EL PASSWORD DEL USUARIO A TRAVÉS DEL EMAIL

    public function recoveryPassword($idUser, $tokenPassword, $password) {
        $stm = "UPDATE tesis.usuarios SET password = :password WHERE id_user = :id_user AND token_password = :token_password";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_user", $idUser);
            $sql ->bindParam(":token_password", $tokenPassword);
            $sql ->bindParam(":password", $password);
            $sql->execute();
            return true;
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al actualizar la contraseña</div>" . $ex->getMessage());
            
        }
        
    }
    
    public function updatePassword($idUser,$password) {
        $stm = "UPDATE tesis.usuarios SET password = :password WHERE id_user = :id_user";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_user", $idUser);
            $sql ->bindParam(":password", $password);
            $sql->execute();
            return true;
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al actualizar la contraseña</div>" . $ex->getMessage());
            
        }
    }


    public function insertarLicenciaturas($siglas, $nombre) {

        $stm = "INSERT INTO tesis.licenciaturas (siglas, nombre) VALUES (:siglas, :nombre)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":siglas", $siglas);
            $sql->bindParam(":nombre", $nombre);
            $sql->execute();

            return true;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al guardar las licenciaturas</div>" . $ex->getMessage());
        }
    }

    public function mostrarLicenciaturas() {

        $stm = "SELECT * FROM tesis.licenciaturas";
        try {

            $sql = MySQL::getConexion()->prepare($stm);
            $sql->execute();
            while ($result = $sql->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al mostrar las licenciaturas</div>" . $ex->getMessage());
        }
    }

    #METODO PARA OBTENER EL ID DE LA LICENCIATURA Y PODER INGRESARLA A LA BASE DE DATOS CON LAS TABLAS RELACIONADAS CON EL CATALGOS

    public function getIdLicenciatura($siglas) {

        $stm = "select id_lic from tesis.licenciaturas WHERE siglas = :siglas";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":siglas", $siglas);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $idLicenciatura = $rows['id_lic'];
            }
            return $idLicenciatura;
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error en el número de licenciatura</div>" . $ex->getMessage());
        }
    }

    public function insertarRequerimientos($nombre, $descripcion) {
        $stm = "INSERT INTO tesis.requerimientos (nombre, descripcion) VALUES (:nombre, :descripcion)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":descripcion", $descripcion);
            $sql->execute();

            return true;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al guardar los requerimientos</div>" . $ex->getMessage());
        }
    }

    public function mostrarRequerimientos() {

        $stm = "SELECT * FROM tesis.requerimientos";
        try {

            $sql = MySQL::getConexion()->prepare($stm);
            $sql->execute();
            while ($result = $sql->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al mostrar los requerimientos</div>" . $ex->getMessage());
        }
    }

    public function mostrarUsuarios() {

        $stm = "SELECT * FROM tesis.usuarios";
        try {

            $sql = MySQL::getConexion()->prepare($stm);
            $sql->execute();
            while ($result = $sql->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        } catch (Exception $ex) {

            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al mostrar los usuarios</div>" . $ex->getMessage());
        }
    }

    public function getNameUser($idUser) {

        $stm = "SELECT id_user, nombre, apellidos FROM tesis.usuarios WHERE id_user = :id_user";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_user", $idUser);
            $sql->execute();
            $rows = $sql->fetch();
            
            if ($rows > 0) {
                $datosUser = $rows['nombre'] . " " . $rows['apellidos'];
                return $datosUser;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al mostrar los usuarios</div>" . $ex->getMessage());
        }
    }
    
    public function getNameProfesor($idMaestro) {
        $stm = "SELECT nombre, apellidos from tesis.maestros WHERE id_maestro = :id_maestro";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_maestro", $idMaestro);
            $sql->execute();
            $rows = $sql->fetch();
            
            if ($rows > 0) {
                $datosMaestro = $rows['nombre'] . " " . $rows['apellidos'];
                return $datosMaestro;
            } else {
                return false;
            }
            
        } catch (Exception $ex) {
            
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al obtener el nombre</div>" . $ex->getMessage());
            
        }
        
    }
    
    public function getEmail($idMaestro) {
        $stm = "SELECT email FROM tesis.maestros WHERE id_maestro = :id_maestro";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_maestro", $idMaestro);
            $sql->execute();
            $rows = $sql->fetch();
            
            if ($rows > 0) {
                $email = $rows['email'];
                return $email;
            } else {
                return false;
            }
            
        } catch (Exception $ex) {
            
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al obtener el email</div>" . $ex->getMessage());
            
        }
        
    }

    public function getNameRequerimiento($idRequerimiento) {
        $stm = "SELECT nombre, descripcion FROM tesis.requerimientos where id_req = :id_req";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_req", $idRequerimiento);
            $sql->execute();
            $rows = $sql->fetch();
            //$rows = $res;
            if ($rows > 0) {
                $requerimiento = $rows["nombre"];
                return $requerimiento;
            }
        } catch (Exception $ex) {
            return die("<br>error al ver requerimiento<br>" . $ex->getMessage());
        }
    }
    
    public function getNameLicenciatura($idLicenciatura) {
        $stm = "select nombre from tesis.licenciaturas WHERE id_lic = :id_lic";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_lic", $idLicenciatura);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $licenciatura = $rows['nombre'];
            }
            return $licenciatura;
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al obtener el nombre de la licenciatura</div>" . $ex->getMessage());
        }
    }
    
    #OBTENEMOS LOS DATOS DEL PROFESOR MEDIANTE UN INNER JOIN
    public function getProfesorLicenciatura($idLicenciatura) {
        $stm = "SELECT * FROM tesis.maestros M INNER JOIN tesis.relacion_maestro_licenciatura R ON M.id_maestro = R.id_maestro WHERE R.id_lic=:id_lic";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_lic", $idLicenciatura);
            $sql->execute();
            $rows = $sql->fetch();
            
             if ($rows > 0) {
                $nombreProfesor = $rows['nombre']." ".$rows['apellidos'];
                return $nombreProfesor;
            } else {
                return false;
            }
            
            
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al obtener el nombre de profesor/div>" . $ex->getMessage());
            
        }
        
    }

    public function registraSolicitud($requerimiento, $emisor, $receptor, $fechaCreacion, $idAdministrador, $idRequerimiento) {
        $stm = "INSERT INTO tesis.solicitudes_requerimientos (nombre_req, emisor, receptor, fecha_creacion, id_admin, id_req) VALUES (:nombre_req, :emisor, :receptor, :fecha_creacion, :id_admin, :id_req)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql ->bindParam(":nombre_req", $requerimiento);
            $sql ->bindParam(":emisor", $emisor);
            $sql ->bindParam(":receptor", $receptor);
            $sql ->bindParam(":fecha_creacion", $fechaCreacion);
            $sql ->bindParam(":id_admin", $idAdministrador);
            $sql ->bindParam(":id_req", $idRequerimiento);
            
            $sql ->execute();
            
            return true;
            
            
        } catch (Exception $ex) {
             return die("<div class='alert alert-danger'><strong>Error!</strong> Error al guardar las solicitudes</div>" . $ex->getMessage());
            
        }
        
        
    }
    
    #el receptor cambiara el id de la solicitud oara que cambie al insertar las relaciones en la tabla
    public function getIdSolicitud($receptor) {
        $stm = "SELECT id_solicitud FROM tesis.solicitudes_requerimientos WHERE receptor = :receptor";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":receptor", $receptor);
            $sql->execute();
            $rows = $sql->fetch();

            if ($rows > 0) {
                $idSolicitud = $rows["id_solicitud"];

                return $idSolicitud;
            }
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al obtener el id de solicitud</div>" . $ex->getMessage());
        }
    }
    
    public function relacionSolicitudProfesor($idSolicitud, $idAdministrador, $idProfesor, $idLicenciatura) {
        $stm = "INSERT INTO tesis.relacion_solicitud_profesor (id_solicitud, id_admin, id_maestro, id_lic) VALUES (:id_solicitud, :id_admin, :id_maestro, :id_lic)";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_solicitud", $idSolicitud);
            $sql->bindParam(":id_admin", $idAdministrador);
            $sql->bindParam(":id_maestro", $idProfesor);
            $sql->bindParam(":id_lic", $idLicenciatura);
            $sql ->execute();
            
            return true;
            
        } catch (Exception $ex) {
             return die("<div class='alert alert-danger'><strong>Error!</strong> Error al insertar la relación solicitud-profesors</div>" . $ex->getMessage());
            
        }
        
    }
    
    public function mostrarSolicitudesEmisor($emisor){
        $rows = null;
        $stm = "SELECT * FROM tesis.solicitudes_requerimientos WHERE emisor = :emisor";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":emisor", $emisor);
            $sql->execute();
            while ($result = $sql->fetch()) {
                
                    $rows[] = $result;
                
                
            }
            return $rows;
            
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al mostrar las solicitudes</div>" . $ex->getMessage());
            
        }
    }
    
    public function mostrarSolicitudesReceptor($receptor){
        $rows = null;
        $stm = "SELECT * FROM tesis.solicitudes_requerimientos WHERE receptor = :receptor";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":receptor", $receptor);
            $sql->execute();
            while ($result = $sql->fetch()) {
                
                    $rows[] = $result;
                
                
            }
            return $rows;
            
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al mostrar las solicitudes</div>" . $ex->getMessage());
            
        }
    }
    
    public function saveFile($fechaRespuesta, $nombreArchivo, $idSolicitud) {
        $stm = "UPDATE tesis.solicitudes_requerimientos SET fecha_respuesta=:fecha_respuesta, nombre_archivo=:nombre_archivo WHERE id_solicitud = :id_solicitud";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":fecha_respuesta", $fechaRespuesta);
            $sql->bindParam(":nombre_archivo", $nombreArchivo);
            $sql->bindParam(":id_solicitud", $idSolicitud);
            $sql->execute();
            
            return true;
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error en los datos del requerimiento</div>" . $ex->getMessage());
        }
        
    }
    
    public function deleteUsuario($idUser, $email) {
        $stm = "DELETE FROM tesis.usuarios where id_user = :id_user";
        $stm2 = "SELECT email FROM tesis.maestros WHERE email = :email";
        $stm3 = "DELETE FROM tesis.maestros WHERE email = :email";
        $stm4 = "SELECT email FROM tesis.administradores WHERE email = :email";
        $stm5 = "DELETE FROM tesis.administradores WHERE email = :email";
        try {
            $sql = MySQL::getConexion()->prepare($stm);
            $sql->bindParam(":id_user", $idUser);
            $sql ->execute();
            
            $sql2 = MySQL::getConexion()->prepare($stm2); 
            $sql2 ->bindParam(":email", $email);
            $sql2 ->execute();
            $rows = $sql2->fetch();
            

            if ($rows > 0) {
                $emailM = $rows['email'];
                if ($emailM){
                    $sql3 = MySQL::getConexion()->prepare($stm3);
                    $sql3->bindParam(":email", $emailM);
                    $sql3->execute();
                    
                    return true;
                } else {
                    $sql4 = MySQL::getConexion()->prepare($stm4);
                    $sql4->bindParam(":email", $email);
                    $sql4->execute();
                    $rowsb = $sql4->fetch();
                    if($rowsb >0) {
                        $emailA= $rowsb['email'];
                        
                        if($emailA) {
                            $sql5 = MySQL::getConexion()->prepare($stm5);
                            $sql5->bindParam(":email", $email);
                            $sql5->execute();
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }

                
            } else {
                return false;
            }
            
            
            
            
            
            //echo "error";
            
            return true;
            
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al eliminar al usuario</div>". $ex->getMessage());
        }
        
        
    }
    
    public function activacion($idUser, $idCuenta) {
        
        $stm = "UPDATE tesis.usuarios SET activacion = '1' WHERE id_user = :id_user";
        $stm2 = "SELECT activacion FROM tesis.usuarios WHERE id_user = :id_user AND token_user = :token_user";
        try {
            
            $sql = MySQL::getConexion()->prepare($stm2);
            $sql->bindParam(":id_user", $idUser);
            $sql ->bindParam(":token_user", $idCuenta);
            $sql ->execute();
            $rows = $sql ->fetch();
            
            if ($rows['activacion'] == 0) {
                $sql2 = MySQL::getConexion()->prepare($stm);
                $sql2->bindParam(":id_user", $idUser);
                $sql2->execute();
                return true;
            } elseif ($rows['activacion'] == 1) {
                return die("<div class='alert alert-warning'><strong>Error!</strong> El usuario ya esta activado</div>");
            } else {

                return false;
            }
        } catch (Exception $ex) {
            return die("<div class='alert alert-danger'><strong>Error!</strong> Error al activar al usuario</div>". $ex->getMessage());
        }
        
    }

}
