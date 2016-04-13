<?php
session_start();

include_once('connect.php');

$type = $_GET['type'];
$action = $_GET['action'];
$booking_id = $_GET['id'];

$query_info = "SELECT *
               FROM booking_list bl
               INNER JOIN facility_list fl ON fl.facility_id = bl.facility_id
               INNER JOIN normal_user ul ON ul.user_id = bl.user_id
               WHERE bl.booking_id = $booking_id";
$result_info = $db->query($query_info);
if(!$result_info){
   echo '<script type="text/javascript">alert("Your query to retrieve billing information failed.");</script>';
   exit;
}
$row = $result_info->fetch_assoc();
$toName = $row['title'].' '.$row['name'];
$toEmail = $row['username'];
$facility_name = $row['facility_name'];
$bookdate = date('d-M-Y', $row['starttime']);
$starttime = date('Y-m-d H:i', $row['starttime']);
$endtime = date('H:i', $row['endtime']);
$fee = $row['fee'];

$usertype = $row['faculty'];
$addline1 = $row['addressline1'];
$addline2 = $row['addressline2'];
$postal = $row['postal'];
$phone = $row['phone'];
$billtime = date('d-M-Y');

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
            $mail->Subject = 'Your booking has been approved!';
            $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m glad to inform you that your booking request is approved.<br>
                              The information below shows your booking details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br>
                              Total: '.$fee.'<br><br>
                              COFT@NTU';
            if ($mail->send()){
              $query = "UPDATE booking_list SET approved=1,color='#378006' WHERE booking_id=$booking_id";
              $result = $db->query($query);
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
                $mail->Subject = 'Your visiting has been approved!';
                $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m glad to inform you that your visiting request is approved.<br>
                              The information below shows your visiting details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br><br>
                              COFT@NTU';
                if ($mail->send()){
                  $query = "UPDATE booking_list SET approved=1,color='#115599' WHERE booking_id=$booking_id";
                  $result = $db->query($query);
                }
            header("Location: adminManageCalendar.php#visiting");
        } else if ($action=="reject") {
                $mail->Subject = 'Your visiting has been rejected!';
                $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your visiting request is rejected.<br>
                              You already have the facility access permission to this facility. Please choose "Booking" as your first booking type of the facility. 
                              The information below shows your visiting details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br><br>
                              COFT@NTU';
                if ($mail->send()){
                  $query = "DELETE FROM booking_list WHERE booking_id=$booking_id";
                  $result = $db->query($query);
                }
            header("Location: adminManageCalendar.php#visiting");
        } else if ($action="cancel"){
            $mail->Subject = 'Your visiting has been cancelled!';
            $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! I\'m sorry to inform you that your visiting request is cancelled.<br>
                              This facility is currently not avaliable. Please refer to the notification field for updates. <br>
                              The information below shows your visiting details:<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br><br>
                              COFT@NTU';
            if ($mail->send()){
              $query = "DELETE FROM booking_list WHERE booking_id=$booking_id";
              $result = $db->query($query);
            }
            header("Location: adminManageCalendar.php#app_visiting");
        }
        break;
    case 'bill':
        //////////////////////////////////////////////

        //Generate the invoice from template pdf file

        /////////////////////////////////////////////

        require_once('Tools/fpdf/fpdf.php');
        require_once('Tools/fpdi/fpdi.php');

        $pdf = new FPDI();

        $pageCount = $pdf->setSourceFile("Invoices/template.pdf");
        $tplIdx = $pdf->importPage(1, '/MediaBox');

        $pdf->addPage();
        $pdf->useTemplate($tplIdx);

        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(12);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetXY(165, 42);
        $pdf->Write(5, $booking_id);

        $pdf->SetXY(25, 50);
        $pdf->Write(5, $billtime);

        $pdf->SetXY(25, 70);
        $pdf->Write(5, $toName.' ('.$usertype.')');
        $pdf->SetXY(25, 75);
        $pdf->Write(5, $addline1);
        $pdf->SetXY(25, 80);
        $pdf->Write(5, $addline2);
        $pdf->SetXY(25, 85);
        $pdf->Write(5, $postal);

        // First table
        // First row header
        $pdf->SetFont('Helvetica','B',12);
        $pdf->SetXY(25, 130);
        $pdf->SetFillColor(234, 234, 234);
        $pdf->Cell(40, 6, 'Bill Date',1,0,"C",TRUE);
        $pdf->Cell(40, 6, 'Customer Name',1,0,"C",TRUE);
        $pdf->Cell(40, 6, 'Customer Contact',1,0,"C",TRUE);
        $pdf->Cell(40, 6, 'Booking Request #',1,0,"C",TRUE);

        // Second row data
        $pdf->SetXY(25, 136);
        $pdf->SetFont('Helvetica');
        $pdf->Cell(40, 6, date("d\-M\-Y"),1,0,"C",FALSE);
        $pdf->Cell(40, 6, $toName,1,0,"C",FALSE);
        $pdf->Cell(40, 6, $phone,1,0,"C",FALSE);
        $pdf->Cell(40, 6, $booking_id ,1,0,"C",FALSE);

        //Second table
        //First row header
        $pdf->SetXY(25, 150);
        $pdf->SetFont('Helvetica','B',12);
        $pdf->SetFillColor(234, 234, 234);
        $pdf->Cell(70, 6, 'Facility Name',1,0,"C",TRUE);
        $pdf->Cell(30, 6, 'Booking Date',1,0,"C",TRUE);
        $pdf->Cell(25, 6, 'Start Time',1,0,"C",TRUE);
        $pdf->Cell(25, 6, 'End Time',1,0,"C",TRUE);
        $pdf->Cell(30, 6, 'Total',1,0,"C",TRUE);

        $pdf->SetXY(25, 156);
        $pdf->SetFont('Helvetica');
        $pdf->Cell(70, 6, $facility_name,1,0,"C",FALSE);
        $pdf->Cell(30, 6, $bookdate,1,0,"C",FALSE);
        $pdf->Cell(25, 6, date('H:i', $starttime),1,0,"C",FALSE);
        $pdf->Cell(25, 6, $endtime,1,0,"C",FALSE);
        $pdf->Cell(30, 6, '$'.number_format($fee,2),1,0,"C",FALSE);

        $pdf->SetXY(25, 166);
        $pdf->Write(5, 'Please proceed to NTU Shared Services (NSS) for the payment by '.date('M t, Y').'.');

        $pdf->Output('Invoices/invoice_'.$booking_id.'.pdf', 'F');
        $mail->Subject = 'Bill for Facility Usage On '.$starttime;
        $mail->Body    = 'Dear '.$toName.', <br> 
                              Thank you for using the COFT Facility Booking System! 
                              Your most recent invoice is attached. Please proceed to NTU Shared Services (NSS) for the payment process by the end of this month.<br>
                              Recipient: '.$toName.'<br>
                              Time: '.$starttime.' - '.$endtime.'<br>
                              Facility Name: '.$facility_name.'<br>
                              Due Date: '.date('M t, Y').'<br>
                              COFT@NTU';
        $mail->AddAttachment('Invoices/invoice_'.$booking_id.'.pdf');
        if ($mail->send()){
          $query = "UPDATE booking_list SET billed=1 WHERE booking_id=$booking_id";
          $result = $db->query($query);
        }
        header("Location: adminManageCalendar.php#bill_booking");
        break;
}
?>