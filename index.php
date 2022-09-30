<?php 
session_start();
include('config.php'); 
session_destroy();
?>

<!-- HTML Start -->
<?php echo "$html_start";?>
<!-- Inside Body -->
<body>
<div class="container-fluid" data-aos="fade-down">
  <div class="row">
    <div class="col-sm-5" >
      <img src="https://image.freepik.com/free-vector/chat-logo-design_93835-108.jpg" class="img-fluid">
      <h1 style="text-align:center;margin-top: -80px;"><span style="color: grey"> Pin</span><span style="color: green">Chat</span></h1>
    </div>
    <div class="col-sm-1">
    </div>
    <div class="col-sm-5 bg-white" style="margin-top: 50px;padding:20px;">
        <form action="login.php" method="post" class="form-control d-grid" style="padding: 20px;box-shadow: 0 0 5px grey;">   

          <h1 style="text-align: center;color: green">Log <span style="color: grey">In</span></h1>
          <input type="text" name="username" placeholder="Username" style="padding: 15px;" class="form-control mt-3 " required>
          <input type="password" name="password" placeholder="Password" style="padding: 15px;" class="form-control mt-4 mb-3" required>
          <button type="submit" class="btn btn-primary mb-2" style="font-size: 25px;padding: 10px;border-radius: 10px;">Log In</button>
          <p class="mb-2" style="text-align: center;color: blue">Don't have account ?</p>
          <hr>
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success col-sm-6 gap-2 d-grid mx-auto mb-2" style="font-size: 20px;padding: 10px;border-radius: 10px;">Create New Account</button>

        </form>
    </div>
</div>
</div>

<!-- Modal -->
<div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="color: green">Welcome to PinChat</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <form action="signup.php" method="post" class="form-control">
        <h3 style="text-align: center;" class="modal-title" ><b>Sign Up</b></h3><br>
              <div class="row">
                  <div class="col-sm-6">
                      <input type="text" name="firstName" placeholder="First Name" style="padding: 15px;" class="form-control mt-3 " required>
                  </div>

                  <div class="col-sm-6">
                      <input type="text" name="lastName" placeholder="Last Name" style="padding: 15px;" class="form-control mt-3 " required>
                  </div>
              </div>
                <input type="text" name="username" placeholder="Username" style="padding: 15px;" class="form-control mt-3 " required id="UserName">
                <input type="password" name="password" placeholder="Password" style="padding: 15px;" class="form-control mt-3 " required>
                <button type="submit" class="btn btn-primary col-sm-6 gap-2 d-grid mx-auto  mb-2 mt-3" style="font-size: 18px;padding: 10px;border-radius: 10px;">Sign Up</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- HTML Footer -->
<?php echo "$html_end";?>

<script type="text/javascript">
  $("input#UserName").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});
</script>