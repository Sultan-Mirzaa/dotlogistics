<?php
require_once "connect.php";
session_start();
if(empty($_SESSION['email']))
{
    header('location: login.php');
}

$query = "SELECT * FROM enquiry order by enq_id desc ";
$res = mysqli_query($con, $query);
// print_r();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Enquiry Form Data</title>
  <link rel="icon" href="images/favicon-dot.png" type="image/gif" style="width:100%">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
  </script>
  <style>
      @media (max-width:991.98px){
          .resp-table{
              overflow:scroll;
          }
      }
  </style>
</head>
<body>

<div class="container-fluid my-5">
    
  <h2>Welcome to Dot Logistics Dashboard <a style="float:right;font-size:16px;" class="btn btn-warning btn-sm" href="logout.php">Logout</a></h2>
  <p>Enquiry form submitted data</p>
  <div class="table-responsiv resp-table">
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th>Sno.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile Number</th>
          <th>Date of Moving</th>
          <th>Moving From</th>
          <th>Moving To</th>
          <th>Message</th>
          <th>Household Items</th>
          <th>Date of Enquiry</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; while($row = mysqli_fetch_assoc($res)): ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['mobile']; ?></td>
          <td><?php echo $row['movingDate']; ?></td>
          <td><?php echo $row['movingFrom']; ?></td>
          <td><?php echo $row['movingTo']; ?></td>
          <td><?php echo $row['message']; ?></td>
          <td><?php echo $row['household_items']; ?></td>
          <td><?php echo date('Y-m-d', strtotime($row['created_on'])); ?></td>
        </tr>
        <?php $i++; endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
