<?php
session_start();

include_once 'connect.php';

$action = $_GET['action'];
$user_id = $_GET['id'];

switch ($action) {
    case 'approve':
        $query = "UPDATE normal_user SET approved=1,facility_access='' WHERE user_id=$user_id";
        $result = $db->query($query);
        if ($result) {
            $query_user = "SELECT username, title, name FROM normal_user WHERE user_id=$user_id";
            $result_user = $db->query($query_user);
            $row = $result_user->fetch_assoc();
            $toName = $row['title'].' '.$row['name'];
            $toEmail = $row['username'];

            require 'Tools/PHPMailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'facilitybook.coft.ntu@gmail.com';                 // SMTP username
            $mail->Password = '19921226';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('coft.ntu.no-reply@gmail.com', 'COFT@NTU');
            $mail->addAddress($toEmail, $toName);     // Add a recipient
            $mail->isHTML(true);                      // Set email format to HTML
            $mail->Subject = 'Your application has been approved!';
            $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m glad to inform you that your application is approved.<br>
                              You can log in to the system and book facilities now.<br>
                              COFT@NTU';
            $mail->send();
        }
        header("Location: adminManageUser.php");
        break;
    case 'reject': 
        $query = "DELETE FROM normal_user WHERE user_id=$user_id";
        $result = $db->query($query);
        if ($result) {
            $query_user = "SELECT username, title, name FROM normal_user WHERE user_id=$user_id";
            $result_user = $db->query($query_user);
            $row = $result_user->fetch_assoc();
            $toName = $row['title'].' '.$row['name'];
            $toEmail = $row['username'];

            require 'Tools/PHPMailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'facilitybook.coft.ntu@gmail.com';                 // SMTP username
            $mail->Password = '19921226';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('coft.ntu.no-reply@gmail.com', 'COFT@NTU');
            $mail->addAddress($toEmail, $toName);     // Add a recipient
            $mail->isHTML(true);                      // Set email format to HTML
            $mail->Subject = 'Your account access has been permanently removed!';
            $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your account has been permanently removed.<br>
                              You must register again to use the system and book facilities.<br>
                              COFT@NTU';
            $mail->send();
        }
        header("Location: adminManageUser.php");
        break;
    case 'disapprove':
        $query = "UPDATE normal_user SET approved=0,facility_access='' WHERE user_id=$user_id;";
        $result = $db->query($query);
        if ($result){
            $query_user = "SELECT username, title, name FROM normal_user WHERE user_id=$user_id";
            $result_user = $db->query($query_user);
            $row = $result_user->fetch_assoc();
            $toName = $row['title'].' '.$row['name'];
            $toEmail = $row['username'];

            require 'Tools/PHPMailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'facilitybook.coft.ntu@gmail.com';                 // SMTP username
            $mail->Password = '19921226';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('coft.ntu.no-reply@gmail.com', 'COFT@NTU');
            $mail->addAddress($toEmail, $toName);     // Add a recipient
            $mail->isHTML(true);                      // Set email format to HTML
            $mail->Subject = 'Your account access has been temporarily disapproved!';
            $mail->Body    = 'Dear '.$toName.', <br> 
                                  Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your account has been temporarily disapproved.<br>
                                  You must wait for the administrators to approve it again to use the system and book facilities.<br>
                                  COFT@NTU';
            $mail->send();
        }
        header("Location: adminManageUser.php");
        break;
    case 'access':
        $id = $_POST['user_id'];
        $facilities = $_POST['current_access'];

        $approved_access = '';
        $size = sizeof($facilities);
        for ($i=0;$i<$size;$i++){
            $approved_access = $approved_access.$facilities[$i].",";
        }
        //Remove the last "," after the last element
        $approved_access = trim($approved_access,",");
        $query = "UPDATE normal_user SET facility_access='".$approved_access."' WHERE user_id = '".$id."'";
        $result = $db->query($query);
        if ($result){
            echo 1;
        } else {
            echo 0;
        }
}
?>