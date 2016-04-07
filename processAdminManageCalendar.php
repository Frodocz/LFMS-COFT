<?php
session_start();

include_once('connect.php');

$type = $_GET['type'];
$action = $_GET['action'];
$booking_id = $_GET['id'];

$query_info = "SELECT fl.facility_name, ul.username, ul.title, ul.name, ul.addressline1, ul.addressline2, ul.postal, bl.starttime, bl.endtime, bl.fee
                  FROM booking_list bl
                  INNER JOIN facility_list fl ON fl.facility_id = bl.facility_id
                  INNER JOIN normal_user ul ON ul.user_id = bl.user_id
                  WHERE bl.booking_id = $booking_id";

$result_info = $db->query($query_info);
$row = $result_info->fetch_assoc();
$toName = $row['title'].' '.$row['name'];
$toEmail = $row['username'];
$facility_name = $row['facility_name'];
$starttime = date('M d Y, H:i', $row['starttime']);
$endtime = date('H:i', $row['endtime']);
$fee = $row['fee'];

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

switch ($type) {
    case 'book':
        if ($action == "approve") {
            $query = "UPDATE booking_list SET approved=1,color='#378006' WHERE booking_id=$booking_id";
            $result = $db->query($query);
            if ($result) {
                $mail->Subject = 'Your booking has been approved!';
                $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m glad to inform you that your booking request is approved.<br>
                              The information below shows your booking details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br>
                              Total: '.$fee.'<br><br>
                              COFT@NTU';
                $mail->send();
            }
            header("Location: adminManageCalendar.php#booking");
        } else if ($action=="reject") {
            $query = "DELETE FROM booking_list WHERE booking_id=$booking_id";
            $result = $db->query($query);
            if ($result){
                $mail->Subject = 'Your booking has been rejected!';
                $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your booking request is rejected.<br>
                              You don\'t have the facility access permission to this facility. Please choose "Visiting" as your first booking type of the facility. <br>
                              The information below shows your booking details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br>
                              Total: '.$fee.'<br><br>
                              COFT@NTU';
                $mail->send();
            }
            header("Location: adminManageCalendar.php#booking");
        } else if ($action="cancel") {
            $query = "DELETE FROM booking_list WHERE booking_id=$booking_id";
            $result = $db->query($query);
            if ($result){
                $mail->Subject = 'Your booking has been cancelled!';
                $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your booking request is cancelled.<br>
                              This facility is currently not avaliable. Please refer to the notification field for updates. <br>
                              The information below shows your booking details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br>
                              Total: '.$fee.'<br><br>
                              COFT@NTU';
                $mail->send();
            }
            header("Location: adminManageCalendar.php#app_booking");
        }
        break;
    case 'visit':
        if ($action == "approve") {
            $query = "UPDATE booking_list SET approved=1,color='#115599' WHERE booking_id=$booking_id";
            $result = $db->query($query);
            if ($result) {
                $mail->Subject = 'Your visiting has been approved!';
                $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m glad to inform you that your visiting request is approved.<br>
                              The information below shows your visiting details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br><br>
                              COFT@NTU';
                $mail->send();
            }
            header("Location: adminManageCalendar.php#visiting");
        } else if ($action=="reject") {
            $query = "DELETE FROM booking_list WHERE booking_id=$booking_id";
            $result = $db->query($query);
            if ($result) {
                $mail->Subject = 'Your visiting has been rejected!';
                $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your visiting request is rejected.<br>
                              You already have the facility access permission to this facility. Please choose "Booking" as your first booking type of the facility. 
                              The information below shows your visiting details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br><br>
                              COFT@NTU';
                $mail->send();
            }
            header("Location: adminManageCalendar.php#visiting");
        } else if ($action="cancel"){
            $query = "DELETE FROM booking_list WHERE booking_id=$booking_id";
            $result = $db->query($query);
            if ($result){
                $mail->Subject = 'Your visiting has been cancelled!';
                $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your visiting request is cancelled.<br>
                              This facility is currently not avaliable. Please refer to the notification field for updates. <br>
                              The information below shows your visiting details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br><br>
                              COFT@NTU';
                $mail->send();
            }
            header("Location: adminManageCalendar.php#app_visiting");
        }
        break;
    case 'bill':
        $query = "UPDATE booking_list SET billed=1 WHERE booking_id=$booking_id";
        $result = $db->query($query);
        if ($result) {
            $mail->Subject = 'Bill for Facility Usage On '.$starttime;
            $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! 
                              Your most recent invoice is attached. Please review and complete the payment by the end of this month.<br>
                              Recipient: '.$toName.'<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br>
                              Due Date: '.date('M t, Y').'<br>
                              COFT@NTU';
            $mail->AddAttachment('Invoices/invoice_25.pdf');
            $mail->send();
        }
        header("Location: adminManageCalendar.php#bill_booking");
        break;
}
?>