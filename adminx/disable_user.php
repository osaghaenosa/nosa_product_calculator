<?php
ob_start();
session_start();
$id = $_GET["id"];
//add the users to the disabled list
$disable_list = file_get_contents("../dashboard/disabled_list.l");

//check if the file is empty
if($disable_list != ""){
    if(strpos($disable_list,",") !== TRUE){
        //i can find a comma there then it is an array
        file_put_contents("../dashboard/disabled_list.l", $id.",".$disable_list);
    }
    else{
        //i cannot find a comma there then it is not an array
    }
}
else{
    file_put_contents("../dashboard/disabled_list.l", $id);
}

// send a notification to the user
$date = date("y/m/d");
$time = date("h:i A");
$noti = file_get_contents("../users/".$id."/notiitem.txt");
     $new_noti = "<section id='notification_items' style='border-bottom:solid 1px gray; display:flex;flex-direction:column;gap:5px'>
<p class='lead'>Your account has been disabled because you have breached the law governing your account.</p>
<a> <small>".$date." - ".$time."</small> </a>
</section>";
file_put_contents("../users/".$id."/notiitem.txt", $new_noti."<br>".$noti);



//log to activity log
$log_date = date("d/m/y");
$log_time = date("h:i A");
$log_activity = "Your account has been disabled because you have breached the law governing your account.";

$activity_log_file = "../users/".$id."/activity_log.json";
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


header("location: ./?r=home&users=".$id);
$_SESSION["rrr"] = "You have successfully Disabled this users account";
ob_flush();
?>