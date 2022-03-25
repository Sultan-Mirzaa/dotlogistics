<?php
require_once "connect.php";
session_start();
if(isset($_SESSION['email'])&&!empty($_SESSION['email']))
{
    header('location: dashboard.php');
}
if(isset($_POST['dot_login']))
{
    $email = $_POST['email'];
    $pass = $_POST['pwd'];
    $query = "SELECT * FROM users where email='$email' and password='$pass' ";
    $res = mysqli_query($con, $query);
    $count = mysqli_num_rows($res);
    if($count > 0 || $count != 0)
    {
        $_SESSION['email'] = $email;
        header('location:dashboard.php');
    }
    else
    {
        $msg = 'Email or password is incorrect...';
    }
}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dot Logistics Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="icon" href="images/favicon-dot.png" type="image/gif" style="width:100%">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
    @media(min-width:768px){
        .center{
            width:35% !important;
        }
    }
      .center{
          position:absolute;
          top:50%;
          left:50%;
          transform:translate(-50%, -50%);
          background:#eee;
          padding:15px;
          border:1px solid #ddd;
          border-radius:5px;
          width:90%;
      }
      .centerh3{
          padding:5px 0 25px 0;
      }
  </style>
</head>
<body>

<div class="container">
    <div class="center">
        <h3 class="text-center">Dot Logistics Sign In</h3>
        <?php if(isset($msg)): ?>
        <p class="text-danger"><?php echo $msg; ?></p>
        <?php endif; ?>
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
        </div>
        <input type="submit" class="btn btn-default" name="dot_login" value="Submit">
      </form> 
    </div>
</div>

</body>
</html>
