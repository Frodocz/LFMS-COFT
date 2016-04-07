<?php
require 'Tools/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'facilitybook.coft.ntu@gmail.com';                 // SMTP username
$mail->Password = '19921226';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('coft.ntu.no-reply@gmail.com', 'COFT@NTU');
$mail->addAddress('frodocz1226@gmail.com', 'Frodo');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Your booking has been cancelled!';
$mail->Body    = 'Dear Mr. Wan Yuan, <br> 
                  Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your booking request is cancelled.<br>
                  The facility you choose is currently unavaliable.<br>
                  The information below shows your booking details being cancelled:<br>
                  Time: 31 Mar 2016, 14:00 - 15:00 <br>
                  Facility Name: Fibre Draw Tower <br><br>
                  COFT@NTU';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>
