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

<?php 
	if (isset($_POST["content"])) {
		$content = $_POST["content"];

		$reg = "INSERT INTO posts(content,username) VALUES
	('$content','$username')";
	$check = mysqli_query($con,$reg);

	if($check){
		echo "<script>alert('Post Created Successfully');</script>";}
	else
	{
		echo "<script>alert('Try Again to create post');</script>";
		
	}
}
?>
<?php 
	if(isset($_POST["de_pid"]))
	{
		$de_pid = $_POST["de_pid"];
		$sql_d = "DELETE FROM posts WHERE ID = '$de_pid'";
		$res_d = mysqli_query($con,$sql_d);
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
	#color3
	{
		background-color:#27AD5D ;
		color:white;
	}
</style>
<div class="container-fluid mt-3">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<h4 style="text-align: center;" class="mb-3"><b>Create Post <i class="fas fa-plus"></i></b></h4>
			<form method="post">
			<textarea placeholder="What's in your mind ? Write and share" name="content" class="mt-3" required style="height: 300px; width: 100%;"> 
			</textarea>

  			<button class="btn btn-success mt-2 mb-3 end-0">Create Post <i class="fas fa-plus"></i></button>
  			
  		</form>
		</div>
		<div class="col-sm-3"></div>
	</div>
	</div>

<p id="result" style="display: none"></p>
	<div class="container-fluid mt-4 mb-5" style="padding: 20px;box-shadow: 0 0 2px;">
		<h2 style="text-align: center;" class="mt-2 mb-3">My Posts <?php 

		$swl = "SELECT * FROM posts WHERE username='$username'";
		$swl_res = mysqli_query($con,$swl);
		$swl_count = mysqli_num_rows($swl_res);
		echo " ( $swl_count ) ";?> </h2>
		<?php



			$sql4 = "SELECT * FROM posts WHERE username='$username' ORDER BY ID DESC ";
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

 					$sql5 = "SELECT * FROM profile WHERE username='$p_username'";
					$rest1 = mysqli_query($con,$sql5);

					$show = $rest1->fetch_assoc();
					$p_image = $show["image"];
					$p_username = $show["username"];

					$y_sql = "SELECT * FROM likes WHERE like_by='$username' && username='$username' && status ='1' && post_id='$p_id'";
					$y_res = mysqli_query($con,$y_sql);
					$y_rows = mysqli_num_rows($y_res);
					if($y_rows==0)
					{
						$like_color = "far";
					}
					else
					{
						$like_color = "fas";
					}
					$sqlc = "SELECT * FROM comments WHERE post_id='$p_id'";
					$resc = mysqli_query($con,$sqlc);
					$numc = mysqli_num_rows($resc);

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
				<input type='text' id='post_username$p_id' value='$p_username' name='post_username$p_id' style='display:none'>
				<input type='text' id='curr_username$p_id' value='$username' name='curr_username$p_id' style='display:none'>
				<p type='submit' class='btn like_btn mt-3' id='$p_id' style='font-size:20px;'><i class='$like_color fa-heart' style='color:red'></i> <span id='like$p_id'>$p_likes</span></p>&nbsp;&nbsp;&nbsp;
				</form>
				<form action='comments.php' method='post'>
					<input type='number' value='$p_id' name='co_pid' style='display:none'>
					<button type='submit' class='btn'><i class='far fa-comment'></i> $numc</button>
				</form>&nbsp;&nbsp;&nbsp;
				<form method='post' action=''>				
					<input type='number' id='pid$p_id' value='$p_id' name='p_id$p_id' style='display:none'>
					<button class='btn btn-light like_count float-right' id='$p_id' data-bs-toggle='modal' data-bs-target='#exampleModal$p_id'> Liked By ..</button>
				</form>

			</div>
			<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#delete_post$p_id'>Delete Post</button>
			</div>
			<div class='col-sm-3'></div>
		</div>
</div>
<div class='modal fade' id='delete_post$p_id' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Delete Post</h5>
        
      </div>
      <div class='modal-body'>
        Do you really want to delete this post?<br>
        Click Outside if NO.
      </div>
      <div class='modal-footer'>
        <form method='post'>
        	<input type='number' name='de_pid' value='$p_id'  style='display: none;'>
        <button type='submit' class='btn btn-success'>Yes</button>
    	</form>
      </div>
    </div>
  </div>
</div>
		";
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
<script>
  $(document).ready(function () {
    $('.like_count').click(function (e) {

      e.preventDefault();
    	var pid = $(this).attr('id');
    	var p="pid"+pid;
      	var p_id = document.getElementById(p).value;

      $.ajax
        ({
          type: "POST",
          url: "like_count.php",
          data: { "p_id": p_id,},
          success: function (data) {

          	 document.getElementById('result1').innerHTML=" ";
          	$("#result1").empty();
          	 $('#result1').html(data);          	 
          	 var z = "#exampleModal"+pid;
          	 $(z).modal('show');


          }
        });


    });
  });
</script>