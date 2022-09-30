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
	$sql1 = "SELECT * FROM profile WHERE username='$username'";
	$rs = $con->query($sql1);
  	$row = $rs->fetch_assoc();
  	$first_name = $row["first_name"];
  	$last_name = $row["last_name"];
  	$full_name = $row["first_name"]." ".$row["last_name"];
  	$bio = $row["bio"];
  	$image = $row["image"];
  	$f_name_i = $row["first_name"];

  	$sql1 = "SELECT * FROM profile WHERE username='$username' ";
	$re1 = mysqli_query($con,$sql1);
	$rs1 = $con->query($sql1);
	$rows = $rs1->fetch_assoc();
	$imagei = $rows["image"];

?>
<?php 
if (isset($_POST['firstName']))
{
	$sql2 = "SELECT * FROM profile WHERE username='$username'";
	$res = mysqli_query($con,$sql2);
	$num = mysqli_num_rows($res);

	$f_name = $_POST['firstName'];
	$l_name = $_POST['lastName'];
	$u_username = $_POST['username'];
	$u_bio = $_POST['bio'];
	$full_names = $_POST['firstName']." ".$_POST['lastName'];

if($num==1)
{
	
	$reg = "UPDATE  profile SET first_name='$f_name',last_name='$l_name',bio = '$u_bio',full_name = '$full_names' WHERE username='$username'";
	mysqli_query($con,$reg);

	$reg3 = "UPDATE users SET first_name='$f_name',last_name='$l_name' WHERE username = '$username'";
	mysqli_query($con,$reg3);
	echo "<script>
alert('Profile Updated Successfully');
	</script>";
	header('location:profile.php');
}
else
{
	echo "<script>
alert('Username Already Exists');
	</script>";
}
}
if(isset($_POST['image']))
{
	$img = $_POST['image'];
	if(!$_POST['image'])
	{
		$img = "main.jpg";
	}
	$reg1 = "UPDATE  profile SET image='$img' WHERE username='$username'";
	mysqli_query($con,$reg1);

	echo "<script>
alert('Profile Image Updated Successfully');
	</script>";
	header('location:profile.php');
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
	.images
	{
		width: 150px;
		height: 150px;
		box-shadow: 0 0 5px grey;
		border-radius: 150px;
		margin-top: 10px;
	}
	.images:hover
	{
		cursor: pointer;
		animation-name: image_shrink;
		animation-duration: 500s;
	}
	@keyframes image_shrink
	{
		0%
		{
			width: 150px;
			height: 150px;
		}
		0.1%
		{
			width: 130px;
			height: 130px;
		}
	}
</style>
<body>
<!-- Menu Bar -->
<?php echo"$menu_bar";?>
<style type="text/css">
	#color4
	{
		background-color: black;
		color:white;
	}
	#pro_image
	{
		width: 250px; height: 250px;box-shadow: 0 0 5px grey; 	border-radius: 250px;
		margin-top: 10px;
	}
</style>
<div class="container mt-3">
	<hr>
	<div class="row">
		<div class="col-sm-6 " style="text-align: center;" data-aos="fade-up-left">
			<img src="images/<?php echo"$image"?>" class="img-fluid" id="pro_image"  ><br>
			<button class="btn btn-secondary mb-2 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">Edit Profile Picture</button>
			<hr>
		</div>
		<div class="col-sm-6" style="text-align: center; padding: 15px;" data-aos="fade-up-right">
			<h1><b><?php echo"$username"?></b></h1>
			<div class="d-flex justify-content-center align-items-center">
				<a class="block" href="posts.php"><span style="font-size: 20px"><?php 
		$swl = "SELECT * FROM posts WHERE username='$username'";
		$swl_res = mysqli_query($con,$swl);
		$swl_count = mysqli_num_rows($swl_res);
		echo "  $swl_count ";?></span> posts</a>
				<a class="block" href="friend.php"><span style="font-size: 20px"><?php 

  	$getreq = "SELECT * FROM friends WHERE(user_send = '$username' || user_rec='$username' )&&send_status='true'&&rec_status='true' ORDER BY ID DESC";
  	$req_res = mysqli_query($con,$getreq);

  	$numb_req = mysqli_num_rows($req_res);
  	echo"$numb_req";?></span> friends</a>
				<a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Profile</a>
			</div><br>
			<h3 style="text-align: left;"><b><?php echo"$full_name"?></b></h3><br>
			<h6 style="text-align: left;"><?php echo"$bio"?></h6>
		</div>


	</div>
</div>

<!-- Modal -->
<div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="color: green">Hello! <?php echo "$full_name"?> </h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <form method="post" class="form-control">
        <h3 style="text-align: center;" class="modal-title" ><b>Update Profile</b></h3><br>
              <div class="row">
                  <div class="col-sm-6">
                      <input type="text" name="firstName" placeholder="First Name" style="padding: 15px;" class="form-control mt-3 " value="<?php echo"$first_name"?>" required>
                  </div>

                  <div class="col-sm-6">
                      <input type="text" name="lastName" placeholder="Last Name" style="padding: 15px;" class="form-control mt-3 " value="<?php echo"$last_name"?>" required>
                  </div>
              </div>
                <textarea placeholder="Add About Yourself..." name="bio" required class="mt-3">  <?php echo"$bio"?>
  				</textarea>
                
                <button type="submit" id="insert" class="btn btn-primary col-sm-6 gap-2 d-grid mx-auto  mb-2 mt-3" style="font-size: 18px;padding: 10px;border-radius: 10px;">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class=" modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="color: green">Hello! <?php echo "$full_name"?> <img src="images/<?php echo "$image"?>" id='img1' style="width: 50px;height: 50px;border-radius: 50px;"></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <form method="post" class="form-control">
        <h3 style="text-align: center;" class="modal-title" ><b>Select Profile Image</b></h3><br>
              <div class="row" style="text-align: center;">
              	<input type="text" name="image" id="value" style="display: none;">
                  <div class="col-sm-2"><img src="images/1.png" class="img-fluid images" onclick="select('1.png')"></div>
                  <div class="col-sm-2"><img src="images/2.png" class="img-fluid images" onclick="select('2.png')"></div>
                  <div class="col-sm-2"><img src="images/3.png" class="img-fluid images" onclick="select('3.png')"></div>
                  <div class="col-sm-2"><img src="images/4.png" class="img-fluid images" onclick="select('4.png')"></div>
                  <div class="col-sm-2"><img src="images/5.png" class="img-fluid images" onclick="select('5.png')"></div>
                  <div class="col-sm-2"><img src="images/6.png" class="img-fluid images" onclick="select('6.png')"></div>                  
                  <div class="col-sm-2"><img src="images/7.png" class="img-fluid images" onclick="select('7.png')"></div>
                  <div class="col-sm-2"><img src="images/main.jpg" class="img-fluid images" onclick="select('main.jpg')"></div>



              </div>
                
                <button type="submit" id="insert" class="btn btn-success col-sm-6 gap-2 d-grid mx-auto  mb-2 mt-3" style="font-size: 18px;padding: 10px;border-radius: 10px;">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	function select(getvalue)
	{
		document.getElementById("img1").src = "images/"+getvalue;
		document.getElementById("value").value = getvalue;
	}
</script>
<!-- HTML Footer -->
<script src="https://cdn.tiny.cloud/1/pj6e88figarznx3v7nvzj9yzcu4kn09m85lgliqe4cgsbixa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
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