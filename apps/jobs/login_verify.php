<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email($from, $password, $to, $subject, $body){
  require '../phpmailer/src/Exception.php';
  require '../phpmailer/src/PHPMailer.php';
  require '../phpmailer/src/SMTP.php';
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = 'mercelipay.com';
  $mail->SMTPAuth =true;
  $mail->Username = $from;
  $mail->Password = $password;
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;

  $mail->setFrom($from);
  $mail->addAddress($to);
//   $mail->AddBCC("osaghaenosa2001@gmail.com");
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $body;
  
  $mail->send();
}

ob_start();
session_start();


$_SESSION["homelink"]="login";

//header("location: account.php");

/*
// To set the cookie so that the user can only login through
//thesame device

if(!isset($_COOKIE["myname"]) && $_COOKIE["myname"]!=$_POST["uname"]){
$_SESSION["nologin"]="You cannot login with this device";
header("location: login.php");

}
else{
$_SESSION["nologin"]="";
}
*/
include("../csrf_token.php");

csrf_token_verify("../login");

if(isset($_POST["email"])){
if(isset($_POST["passcode"]) && isset($_POST["email"])){
	if($_POST["passcode"]=="" || $_POST["email"]==""){
		$_SESSION["errl"]="<div class='d-flex flex-column align-items-center gap-2'><i class='bi bi-x-circle-fill text-danger text-center' style='font-size: 50px'></i><br><br><span>Please Input Something</span></div>";
		
		
		
		//header("location: top_popup.php");
		header("location: ../login");
		
	}

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



for ($i=0; $i < $in; $i++) { 
$linedata=explode("&,", $line[$i]);
$linedataee=explode("&,", $line[$i]);
$linedatarefer=explode("&,", $line[$i]);
for ($j=0; $j <= 17; $j++) { 
	if($linedata[2]==$_POST["email"]&& $linedataee[3] == $_POST["passcode"]){

		//echo " ".$linedata[$j];
		//firstname&,surname&,email&,password&,phone&,gender&,dob&,country&,id&,next_of_kin_name&,next_of_kin_phone&,nexxt_of_kin_address&,fathers_name&,mothers_name&,marital_status
		$_SESSION["myemail"]=$linedata[2];
		$_SESSION["mypassword"]=$linedata[3];
		$_SESSION["surname"]=$linedata[1];
		$_SESSION["firstname"]=$linedata[0];
        
        $_SESSION["phone"]=$linedata[4];
        $_SESSION["gender"]=$linedata[5];
        $_SESSION["dob"]=$linedata[6];
        $_SESSION["state"]=$linedata[7];
        $_SESSION["id"]=$linedata[8];

		$_SESSION["next_of_kins_name"]=$linedata[9];
		$_SESSION["next_of_kins_phone"]=$linedata[10];
		$_SESSION["next_of_kins_address"]=$linedata[11];
		$_SESSION["next_of_kins_relationship"]=$linedata[12];
		$_SESSION["fathers_name"]=$linedata[13];
		$_SESSION["mothers_name"]=$linedata[14];
		$_SESSION["marital_status"]=$linedata[15];
		


		#working
		//echo "  ".$_SESSION["myaccstate"];
		
		$_SESSION["lnumber"]=$j;
		$_SESSION["cnumber"]=$i;
		#working
		//echo $i;
			$_SESSION["errl"]="";
			
			 $_SESSION["login_success"]="ss";
         //check if the user is changed
			$d_seta = "device_set".$_SESSION["id"];
			if(!isset($_COOKIE[$d_seta])){
				//check if the user has done 2FA
				$user_folder = "../users/".$_SESSION["id"]."/transactions/security/2fa.pin";
				if(file_exists($user_folder)){
					header("location: ../login/2fa_login?p=".$_SESSION['id']);
					// showAlert("Answer your Security Question");
				}
				else{
					header("location: ../dashboard/home");
					$_SESSION["logged_in"]="true";
		 $_SESSION["popup_first"] = "true";
				}
			}
			else{
				header("location: ../dashboard/home");
				$_SESSION["logged_in"]="true";
		 $_SESSION["popup_first"] = "true";
			}

         $_SESSION["info_widget"] = "Welcome to your dashboard,<br> You need to add your 4-digit pin in other to perform any transaction on this platform. <a href='settings?change_pin'> Set Your Pin Now</a>";
         
         
$o_inf = file_get_contents("../users/".$_SESSION["id"]."/other_info.db");
		$expl = explode("&,", $o_inf);

		$_SESSION["middle_name"]=$expl[0];
        $_SESSION["zip"]=$expl[1];
        $_SESSION["house_address"]=$expl[2];
        $_SESSION["occupation"]=$expl[3];
        $_SESSION["salary"]=$expl[4];
        $_SESSION["account_type"]=$expl[5];
        $_SESSION["account_currency"]=$expl[6];

		 
		//log to activity log
$log_date = date("d/m/y");
$log_time = date("h:i A");
$log_activity = "User Logged In";

$activity_log_file = "../users/".$_SESSION["id"]."/activity_log.json";
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
	}
}
$linedata=explode("&,", $line[$_SESSION["cnumber"]]);
	//echo($linedata[0]);
	//echo " ".$i;
	/*if($linedata[$i]=="nosa"){
		echo($linedata[$i]);
	}*/
	}
	if(!password_verify($_POST["passcode"], $linedata[3])){
		//echo $linedata[3];
		$_SESSION["errl"]="<div class='d-flex flex-column align-items-center gap-2'><i class='bi bi-x-circle-fill text-danger text-center' style='font-size: 50px'></i><br><br><span><b>Invalid Details Entered</b> <br><div class='d-flex justify-content-center'><a href='' style='font-size: 10px'>Did you forget your Password?</a></div></span></div><br>";
		//header("location: top_popup.php");
	header("location: ../login");
	}
    else{

		

          //$_SESSION["upgrade"]=$linedata[4];
         if(isset($_SESSION["referinfo"])){
         fwrite($db,"\n".$_SESSION["referinfo"]);
          $_SESSION["referinfo"]="";
          $_SESSION["uname"]=$_POST["uname"];
		  $_SESSION["passw"]=$_POST["passw"];
		  
		  
			//check if the user is changed
			$d_seta = "device_set".$_SESSION["id"];
			if(!isset($_COOKIE[$d_seta])){
				//check if the user has done 2FA
				$user_folder = "../users/".$_SESSION["id"]."/transactions/security/2fa.pin";
				if(file_exists($user_folder)){
					header("location: ../login/2fa_login?p=".$_SESSION['id']);
					// showAlert("Answer your Security Question");
				}
				else{
					header("location: ../dashboard/home");
				}
			}
			else{
				header("location: ../dashboard/home");
			}

          

		  

         }
		 //get if the user' device has been logged in to this app
		 $d_set = "device_set".$_SESSION["id"];
		 if(!isset($_COOKIE[$d_set])){
			//log to activity log
			$log_date = date("d/m/y");
			$log_time = date("h:i A");
			$log_activity = "An Unknown device logged in to your Account";
   
			$activity_log_file = "../users/".$_SESSION["id"]."/activity_log.json";
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

			  // send a notification to the user himself

			  $noti_self = file_get_contents("../users/".$_SESSION["id"]."/notiitem.txt");
			  $new_noti = "<section id='notification_items' style='border-bottom:solid 1px gray; display:flex;flex-direction:column;gap:5px'>
<p class='lead'>".$log_activity."</p>
<a style='font-size:10px'>".$log_date." - ".$log_time."</a>
</section>";
			  file_put_contents("../users/".$_SESSION["id"]."/notiitem.txt", $new_noti."<br>".$noti_self);

			  //send an email for login

			  $subject_user = "An unknown Device Login";
        $message_user = "<p>Hello <span><b>".$_POST["username"]."</b></span><br> We discovered that an Unknown device just logged in to your account.<br> If it wasn't you, you are adviced to change your password immediately and if you can't access your account after some time, then contact our customer care on <br><a href='tel:09066663854'>09066663854</a><br><small>Have fun Using our services</small></p>";
            
        
         send_email('support@mercelipay.com','Precious22@',$_POST["cemail"],''.$subject_user,''.$message_user);
		 }
		 else{
			//log to activity log
			$log_date = date("d/m/y");
			$log_time = date("h:i A");
			$log_activity = "Logged in to your Account";
   
			$activity_log_file = "../users/".$_SESSION["id"]."/activity_log.json";
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
		 }
		 
    }



fclose($db);

}
}
}

ob_flush();
?>
