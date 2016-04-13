<?php
//processInvoice.php
session_start();

$booking_id = $_GET['booking_id'];

include('connect.php');

$query_bill = "SELECT * FROM booking_list bl
               INNER JOIN normal_user nu
               INNER JOIN facility_list fl
               ON bl.user_id=nu.user_id AND bl.facility_id=fl.facility_id AND bl.booking_id=".$booking_id; 
//Take the first selected booking and retrieve the billing person info
$result_bill = $db->query($query_bill);
$row_bill = $result_bill->fetch_assoc();

$name = $row_bill['name'];
$usertype = $row_bill['faculty'];
$addline1 = $row_bill['addressline1'];
$addline2 = $row_bill['addressline2'];
$postal = $row_bill['postal'];
$phone = $row_bill['phone'];
$billtime = date('d-M-Y');

$facility_name = $row_bill['facility_name'];

$fee = $row_bill['fee'];
$bookingdate = date('Y-m-d',$row_bill['starttime']);
$starttime = date('H:i',$row_bill['starttime']);
$endtime = date('H:i',$row_bill['endtime']);

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
$pdf->Cell(40, 6, $name,1,0,"C",FALSE);
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
$pdf->Cell(30, 6, $bookingdate,1,0,"C",FALSE);
$pdf->Cell(25, 6, $starttime,1,0,"C",FALSE);
$pdf->Cell(25, 6, $endtime,1,0,"C",FALSE);
$pdf->Cell(30, 6, '$'.number_format($fee,2),1,0,"C",FALSE);

$pdf->Output('Invoices/invoice_'.$booking_id.'.pdf', 'F');

////////////////////////////////////////////
//Send email to the user with attachment //
///////////////////////////////////////////

// $htmlbody = "$content";

// //define the receiver of the email 
// $to = $row_bill['email'];

// //define the subject of the email 
// $subject = 'Work Request Form from Centre for Optical Fibre Technology'; 

// //create a boundary string. It must be unique 
// //so we use the MD5 algorithm to generate a random hash 
// $random_hash = md5(date('r', time())); 

// //define the headers we want passed. Note that they are separated with \r\n 
// $headers = "From: Centre for Optical Fibre Technology";

// //add boundary string and mime type specification 
// $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 

// //read the atachment file contents into a string,
// //encode it with MIME base64,
// //and split it into smaller chunks
// $attachment = chunk_split(base64_encode(file_get_contents('attachment/invoice_'.$wr_id.'.pdf'))); 

// //define the body of the message.
// $message = "--PHP-mixed-$random_hash\r\n"."Content-Type: multipart/alternative; boundary=\"PHP-alt-$random_hash\"\r\n\r\n";
// $message .= "--PHP-alt-$random_hash\r\n"."Content-Type: text/plain; charset=\"iso-8859-1\"\r\n"."Content-Transfer-Encoding: 7bit\r\n\r\n";


// //Insert the html message.
// $message .= $htmlbody;
// $message .="\r\n\r\n--PHP-alt-$random_hash--\r\n\r\n";

// //include attachment
// $message .= "--PHP-mixed-$random_hash\r\n"
// ."Content-Type: application/zip; name=\"invoice_$wr_id.pdf\"\r\n"
// ."Content-Transfer-Encoding: base64\r\n"
// ."Content-Disposition: attachment\r\n\r\n";
// $message .= $attachment;
// $message .= "/r/n--PHP-mixed-$random_hash--";

// //send the email
// $mail = mail( $to, $subject , $message, $headers);

// if(!$mail){
//     $query_fail = "DELETE FROM work_request_form WHERE wr_id = $wr_id";
//     $db_conn->query($query_fail);
//     header("Location: orderHistory.php?emailFail=1");
//     $db_conn->close();
//     exit;

// }else{
//     for($j=0; $j < $number_selected; $j++){
//         $query_update = "UPDATE booking SET billed = 1 WHERE booking_id = $selected_booking[$j]";
//         $result_update = $db_conn->query($query_update);
//         if(!$result_update){
//                echo '<script type="text/javascript">alert("Your query to update booking information failed.");</script>';
//                exit;
//         }
//     }
// }

// $db->close();
// header("Location: orderHistory.php"); 
?>
