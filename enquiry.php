<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once "connect.php";

require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$movingDate = $_POST['date'];
$movingFrom = $_POST['from'];
$movingTo = $_POST['to'];
$msg = $_POST['Message'];
$other_item = $_POST['items'];
$household_items = implode(', ', $other_item);
if($household_items == '')
{
    $household_items = 'No data';
}

/* Database storing process */

$query = "Insert into enquiry (name,email,mobile,movingDate,movingFrom,movingTo,message,household_items) values('$name','$email','$mobile','$movingDate','$movingFrom','$movingTo','$msg','$household_items')";
$res = mysqli_query($con, $query);

/* Database storing process */

$mail->Host = 'smtp.gmail.com';
// $mail->Host = 'mail.venkatasreenidhiprojects.com';
$mail->port= 587;
$mail->SMTPAuth= true;
$mail->SMTPSecure= 'tls';
$mail->Username='wajid98765@gmail.com';
$mail->Password='wajid1990khan';
$mail->SMTPDebug = 1;
$mail->setFrom($email, $name);
$mail->addAddress('contact@dotlogistics.co.in');
$mail->addCC('dotlogisticshyd@gmail.com');

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
                <th>Household Items</th>
            </tr>
            <tr>
                <td>'.$name.'</td>
                <td>'.$email.'</td>
                <td>'.$mobile.'</td>
                <td>'.$movingDate.'</td>
                <td>'.$movingFrom.'</td>
                <td>'.$movingTo.'</td>
                <td>'.$msg.'</td>
                <td>'.$household_items.'</td>
            </tr>
        </table>
';

$mail->isHTML(true);
$mail->Subject='Enquiry';
// $mail->Body='<h3>Name : '.$name.'<br>Email : '.$email.'<br>Mobile : '.$mobile.'<br>movingDate : '.$movingDate.'<br>movingFrom : '.$movingFrom.'<br>movingTo : '.$movingTo.'<br>Message : '.$msg.'</h3>';
$mail->Body=$body;

if(!$mail->send())
{
    // $msg = "Somethng went wrong. Please try again. Mailer error: " . $mail->ErrorInfo;
    echo '<script>alert("Somethng went wrong. Please try again.")</script>';
    echo '<script>location = "https://dotlogistics.co.in/thankyou.html"</script>';
}
else
{
    echo '<script>alert("Enquiry has been sent successfully...")</script>';
    echo '<script>location = "https://dotlogistics.co.in/thankyou.html"</script>';
}



?>