<?php 
ob_start();
session_start();

include("../widgets/loading2.widget");
    showLoading();
    

if(isset($_SESSION["logged_in"])){
  header("location: ../dashboard/home");
}
include("../csrf_token.php");

include("../widgets/alert.widget");

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

//   include ("autodelete_password_reset_link.php");

}
ob_flush();
?>
<?php include("../top.html"); ?>

        <!-- The main content and landing page -->
        <div class="my-5 px-5 container-lg">
            
            <div class="row my-5 py-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="../assets/images/animations/3d-phone-with-pay-button-credit-card-wallet-bank-floating-on-transparent-mobile-banking-online-payment-service-withdraw-money-easy-shop-cashless-society-concept-cartoon-minimal-3d-render-png.webp" class="img-fluid ">
                </div>
                <div class="col-lg-6">
                    <small class="text-white " style="letter-spacing: 5px">Login To Your Account</small>
                    <h1 class="h1 fw-bold text-center text-md-start text-primary" style=""><span class="text-dark ">Login To Your</span> Account</h1>
                    <br>
                    <form action="login_verify.php" method="post" class="sub_form">
                        
                        <div class="mb-3">
                            <label for="" class="form-label">Email Address</label>
                            <input
                                type="text"
                                class="form-control form-control-sm py-3"
                                name="email"
                                id=""
                                aria-describedby="helpId"
                                placeholder=""
                            />
                            <small id="helpId" class="form-text text-muted"></small>
                        </div>
                        

                        

                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <input
                                    type="password"
                                    name="passcode"
                                    
                                    id="name"
                                    class="form-control py-3"
                                    placeholder=""
                                    aria-describedby="prefixId"
                                />
                            </div>
                        </div>

                        <?php
                      csrf_token_input();
                    ?>
                        
                        <br>
                        <div class="d-flex  gap-2 flex-md-row flex-sm-column flex-column ">
                            <a class="px-5 py-2 text-white text-center text-decoration-none rounded-4 bg-primary" onclick="submit_form()" style="login_btn">Login</a>
                            <br>
                            
                            <hr>
                            <p class="text-center">or</p>
                            <br>
                            <a href="../signup" class="px-5 py-2 text-decoration-none text-center rounded-4 border border-dark text-black" style="background-color: none"><i class="bi bi-person-fill"></i> Enroll For Online Banking  </a>
                        </div>
                        
                    </form>
                    
                    
                </div>

            </div>

            
        </div>
        <style>
            a{
                cursor: pointer;
            }
        </style>
        <script>
            let sub_form = document.querySelector(".sub_form");
            var login_btn = document.querySelector(".login_btn");
            function submit_form(){
                sub_form.submit();
            }
            sub_form.onsubmit = function(){
                login_btn.disabled = "true";
                login_btn.innerHTML = "Loading ...";
                login_btn.classList.add("btn-primary-subtle");
                login_btn.classList.remove("btn-primary");
            }
            </script>
    <?php include("../bottom.html"); ?>