<?php
	
	$con = new mysqli("localhost","root","", "pinchat");
	$color1 = "white";
	$color2 = "white";
	$color3 = "white";
	$color4 = "white";
	$html_start = "<!doctype html>
<html lang='en'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous'>

    <!-- Google Font Roboto Link -->
    <link rel='preconnect' href='https://fonts.gstatic.com'>
<link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel='stylesheet'>

    <!-- Tab Icon Image -->

    <link rel='icon' type='image/x-icon' href='https://i.ibb.co/6rFPkD3/logo2.jpg'>

    <!-- Animation -->

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>

     <!-- AOS animation -->
    <link href='https://unpkg.com/aos@2.3.1/dist/aos.css' rel='stylesheet'>


    <title>PinChat</title>
    <style>
    body{
    	background-color:#FeFeFe;
    }
    #menu_block_item{
        width: 250px;
        height: 100vh;
        position: fixed;
        right: 0px;
        top: 62px;
        z-index:2;
        transition: 0.5s;
        display: none;
    }
    .menu_btn
    {
        cursor: pointer;
        font-size: 20px;
        box-shadow: 0 0 ;
        transition: font-size 1s,box-shadow 1s;
    }
    .menu_btn:hover
    {
        font-size: 20px;
        box-shadow: 2px 2px 2px,-2px -2px 2px ;
    }
    .menu_itm
    {
        font-size: 20px;
        transition: font-size 0.5s;
    }
    .menu_itm:hover
    {
        font-size: 30px;
        color: blue;
    }
    @media only screen and (min-width:1150px) {
    	.nav_bar
{
	display:none;
}
    }
    @media only screen and (max-width:1150px) {
    	.nav_bar1{
    	background-color:red;
    	display:none;
}
.nav_bar
{
	display:block;
}
    	body{
    		font-size:12px;
    	}
    	p,h6,a
    	{
    		font-size:12px;
    	}
    	h1,h2,h3,h4,h5
    	{
    		font-size:14px;
    	}


}
 	</style>
  </head>";

  $html_end = " <!-- Optional JavaScript; choose one of the two! -->
  <div class='container-fluid' style='padding: 20px;text-align:center;'>
    <img src='https://i.ibb.co/6rFPkD3/logo2.jpg' style='width: 60px;height: 60px;border-radius: 60px;'>
          <span>Pin</span><span style='color: green'>Chat</span>
    <p> © 2021 Designed and Developed By Yash Kumar Saini All Rights Reserved.</p>
  </div>

<script type='text/javascript'>
function menu(value)
        {
            if(value==1)
            {
                document.getElementById('menu_btn').style.display='none';
                document.getElementById('menu_cross').style.display='inline';
                document.getElementById('menu_block_item').style.display='block';
            }
            else if(value==2)
            {
                document.getElementById('menu_block_item').style.display='none';
                document.getElementById('menu_btn').style.display='inline';
                document.getElementById('menu_cross').style.display='none';
            }
        }
        </script>

<script type='text/javascript'>
	if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js' integrity='sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW' crossorigin='anonymous'></script>
    
    <!-- Icons Script -->
    <script src='https://kit.fontawesome.com/56eedf655b.js' crossorigin='anonymous'></script>

    <script src='https://unpkg.com/aos@2.3.1/dist/aos.js'></script>
    <script>
      AOS.init({duration : 700});
    </script>
    <!-- JQuery CDN Link -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js' integrity='sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js' integrity='sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj' crossorigin='anonymous'></script>
    -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'>

</script>
  </body>
</html>";



	$menu_bar = "<style type='text/css'>
    body
    {
      font-family: 'Roboto', sans-serif;
    }
    .nav_btn
    {

      border-radius: 20px;
      background-color: white;
      padding: 10px;
    }
    .nav_btn:hover
    {
      animation-name: nav_b;
      animation-duration: 500s;
      cursor: pointer;
    }
    @keyframes nav_b
    {
      0%
      {
        background-color: white;
        color: black;
      }
      0.1%
      {
        background-color: #27AD5D;
        color: white;
        border-bottom-left-radius: 0px 10px ;
      }
      100%
      {
        background-color: white;
        color: black;
      }
    }
    .nav_btn1
    {
      margin-left: 1px;
      border-radius: 20px;
      background-color: white;
      padding: 5px;
    }
    .nav_btn1:hover
    {
      animation-name: nav_bt;
      animation-duration: 500s;
      cursor: pointer;
    }
    @keyframes nav_bt
    {
      0%
      {
        background-color: white;
        color: black;
      }
      0.1%
      {
        background-color: black;
        color: white;
        border-bottom-right-radius: 0px 10px ;
      }
      100%
      {
        background-color: white;
        color: black;
      }
    }
    a
    {
      text-decoration: none;
      color: black;
    }
  </style>

    <div class='container-fluid bg-light nav_bar1' style='padding-top: 10px;padding-bottom: 10px; box-shadow: 0 0 5px grey;'>
      <div class='row ' >
        <div class='col-sm-3 d-flex justify-content-center align-items-center mt-2'>
          <img src='https://i.ibb.co/6rFPkD3/logo2.jpg' style='width: 60px;height: 60px;border-radius: 60px;'>
          <span>Pin</span><span style='color: green'>Chat</span>
          <hr>
        </div>
        <div class='col-sm-5  d-flex justify-content-center align-items-center mt-2' >
          <nav >
              <a class='nav_btn ' href='home.php' id='color1'><i class='fas fa-home'></i> Home</a>

              <a class='nav_btn ' href='friend.php' id='color2'><i class='fas fa-user-friends'></i> Friends</a>

              <a class='nav_btn ' href='posts.php' id='color3'><i class='fas fa-mail-bulk'></i> My Posts</a>
          </nav>
          <hr>
        </div>
        <div class='col-sm-2 d-flex justify-content-center align-items-center mt-2 '>

          	<a id='profile_photo' class='nav_btn1'></a>

            <a class='nav_btn ' href='chats.php'><i class='fas fa-paper-plane'></i> Chat <span class='badge bg-dark p-1' id='chat_count'></span></a>

        </div>
        <div class='col-sm-2 d-flex justify-content-center align-items-center mt-2 ' >
          <nav>
            <a class='nav_btn1' href='profile.php' id='color4'> <i class='fas fa-user-circle'></i> Profile</a>
            <a class='nav_btn1' href='index.php' >LogOut <i class='fas fa-sign-out-alt'></i></a>
          </nav>
          <hr>
        </div>
      </div>
    </div>
    <div class='container-fluid fixed-top nav_bar' id='main'  >
    

        <div style='text-align: right;'>
            <svg  id='menu_btn' style='margin-right: 10px;background-color: white'  onclick='menu(1)' class='menu_btn animated fadeInRight' width='3em' height='3em' viewBox='0 0 16 16' class='bi bi-list' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
            <path fill-rule='evenodd' d='M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z'/>
            </svg>
            <span id='menu_cross' onclick='menu(2);' style='display: none;'><svg style='margin-right: 10px;background-color: white' class='menu_btn animated fadeInDown' width='3em' height='3em' viewBox='0 0 16 16' class='bi bi-x' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/></svg></span>
        </div>
        <nav  id='menu_block_item' class='menu_block_item animated fadeInRight'>
        <ul class='list-group' style='text-align: center;cursor: pointer;border-width: 1px;background-color: white;height: 100%;'>

          <li class='list-group-item menu_itm ' style='border-width: 0px;'><img src='https://i.ibb.co/6rFPkD3/logo2.jpg' style='width: 60px;height: 60px;border-radius: 60px;'><span>Pin</span><span style='color: green'>Chat</span></li>
          <li class='list-group-item menu_itm ' style='border-width: 0px;'><a id='profile_photo1' ></a></li>
          <li class='list-group-item menu_itm ' style='border-width: 0px;'><a href='home.php' onclick='menu(2)'><i class='fas fa-home'></i> Home</a></li>
          <li class='list-group-item menu_itm ' style='border-width: 0px;'><a href='friend.php' onclick='menu(2)'><i class='fas fa-user-friends'></i> Friends</li></a>
          <li class='list-group-item menu_itm ' style='border-width: 0px;'><a href='posts.php' onclick='menu(2)'><i class='fas fa-mail-bulk'></i> My Posts</li></a>
          <li class='list-group-item menu_itm ' style='border-width: 0px;'><a href='chats.php' onclick='menu(2)'><i class='fas fa-paper-plane'></i> Chat <span class='badge bg-dark p-1' id='chat_count1'></span></a></li>
          <li class='list-group-item menu_itm ' style='border-width: 0px;'><a href='profile.php' onclick='menu(2)'><i class='fas fa-user-circle'></i> Profile </a></li>
          <li class='list-group-item menu_itm ' style='border-width: 0px;'><a href='index.php' onclick='menu(2)'>LogOut <i class='fas fa-sign-out-alt'></i></a></li>
        </ul>
    </nav>
    </div>";
?>

