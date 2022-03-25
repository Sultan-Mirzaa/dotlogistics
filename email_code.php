<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once "connect.php";


require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

$name = $_POST['full_name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$movingDate = $_POST['movingDate'];
$movingFrom = $_POST['movingFrom'];
$movingTo = $_POST['movingTo'];
$msg = $_POST['textarea'];

/* Database storing process */


$query = "Insert into enquiry (name,email,mobile,movingDate,movingFrom,movingTo,message) values('$name','$email','$mobile','$movingDate','$movingFrom','$movingTo','$msg')";
$res = mysqli_query($con, $query);

/* Database storing process */


// $mail->Host = 'smtp.gmail.com';
$mail->Host = 'mail.dotlogistics.co.in';
$mail->port= 587;
$mail->SMTPAuth= true;
$mail->SMTPSecure= 'tls';
$mail->Username='contact@dotlogistics.co.in';
$mail->Password='DotLogistic@#3$4';
$mail->SMTPDebug = 1;
$mail->setFrom($email, $name);
$mail->addAddress('dotlogisticshyd@gmail.com');
$mail->addCC('contact@dotlogistics.co.in');
$mail->addCC('amrutha@v3digitals.com');

$body = '
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  overflow:auto;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #eeeeee;
}
</style>
        <table >
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>moving Date</th>
                <th>moving From</th>
                <th>moving To</th>
                <th>Message</th>
            </tr>
            <tr>
                <td>'.$name.'</td>
                <td>'.$email.'</td>
                <td>'.$mobile.'</td>
                <td>'.$movingDate.'</td>
                <td>'.$movingFrom.'</td>
                <td>'.$movingTo.'</td>
                <td>'.$msg.'</td>
            </tr>
        </table>
';

$mail->isHTML(true);
$mail->Subject='Enquiry';
// $mail->Body='<h3>Name : '.$name.'<br>Email : '.$email.'<br>Mobile : '.$mobile.'<br>movingDate : '.$movingDate.'<br>movingFrom : '.$movingFrom.'<br>movingTo : '.$movingTo.'<br>Message : '.$msg.'</h3>';
$mail->Body=$body;

if(!$mail->send())
{
    echo "Somethng went wrong. Please try again. Mailer error: " . $mail->ErrorInfo;
}
else
{
    echo "Enquiry has been sent successfully...";
}



?>