<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Domain;
use App\Models\Subdomain;



/** funcion para enviar un correo usando la libreria PHPMAILER*/

if(!function_exists('sendEmail')){
    function sendEmail($mailConfig){
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail-> SMTPDebug = 0;
        $mail-> isSMTP();
        $mail->Host =env('EMAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('EMAIL_USERNAME');
        $mail->Password = env('EMAIL_PASSWORD');
        $mail->Port = env('EMAIL_PORT');
        //$mail->SMTPSecure = env('EMAIL_ENCRYPTION');
        $mail->setFrom($mailConfig['mail_from_email'], $mailConfig['mail_from_name']);
        $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mail_subject'];
        $mail->Body = $mailConfig['mail_body'];
        if($mail->send()){
            return true;
        }else{
            return false;
        }
    }
    // funcion para llamar la imagen del logo
    function logo(){
        return asset('img/logo.png');
    }
}

// funcion para traer el id del dominio por medio del nombre

if(!function_exists('getDomainId')){
    function getDomainId($domainName){
        $domain = Domain::where('domain', $domainName)->first();
        if($domain){
            return $domain->id;
        }else{
            return null;
        }
    }
}

// funcion para traer el id del subdominio por medio del nombre

if(!function_exists('getSubdomainId')){
    function getSubdomainId($subdomainName){
        $subdomain = Subdomain::where('subdomain', $subdomainName)->first();
        if($subdomain){
            return $subdomain->id;
        } else{
            return null;
        }
    }
}