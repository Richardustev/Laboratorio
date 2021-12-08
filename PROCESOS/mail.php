<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
include 'pdf.php';
include 'datos.php';
require 'update_diagnostico.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


$ssql_mail = "SELECT * FROM datos_paciente WHERE atendido_e = 'desactivado' AND atendido_m = 'atendido';";
$ssql_mail_ejecutar = mysqli_query($mysqli, $ssql_mail) or die('Error: ' . $mysqli_error($mysqli));
$ssql_mail_array = mysqli_fetch_array($ssql_mail_ejecutar);
$correo_paciente = $ssql_mail_array['correo_paciente'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $correo;                     //SMTP username
    $mail->Password   = $password;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('lolcat162@gmail.com', 'Ricardo Araujo');
    $mail->addAddress($correo_paciente);     //Add a recipient

    // //Attachments
    $mail->addStringAttachment($pdfdoc, 'Diagnostico.pdf');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'PDF DIAGNOSTICO';
    $mail->Body    = 'Pdf adjunto: ';

    $mail->send();
    
    $ssql_mail_atendido = "UPDATE datos_paciente SET atendido_m = 'desactivado';";
    $ssql_mail_atendido_ejecutar = mysqli_query($mysqli, $ssql_mail_atendido) or die('Error: ' . $mysqli_error($mysqli));

    if($ssql_mail_atendido){
        echo '<script>alert("Actualizado");
        location.href = "regresar.php";</script>';
    } else {
        echo 'wtf';
    }

    echo 'Message has been sent';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>