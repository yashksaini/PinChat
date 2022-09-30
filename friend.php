<?php 
session_start();
include('config.php'); 

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$sql = "SELECT * FROM users WHERE username='$username' && password='$password'";
$re = mysqli_query($con,$sql);
$number = mysqli_num_rows($re);

if($number!=1)
{
  header('location:index.php');
}
	$rs = $con->query($sql);
  	$row = $rs->fetch_assoc();
  	$full_name_i = $row["first_name"]." ".$row["last_name"];
  	$f_name_i = $row["first_name"];


  	$sql1 = "SELECT * FROM profile WHERE username='$username' ";
	$re1 = mysqli_query($con,$sql1);
	$rs1 = $con->query($sql1);
	$rows = $rs1->fetch_assoc();
	$imagei = $rows["image"];

?>

<?php 
if(isset($_POST['s_username']))
{
	$s_username = $_POST['s_username'];
	$check = "SELECT * FROM friends WHERE user_send='$username'&& user_rec='$s_username' && send_status='true' && rec_status='false'";
	$result = mysqli_query($con,$check);

	$nu = mysqli_num_rows($result);

	if($nu>0)
	{
		echo "<script>alert('Request already sent');</script>";
	}
	else
	{

		$check1 = "SELECT * FROM friends WHERE (user_send='$username'&& user_rec='$s_username')||(user_send='$s_username'&& user_rec='$username') && send_status='false' && rec_status='false'";
	$result1 = mysqli_query($con,$check1);
	$row=$result1->fetch_assoc();
	$fr_id = $row["ID"];

	$nu1 = mysqli_num_rows($result1);
	if($nu1==1)
	{
		$reg = "UPDATE  friends SET send_status='true',user_send='$username',user_rec='$s_username' WHERE ID='$fr_id'";
	mysqli_query($con,$reg);
	}
	else
	{
	$reg = "INSERT INTO friends(user_send,user_rec,send_status,rec_status) VALUES
	('$username','$s_username','true','false') ";
	mysqli_query($con,$reg);
	echo "<script>alert('Request sent Successfully');</script>";
}
	}
}
?>
<?php if(isset($_POST["accept"]))
{
	$reg = "UPDATE  friends SET rec_status='true' WHERE user_rec='$username'";
	mysqli_query($con,$reg);


	echo "<script>alert('Request accepted Successfully');</script>";
}
?>
<?php if(isset($_POST["withdraw"]))
{
	$reg = "UPDATE  friends SET send_status='false' WHERE user_send='$username'";
	mysqli_query($con,$reg);


	echo "<script>alert('Request Withdraw Successfully');</script>";
}
?>

<!-- HTML Start -->
<?php echo "$html_start";?>
<style type="text/css">
	.block
	{
		margin-left: 20px;
		margin-right: 20px;
		border-radius: 5px;
		background-color: #f6f6f6;
		color: black;
		padding: 10px;
	}
	.block:hover
	{
		background-color: #E9E9E9;
		border-bottom-left-radius: 0px;
		color: black;
	}
	.i_image
	{
		width: 80px;
		height: 80px;
		border-radius: 100px;
		box-shadow: 0 0 2px;
	}
	.badge
	{
		border-radius: 50px;
	}
</style>
<body>
<!-- Menu Bar -->


<?php  echo"$menu_bar";?>

<style type="text/css">
	#color2
	{
		background-color:#27AD5D ;
		color:white;
	}
</style>


<div class="container-fluid" >
	<div class="row">
		<div class="col-sm-3"></div>
			<div class="col-sm-6 mb-3 mt-5">
				<form method="post">
					<div class="input-group ">
						<button type="submit" class="btn btn-primary" style="padding: 15px;border-radius: 50px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"><i class="fas fa-search"></i></button>
  					<input type="text" name="name" placeholder="Search Friend Here..." class="form-control bg-light" style="padding: 15px;" aria-label="Text input with segmented dropdown button" required>

	  					<div class="input-group-prepend">
	    				<button type="submit" class="btn btn-primary" style="padding: 15px;border-radius: 50px;border-top-left-radius: 0px;border-bottom-left-radius: 0px;">Search</button>
	  					</div>
					</div>
				</form>
			</div>
	</div>
</div>

<div class="container mb-4" style="box-shadow: 0 0 2px ;">
	<?php 
		if(isset($_POST['name']))
		{
			$name = $_POST['name'];
			$search = "SELECT * FROM profile WHERE locate('$name',username)>0  || locate('$name',full_name)>0";

			$r_search = mysqli_query($con,$search);
			$numb = mysqli_num_rows($r_search);

if($numb>0)
{
 while($row = $r_search->fetch_assoc()) 
 {
 	$username1 = $row['username'];
 	$image = $row['image'];
 	$full_name = $row['first_name']." ".$row['last_name'];

 	if($username!= $username1 )
 	{
 	echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<img src='images/$image' class='i_image'>
				<div>
					<h5 style='margin-left: 10px;margin-right: 10px;'>$full_name</h5><br>
					<p  style='margin-left: 10px;margin-right: 10px;'>$username1</p>
				</div>
				<form method='post'>
				<input type='text' name='p_username' value='$username1' style='display:none'>
				<button class='btn btn-outline-info' style='border-radius: 50px;color: black;margin-left: 10px;margin-right: 10px;'>Profile</button>
				</form>
		</div>
		<div class='col-sm-3'></div>
	</div>";
		}
	}
 }

		else
		{
			echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<h5> No Matches found for the search.. ' $name ' </h5>
		</div>
		<div class='col-sm-3'></div>
	</div>";
		}
}
	?>
<?php
if(isset($_POST['p_username']))
{
	$p_username = $_POST['p_username'];
	$getreq = "SELECT * FROM friends WHERE(user_send = '$p_username' || user_rec='$p_username' )&&send_status='true'&&rec_status='true' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);
  	$numb_req = mysqli_num_rows($req_res);

  	$swl = "SELECT * FROM posts WHERE username='$p_username'";
		$swl_res = mysqli_query($con,$swl);
		$swl_count = mysqli_num_rows($swl_res);

	$sqli = "SELECT * FROM profile WHERE username='$p_username'";
	$profile = mysqli_query($con,$sqli);
	$row = $profile->fetch_assoc();

	$p_full_name = $row["full_name"];
	$p_username = $row["username"];
	$p_image = $row["image"];
	$p_bio = $row["bio"];

	$sql = "SELECT * FROM friends WHERE ((user_send='$username'&& user_rec='$p_username')||(user_send='$p_username'&& user_rec='$username'))&&send_status='true'&&rec_status='true'";
	$rest = mysqli_query($con,$sql);
	$number = mysqli_num_rows($rest);

	echo "<div class='row' data-aos='fade-down'>
		<div class='col-sm-6 ' style='text-align: center;'>
			<img src='images/$p_image' class='img-fluid ' style='width: 250px; height: 250px;box-shadow: 0 0 5px grey; 	border-radius: 250px;
		margin-top: 10px;' ><br>
			<hr>
		</div>
		<div class='col-sm-6' style='text-align: center; padding: 15px;'>
			<h1><b>$p_username</b></h1>
			<div class='d-flex justify-content-center align-items-center'>
				<a class='block' href='#'><span style='font-size: 20px'>$swl_count</span> posts</a>
				<a class='block' href='#'><span style='font-size: 20px'>$numb_req</span> friends</a>";
	if($number!=1)
	{
		$sql5 = "SELECT * FROM friends WHERE user_send='$username'&& user_rec='$p_username'&&send_status='true'&&rec_status='false'";
		$rest5 = mysqli_query($con,$sql5);
		$number5 = mysqli_num_rows($rest5);

		if($number5==1)
		{
			echo "<form method='post'>
				<input type='text' name='withdraw' value='1' style='display:none'>
			<button type='submit' class='btn btn-secondary' >Withdraw Request</button>
			</form>";
		}
		else
		{
			$sql2 = "SELECT * FROM friends WHERE user_send='$p_username'&& user_rec='$username'&&send_status='true'&&rec_status='false'";
			$rest3 = mysqli_query($con,$sql2);
			$number3 = mysqli_num_rows($rest3);

			if($number3==1)
			{
				echo "<form method='post'>
				<input type='text' name='accept' value='1' style='display:none'>
				<button type='submit' class='btn btn-primary' >Accept</button>
				</form>";
			}
			else
			{
				echo "<form method='post'>
				<input type='text' name='s_username' value='$p_username' style='display:none'>
				<button type='submit' class='btn btn-primary' >Send Request</button>
				</form>";
			}
		}
	}
	echo "</div><br>
			<h3 style='text-align: left;'><b>$p_full_name<b></b></h3><br>
			<h6 style='text-align: left;'>$p_bio</h6>
		</div>
	</div>";
}

 ?>
</div>
<div class="container mb-5" style="box-shadow: 0 0 2px;padding: 15px;border-radius: 5px;text-align: center;">
	<div class="row">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="friends-tab" data-bs-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="true">Friends <span class="badge bg-primary" style="padding: 2px;position: absolute;font-size: 10px;"><?php 

  	$getreq = "SELECT * FROM friends WHERE(user_send = '$username' || user_rec='$username' )&&send_status='true'&&rec_status='true' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);
  	echo"$numb_req";?></span></a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="requests-tab" data-bs-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false">Requests <span class="badge bg-primary" style="padding: 2px;position: absolute;font-size: 10px;"><?php 

  	$getreq = "SELECT * FROM friends WHERE user_rec = '$username'&&rec_status='false'&&send_status='true' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);
  	echo"$numb_req";?></span></a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="send-tab" data-bs-toggle="tab" href="#send" role="tab" aria-controls="send" aria-selected="false">Sent <span class="badge bg-primary" style="padding: 2px;position: absolute;font-size: 10px;"><?php 

  	$getreq = "SELECT * FROM friends WHERE user_send = '$username'&&send_status='true'&&rec_status='false' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);
  	echo"$numb_req";?></span></a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="friends" role="tabpanel" aria-labelledby="friends-tab">

  	
  	<?php 

  	$getreq = "SELECT * FROM friends WHERE (user_send = '$username' || user_rec='$username' )&&send_status='true'&&rec_status='true' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);
if($numb_req>0)
{
  	while($row_req = $req_res->fetch_assoc()) 
 {
 	$user_send = $row_req["user_send"];
 	if($user_send==$username){
 	$user_send = $row_req["user_rec"];
 }

 	$get = "SELECT * FROM profile WHERE username='$user_send'";
 	$req_get = mysqli_query($con,$get);
 	$show = $req_get->fetch_assoc();

 	$req_image = $show["image"];
 	$req_username = $show["username"];
 	$req_full_name = $show["full_name"];

 	echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<img src='images/$req_image' class='i_image'>
				<div>
					<h5 style='margin-left: 10px;margin-right: 10px;'>$req_full_name</h5><br>
					<p  style='margin-left: 10px;margin-right: 10px;'>$req_username</p>
				</div>
				<form action='friend_profile.php' method='post'>
				<input type='text' name='f_username' value='$req_username' style='display:none'>
				<button class='btn btn-outline-info mt-2' style='border-radius: 50px;color:black;margin-left: 10px;margin-right: 10px;'>Profile</button>
				</form>
				
		</div>
		<div class='col-sm-3'></div>
	</div>";
 }
}
else
{
	echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<h5 style='text-align:center'>No Friends </h5>
		</div>
		<div class='col-sm-3'></div>
	</div>";
}


  	?>

  </div>
  <div class="tab-pane fade" id="requests" role="tabpanel" aria-labelledby="requests-tab">
  	
  	<?php 

  	$getreq = "SELECT * FROM friends WHERE user_rec = '$username'&&rec_status='false'&&send_status='true' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);

if($numb_req>0)
{
 while($row_req = $req_res->fetch_assoc()) 
 {
 	$user_send = $row_req["user_send"];

 	$get = "SELECT * FROM profile WHERE username='$user_send'";
 	$req_get = mysqli_query($con,$get);
 	$show = $req_get->fetch_assoc();

 	$req_image = $show["image"];
 	$req_username = $show["username"];
 	$req_full_name = $show["full_name"];

 	echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<img src='images/$req_image' class='i_image'>
				<div>
					<h5 style='margin-left: 10px;margin-right: 10px;'>$req_full_name</h5><br>
					<p  style='margin-left: 10px;margin-right: 10px;'>$req_username</p>
				</div>
				<form method='post'>
				<input type='text' name='p_username' value='$req_username' style='display:none'>
				<button class='btn btn-outline-primary mt-2' style='border-radius: 50px;margin-left: 10px;margin-right: 10px;'>Profile</button>
				</form>
		</div>
		<div class='col-sm-3'></div>
	</div>";
 }
}
else
{
	echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<h5 style='text-align:center'>No Requests </h5>
		</div>
		<div class='col-sm-3'></div>
	</div>";
}


  	?>
  	

  </div>
  <div class="tab-pane fade" id="send" role="tabpanel" aria-labelledby="send-tab">
  	<?php 

  	$getreq = "SELECT * FROM friends WHERE user_send = '$username'&&send_status='true'&&rec_status='false' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);
if($numb_req>0)
{
  	while($row_req = $req_res->fetch_assoc()) 
 {
 	$user_send = $row_req["user_rec"];

 	$get = "SELECT * FROM profile WHERE username='$user_send'";
 	$req_get = mysqli_query($con,$get);
 	$show = $req_get->fetch_assoc();

 	$req_image = $show["image"];
 	$req_username = $show["username"];
 	$req_full_name = $show["full_name"];

 	echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<img src='images/$req_image' class='i_image'>
				<div>
					<h5 style='margin-left: 10px;margin-right: 10px;'>$req_full_name</h5><br>
					<p  style='margin-left: 10px;margin-right: 10px;'>$req_username</p>
				</div>
				<form method='post'>
				<input type='text' name='p_username' value='$req_username' style='display:none'>
				<button class='btn btn-outline-primary mt-2' style='border-radius: 50px;margin-left: 10px;margin-right: 10px;'>Profile</button>
				</form>
		</div>
		<div class='col-sm-3'></div>
	</div>";
 }
}
else
{
	echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<h5 style='text-align:center'>No Sent Requests </h5>
		</div>
		<div class='col-sm-3'></div>
	</div>";
}


  	?>
  </div>
</div>
	</div>

</div>
<script type="text/javascript">
	document.getElementById('profile_photo').innerHTML = "<?php echo "<img src='images/$imagei' style='width:30px;height:30px;border-radius:30px;'> $f_name_i" ?>";
	document.getElementById('profile_photo1').innerHTML = "<?php echo "<img src='images/$imagei' style='width:30px;height:30px;border-radius:30px;'> $f_name_i" ?>";
</script>
<script type="text/javascript">
	document.getElementById('chat_count').innerHTML = "<?php 
	$sql_chat_count1 = "SELECT * FROM chats WHERE rec_username='$username' && rec_status='false'";
 	$chat_count_res1 = mysqli_query($con,$sql_chat_count1);
 	$num_rows_chat1 = mysqli_num_rows($chat_count_res1);

 	if($num_rows_chat1>0){
 	 	echo"$num_rows_chat1";}
 	?>";
 	document.getElementById('chat_count1').innerHTML = "<?php 
	$sql_chat_count1 = "SELECT * FROM chats WHERE rec_username='$username' && rec_status='false'";
 	$chat_count_res1 = mysqli_query($con,$sql_chat_count1);
 	$num_rows_chat1 = mysqli_num_rows($chat_count_res1);

 	if($num_rows_chat1>0){
 	 	echo"$num_rows_chat1";}
 	?>";
</script>
<?php echo "$html_end";?>