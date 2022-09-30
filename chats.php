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
  	$full_name = $row["first_name"]." ".$row["last_name"];
  	$f_name_i = $row["first_name"];

  	$sql1 = "SELECT * FROM profile WHERE username='$username' ";
	$re1 = mysqli_query($con,$sql1);
	$rs1 = $con->query($sql1);
	$rows = $rs1->fetch_assoc();
	$imagei = $rows["image"];

?>


<!-- HTML Start -->
<?php echo "$html_start";?>
<style type="text/css">
	.chat_left
    {
      border-radius:20px;
      min-width:50px;
      max-width:80%; 
      padding: 20px;
      background-color: #4c68d7;
      color:white;
      border-bottom-left-radius: 0px;
      margin-top: 5px;
      text-align: left;
      display: inline-block;
    }
    .chat_right
    {
      border-radius:20px;
      min-width:50px;
      max-width:80%; 
      padding: 20px;
      background-color: #dfdfdf;
      color:black;
      border-bottom-right-radius: 0px;
      margin-top: 5px;
      text-align: right;
      display: inline-block;
    }
    .i_image
	{
		width: 80px;
		height: 80px;
		border-radius: 100px;
		box-shadow: 0 0 2px;
	}
</style>

<body>
<!-- Menu Bar -->
<?php echo"$menu_bar";?>

	<div class="container mt-5 p-3" style="box-shadow: 0 0 2px;border-radius: 5px;background-color: #fafafa">
		<h4><?php 

  	$getreq = "SELECT * FROM friends WHERE(user_send = '$username' || user_rec='$username' )&&send_status='true'&&rec_status='true' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);
  	echo"$numb_req";?> Friends</h4><hr>
		<?php 

  	$getreq = "SELECT * FROM friends WHERE (user_send = '$username' || user_rec='$username' )&&send_status='true'&&rec_status='true' ORDER BY timestamp DESC";
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

 	$sql_chat_count = "SELECT * FROM chats WHERE send_username='$req_username'&& rec_username='$username' && rec_status='false'";
 	$chat_count_res = mysqli_query($con,$sql_chat_count);
 	$num_rows_chat = mysqli_num_rows($chat_count_res);

 	if($num_rows_chat>0)
 	{
 		echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<img src='images/$req_image' class='i_image'>
				<div>
					<h5 style='margin-left: 10px;margin-right: 10px;'>$req_full_name</h5><br>
					<p  style='margin-left: 10px;margin-right: 10px;'>$req_username</p>
				</div>
				<form action='chat.php' method='post'>
				<input type='text' name='chat_username' value='$req_username' style='display:none'>
				<button class='btn btn-outline-dark mt-2' style='border-radius: 2px;margin-left: 10px;margin-right: 10px;'><i class='fas fa-paper-plane'></i> Chat </button><span class='badge bg-warning p-1'style='font-size:8px;position:absolute;margin-left:-15px;'>$num_rows_chat</span>
				</form>
		</div>
		<div class='col-sm-3'></div>
	</div>";
 	}

 	else

 	echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<img src='images/$req_image' class='i_image'>
				<div>
					<h5 style='margin-left: 10px;margin-right: 10px;'>$req_full_name</h5><br>
					<p  style='margin-left: 10px;margin-right: 10px;'>$req_username</p>
				</div>
				<form action='chat.php' method='post'>
				<input type='text' name='chat_username' value='$req_username' style='display:none'>
				<button class='btn btn-outline-dark mt-2' style='border-radius: 2px;margin-left: 10px;margin-right: 10px;'><i class='fas fa-paper-plane'></i> Chat</button>
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
				<h5 style='text-align:center'>No Friends To Chat</h5>
		</div>
		<div class='col-sm-3'></div>
	</div>";
}


  	?>
  	<hr>
	</div>

<p id="result" style="display: none;"></p>
<!-- HTML Footer -->
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
