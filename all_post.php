
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
?>
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
				<p type='submit' class='btn like_btn mt-3' id='$p_id' style='font-size:20px;'></p>&nbsp;&nbsp;&nbsp;
				</form>
				<button class='btn' ><i class='far fa-comment'></i></button>
				<form method='post' action=''>				
					<input type='number' id='pid$p_id' value='$p_id' name='p_id$p_id' style='display:none'>
					<button class='btn btn-light like_count float-right' id='$p_id' data-bs-toggle='modal' data-bs-target='#exampleModal$p_id'> Liked By ..</button>
				</form>

			</div>
			</div>
			<div class='col-sm-3'></div>
		</div>";
	}
}
}
		?>