<?php 
session_start();
include('config.php'); 

$username = $_SESSION['username'];
$password = $_SESSION['password'];
if(isset($_POST['f_username']))
{
	$_SESSION['f_username'] = $_POST['f_username'];
}
$f_username = $_SESSION['f_username'];

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

	$sql1 = "SELECT * FROM profile WHERE username='$f_username'";
	$rs = $con->query($sql1);
  	$row1 = $rs->fetch_assoc();
  	$first_name = $row1["first_name"];
  	$last_name = $row1["last_name"];
  	$full_name = $row1["first_name"]." ".$row1["last_name"];
  	$bio = $row1["bio"];
  	$image = $row1["image"];


?>
<?php

if(isset($_POST["friend_username"]))
{
	$friend_username = $_POST["friend_username"];

	$reg = "UPDATE  friends SET send_status='false',rec_status='false' WHERE (user_send='$username'&&user_rec='$friend_username')||(user_send='$friend_username'&&user_rec='$username')";
	mysqli_query($con,$reg);

	header("location:friend.php");
}
?>


<!-- HTML Start -->
<?php echo "$html_start";?>
<style type="text/css">
	img
	{
		width: 100%;
		height: auto;
	}
</style>
<body>
<!-- Menu Bar -->
<?php echo"$menu_bar";?>

<style type="text/css">
	#color2
	{
		background-color:#27AD5D ;
		color:white;
	}
	#pro_image
	{
		width: 250px; height: 250px;box-shadow: 0 0 5px grey; 	border-radius: 250px;
		margin-top: 10px;
	}
	.block
	{
		margin-left: 20px;
		margin-right: 20px;
		border-radius: 5px;
		background-color: #fff;
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
</style>
<div class="container mt-3">
	<hr>
	<div class="row">
		<div class="col-sm-6 " style="text-align: center;" data-aos="fade-up-left">
			<img src="images/<?php echo"$image"?>" class="img-fluid" id="pro_image"  ><br>
			<hr>
		</div>
		<div class="col-sm-6" style="text-align: center; padding: 15px;" data-aos="fade-up-right">
			<h1><b><?php echo"$f_username"?></b></h1>
			<div class="d-flex justify-content-center align-items-center">
				<a class="block btn"><span style="font-size: 20px"><?php 
		$swl = "SELECT * FROM posts WHERE username='$f_username'";
		$swl_res = mysqli_query($con,$swl);
		$swl_count = mysqli_num_rows($swl_res);
		echo "  $swl_count ";?></span> posts</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="block btn" data-toggle="modal" data-target="#f_friends"><span style="font-size: 20px" ><?php 

  	$getreq = "SELECT * FROM friends WHERE(user_send = '$f_username' || user_rec='$f_username' )&&send_status='true'&&rec_status='true' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);
  	echo"$numb_req";?></span> friends</button>
  	&nbsp;&nbsp;&nbsp;&nbsp;
  	<button class="btn btn-danger" data-toggle="modal" data-target="#remove_friend">Remove</button>

			</div><br>
			<h3 style="text-align: left;"><b><?php echo"$full_name"?></b></h3><br>
			<h6 style="text-align: left;"><?php echo"$bio"?></h6>
		</div>


	</div>
</div>
<div class="modal fade" id="remove_friend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Friend</h5>
        <button  class="close btn btn-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to remove <?php echo"$full_name"?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <form method="post">
        	<input type="text" name="friend_username" value="<?php echo"$f_username";?>" style="display: none;">
        <button type="submit" class="btn btn-success">Yes</button>
    	</form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="f_friends" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Friends</h5>
        <button  class="close btn btn-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
		$get_friends = "SELECT * FROM friends WHERE (user_send='$f_username'||user_rec='$f_username')&&send_status='true'&&rec_status='true'";
		$get_result = mysqli_query($con,$get_friends);
		$getrows = mysqli_num_rows($get_result);
		if($getrows>0){
		while($row=$get_result->fetch_assoc())
		{
			$user_send = $row["user_send"];
 				if($user_send==$f_username)
 				{
 					$user_send = $row["user_rec"];
 				}
 				$get_each_detail = "SELECT *  FROM profile WHERE username='$user_send'";
 				$get_each_result = mysqli_query($con,$get_each_detail);
 				$show = $get_each_result->fetch_assoc();

 				$ffimage = $show["image"];
 				$ffull_name = $show["full_name"];
 				$fusername = $show["username"];

			 	echo "<div class='row'>
					<div class='col-sm-1'></div>
					<div class='col-sm-10 d-flex justify-content-center align-items-center bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
							<img src='images/$ffimage' class='i_image'>
							<div>
								<h5 style='margin-left: 10px;margin-right: 10px;'>$ffull_name</h5><br>
								<p  style='margin-left: 10px;margin-right: 10px;'>$fusername</p>
							</div>
					</div>
					<div class='col-sm-1'></div>
				</div>";
		}
	}
		else
		{
			echo "<div class='row'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6 d-flex justify-content-center align-items-center mt-3 mb-3 bg-white' style='padding-top: 10px;padding-bottom:10px;box-shadow: 0 0 2px;border-radius: 5px; ' data-aos='fade-down'>
				<h5> No Friends </h5>
		</div>
		<div class='col-sm-3'></div>
	</div>";
		}

	?>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<p id="result" style="display: none"></p>
	<div class="container-fluid mt-4 mb-5" style="padding: 20px;box-shadow: 0 0 2px;">
		<h2 style="text-align: center;" class="mt-2 mb-3"> Posts <?php 

		$swl = "SELECT * FROM posts WHERE username='$f_username'";
		$swl_res = mysqli_query($con,$swl);
		$swl_count = mysqli_num_rows($swl_res);
		echo " ( $swl_count ) ";?> </h2>
		<?php



			$sql4 = "SELECT * FROM posts WHERE username='$f_username' ORDER BY ID DESC ";
			$rest2 = mysqli_query($con,$sql4);
			$numb = mysqli_num_rows($rest2);

			if($numb>0)
			{
			 while($row = $rest2->fetch_assoc()) 
 				{
 					$p_content = $row["content"];
 					$post_date = $row["date_of_post"];
 					$p_username = $row["username"];
 					$p_id = $row["ID"];
 					$p_likes = $row["likes"];

 					$sql5 = "SELECT * FROM profile WHERE username='$f_username'";
					$rest1 = mysqli_query($con,$sql5);

					$show = $rest1->fetch_assoc();
					$p_image = $show["image"];
					$p_username = $show["username"];

					$y_sql = "SELECT * FROM likes WHERE like_by='$username' && username='$f_username' && status ='1' && post_id='$p_id'";
					$y_res = mysqli_query($con,$y_sql);
					$y_rows = mysqli_num_rows($y_res);
					
					$sqlc = "SELECT * FROM comments WHERE post_id='$p_id'";
					$resc = mysqli_query($con,$sqlc);
					$numc = mysqli_num_rows($resc);
					if($y_rows==0)
					{
						$like_color = "far";
					}
					else
					{
						$like_color = "fas";
					}
					{

 					echo "<div class='row'>
			<div class='col-sm-2'>
			</div>
			<div class='col-sm-8 mt-4' style='padding: 10px;box-shadow: 0 0 2px;border-radius: 5px;' data-aos='fade-down'>
			<div class='d-flex justify-content-left align-items-center'>
				<img src='images/$p_image' style='width: 60px;height: 60px; box-shadow: 0 0 10px green;border-radius: 60px;'>&nbsp;&nbsp;&nbsp;
				<h4>$p_username</h4>
			</div>
			<hr>
			<div style='max-height:300px;overflow-y:scroll;'>
			<p class='mt-2 mb-2 '>$p_content</p>
			</div>
			<hr>
			<div class='d-flex justify-content-left align-items-center'>
				<p  class='mt-2 mb-2'><b> $post_date</b></p>&nbsp;&nbsp;&nbsp;
				<form method='post' action='' id='form_likes'>
				<input type='number' id='post_id$p_id' value='$p_id' name='post_id$p_id' style='display:none'>
				<input type='text' id='post_username$p_id' value='$f_username' name='post_username$p_id' style='display:none'>
				<input type='text' id='curr_username$p_id' value='$username' name='curr_username$p_id' style='display:none'>
				<p type='submit' class='btn like_btn mt-3' id='$p_id' style='font-size:20px;'><i class='$like_color fa-heart' style='color:red'></i> <span id='like$p_id'>$p_likes</span></p>&nbsp;&nbsp;&nbsp;
				</form>
				
				<form action='comments.php' method='post'>
					<input type='number' value='$p_id' name='co_pid' style='display:none'>
					<button type='submit' class='btn'><i class='far fa-comment'></i> $numc</button>
				</form>
			</div>
			</div>
			<div class='col-sm-3'></div>
		</div>";
	}
}
}
		?>
		</div>
		<div id="result1"></div>
		<span id="result2"></span>

<!-- HTML Footer -->
<script src="https://cdn.tiny.cloud/1/pj6e88figarznx3v7nvzj9yzcu4kn09m85lgliqe4cgsbixa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    tinymce.init({
      selector: 'textarea',
      menubar:false,
      height:300,
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
  </script>
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
  $(document).ready(function () {
    $('.like_btn').click(function (e) {

      e.preventDefault();
    	var id = $(this).attr('id');
    	var p="post_id"+id;
    	var q="post_username"+id;
    	var r="curr_username"+id;
      var post_id = document.getElementById(p).value;
      var post_username =document.getElementById(q).value;
      var curr_username = document.getElementById(r).value;

      $.ajax
        ({
          type: "POST",
          url: "like.php",
          data: { "post_id": post_id, "post_username": post_username, "curr_username": curr_username },
          success: function (data) {
          	 $('#result').html(data);
          	 var t = document.getElementById('result').innerHTML ;
          	 var i = "like"+id;
          	 var c = document.getElementById(i).innerHTML;
          	
          	 if(t=="far")
          	 {
          	    c--;
          	 }
          	 else
          	 {
          	 	c++;
          	 }
          	 document.getElementById(post_id).innerHTML = "<i class='"+t+" fa-heart' style='color:red'></i> <span id='like"+id+"'>"+c+"</span>";

          }
        });
    });
  });
</script>