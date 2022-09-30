<?php 
session_start();
include('config.php'); 
if(isset($_POST['chat_username']))
{
	$_SESSION['chat_username'] = $_POST['chat_username'];
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$chat_username = $_SESSION['chat_username'];

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
<?php 
    
    $sql1 = "SELECT * FROM profile WHERE username='$chat_username' ";
	$re1 = mysqli_query($con,$sql1);
	$rs1 = $con->query($sql1);
	$rows = $rs1->fetch_assoc();
	$chat_imagei = $rows["image"];
	$chat_full_name = $rows["full_name"];

	$sql_tik = "UPDATE chats SET rec_status='true' WHERE send_username='$chat_username'&&rec_username='$username'";
	$tic_res = mysqli_query($con,$sql_tik);
	if(isset($_POST['chat_text']))
	{
		$chat_text = $_POST['chat_text'];
		$sql_l = "INSERT INTO chats(send_username,rec_username,content)VALUES('$username','$chat_username','$chat_text')";
		$check = mysqli_query($con,$sql_l);

		$sql_friend = "UPDATE friends SET timestamp=now()  WHERE (user_send='$username'&&user_rec='$chat_username')||(user_send='$chat_username'&&user_rec='$username')";
		$u_friend = mysqli_query($con,$sql_friend);
	}

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
</style>
<body>
<!-- Menu Bar -->
<?php echo"$menu_bar";?>

	<div class="container-fluid chat" >
		<div class="row d-flex justify-content-center align-items-center">
			<div class="col-sm-6" style="background-color: #fff;position: absolute;bottom: 2px;top: 100px;border-radius: 10px;z-index: 0;">
				<div class="d-flex align-items-center justify-content-center" style="padding: 5px;">
					<img src="images/<?php echo"$chat_imagei"; ?>" style="height: 30px;width: 30px;border-radius: 40px;" >&nbsp;&nbsp;&nbsp;
					<h4><b><?php echo"$chat_full_name";?></b></h4>
				</div>
				<div style="position: absolute;top: 40px;bottom:60px; z-index:1;border-radius: 10px;background-color:#fafafa;left: 0;right: 0;padding: 15px;overflow-y:scroll;display:flex; flex-direction:column-reverse;" id="chat_box">

					
			      </div><form action="chat.php" method="post">
				<div class="input-group" style="position: absolute;bottom: 2px;left: 0;right: 0;">
					
  					<input type="text" name="chat_text" placeholder="Type Message Here.." class="form-control bg-light" style="padding: 15px;border-radius: 50px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;" aria-label="Text input with segmented dropdown button" required>

	  					<div class="input-group-prepend">
	    				<button type="submit" class="btn btn-primary" style="padding: 15px;border-radius: 50px;border-top-left-radius: 0px;border-bottom-left-radius: 0px;"><i class='fas fa-paper-plane'></i> Send</button>
	  					</div>
	  				
					</div></form>
			</div>
		</div>
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

<script>
    $(document).ready(function(){
      // load text file when page loads
      $("#chat_box").load("chat_box.php");

      // Then reload it every 5 seconds, for ever ...
      setInterval(function(){
        $("#chat_box").load("chat_box.php");
      }, 200);
    });
    </script>