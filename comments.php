<?php 
session_start();
include('config.php'); 
$username = $_SESSION['username'];
$password = $_SESSION['password'];

if(isset($_POST["co_pid"]))
{
	$_SESSION["co_pid"]= $_POST["co_pid"];
}
	$co_pid = $_SESSION["co_pid"];

	$sql2= "SELECT * FROM posts WHERE ID = '$co_pid'";
	$res2 = mysqli_query($con,$sql2);
	$row2 = $res2->fetch_assoc();

	$co_username = $row2["username"];
	$co_content = $row2["content"];


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
	
	if(isset($_POST["comment_c"])) 
	{
		$comment_c = $_POST["comment_c"];
		$sql2 = "INSERT INTO comments(user_post,user_comment,content,post_id) VALUES
				('$co_username','$username','$comment_c','$co_pid')";
		$res2 = mysqli_query($con,$sql2);

		$sqlc = "SELECT * FROM comments WHERE post_id='$co_pid'";
		$resc = mysqli_query($con,$sqlc);
		$numc = mysqli_num_rows($resc);

		$u_comments = "UPDATE posts SET comment_count='$numc' WHERE ID='$co_pid'";
		$u_res = mysqli_query($con,$u_comments);
	}
	$sqlc = "SELECT * FROM comments WHERE post_id='$co_pid'";
		$resc = mysqli_query($con,$sqlc);
		$numc = mysqli_num_rows($resc);
	
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
    .chat_left1
    {
      border-radius:20px;
      min-width:50px;
      max-width:80%; 
      padding: 20px;
      background-color: lightgreen;
      color:black;
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
<!-- HTML Footer -->
<div class="container" style="padding: 20px;">
	<div class='row'>
			<div class='col-sm-2'>
			</div>
			<div class='col-sm-8 mt-4' style='padding: 10px;box-shadow: 0 0 2px;border-radius: 5px;' data-aos='fade-down'>
			<div class='d-flex justify-content-left align-items-center'>
				<h4><b><?php echo "$co_username";?></b></h4>
			</div>
			<hr>
			<div style='max-height:250px;overflow-y:scroll;'>
			<p class='mt-2 mb-2 '><?php echo"$co_content";?></p>
			</div>
			<hr>
			Comments <?php echo "( $numc )";?>
			</div>
			<div class='col-sm-2'></div>
	</div>
</div>
<div class="container-fluid mt-3">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			
			<form method="post">
			<textarea placeholder="Write Your Comment Here..." name="comment_c" class="mt-3" required style="height: 300px; width: 100%;"> 
			</textarea>

  			<button class="btn btn-success mt-2 mb-3 end-0">Post Comment <i class="fas fa-plus"></i></button>
  			
  		</form>
		</div>
		<div class="col-sm-3"></div>
	</div>
	</div>
	<div class="container bg-light" >
		<h3 style="text-align: center;"><b>All Comments</b></h3>
		<div class="row">

		<?php
			$sql3 = "SELECT * FROM comments WHERE post_id = '$co_pid' ORDER BY ID DESC";
			$res3 = mysqli_query($con,$sql3);
			$num3 = mysqli_num_rows($res3);
			if($num3>0)
			{
				while ($row3 = $res3->fetch_assoc()) 
				{
					$comment_username = $row3["user_comment"];
					$comment_content = $row3["content"];

					if($username==$comment_username)
					{
						echo "<div class='col-sm-3'></div><div class='col-sm-6'><div class='d-flex justify-content-end '>
			          					<span class='chat_right'>$comment_content </span>
			        				  </div></div><div class='col-sm-3'></div>";
					}
					else if($co_username==$comment_username)
					{
						echo "<div class='col-sm-3'></div><div class='col-sm-6'><div class='d-flex justify-content-start'>
			          					<span class='chat_left'>$comment_content <b><i>by: $comment_username</i></b></span>
			        				</div></div><div class='col-sm-3'></div>";
					}
					else
					{
						echo "<div class='col-sm-3'></div><div class='col-sm-6'><div class='d-flex justify-content-start'>
			          					<span class='chat_left1'>$comment_content  <b><i>by: $comment_username</i></b></span>
			        				</div></div><div class='col-sm-3'></div>";
					}
				}
			}
			else
			{
				echo "<h4 style='text-align:center;padding:20px;'>No Comments</h4>";
			}
		 ?>
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

<script src="https://cdn.tiny.cloud/1/pj6e88figarznx3v7nvzj9yzcu4kn09m85lgliqe4cgsbixa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    tinymce.init({
      selector: 'textarea',
      menubar:false,
      height:150,
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
  </script>

<?php echo "$html_end";?>