<?php
 session_start();
 include('config.php'); 

 	$_SESSION['username']=$_POST['username'];
	$_SESSION['password'] = $_POST['password'];

$username = $_SESSION ['username'];
$password = $_SESSION ['password'];

$sql = "SELECT * FROM users WHERE username='$username' && password='$password'";
$re = mysqli_query($con,$sql);
$number = mysqli_num_rows($re);

if($number==1)
{
	header('location:home.php');
}
else
{
	echo "$html_start
    <body>

    <div class='container mt-5'>
      <div class='row'>
        <div class='col-sm-3'>
        </div>
        <div class='col-sm-6'>
          <div class='shadow-lg  mb-1 bg-light rounded' style='font-family: arial;color: white'>
          <div class='card bg-light'>
          <div class='card-body'>
            <h2 class='card-title alert alert-danger' style='text-align: center;'>Error</h2>
            <h6 class='card-subtitle mb-2 alert alert-danger' style='text-align: center;'>Username OR password is incorrect.</h6>
            <a href='index.php'><button class='btn btn-danger float-right'>Go Back</button></a>
            </div>
        </div>
        </div>
        </div>
        <div class='col-sm-3'>
        </div>
      </div>
    </div> $html_end";
}
?>
