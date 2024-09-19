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
session_start();


$u_id = "";

$_SESSION["homelink"]="../login/forgot_password";


if(isset($_GET["id"])){
if(isset($_GET["id"])){
	if($_GET["id"]==""){
		$_SESSION["rrr"]="Please Input Something";
		header("location: forgot_password");
		
	}

else{

$db=fopen("../dbase/db.db", "a+");
$in=0;
$line=[];
$lpos=0;
while (!feof($db)) {
	$in++;
	$line[]=fgets($db);
}



for ($pl=0; $pl < $in; $pl++) { 
$linedata=explode("&,", $line[$pl]);
for ($nj=0; $nj <= 10; $nj++) { 
	if($linedata[$nj]==$_GET["id"]){

        $u_id=$linedata[8];
        $_SESSION["hty"] = $pl;
		echo "dsss";
		
	}
}
$linedata=explode("&,", $line[$_SESSION["hty"]]);
}

//get the user file
function getRandomStringRandomInt($length = 16)
{
    $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pieces = [];
    $max = mb_strlen($stringSpace, '8bit') - 1;
    for ($i = 0; $i < $length; ++ $i) {
        $pieces[] = $stringSpace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
if($linedata[2]==$_GET["id"]){
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
$myurl = "https://";
else
$myurl = "http://";
// Append the host(domain name, ip) to the URL.
$myurl.= $_SERVER['HTTP_HOST'];

$randomness = getRandomStringRandomInt();
$user_file = "../login/".$randomness.".php";
$user_random_file = fopen($user_file, "a+");
file_put_contents($user_file, $u_id);

$z_list = file_get_contents("../login/autodelete_pin_reset_link.list");
if($z_list == ""){
    $up_list = $randomness;
}
else{
    $up_list = $randomness.",".$z_list;
}
file_put_contents("../login/autodelete_pin_reset_link.list",$up_list);

//send an email to the users with the reset link
$subject_user = "Reset Your Transaction Pin";
$message_user = "


<div style='position: relative; left: calc(50% -450px);'>
    <img src='https://nosatestbusiness.000webhostapp.com/assets/images/mercelinous-logo-icon-2.png' style='width:50px; height:50px'>
    <h1 style='font-size:1.5rem'>You Requested to change your Transaction Pin maybe because you forgot it and our customer care services decided to release the link for you to reset the pin.</h1>
    <div style='position: relative; left: calc(50% -450px); width:400px; height:initial; padding:10px 10px 10px 10px; border: solid 2px green; display: flex; flex-direction:column; gap:1rem'>
        <p>Click on this link to reset your pin</p>
        <a href='".$myurl."/resetpin/".$randomness."' style='text-align:center;text-decoration: none; width:initial; border-radius: 8px; background-color: seagreen; padding-top:10px;padding-bottom:10px; text-align:center;color:white; padding-left:10px; padding-right:10px'>Reset Your Password</a>
        <br><br>
        <p style='font-size:10px'>If you did not request for this, please kindly ignore.<br> Link would expire in 10 minutes time</p>
    </div>
    
</div>
";
send_email("osaghaenosa2001@gmail.com",'wtltknsrqbjiolkj',$_GET["id"],''.$subject_user,''.$message_user);


echo "Sent a file to ".$u_id." named ".$randomness.".php";
header("location: ./?r=home&users=".$u_id);
$_SESSION["checkmark"] = "<i class='bi bi-check-circle-fill text-success'></i>";
}
else{
    $_SESSION["rrr"] = "Email not found in our Database!";
    header("location: ./?r=home&users=".$u_id);
}

fclose($db);

}
}
}
else{
    header("location: ./?r=home&users=".$u_id);
    $_SESSION["rrr"] = "Error!";
}



ob_flush();
?>