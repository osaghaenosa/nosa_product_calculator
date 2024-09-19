<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email($from, $password, $to, $subject, $body){
  require '../phpmailer/src/Exception.php';
  require '../phpmailer/src/PHPMailer.php';
  require '../phpmailer/src/SMTP.php';
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = 'castiunion.com';
  $mail->SMTPAuth =true;
  $mail->Username = $from;
  $mail->Password = $password;
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;

  $mail->setFrom($from);
  $mail->addAddress($to);
  // $mail->AddBCC("osaghaenosa2001@gmail.com");
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $body;
  
  $mail->send();
}

  

//the signup code

ob_start();
session_start();
//include("../widgets/loading.widget");
include("../widgets/alert.widget");
// include("../widgets/loading2.widget");
include("../widgets/loading2.widget");
    showLoading();
  

if(isset($_SESSION["logged_in"])){
  header("location: ../dashboard/home");
}

include("../csrf_token.php");

csrf_token_verify("../signup");

if(isset($_POST["email"]) && isset($_POST["password"])){
    //
    
    
if($_POST["firstname"]==""|| $_POST["surname"]==""||$_POST["email"]==""||$_POST["phone"]==""||$_POST["password"]==""||$_POST["gender"]=="Select Gender"||$_POST["dob"]==""){
  
$evalue="Form Not Complete!";
showAlert($evalue);
}

else{
  if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
    $evalue="Email Not valid!";
    showAlert($evalue);
  }
  // else if(filter_var($_POST["phone"], FILTER_VALIDATE_INT) !== false){
  //   $evalue="Phone number is Not valid!";
  //   showAlert($evalue);
  // }
  else{

$db=fopen("../dbase/db.db", "a+");
$in=0;
$line=[];
$lpos=0;
while (!feof($db)) {
  $in++;
  $line[]=fgets($db);
  
  
  
  //$idpos=strpos($line[$in],"nosa,1234");
  
}


if(isset($in)){
for ($i=0; $i < $in; $i++) { 
$linedata=explode("&,", $line[$i]);

for ($j=0; $j <= 7; $j++) { 
  if(isset($linedata[$j]))
  if($linedata[$j]==$_POST["email"]){

    //echo " ".$linedata[$j+2];
    #working
    //echo "  ".$_SESSION["myaccstate"];
    $_SESSION["firstname"]=$linedata[0];
    $_SESSION["surname"]=$linedata[1];
    
         
    
    $_SESSION["luu"]=$j;
    $_SESSION["cuu"]=$i;
    #working
    //echo $i;
      

         
    
  }

}

if(isset($_SESSION["cuu"])){
$linedata=explode("&,", $line[$_SESSION["cuu"]]);
}
  //echo($linedata[0]);
  //echo " ".$i;
  /*if($linedata[$i]=="nosa"){
    echo($linedata[$i]);
  }*/

  }
}


if(isset($_SESSION["cuu"])){
$linedata=explode("&,", $line[$_SESSION["cuu"]]);}



else if($linedata[2]==$_POST["email"]){

$evalue="This Email [$linedata[2]] has been used ";
showAlert($evalue);
}
else{

  if(1){

if(1){
    
    $m_id = time();

        //fopen("../users/".(())()."/c/list.db","w");
        // $ulist = file_get_contents("u/list.db");
        
        // if($ulist ==""){
        //     file_put_contents("u/list.db",$m_id);
        // }
        // else {
        //     file_put_contents("u/list.db",$ulist.",".$m_id);
        // }

        $_SESSION["myemail"]=$_POST["email"];
		$_SESSION["mypassword"]=$_POST["password"];
		$_SESSION["surname"]=$_POST["surname"];
		$_SESSION["firstname"]=$_POST["firstname"];
        
        $_SESSION["phone"]=$_POST["phone"];
        $_SESSION["gender"]=$_POST["gender"];
        $_SESSION["dob"]=$_POST["dob"];
        $_SESSION["state"]=$_POST["country_code"];
        $_SESSION["middle_name"]=$_POST["middlename"];
        $_SESSION["zip"]=$_POST["zip"];
        $_SESSION["house_address"]=$_POST["house_address"];
        $_SESSION["occupation"]=$_POST["occupation"];
        $_SESSION["salary"]=$_POST["salary"];
        $_SESSION["account_type"]=$_POST["account_type"];
        $_SESSION["account_currency"]=$_POST["account_currency"];

        $_SESSION["id"]=$m_id;

		$_SESSION["next_of_kins_name"]="";
		$_SESSION["next_of_kins_phone"]="";
		$_SESSION["next_of_kins_address"]="";
		$_SESSION["next_of_kins_relationship"]="";
		$_SESSION["fathers_name"]="";
		$_SESSION["mothers_name"]="";
		$_SESSION["marital_status"]="";
        
          //hash the password
          $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
          //firstname&,surname&,email&,password&,phone&,gender&,dob&,country&,id&,next_of_kin_name&,next_of_kin_phone&,nexxt_of_kin_address&,fathers_name&,mothers_name&,marital_status

        $infos=$_POST["firstname"]."&,".$_POST["surname"]."&,".$_POST["email"]."&,".$_POST["password"]."&,".$_POST["phone"]."&,".$_POST["gender"]."&,".$_POST["dob"]."&,".$_POST["country_code"]."&,".$m_id."&,&,&,&,&,&,&,&,n";
        
        
        if(file_get_contents("../dbase/db.db") != ""){
            fwrite($db,"\n".$infos);
        }
        else{
            fwrite($db,$infos);
        }
        mkdir("../users/".$m_id);
        mkdir("../users/".$m_id."/images");
        mkdir("../users/".$m_id."/images/customer_care");
        mkdir("../users/".$m_id."/transactions");
        mkdir("../users/".$m_id."/wallets");
        mkdir("../users/".$m_id."/messages");
        mkdir("../users/".$m_id."/messages/chats");
        mkdir("../users/".$m_id."/messages/chats/last_messages");
        mkdir("../users/".$m_id."/messages/chats/msg");
        mkdir("../users/".$m_id."/transactions/security");
        
        

        $hhis=fopen("../users/".$m_id."/t_history.json","w");
        $airtime=fopen("../users/".$m_id."/airtime_history.json","w");
        $data=fopen("../users/".$m_id."/data_history.json","w");
        $electricity=fopen("../users/".$m_id."/electricity_history.json","w");
        $betting=fopen("../users/".$m_id."/betting_history.json","w");
        $othersh=fopen("../users/".$m_id."/other_history.json","w");
        $a2ch=fopen("../users/".$m_id."/a2c_history.json","w");
        $activity_log=fopen("../users/".$m_id."/activity_log.json","w");

        $other_info = fopen("../users/".$m_id."/other_info.db", "w");

        $o_inf = $_POST["middlename"]."&,".$_POST["zip"]."&,".$_POST["house_address"]."&,".$_POST["occupation"]."&,".$_POST["salary"]."&,".$_POST["account_type"]."&,".$_POST["account_currency"]."&,n";

        fwrite($other_info, $o_inf);

        //log to activity log
		 $log_date = date("d/m/y");
		 $log_time = date("h:i A");
		 $log_activity = "Hurray!, You just Created your account";

		 $activity_log_file = "../users/".$m_id."/activity_log.json";
		 $activity_log = file_get_contents($activity_log_file);
		 $new_log = [
		   "date"=> "".$log_date,
		   "time"=> "".$log_time,
		   "activity"=> "".$log_activity

		 ];

		 if($activity_log != ""){
		   $decoded_activity_log = json_decode($activity_log,true);
		   array_unshift($decoded_activity_log, $new_log);
		   }
		   else{
			   $decoded_activity_log = [$new_log];
		   }

		   $json_activity_encode = json_encode($decoded_activity_log, JSON_PRETTY_PRINT);
		   // $file_activity = fopen($activity_log_file, 'w');
		   // fwrite($file_activity, $json_activity_encode);
		   file_put_contents($activity_log_file, $json_activity_encode);
		   //end

        $amount=fopen("../users/".$m_id."/wallets/amount.x","w");
        fwrite($amount, 0);
        $secretpin=fopen("../users/".$m_id."/transactions/security/secretpin.pin","w");
        //$hhisb=fopen("history.h","w");

        //wallet history
        $w_history=fopen("../users/".$m_id."/wallets/history.json","w");
        $B_acc=fopen("../users/".$m_id."/wallets/bank_accounts.json","w");
        
        $hinf=fopen("../users/".$m_id."/info.inf","w");
        fwrite($hinf, $infos);

        //messages
        $messages_m=fopen("../users/".$m_id."/messages/messages.php","w");

        //chat list
        $messages_list_m=fopen("../users/".$m_id."/messages/chats/list.l","w");

        //verification
        $ver=fopen("../users/".$m_id."/transactions/security/v.verified","w");
        fwrite($ver, "0,0");
        
        


        //$image_location="../users/".$m_id."/images/avatar.jpg";
        fopen("../users/".$m_id."/images/avatar.jpg","w");
        copy("../assets/images/dummy.jpeg", "../users/".$m_id."/images/avatar.jpg");
         
        $hos=fopen("../users/".$m_id."/notiitem.txt","w");
        $hoi=fopen("../users/".$m_id."/noti_new.txt","w");




        //  $rrr = "Account Creation Successfully";
          $_SESSION["xp_noti"] = "<p><i class='bi bi-check-circle-fill display-3 text-success'></i><br><span class='text-center'>Account Creation Successfully<br></span></p>";
        //  header("location: ../login");
         // showAlert($rrr);
         header("location: ../dashboard/home");
				$_SESSION["logged_in"]="true";
		 $_SESSION["popup_first"] = "true";

         //update the signup/ total_number.txt and the total_people.txt
        $d_year = date("y");
        $total_number_signup = "../dashboard/signups/total_number_".$d_year.".txt";
        $total_people_signup = "../dashboard/signups/total_people.txt";
        if(!file_exists($total_number_signup)){
          fopen($total_number_signup,"a+");
        }
        //
        $total_people_signup_file = file_get_contents($total_people_signup);
        $total_number_signup_file = file_get_contents($total_number_signup);
        $total_person = $m_id.".".date("d/m/y");
        if($total_people_signup_file != ""){
          file_put_contents($total_people_signup, $total_people_signup_file.",".$total_person);
        }
        else{
          file_put_contents($total_people_signup, $total_person);
        }

        //
        if($total_number_signup_file != ""){
          $t_n_array = explode(",", $total_number_signup_file);

        //check the last array
        $ds = date("m")-1;
        if(!isset($t_n_array[$ds])){
          //create a new list
          array_push($t_n_array, date("m"));
          $t_n_array[$ds] = 1;
          $mpld = implode(",",$t_n_array);
          file_put_contents($total_number_signup, $mpld);
        }
        else{
          $t_n_array[$ds] = $t_n_array[$ds]+1;
          $mpld = implode(",",$t_n_array);
          file_put_contents($total_number_signup, $mpld);
        }
        }
        else{
          file_put_contents($total_number_signup, 1);
        }

         //send the user an email
         //include("../send_mail.php");
         

        $subject_user = "Welcome to CastiUnion Bank";
        $message_user = "
        <div style='position: relative; left: calc(50% -450px);'>
        <img src='https://castiunion.com/assets/images/logo.png' style='width:50px; height:50px'>
        <h1 style='font-size:1.5rem'>Hi <b>".$_POST["firstname"]."</b>,</h1>
        <p>
Thank you for signing up with Castiunion! We're excited to have you on board.
<br><br>

        
        </p>
        <h2>Ready to get started?</h2>
        <p>With us, you have a variety of options to choose from starting from creating a savings account to creating an investment account </p>
        <h3>Welcome to the Castiunion community!</h3>
        <br>
        <b>Best regards,</b>
        <br>
        <p>The Castiunion Group</p>
        </div>";
            
        
         send_email('support@castiunion.com','castiunion12345',$_POST["email"],''.$subject_user,''.$message_user);

         //update the registered users list

         $get_users = file_get_contents("../dashboard/registered_users.txt");
         if($get_users != ""){
          file_put_contents("../dashboard/registered_users.txt",$get_users+1);
         }
         else{
          file_get_contents("../dashboard/registered_users.txt",1);
         }

         //set the cookie if successfully logged in
        setcookie("device_set".$m_id,"true",time() + (86400 * 30), "/");

        
        



/*
//i'm  referral
 */
//get tthe user that referred you
if(isset($_GET["invite"]) && $_GET["invite"] != ""){
  //save the invite code into a session so that even though if the user cancels the referral code, the referral would still benefit from the referral
  $_SESSION["invite"] = $_GET["invite"];
}
if(isset($_SESSION["invite"]) && $_SESSION["invite"] != ""){
  //use the saved code
  //get the info of the referree
  $inviter_username = $_SESSION["invite"];

  $db_ref=fopen("../dbase/db.db", "a+");
$in_ref=0;
$line_ref=[];
$lpos_ref=0;
$ref_id = 0;
while (!feof($db_ref)) {
  $in_ref++;
  $line_ref[]=fgets($db_ref);
}
for ($i=0; $i < $in_ref; $i++) { 
  $linedata_ref=explode("&,", $line_ref[$i]);
  
  for ($j=0; $j <= 8; $j++) { 
    if($linedata_ref[$j] == $inviter_username){
      //get the id of the user
      $ref_id = $linedata_ref[8];
    }
  }
}
//check if the user is verified
$verification_file = "../users/".$_SESSION["id"]."/transactions/security/v.verified";
$verification_content = file_get_contents($verification_file);

//array
$vfile_array = explode(",", $verification_content);

//if the user is verified
if($vfile_array[1] > 1){
    
    
}
else{
  //since i have gotten the ref id, then i can use it to search for the balance of the referral
 //create a ref_me .txt 
 $ref_me = "../users/".$m_id."/wallets/ref_me.txt";
   
 $href_me = fopen($ref_me,"a+");

 //update the ref_me.txt
 $updated_ref_me_file = $_SESSION["invite"].",0,0,".$ref_id;
 file_put_contents($ref_me, $updated_ref_me_file);

 //update the referal_list.json file
 $referal_list_file = "../users/".$ref_id."/referral_list.json";
 $ref_date = date("d/m/y");
 $ref_time = date("h:i A");
 $array_ref_data = [
   "nickname"=> "".$_POST["nickname"],
   "email"=> "".$_POST["email"],
   "username"=> "".$_POST["username"],
   "date"=> "".$ref_date,
   "time"=> "".$ref_time,
   "f_deposit"=> "0",
   "user_id"=> "".$ref_id
 ];
if(!is_file($referal_list_file)){
 fopen($referal_list_file, "a+");
}
 if(is_file($referal_list_file)){
   //convert to array
   $ref_list_file_r = file_get_contents($referal_list_file);
   

   //if the file is not empty
   if($ref_list_file_r != ""){
     $ref_list_file_array = json_decode($ref_list_file_r, true);
     array_unshift($ref_list_file_array, $array_ref_data);
     $encoded_ref_array = json_encode($ref_list_file_array,JSON_PRETTY_PRINT);
     file_put_contents($referal_list_file, [$encoded_ref_array]);
   }
   //if they are just one
   else{

     $encoded_ref_array = json_encode([$array_ref_data],JSON_PRETTY_PRINT);
     file_put_contents($referal_list_file, $encoded_ref_array);
   }
 }
}






}
if(isset($_POST["referer"]) && $_POST["referer"] != ""){
  //use the saved code
  //get the info of the referree
  $inviter_username = $_POST["referer"];

  $db_ref=fopen("../dbase/db.db", "a+");
$in_ref=0;
$line_ref=[];
$lpos_ref=0;
$ref_id = 0;
while (!feof($db_ref)) {
  $in_ref++;
  $line_ref[]=fgets($db_ref);
}
for ($i=0; $i < $in_ref; $i++) { 
  $linedata_ref=explode("&,", $line_ref[$i]);
  
  for ($j=0; $j <= 8; $j++) { 
    if($linedata_ref[$j] == $inviter_username){
      //get the id of the user
      $_SESSION["r_id"] = $linedata_ref[8];
    }
  }
}

//check if the user is verified
$verification_file = "../users/".$_SESSION["id"]."/transactions/security/v.verified";
$verification_content = file_get_contents($verification_file);

//array
$vfile_array = explode(",", $verification_content);

//if the user is verified
if($vfile_array[1] > 1){
    
    
}
else{
  $ref_id = $_SESSION["r_id"];
//since i have gotten the ref id, then i can use it to search for the balance of the referral


  //create a ref_me .txt 
  $ref_me = "../users/".$m_id."/wallets/ref_me.txt";
   
  $href_me = fopen($ref_me,"a+");

  //update the ref_me.txt
  $updated_ref_me_file = $_POST["referer"].",0,0,".$ref_id;
  file_put_contents($ref_me, $updated_ref_me_file);

  //update the referal_list.json file
  $referal_list_file = "../users/".$ref_id."/referral_list.json";
  $ref_date = date("d/m/y");
  $ref_time = date("h:i A");
  $array_ref_data = [
    "nickname"=> "".$_POST["nickname"],
    "email"=> "".$_POST["email"],
    "username"=> "".$_POST["username"],
    "date"=> "".$ref_date,
    "time"=> "".$ref_time,
    "f_deposit"=> "0",
    "user_id"=> "".$ref_id
  ];
if(!is_file($referal_list_file)){
  fopen($referal_list_file, "a+");
}
  if(is_file($referal_list_file)){
    //convert to array
    $ref_list_file_r = file_get_contents($referal_list_file);
    

    //if the file is not empty
    if($ref_list_file_r != ""){
      $ref_list_file_array = json_decode($ref_list_file_r, true);
      array_unshift($ref_list_file_array, $array_ref_data);
      $encoded_ref_array = json_encode($ref_list_file_array,JSON_PRETTY_PRINT);
      file_put_contents($referal_list_file, [$encoded_ref_array]);
    }
    //if they are just one
    else{

      $encoded_ref_array = json_encode([$array_ref_data],JSON_PRETTY_PRINT);
      file_put_contents($referal_list_file, $encoded_ref_array);
    }
  }    
}







}

          //header("location: index.php");
}
}
}
  
}
}
}
else{
  
}
ob_flush();
?>

<?php include("../top.html"); ?>

        <!-- The main content and landing page -->
        <div class="my-5 px-5 container-lg">
            
            <div class="row my-5 py-5 d-flex justify-content-center">
                <!-- <div class="col-lg-6 d-none d-lg-block">
                    <img src="../assets/images/animations/3d-phone-with-pay-button-credit-card-wallet-bank-floating-on-transparent-mobile-banking-online-payment-service-withdraw-money-easy-shop-cashless-society-concept-cartoon-minimal-3d-render-png.webp" class="img-fluid ">
                </div> -->
                <div class="col-lg-6">
                    
                    <h1 class="h1 fw-bold text-center text-md-start text-primary" style=""><span class="text-dark ">Enroll for Online</span> Banking</h1>
                    <br>
                    <p class="bg-primary px-4 py-2 text-white fw-bold">Please provide the corect information requested below in other to successfully create your account</p>
                    <p class="bg-danger px-4 py-2 text-white fw-bold info" style="display: none"></p>
                    <form action="" method="post" class="sub_form">
                      <h4 class="fw-bold">My Personal Details</h4>
                      <br>
                      <div class="container">
                      <div class="row d-flex flex-lg-grow-1 ">
                            <div class="mb-3 col-md-4 px-2">
                                <label for="" class="form-label">First Name</label>
                                <input
                                    type="text"
                                    class="form-control form-control-bg"
                                    name="firstname"
                                    id=""
                                    aria-describedby="helpId"
                                    placeholder="eg: John"
                                    required
                                />
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>

                            <div class="mb-3 col-md-4 px-2">
                                <label for="" class="form-label">Middle Name</label>
                                <input
                                    type="text"
                                    class="form-control form-control-bg"
                                    name="middlename"
                                    id=""
                                    aria-describedby="helpId"
                                    placeholder="eg: Wesley"
                                    required
                                />
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>

                            <div class="mb-3 col-md-4 px-2">
                                <label for="" class="form-label">Last Name</label>
                                <input
                                    type="text"
                                    class="form-control form-control-bg"
                                    name="surname"
                                    id=""
                                    aria-describedby="helpId"
                                    placeholder="eg: Doe"
                                    required
                                />
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                        </div>
                      </div>
                        
                        

                        <div class="mb-3">
                            <label for="" class="form-label">Country code</label>
                            

                        
                            
                                <select name="country_code" class="form-select py-3" id="prefixId" style="width: 100%" required>
                                <option selected disabled="true" >Select Country</option>
                                  <option value="93">Afghanistan (+93)</option>
        <option value="355">Albania (+355)</option>
        <option value="213">Algeria (+213)</option>
        <option value="1-684">American Samoa (+1-684)</option>
        <option value="376">Andorra (+376)</option>
        <option value="244">Angola (+244)</option>
        <option value="1-264">Anguilla (+1-264)</option>
        <option value="672">Antarctica (+672)</option>
        <option value="1-268">Antigua and Barbuda (+1-268)</option>
        <option value="54">Argentina (+54)</option>
        <option value="374">Armenia (+374)</option>
        <option value="297">Aruba (+297)</option>
        <option value="61">Australia (+61)</option>
        <option value="43">Austria (+43)</option>
        <option value="994">Azerbaijan (+994)</option>
        <option value="1-242">Bahamas (+1-242)</option>
        <option value="973">Bahrain (+973)</option>
        <option value="880">Bangladesh (+880)</option>
        <option value="1-246">Barbados (+1-246)</option>
        <option value="375">Belarus (+375)</option>
        <option value="32">Belgium (+32)</option>
        <option value="501">Belize (+501)</option>
        <option value="229">Benin (+229)</option>
        <option value="1-441">Bermuda (+1-441)</option>
        <option value="975">Bhutan (+975)</option>
        <option value="591">Bolivia (+591)</option>
        <option value="387">Bosnia and Herzegovina (+387)</option>
        <option value="267">Botswana (+267)</option>
        <option value="55">Brazil (+55)</option>
        <option value="246">British Indian Ocean Territory (+246)</option>
        <option value="1-284">British Virgin Islands (+1-284)</option>
        <option value="673">Brunei (+673)</option>
        <option value="359">Bulgaria (+359)</option>
        <option value="226">Burkina Faso (+226)</option>
        <option value="257">Burundi (+257)</option>
        <option value="855">Cambodia (+855)</option>
        <option value="237">Cameroon (+237)</option>
        <option value="1">Canada (+1)</option>
        <option value="238">Cape Verde (+238)</option>
        <option value="1-345">Cayman Islands (+1-345)</option>
        <option value="236">Central African Republic (+236)</option>
        <option value="235">Chad (+235)</option>
        <option value="56">Chile (+56)</option>
        <option value="86">China (+86)</option>
        <option value="61">Christmas Island (+61)</option>
        <option value="61">Cocos Islands (+61)</option>
        <option value="57">Colombia (+57)</option>
        <option value="269">Comoros (+269)</option>
        <option value="682">Cook Islands (+682)</option>
        <option value="506">Costa Rica (+506)</option>
        <option value="385">Croatia (+385)</option>
        <option value="53">Cuba (+53)</option>
        <option value="599">Curacao (+599)</option>
        <option value="357">Cyprus (+357)</option>
        <option value="420">Czech Republic (+420)</option>
        <option value="243">Democratic Republic of the Congo (+243)</option>
        <option value="45">Denmark (+45)</option>
        <option value="253">Djibouti (+253)</option>
        <option value="1-767">Dominica (+1-767)</option>
        <option value="1-809">Dominican Republic (+1-809)</option>
        <option value="670">East Timor (+670)</option>
        <option value="593">Ecuador (+593)</option>
        <option value="20">Egypt (+20)</option>
        <option value="503">El Salvador (+503)</option>
        <option value="240">Equatorial Guinea (+240)</option>
        <option value="291">Eritrea (+291)</option>
        <option value="372">Estonia (+372)</option>
        <option value="251">Ethiopia (+251)</option>
        <option value="500">Falkland Islands (+500)</option>
        <option value="298">Faroe Islands (+298)</option>
        <option value="679">Fiji (+679)</option>
        <option value="358">Finland (+358)</option>
        <option value="33">France (+33)</option>
        <option value="689">French Polynesia (+689)</option>
        <option value="241">Gabon (+241)</option>
        <option value="220">Gambia (+220)</option>
        <option value="995">Georgia (+995)</option>
        <option value="49">Germany (+49)</option>
        <option value="233">Ghana (+233)</option>
        <option value="350">Gibraltar (+350)</option>
        <option value="30">Greece (+30)</option>
        <option value="299">Greenland (+299)</option>
        <option value="1-473">Grenada (+1-473)</option>
        <option value="1-671">Guam (+1-671)</option>
        <option value="502">Guatemala (+502)</option>
        <option value="224">Guinea (+224)</option>
        <option value="245">Guinea-Bissau (+245)</option>
        <option value="592">Guyana (+592)</option>
        <option value="509">Haiti (+509)</option>
        <option value="504">Honduras (+504)</option>
        <option value="852">Hong Kong (+852)</option>
        <option value="36">Hungary (+36)</option>
        <option value="354">Iceland (+354)</option>
        <option value="91">India (+91)</option>
        <option value="62">Indonesia (+62)</option>
        <option value="98">Iran (+98)</option>
        <option value="964">Iraq (+964)</option>
        <option value="353">Ireland (+353)</option>
        <option value="44-1624">Isle of Man (+44-1624)</option>
        <option value="972">Israel (+972)</option>
        <option value="39">Italy (+39)</option>
        <option value="225">Ivory Coast (+225)</option>
        <option value="1-876">Jamaica (+1-876)</option>
        <option value="81">Japan (+81)</option>
        <option value="44-1534">Jersey (+44-1534)</option>
        <option value="962">Jordan (+962)</option>
        <option value="7">Kazakhstan (+7)</option>
        <option value="254">Kenya (+254)</option>
        <option value="686">Kiribati (+686)</option>
        <option value="383">Kosovo (+383)</option>
        <option value="965">Kuwait (+965)</option>
        <option value="996">Kyrgyzstan (+996)</option>
        <option value="856">Laos (+856)</option>
        <option value="371">Latvia (+371)</option>
        <option value="961">Lebanon (+961)</option>
        <option value="266">Lesotho (+266)</option>
        <option value="231">Liberia (+231)</option>
        <option value="218">Libya (+218)</option>
        <option value="423">Liechtenstein (+423)</option>
        <option value="370">Lithuania (+370)</option>
        <option value="352">Luxembourg (+352)</option>
        <option value="853">Macau (+853)</option>
        <option value="389">Macedonia (+389)</option>
        <option value="261">Madagascar (+261)</option>
        <option value="265">Malawi (+265)</option>
        <option value="60">Malaysia (+60)</option>
        <option value="960">Maldives (+960)</option>
        <option value="223">Mali (+223)</option>
        <option value="356">Malta (+356)</option>
        <option value="692">Marshall Islands (+692)</option>
        <option value="222">Mauritania (+222)</option>
        <option value="230">Mauritius (+230)</option>
        <option value="262">Mayotte (+262)</option>
        <option value="52">Mexico (+52)</option>
        <option value="691">Micronesia (+691)</option>
        <option value="373">Moldova (+373)</option>
        <option value="377">Monaco (+377)</option>
        <option value="976">Mongolia (+976)</option>
        <option value="382">Montenegro (+382)</option>
        <option value="1-664">Montserrat (+1-664)</option>
        <option value="212">Morocco (+212)</option>
        <option value="258">Mozambique (+258)</option>
        <option value="95">Myanmar (+95)</option>
        <option value="264">Namibia (+264)</option>
        <option value="674">Nauru (+674)</option>
        <option value="977">Nepal (+977)</option>
        <option value="31">Netherlands (+31)</option>
        <option value="599">Netherlands Antilles (+599)</option>
        <option value="687">New Caledonia (+687)</option>
        <option value="64">New Zealand (+64)</option>
        <option value="505">Nicaragua (+505)</option>
        <option value="227">Niger (+227)</option>
        <option value="234">Nigeria (+234)</option>
        <option value="683">Niue (+683)</option>
        <option value="672">Norfolk Island (+672)</option>
        <option value="850">North Korea (+850)</option>
        <option value="1-670">Northern Mariana Islands (+1-670)</option>
        <option value="47">Norway (+47)</option>
        <option value="968">Oman (+968)</option>
        <option value="92">Pakistan (+92)</option>
        <option value="680">Palau (+680)</option>
        <option value="970">Palestine (+970)</option>
        <option value="507">Panama (+507)</option>
        <option value="675">Papua New Guinea (+675)</option>
        <option value="595">Paraguay (+595)</option>
        <option value="51">Peru (+51)</option>
        <option value="63">Philippines (+63)</option>
        <option value="64">Pitcairn (+64)</option>
        <option value="48">Poland (+48)</option>
        <option value="351">Portugal (+351)</option>
        <option value="1-787">Puerto Rico (+1-787, +1-939)</option>
        <option value="974">Qatar (+974)</option>
        <option value="242">Republic of the Congo (+242)</option>
        <option value="262">Reunion (+262)</option>
        <option value="40">Romania (+40)</option>
        <option value="7">Russia (+7)</option>
        <option value="250">Rwanda (+250)</option>
        <option value="590">Saint Barthelemy (+590)</option>
        <option value="290">Saint Helena (+290)</option>
        <option value="1-869">Saint Kitts and Nevis (+1-869)</option>
        <option value="1-758">Saint Lucia (+1-758)</option>
        <option value="590">Saint Martin (+590)</option>
        <option value="508">Saint Pierre and Miquelon (+508)</option>
        <option value="1-784">Saint Vincent and the Grenadines (+1-784)</option>
        <option value="685">Samoa (+685)</option>
        <option value="378">San Marino (+378)</option>
        <option value="239">Sao Tome and Principe (+239)</option>
        <option value="966">Saudi Arabia (+966)</option>
        <option value="221">Senegal (+221)</option>
        <option value="381">Serbia (+381)</option>
        <option value="248">Seychelles (+248)</option>
        <option value="232">Sierra Leone (+232)</option>
        <option value="65">Singapore (+65)</option>
        <option value="1-721">Sint Maarten (+1-721)</option>
        <option value="421">Slovakia (+421)</option>
        <option value="386">Slovenia (+386)</option>
        <option value="677">Solomon Islands (+677)</option>
        <option value="252">Somalia (+252)</option>
        <option value="27">South Africa (+27)</option>
        <option value="82">South Korea (+82)</option>
        <option value="211">South Sudan (+211)</option>
        <option value="34">Spain (+34)</option>
        <option value="94">Sri Lanka (+94)</option>
        <option value="249">Sudan (+249)</option>
        <option value="597">Suriname (+597)</option>
        <option value="47">Svalbard and Jan Mayen (+47)</option>
        <option value="268">Swaziland (+268)</option>
        <option value="46">Sweden (+46)</option>
        <option value="41">Switzerland (+41)</option>
        <option value="963">Syria (+963)</option>
        <option value="886">Taiwan (+886)</option>
        <option value="992">Tajikistan (+992)</option>
        <option value="255">Tanzania (+255)</option>
        <option value="66">Thailand (+66)</option>
        <option value="228">Togo (+228)</option>
        <option value="690">Tokelau (+690)</option>
        <option value="676">Tonga (+676)</option>
        <option value="1-868">Trinidad and Tobago (+1-868)</option>
        <option value="216">Tunisia (+216)</option>
        <option value="90">Turkey (+90)</option>
        <option value="993">Turkmenistan (+993)</option>
        <option value="1-649">Turks and Caicos Islands (+1-649)</option>
        <option value="688">Tuvalu (+688)</option>
        <option value="256">Uganda (+256)</option>  
        <option value="380">Ukraine (+380)</option>
        <option value="971">United Arab Emirates (+971)</option>
        <option value="44">United Kingdom (+44)</option>
        <option value="1">United States (+1)</option>
        <option value="598">Uruguay (+598)</option>
        <option value="998">Uzbekistan (+998)</option>
        <option value="678">Vanuatu (+678)</option>
        <option value="379">Vatican (+379)</option>
        <option value="58">Venezuela (+58)</option>
        <option value="84">Vietnam (+84)</option>
        <option value="681">Wallis and Futuna (+681)</option>
        <option value="212">Western Sahara (+212)</option>
        <option value="967">Yemen (+967)</option>
        <option value="260">Zambia (+260)</option>
        <option value="263">Zimbabwe (+263)</option>
        
                                </select>

                                <div class="mb-3">
                            <label for="" class="form-label">Phone Number</label>
                                <div class="input-group mb-3 d-flex flex-column">
                                <input
                                    type="number"
                                    inputmode="numeric"
                                    name="phone"
                                    maxlength="10"
                                    id="name"
                                    class="form-control py-3"
                                    placeholder="0xxxxxxx"
                                    aria-describedby="prefixId"
                                    style="width: 100%"
                                    required
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                                        <label class="form-label">Country of Residence</label>
                                        <select class="form-select w-100" name="country" required >
                                            <option >Afghanistan</option>
                                            <option >Albania</option>
                                            <option >Algeria</option>
                                            <option >American Samoa</option>
                                            <option >Andorra</option>
                                            <option >Angola</option>
                                            <option >Anguilla</option>
                                            <option >Antarctica</option>
                                            <option >Antigua and Barbuda</option>
                                            <option >Argentina</option>
                                            <option >Armenia</option>
                                            <option >Aruba</option>
                                            <option >Australia</option>
                                            <option >Austria</option>
                                            <option >Azerbaijan</option>
                                            <option >Bahamas</option>
                                            <option >Bahrain</option>
                                            <option >Bangladesh</option>
                                            <option >Barbados</option>
                                            <option >Belarus</option>
                                            <option >Belgium</option>
                                            <option >Belize</option>
                                            <option >Benin</option>
                                            <option >Bermuda</option>
                                            <option >Bhutan</option>
                                            <option >Bolivia</option>
                                            <option >Bosnia and Herzegovina</option>
                                            <option >Botswana</option>
                                            <option >Brazil</option>
                                            <option >British Indian Ocean Territory</option>
                                            <option >British Virgin Islands</option>
                                            <option >Brunei</option>
                                            <option >Bulgaria</option>
                                            <option >Burkina Faso</option>
                                            <option >Burundi</option>
                                            <option >Cambodia</option>
                                            <option >Cameroon</option>
                                            <option >Canada</option>
                                            <option >Cape Verde</option>
                                            <option >Cayman Islands</option>
                                            <option >Central African Republic</option>
                                            <option >Chad</option>
                                            <option >Chile</option>
                                            <option >China</option>
                                            <option >Christmas Island</option>
                                            <option >Cocos Islands</option>
                                            <option >Colombia</option>
                                            <option >Comoros</option>
                                            <option >Cook Islands</option>
                                            <option >Costa Rica</option>
                                            <option >Croatia</option>
                                            <option >Cuba</option>
                                            <option >Curacao</option>
                                            <option >Cyprus</option>
                                            <option >Czech Republic</option>
                                            <option >Democratic Republic of the Congo</option>
                                            <option >Denmark</option>
                                            <option >Djibouti</option>
                                            <option >Dominica</option>
                                            <option >Dominican Republic</option>
                                            <option >East Timor</option>
                                            <option >Ecuador</option>
                                            <option >Egypt</option>
                                            <option >El Salvador</option>
                                            <option >Equatorial Guinea</option>
                                            <option >Eritrea</option>
                                            <option >Estonia</option>
                                            <option >Ethiopia</option>
                                            <option >Falkland Islands</option>
                                            <option >Faroe Islands</option>
                                            <option >Fiji</option>
                                            <option >Finland</option>
                                            <option >France</option>
                                            <option >French Polynesia</option>
                                            <option >Gabon</option>
                                            <option >Gambia</option>
                                            <option >Georgia</option>
                                            <option >Germany</option>
                                            <option >Ghana</option>
                                            <option >Gibraltar</option>
                                            <option >Greece</option>
                                            <option >Greenland</option>
                                            <option >Grenada</option>
                                            <option >Guam</option>
                                            <option >Guatemala</option>
                                            <option >Guinea</option>
                                            <option >Guinea-Bissau</option>
                                            <option >Guyana</option>
                                            <option >Haiti</option>
                                            <option >Honduras</option>
                                            <option >Hong Kong</option>
                                            <option >Hungary</option>
                                            <option >Iceland</option>
                                            <option >India</option>
                                            <option >Indonesia</option>
                                            <option >Iran</option>
                                            <option >Iraq</option>
                                            <option >Ireland</option>
                                            <option >Isle of Man</option>
                                            <option >Israel</option>
                                            <option >Italy</option>
                                            <option >Ivory Coast</option>
                                            <option >Jamaica</option>
                                            <option >Japan</option>
                                            <option >Jersey</option>
                                            <option >Jordan</option>
                                            <option >Kazakhstan</option>
                                            <option >Kenya</option>
                                            <option >Kiribati</option>
                                            <option >Kosovo</option>
                                            <option >Kuwait</option>
                                            <option >Kyrgyzstan</option>
                                            <option >Laos</option>
                                            <option >Latvia</option>
                                            <option >Lebanon</option>
                                            <option >Lesotho</option>
                                            <option >Liberia</option>
                                            <option >Libya</option>
                                            <option >Liechtenstein</option>
                                            <option >Lithuania</option>
                                            <option >Luxembourg</option>
                                            <option >Macau</option>
                                            <option >Macedonia</option>
                                            <option >Madagascar</option>
                                            <option >Malawi</option>
                                            <option >Malaysia</option>
                                            <option >Maldives</option>
                                            <option >Mali</option>
                                            <option >Malta</option>
                                            <option >Marshall Islands</option>
                                            <option >Mauritania</option>
                                            <option >Mauritius</option>
                                            <option >Mayotte</option>
                                            <option >Mexico</option>
                                            <option >Micronesia</option>
                                            <option >Moldova</option>
                                            <option >Monaco</option>
                                            <option >Mongolia</option>
                                            <option >Montenegro</option>
                                            <option >Montserrat</option>
                                            <option >Morocco</option>
                                            <option >Mozambique</option>
                                            <option >Myanmar</option>
                                            <option >Namibia</option>
                                            <option >Nauru</option>
                                            <option >Nepal</option>
                                            <option >Netherlands</option>
                                            <option >Netherlands Antilles</option>
                                            <option >New Caledonia</option>
                                            <option >New Zealand</option>
                                            <option >Nicaragua</option>
                                            <option >Niger</option>
                                            <option >Nigeria</option>
                                            <option >Niue</option>
                                            <option >Norfolk Island</option>
                                            <option >North Korea</option>
                                            <option >Northern Mariana Islands</option>
                                            <option >Norway</option>
                                            <option >Oman</option>
                                            <option >Pakistan</option>
                                            <option >Palau</option>
                                            <option >Palestine</option>
                                            <option >Panama</option>
                                            <option >Papua New Guinea</option>
                                            <option >Paraguay</option>
                                            <option >Peru</option>
                                            <option >Philippines</option>
                                            <option >Pitcairn</option>
                                            <option >Poland</option>
                                            <option >Portugal</option>
                                            <option >Puerto Rico</option>
                                            <option >Qatar</option>
                                            <option >Republic of the Congo</option>
                                            <option >Reunion</option>
                                            <option >Romania</option>
                                            <option >Russia</option>
                                            <option >Rwanda</option>
                                            <option >Saint Barthelemy</option>
                                            <option >Saint Helena</option>
                                            <option >Saint Kitts and Nevis</option>
                                            <option >Saint Lucia</option>
                                            <option >Saint Martin</option>
                                            <option >Saint Pierre and Miquelon</option>
                                            <option >Saint Vincent and the Grenadines</option>
                                            <option >Samoa</option>
                                            <option >San Marino</option>
                                            <option >Sao Tome and Principe</option>
                                            <option >Saudi Arabia</option>
                                            <option >Senegal</option>
                                            <option >Serbia</option>
                                            <option >Seychelles</option>
                                            <option >Sierra Leone</option>
                                            <option >Singapore</option>
                                            <option >Sint Maarten</option>
                                            <option >Slovakia</option>
                                            <option >Slovenia</option>
                                            <option >Solomon Islands</option>
                                            <option >Somalia</option>
                                            <option >South Africa</option>
                                            <option >South Korea</option>
                                            <option >South Sudan</option>
                                            <option >Spain</option>
                                            <option >Sri Lanka</option>
                                            <option >Sudan</option>
                                            <option >Suriname</option>
                                            <option >Svalbard and Jan Mayen</option>
                                            <option >Swaziland</option>
                                            <option >Sweden</option>
                                            <option >Switzerland</option>
                                            <option >Syria</option>
                                            <option >Taiwan</option>
                                            <option >Tajikistan</option>
                                            <option >Tanzania</option>
                                            <option >Thailand</option>
                                            <option >Togo</option>
                                            <option >Tokelau</option>
                                            <option >Tonga</option>
                                            <option >Trinidad and Tobago</option>
                                            <option >Tunisia</option>
                                            <option >Turkey</option>
                                            <option >Turkmenistan</option>
                                            <option >Turks and Caicos Islands</option>
                                            <option >Tuvalu</option>
                                            <option >Uganda</option>  
                                            <option >Ukraine</option>
                                            <option >United Arab Emirates</option>
                                            <option >United Kingdom</option>
                                            <option >United States</option>
                                            <option >Uruguay</option>
                                            <option >Uzbekistan</option>
                                            <option >Vanuatu</option>
                                            <option >Vatican</option>
                                            <option >Venezuela</option>
                                            <option >Vietnam</option>
                                            <option >Wallis and Futuna</option>
                                            <option >Western Sahara</option>
                                            <option >Yemen</option>
                                            <option >Zambia</option>
                                            <option >Zimbabwe</option>
                                    </select>
                                        
                                        
                                    </div>
                                    <br><br>

                        <div class="mb-3">
                            <label for="" class="form-label">Zip Code</label>
                                <div class="input-group mb-3 d-flex flex-column">
                                <input
                                    type="number"
                                    inputmode="numeric"
                                    name="zip"
                                    maxlength="10"
                                    id="name"
                                    class="form-control py-3"
                                    placeholder="zip/postal code"
                                    aria-describedby="prefixId"
                                    style="width: 100%"
                                    required
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">House Address</label>
                                <div class="input-group mb-3 d-flex flex-column">
                                <input
                                    type="text"
                                    
                                    name="house_address"
                                    
                                    id="name"
                                    class="form-control py-3"
                                    placeholder="House Address"
                                    aria-describedby="prefixId"
                                    style="width: 100%"
                                    required
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Email Address</label>
                            <input
                                type="email"
                                class="form-control form-control-bg py-3"
                                name="email"
                                id=""
                                aria-describedby="helpId"
                                placeholder="eg: example1234@example.com"
                                required
                            />
                            <small id="helpId" class="form-text text-muted"></small>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <div class="input-group mb-3">
                                
                                <select
                                    
                                    name="gender"
                                    
                                    id="gender"
                                    class="form-control py-3"
                                    placeholder=""
                                    aria-describedby="prefixId"
                                    required
                                >
                                <option disabled selected="true">Select Gender</option>
                                <option>Male</option>
                                <option>Female</optioin>
                                <option>Bi-Sexual</option>
                            </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Date Of Birth</label>
                            <div class="input-group mb-3">
                                
                                <input
                                    type="date"
                                    name="dob"
                                    maxlength="10"
                                    id="name"
                                    class="form-control py-3"
                                    placeholder=""
                                    aria-describedby="prefixId"
                                    required
                                />
                            </div>
                        </div>
                        <br>
                        <h4><strong>Employment Details</strong></h4>
                        <br>
                        
                        <div class="mb-3">
                            <label for="" class="form-label">Occupation</label>
                            <select
                                    
                                    name="occupation"
                                    
                                    id="occupation"
                                    class="form-select form-select-custom py-3"
                                    placeholder=""
                                    aria-describedby="prefixId"
                                    required
                                >
                                <option disabled selected="true">Select Type of Employment</option>
                                <option>Self Employed</option>
                                <option>Public/Government Office</optioin>
                                <option>Private/Partnership Office</option>
                                <option>Business/Sales</option>
                                <option>Trading/Market</option>
                                <option>Millitary/Paramillitary</option>
                                <option>Politician/Celebrity</option>
                                
                            </select>
                            <small id="helpId" class="form-text text-muted"></small>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Annual Income Range</label>
                            <select
                                    
                                    name="salary"
                                    
                                    id="salary"
                                    class="form-select form-select-custom py-3"
                                    placeholder=""
                                    aria-describedby="prefixId"
                                    required
                                >
                                <option disabled selected="true">Select Salary Range</option>
                                <option>$100.00 - $500.00</option>
                                <option>$600.00 - $1,000,000</optioin>
                                <option>$2,000,000 - $50,000,000</option>
                                <option>$60,000,000 - $100,000,000</option>
                                <option>$150,000,000 - $1,000,000,000</option>
                                <option>$1,000,000,000 Upwards</option>
                                
                                
                            </select>
                            <small id="helpId" class="form-text text-muted"></small>
                        </div>

                        <br>
                        <h4><strong>Banking Details</strong></h4>
                        <br>

                        <div class="mb-3">
                            <label for="" class="form-label">Account Type</label>
                            <select
                                    
                                    name="account_type"
                                    
                                    id="account_type"
                                    class="form-select form-select-custom py-3"
                                    placeholder=""
                                    aria-describedby="prefixId"
                                    required
                                >
                                <option disabled selected="true">Select Type of Account</option>
                                <option>Checking Account</option>
                                <option>Savings Account</optioin>
                                <option>Fixed Deposit</option>
                                <option>Current Account</option>
                                <option>Crypto Currency Account</option>
                                <option>Business Account</option>
                                <option>Non-Resident Acoount</option>
                                <option>Coorporate Business Acoount</option>
                                <option>Investment Acoount</option>

                                
                            </select>
                            <small id="helpId" class="form-text text-muted"></small>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Account Currency</label>
                            <select
                                    
                                    name="account_currency"
                                    
                                    id="account_currency"
                                    class="form-select form-select-custom py-3"
                                    placeholder=""
                                    aria-describedby="prefixId"
                                    required
                                >
                                <option disabled selected="true">Select Currency</option>
                                <option value="Euro,EUR">Euro (EUR)</option>
    <option value="US Dollar,USD">US Dollar (USD)</option>
    <option value="Japanese Yen,JPY">Japanese Yen (JPY)</option>
    <option value="British Pound,GBP">British Pound (GBP)</option>
    <option value="Australian Dollar,AUD">Australian Dollar (AUD)</option>
    <option value="Canadian Dollar,CAD">Canadian Dollar (CAD)</option>
    <option value="Swiss Franc,CHF">Swiss Franc (CHF)</option>
    <option value="Chinese Yuan,CNY">Chinese Yuan (CNY)</option>
    <option value="Swedish Krona,SEK">Swedish Krona (SEK)</option>
    <option value="New Zealand Dollar,NZD">New Zealand Dollar (NZD)</option>
    <option value="Mexican Peso,MXN">Mexican Peso (MXN)</option>
    <option value="Singapore Dollar,SGD">Singapore Dollar (SGD)</option>
    <option value="Hong Kong Dollar,HKD">Hong Kong Dollar (HKD)</option>
    <option value="Norwegian Krone,NOK">Norwegian Krone (NOK)</option>
    <option value="South Korean Won,KRW">South Korean Won (KRW)</option>
    <option value="Turkish Lira,TRY">Turkish Lira (TRY)</option>
    <option value="Russian Ruble,RUB">Russian Ruble (RUB)</option>
    <option value="Indian Rupee,INR">Indian Rupee (INR)</option>
    <option value="Brazilian Real,BRL">Brazilian Real (BRL)</option>
    <option value="South African Rand,ZAR">South African Rand (ZAR)</option>
    <option value="Saudi Riyal,SAR">Saudi Riyal (SAR)</option>
    <option value="Emirati Dirham,AED">Emirati Dirham (AED)</option>
    <option value="Malaysian Ringgit,MYR">Malaysian Ringgit (MYR)</option>
    <option value="Thai Baht,THB">Thai Baht (THB)</option>
                                
                            </select>
                            <small id="helpId" class="form-text text-muted"></small>
                        </div>

                        <br>
                        <h4><strong>Passwords</strong></h4>
                        <br>

                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <input
                                    type="password"
                                    name="password"
                                    
                                    id="password_a"
                                    class="form-control py-3"
                                    placeholder="xxxxxxxxxxxxx"
                                    aria-describedby="prefixId"
                                    required
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <div class="input-group mb-3">
                                
                                <input
                                    type="password"
                                    name="password_c"
                                    maxlength="10"
                                    id="password_c"
                                    class="form-control py-3"
                                    placeholder="xxxxxxxxxxxx"
                                    aria-describedby="prefixId"
                                    required
                                />
                            </div>
                            <span class="" id="password_output" style="font-size: 10px"></span>
                        </div>

                        <?php
                      csrf_token_input();
                    ?>
                        
                        <br>
                        <div class="d-flex  gap-2 flex-md-row flex-sm-column flex-column ">
                            <button type="submit" class="px-5 py-2 text-white text-center text-decoration-none rounded-4 bg-primary login_btn fw-bold" onclick="submit_form()" style=" cursor: pointer">Enroll</button>
                            <br>
                            
                            <hr>
                            <p class="text-center">or</p>
                            <br>
                            <a href="../login" class="px-5 py-2 text-decoration-none text-center rounded-4 border border-dark text-black" style="background-color: none"><i class="bi bi-person-fill"></i> Login to your Account </a>
                        </div>
                        
                    </form>
                    
                    
                </div>

            </div>

            
        </div>
        <script>
          var password_a = document.querySelector("#password_a");
            var password_b = document.querySelector("#password_c");
            var password_output = document.querySelector("#password_output");
            
            password_b.onkeyup = function(){
              if(password_b.value != ""){
                if(password_b.value != password_a.value){
                password_output.innerHTML = "Password did not match";
                password_output.style.color = "red";
                }
                else{
                password_output.innerHTML = "Password is Correct";
                password_output.style.color = "green";
              }
              }
              
            }
        </script>
        
        <script>
            let sub_form = document.querySelector(".sub_form");
            var login_btn = document.querySelector(".login_btn");
            var input = document.querySelectorAll("input");
            var info = document.querySelector(".info");
            function dalert(txt){
              
              info.style.display = "block";
              info.innerHTML = txt;
              window.scroll(0,0);
            }

            function submit_form(){
              for(var xi=0; xi<input.length; xi++){
                if(input[xi].value !== ""){
                  
                }
                else{
                  dalert("Please Complete Filling in the form to continue");
                }
              }
                

            }

            sub_form.onsubmit = function(){
                login_btn.disabled = "true";
                login_btn.innerHTML = "Loading ...";
                login_btn.classList.add("btn-primary-subtle");
                login_btn.classList.remove("btn-primary");
            }

            
            </script>
    <?php include("../bottom.html"); ?>

    <div class="terms_popup px-3">
          <div class="t_stable d-flex justify-content-center align-items-center bg-white p-5">
            <h2>Before You Proceed, you have to make sure that you've read our Terms and conditions and have agreed to them</h2>
            <br>
            <p class="bg-primary px-4 py-2 text-white">The terms and conditions are as follows</p>
            
            <div class="border border-2 overflow-y-scroll w-100 p-2" style="height: 300px; font-size: 12px">
            <h1 style="font-size: 15px">Casti Union Bank Terms and Conditions</h1>

<h2 style="font-size: 14px">1. Introduction</h2>
<p>Welcome to Casti Union Bank. By opening an account or using any of our services, you agree to abide by the following terms and conditions. These terms apply to all users of our banking services.</p>

<h2 style="font-size: 14px">2. Account Opening and Maintenance</h2>
<ul>
    <li><strong>Eligibility:</strong> You must be at least 18 years old to open an account with Casti Union Bank. Minors may open accounts with the assistance of a parent or legal guardian.</li>
    <li><strong>Verification:</strong> You agree to provide accurate and complete information during the account opening process and to update this information as necessary.</li>
    <li><strong>Account Types:</strong> We offer various account types, including savings, checking, and investment accounts. Each account type may have specific terms and conditions.</li>
</ul>

<h2 style="font-size: 14px">3. Deposits and Withdrawals</h2>
<ul>
    <li><strong>Deposits:</strong> Deposits can be made via cash, check, electronic transfer, or other methods as specified by the bank. Funds availability may vary based on the type of deposit.</li>
    <li><strong>Withdrawals:</strong> Withdrawals can be made in accordance with the account type and bank policies. Some accounts may have withdrawal limits or require notice for large withdrawals.</li>
</ul>

<h2 style="font-size: 14px">4. Fees and Charges</h2>
<ul>
    <li><strong>Service Fees:</strong> Various fees may apply to your account, including maintenance fees, transaction fees, and fees for specific services. These fees will be detailed in the fee schedule provided when you open your account and are subject to change.</li>
    <li><strong>Overdraft Fees:</strong> If your account balance falls below zero, overdraft fees may apply. You are responsible for maintaining a positive balance in your account.</li>
</ul>

<h2 style="font-size: 14px">5. Online Banking</h2>
<ul>
    <li><strong>Access:</strong> Online banking services are available to all account holders. You agree to keep your login credentials confidential and to notify us immediately of any unauthorized access.</li>
    <li><strong>Transactions:</strong> Online transactions are subject to the same terms and conditions as in-person transactions. Some transactions may have additional security requirements.</li>
</ul>

<h2 style="font-size: 14px">6. Privacy and Security</h2>
<ul>
    <li><strong>Data Protection:</strong> We are committed to protecting your personal information. Our privacy policy outlines how we collect, use, and safeguard your data.</li>
    <li><strong>Security Measures:</strong> We implement various security measures to protect your account and transactions. You agree to comply with these measures and to notify us of any security breaches.</li>
</ul>

<h2 style="font-size: 14px">7. Investment and Insurance Services</h2>
<ul>
    <li><strong>Investment Accounts:</strong> Investment accounts are subject to market risks. Past performance is not indicative of future results. You should consult with a financial advisor before making investment decisions.</li>
    <li><strong>Insurance Policies:</strong> Insurance policies offered through Casti Union Bank are subject to the terms and conditions of the insurance provider. Coverage details and exclusions will be provided in the policy documents.</li>
</ul>

<h2 style="font-size: 14px">8. Dispute Resolution</h2>
<ul>
    <li><strong>Complaints:</strong> If you have a complaint about our services, please contact us promptly. We will investigate and attempt to resolve your complaint in a timely manner.</li>
    <li><strong>Arbitration:</strong> Any disputes arising from these terms and conditions or your use of our services will be resolved through binding arbitration, in accordance with the rules of the American Arbitration Association.</li>
</ul>

<h2 style="font-size: 14px">9. Amendments</h2>
<ul>
    <li><strong>Changes to Terms:</strong> We may amend these terms and conditions at any time. Notice of changes will be provided through our website or other communication channels. Continued use of our services constitutes acceptance of the amended terms.</li>
</ul>

<h2 style="font-size: 14px">10. Termination</h2>
<ul>
    <li><strong>Account Closure:</strong> You may close your account at any time by notifying us in writing. We reserve the right to close your account if it is inactive or if you violate these terms and conditions.</li>
    <li><strong>Service Termination:</strong> We may terminate your access to our services at any time, with or without cause, and without prior notice.</li>
</ul>

<h2 style="font-size: 14px">11. Governing Law</h2>
<p>These terms and conditions are governed by and construed in accordance with the laws of the state in which Casti Union Bank operates, without regard to its conflict of law principles.</p>

<!-- <h2>12. Contact Information</h2>
<p>For any questions or concerns regarding these terms and conditions, please contact us at:</p>
<p>
    <strong>Casti Union Bank</strong><br>
    [Your Address]<br>
    [Your City, State, ZIP Code]<br>
    [Phone Number]<br>
    [Email Address]
</p> -->

<p>By using the services of Casti Union Bank, you acknowledge that you have read, understood, and agreed to these terms and conditions.</p>

            </div>
            <br>
            <div class="d-flex flex-row-reverse px-1 w-100">
              <button class="btn btn-primary px-4 fw-bold" onclick="check_agreement()">I Agree</button>
            </div>
          </div>
        </div>

        <style>
          .terms_popup{
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0px;
            left: 0px;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100000000;
          }
          .t_stable{
            border: solid 1px black;
            width: 500px;
            display: flex;
            flex-direction: column;

          }
        </style>
        <script>
          function check_agreement(){
            document.querySelector(".terms_popup").style.display = "none";
          }
        </script>
