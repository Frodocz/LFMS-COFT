<?php 
    session_start();
    $email = $_POST['username'];
    include_once('connect.php');

    $query = "SELECT * FROM normal_user WHERE username='$email'";
    $result = $db->query($query);

    if ($result->num_rows>0){
        $row = $result->fetch_assoc();
        $id = $row['user_id'];
        $toEmail = $row['username'];
        $toName = $row['name'];
        $token = $row['password'];

        require 'Tools/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'facilitybook.coft.ntu@gmail.com';                 // SMTP username
        $mail->Password = '19921226';                           // SMTP password
        $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('coft.ntu.no-reply@gmail.com', 'COFT@NTU');
        $mail->addAddress($toEmail, $toName);     // Add a recipient
        $mail->isHTML(true);                      // Set email format to HTML

        $mail->Subject = 'Reset Your COFT Account Password!';
        $mail->Body    = 'Dear '.$toName.', <br> 
                            Thank you for using the COFT Facility Booking System! It seems that you have requested to reset your password. If you confirm to do so, please follow the link below to reset now.<br>
                            http://localhost/fyp/userResetPassword.php?id='.$id.'&token='.$token.'
                            <br><br>
                            COFT@NTU';
        if ($mail->send()){
            header("Location: login.php");
        }
    }
?>