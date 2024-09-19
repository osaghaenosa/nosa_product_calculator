<?php
ob_start();
session_start();
include("../../widgets/alert.widget");


if(isset($_SESSION["rrr"])){
  showAlert($_SESSION["rrr"]);
  unset($_SESSION["rrr"]);
}

$evalue="Email Not valid!";
	//	showAlert($evalue);
if(isset($_SESSION["errl"])){

  if($_SESSION["errl"]!=""){

    showAlert($_SESSION["errl"]);

    $_SESSION["errl"]="";

  }


}
ob_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale:1">
    <link rel="stylesheet" href="../../assets/css/cards.css">
    <link rel="icon" type="image/png" href="../../assets/images/logo.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link href="../../assets/css/heartbeat_animation.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Login To your Account</title>
</head>
<body>
<?php 
  //the top nav
?>

<div class="container-md ">
    <div class="row flex-wrap py-5 align-items-center justify-content-center">
        <div class="col-md-6">
            <form
                class="p-4 p-md-5 border  rounded-3 bg-body-tertiary"
                method="post"
                action="login_verify.php"
                style="min-width:500px">

                <div class="d-flex gap-3 py-5" style="align-items: center">
                  <a href="../../"><img src="../../assets/images/logo.png" style="width:50px; height:initial"></a>
                    <h2 class="my-2">Login to your Admin Account</h2>
                </div>

                <div class="form-floating mb-3" style="width:initial">
                    <input
                        type="text"
                        class="form-control"
                        id="floatingInput"
                        placeholder="Username"
                        name="email"
                        style="width:450px">
                        <label for="floatingInput">Username</label>
                    </div>

                    <div class="" style="display:flex">
                        <div class="form-floating mb-3 flex-fill" id="p_box" style="width:450px">

                            <input
                                class="form-control qx"
                                id="floatingPassword"
                                type="password"
                                placeholder="Password"
                                name="passcode"
                                style="width:450px">
                                <label for="floatingPassword">Password</label>

                            </div>
                            <div class="form-floating mb-3 flex-fill" id="p_box" style="display:none">

                                <input
                                    class="form-control qx"
                                    id="floatingPassword"
                                    type="text"
                                    placeholder="Password"
                                    name="passcode">
                                    <label for="floatingPassword">Password</label>

                                </div>
                                <a
                                    class="my-3"
                                    onclick="showPassword()"
                                    style="font-size:20px;position:absolute;margin-left:400px;color:seagreen">
                                    <i class="bi bi-eye" id="eye_open"></i>
                                    <i class="bi bi-eye-slash" id="eye_closed"></i>
                                </a>
                            </div>

                            <!-- <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me">
                                        Remember me
                                    </label>
                                </div> -->
                                <div class="form-floating mb-3">
                                    <button class="btn btn-success w-100 py-2" type="submit">Sign in</button>
                                    
                                    <!-- <p class="d-lg-flex mt-2 text-success" style="flex-direction: row-reverse;">
                                        <a href="forgot_password" class="text-decoration-none text-success">Forgot Password</a>
                                    </p> -->
                                </div>
                                </form>
                            </div>
                            
                        
                    
                   

                </div>
</div>

<style>
  
</style>
<script>
  var p_box = document.querySelectorAll("#p_box");
  var p_box_input = document.querySelectorAll("#p_box input");
  var eye_open = document.querySelector("#eye_open");
  var eye_closed = document.querySelector("#eye_closed");
  eye_closed.style.display = "none";
  eye_open.style.display = "block";
  p_box_input[1].name = "";
      p_box_input[0].name = "passcode";
  
  var tg = 0;
  function showPassword(){
    tg+=1;
    
   
    if(tg ==1){
      p_box_input[1].value = p_box_input[0].value;
      p_box_input[0].name = "";
      p_box_input[1].name = "passcode";
      eye_closed.style.display = "block";
      eye_open.style.display = "none";
      
    }
    else{
      p_box_input[0].value = p_box_input[1].value;
      p_box_input[1].name = "";
      p_box_input[0].name = "passcode";
      eye_closed.style.display = "none";
      eye_open.style.display = "block";
    }
    

  }
  setInterval(function(){
    if(tg>1){
      p_box[0].style.display = "block";
      p_box[1].style.display = "none";
      
      tg=0;
    }
    if(tg == 0){
      p_box[0].style.display = "block";
      p_box[1].style.display = "none";

      //p_box_input[0].value = p_box_input[1].value;
    }
    else if(tg == 1){
      p_box[1].style.display = "block";
      p_box[0].style.display = "none";
      //p_box_input[1].value = p_box_input[0].value;
    }
  },10);
</script>
</body>
</html>
