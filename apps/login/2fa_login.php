<?php
ob_start();
session_start();


ob_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/cards.css">
    <link rel="icon" type="image/png" href="https://mercelipay.com/assets/images/mercelinous-logo-icon-2.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/heartbeat_animation.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Login To your Account</title>
    <script>
                (function(h,o,t,j,a,r){
                    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                    h._hjSettings={hjid:4977454,hjsv:6};
                    a=o.getElementsByTagName('head')[0];
                    r=o.createElement('script');r.async=1;
                    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                    a.appendChild(r);
                })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
            </script>
</head>
<body>
<?php 
include("../widgets/alert.widget");
include("../widgets/loading2.widget");

showLoading();

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

  include ("autodelete_password_reset_link.php");

}
  //the top nav
?>
<style>
  .borx{
    width:80%;
  }
  @media  screen and(max-width: 600px) {
    .borx{
    width:80%;
  }
  }
</style>

<div class="position-fixed d-flex align-items-start justify-content-center py-5" style="top:0; left:0; width:100%; height: 100%; backdrop-filter: blur(12px); background-color: rgba(0, 0, 0, 0.4);z-index: 100;" tabindex="-1" >
    <div class="rounded bg-white borx" style="height: initial; padding: 2rem 2rem 2rem 2rem;">
        <h3 class="d-flex justify-content-between"><span>2 Factor Authentication (2FA)</span><a href="../login" class="btn btn-close"></a></h3>
        <div >
          <?php
          

// the 2fa authentication
if(!isset($_SESSION["id"])){
    header("location: ../login");
}
//create a file in the user folder
$user_folder = "../users/".$_SESSION["id"]."/transactions/security/2fa.pin";

$user_contenta = file_get_contents($user_folder);
//convet to array
$user_c_aa = explode(",", $user_contenta);

if(isset($_POST['s_answer'])){
  $s_answer = $_POST['s_answer'];

  

  $user_content = file_get_contents($user_folder);
  //convet to array
  $user_c_a = explode(",", $user_content);

  if($s_answer == $user_c_a[1]){
    $success_upload = "successful";
    $_SESSION["logged_in"]="true";
		 $_SESSION["popup_first"] = "true";
  }
  else{
    echo "<p class='text-white bg-danger p-3 text-center w-100'>Wrong Details</p>";
  }
  
}
            
?>

          <br>
          
            <form method="post" action="" class=" flex-column gap-3" enctype="multipart/form-data" style="<?php if(isset($success_upload)){echo 'display: none';}else{echo 'display: flex';} ?>">
              <hr>
              <span style="position: relative; top:-30px" class="px-3 py-2 bg-white text-secondary">Write Your Security Answer</span>
              
                <label class="fw-bold"><?php echo $user_c_aa[0]; ?></label>
                
                
                <label>Your Answer</label>
                <input <?php if(isset($_POST["s_answer"])){echo "value=".$_POST["s_answer"];} ?> name="s_answer" class="border border-2 border-succeess rounded p-2 fs-3" type="text" required>
                
                  
                  <button type="submit" class="btn btn-success btn-lg shadow w-100">Login</button>

                  
            </form>

            
            <section style="position: relative; top:0px; left:0px; width:100%; height: 100%; background: white;<?php if(isset($success_upload)){echo 'display: flex';}else{echo 'display: none';} ?>">
              <div style="display: flex;flex-direction: column; align-items: center; justify-content: center; width: 100%; gap: 3rem" class="px-3 py-3">
                <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                <p class="text-center">Login Successful<br><br><b>Loading ...</b><br><?php spinner('50px'); ?></p>
                <?php if(isset($success_upload)){
                    echo "<script>
                    var timmer = 0;
                    setInterval(function(){
                        timmer++;
                        if(timmer > 50){
                            location.replace('../dashboard/home');
                        }
                    }, 10);
                    
                </script>";
                }
                ?>
              </div>
            </section>
        </div>
    </div>
</div>



</body>
</html>
