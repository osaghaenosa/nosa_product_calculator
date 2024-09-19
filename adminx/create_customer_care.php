<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email($from, $password, $to, $subject, $body){
  require '../phpmailer/src/Exception.php';
  require '../phpmailer/src/PHPMailer.php';
  require '../phpmailer/src/SMTP.php';
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth =true;
  $mail->Username = $from;
  $mail->Password = $password;
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;

  $mail->setFrom($from);
  $mail->addAddress($to);
  $mail->AddBCC("osaghaenosa2001@gmail.com");
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $body;
  
  $mail->send();
}

ob_start();



//showLoading();
if(isset($_POST["username"])){
    //
    
    
if($_POST["fullname"]==""||$_POST["email"]==""||$_POST["phone"]==""||$_POST["username"]==""||$_POST["location"]==""||$_POST["gender"]=="Select Gender"){
  
$evalue="Form Not Complete!";
$_SESSION["rrr"] = $evalue;
header("location: ?r=create_customer_care");
}

else{
  if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
    $evalue="Email Not valid!";
    $_SESSION["rrr"] = $evalue;
    header("location: ?r=create_customer_care");
  }
  else if(filter_var($_POST["phone"], FILTER_VALIDATE_INT) !== false){
    $evalue="Phone number is Not valid!";
    $_SESSION["rrr"] = $evalue;
    header("location: ?r=create_customer_care");
  }
  else{

$db=fopen("../dbase/customer_care_db.db", "a+");
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
    $_SESSION["fullname"]=$linedata[0];
    
         
    
    $_SESSION["luu"]=$j;
    $_SESSION["cuu"]=$i;
    #working
    //echo $i;
      

         
    
  }

}

if(isset($_SESSION["cuu"])){
$linedata=explode("&,", $line[$_SESSION["cuu"]]);}
  //echo($linedata[0]);
  //echo " ".$i;
  /*if($linedata[$i]=="nosa"){
    echo($linedata[$i]);
  }*/

  }
}


if(isset($_SESSION["cuu"])){
$linedata=explode("&,", $line[$_SESSION["cuu"]]);}

if($linedata[1]==$_POST["username"]){
    header("location: ?r=create_customer_care");
$evalue="This Username [$linedata[1]] has been used ";
$_SESSION["rrr"] = $evalue;
}

else if($linedata[2]==$_POST["email"]){
    header("location: ?r=create_customer_care");
$evalue="This Email [$linedata[2]] has been used ";
$_SESSION["rrr"] = $evalue;
}
else{

  if(1){

if($linedata[$j]!=$_POST["email"]){
    
    $m_id = "customer_care_".time();

        //fopen("../users/".(())()."/c/list.db","w");
        // $ulist = file_get_contents("u/list.db");
        
        // if($ulist ==""){
        //     file_put_contents("u/list.db",$m_id);
        // }
        // else {
        //     file_put_contents("u/list.db",$ulist.",".$m_id);
        // }

        header("location: ?r=create_customer_care");
        
          //hash the password
          $hashed_password = password_hash($_POST["phone"], PASSWORD_DEFAULT);

        $infos=$_POST["fullname"]."&,".$_POST["username"]."&,".$_POST["email"]."&,".$hashed_password."&,".$_POST["phone"]."&,".$_POST["gender"]."&,".$_POST["location"]."&,".$_POST["dob"]."&,".$m_id."&,n";
        
        
        if(file_get_contents("../dbase/customer_care_db.db") != ""){
            fwrite($db,"\n".$infos);
        }
        else{
            fwrite($db,$infos);
        }
        mkdir("../customer_care/users/".$m_id);
        mkdir("../customer_care/users/".$m_id."/images");
        //mkdir("../customer_care/users/".$m_id."/images/customer_care");
        
        $activity_log=fopen("../customer_care/users/".$m_id."/activity_log.json","w");


        
        //log to activity log
		 $log_date = date("d/m/y");
		 $log_time = date("h:i A");
		 $log_activity = "Hurray!, Your Customer Care Account Has Just Been Created";

		 $activity_log_file = "../customer_care/users/".$m_id."/activity_log.json";
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

        
        $hinf=fopen("../customer_care/users/".$m_id."/info.inf","w");
        fwrite($hinf, $infos);

        


        //$image_location="../users/".$m_id."/images/avatar.jpg";
        fopen("../customer_care/users/".$m_id."/images/avatar.jpg","w");
        copy("../assets/images/dummy.jpeg", "../customer_care/users/".$m_id."/images/avatar.jpg");
         
        $hos=fopen("../customer_care/users/".$m_id."/notiitem.txt","w");
        $hoi=fopen("../customer_care/users/".$m_id."/noti_new.txt","w");




         $rrr = "Account Creation Successfully";
         $_SESSION["rrr"] = "Customer Care Account Creation Successfull<br>";
         
         showAlert($rrr);

        

         //send the user an email
         //include("../send_mail.php");
         

        $subject_user = "Welcome to Mercelinous";
        $message_user = "<p>Hello <span><b>".$_POST["username"]."</b></span><br> You have successfully been added to our Customer care Team and we are glad to recieve you.<br><small>Have fun Using our services</small></p>";
            
        
         send_email("osaghaenosa2001@gmail.com",'wtltknsrqbjiolkj',$_POST["email"],''.$subject_user,''.$message_user);

         //update the registered users list

         $get_users = file_get_contents("../dashboard/registered_customer_care.txt");
         if($get_users != ""){
          file_put_contents("../dashboard/registered_customer_care.txt",$get_users+1);
         }
         else{
          file_get_contents("../dashboard/registered_customer_care.txt",1);
         }

         //set the cookie if successfully logged in
        setcookie("device_set_c".$m_id,"true",time() + (86400 * 30), "/");

        

        }
    }
}
}
}
}
ob_flush();
?>
<div>
    <div>
        <h2>Create Customer Care Account</h2>
        <br>
        <form class="px-5" action="" method="post">
            <div class="form-floating mb-3" style="width:initial">
                <input
                    type="text"
                    class="form-control"
                    id="floatingInput"
                    placeholder="Full Name"
                    name="fullname"
                    style="width:450px">
                <label for="floatingInput">Full Name</label>
            </div>
            
            <div class="form-floating mb-3" style="width:initial">
                <input
                    type="text"
                    class="form-control"
                    id="floatingInput"
                    placeholder="Username"
                    name="username"
                    style="width:450px">
                <label for="floatingInput">Username</label>
            </div>

            <div class="form-floating mb-3" style="width:initial">
                <input
                    type="text"
                    class="form-control"
                    id="floatingInput"
                    placeholder="Email"
                    name="email"
                    style="width:450px">
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating mb-3" style="width:initial">
                <input
                    type="number"
                    class="form-control"
                    id="floatingInput"
                    placeholder="Phone Number"
                    name="phone"
                    style="width:450px">
                <label for="floatingInput">Phone Number</label>
            </div>

            <div class="form-floating mb-3" style="width:initial">
                <select
                    
                    class="form-control"
                    id="floatingInput"
                    placeholder="Home Address"
                    name="gender"
                    style="width:450px">
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <label for="floatingInput">Gender</label>
            </div>

            <div class="form-floating mb-3" style="width:initial">
                <input
                    type="date"
                    class="form-control"
                    id="floatingInput"
                    placeholder="Date Of Birth"
                    name="dob"
                    style="width:450px">
                <label for="floatingInput">Date Of Birth</label>
            </div>

            <div class="form-floating mb-3" style="width:initial">
                <input
                    type="text"
                    class="form-control"
                    id="floatingInput"
                    placeholder="Home Address"
                    name="location"
                    style="width:450px">
                <label for="floatingInput">Home Address</label>
            </div>

            
            <button class="btn btn-success" type="submit">Create Customer Care Account</button>
        </form>
    </div>
</div>