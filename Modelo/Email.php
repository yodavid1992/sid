<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author David
 */


class Email {
    
    public function getUrl($idUser, $idCuenta) {
        $url= $_SERVER['SERVER_NAME'].'/TesisFinal/Vista/Activacion.php?id='.$idUser.'&val='.$idCuenta;
        return $url;
    }
    
    public function asuntoActivacion() {
        $asunto = "Activación Cuenta de Acceso";
        return $asunto;
    }
    
    public function cuerpoActivacion($url, $nombre, $email, $password) {
        $cuerpo = "Estimado " . $nombre . "<br>
                    Se le ha enviado este correo para activar su cuenta el en sistema. Por favor ingrese al siguiente link para accesar <br>
                    <br> <a href='$url'> Activar Cuenta </a> <br>
                    Su usuario es: " . $email . " <br>"
                    ."Su contraseña es: ". $password;
        
        return $cuerpo;
    }
    
    public function asuntoSolicitud(){
        $asunto = "Nueva Solicitud de Requerimiento";
        return $asunto;
    }
    
    public function cuerpoSolicitud($nombre, $requerimiento) {
        $cuerpo = "Estimado Profesor ".$nombre."<br>"
                . "A través de este medio le solicito a usted la siguiente solicitud de requerimiento "
                . $requerimiento.".<br>"
                . "El motivo de la solicitud, es para dar seguimiento a las actividades a realizar durante el semestre. <br>"
                . " Por favor, ingrese al sistema para que cargue su evidencia. <br>"
                . "Le agradezco su amable atención y le envío un cordial saludo. <br>"
                . "ATENTAMENTE <br>"
                . "Subdirección Académica.";
        
        return $cuerpo;
    }
    
    public function urlPassword($idUser, $tokenPassword) {
        $url= $_SERVER['SERVER_NAME'].'/TesisFinal/Vista/Password.php?id='.$idUser.'&val='.$tokenPassword;
        return $url;
        
    }
    
    public function asuntoPassword() {
        $asunto = "Recuperación de Contraseña";
        return $asunto;
    }
    
    public function cuerpoPassword($url) {
        $cuerpo = "Estimado usuario.<br>"
                . "Ingrese al siguiente link para cambiar su contraseña y poder accesar al sistema.<br>"
                . "<a href='$url'> Reestablecer Contraseña </a> <br>";
        return $cuerpo;
    }
    

    //put your code here
    public function sendEmail($asunto, $cuerpo, $email, $receptor) {
        require_once '../PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        $mail->Username = 'notificacionessid@gmail.com';
        $mail->Password = 'notificaciones123';

        $mail->setFrom('notificacionessid@gmail.com', 'Sistema de Información Docente');
        $mail->addAddress($email, $receptor);

        $mail->Subject = $asunto; //cambiara, ya sea para activar cuenta o requerimiento
        $mail->Body = $cuerpo;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

}
