<?php 
session_start();
include('config.php'); 

$firstName = $_POST ['firstName'];
$lastName = $_POST ['lastName'];
$username = $_POST ['username'];
$password = $_POST ['password'];
$full_name = $_POST['firstName']." ".$_POST["lastName"];

	$sql = "SELECT * FROM users WHERE username='$username'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if($num==1)
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
            <h2 class='card-title alert alert-danger' style='text-align: center;'>This Username already taken by someone.</h2>
            <h6 class='card-subtitle mb-2 alert alert-danger' style='text-align: center;'>Try Again with different username</h6>
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
	else
	{
	$reg = "INSERT INTO users(first_name,last_name,username,password) VALUES
	('$firstName','$lastName','$username','$password') ";
	mysqli_query($con,$reg);

  $reg2 = "INSERT INTO profile(username,first_name,last_name,image,full_name) VALUES
  ('$username','$firstName','$lastName','main.jpg','$full_name')";
  mysqli_query($con,$reg2);

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
            <h2 class='card-title alert alert-success' style='text-align: center;'>New account created successfully</h2>
            <h6 class='card-subtitle mb-2 alert alert-success' style='text-align: center;'>Sign Up successfully</h6>
            <a href='index.php'><button class='btn btn-success float-right'>Log In</button></a>
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