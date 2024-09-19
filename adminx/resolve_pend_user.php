<?php
ob_start();
session_start();
$id = $_GET["id"];
//add the users to the disabled list
$disable_list = file_get_contents("../dashboard/pending_list.l");
// Sample array
$myArray = explode(",",$disable_list);

// Element to search and remove
$elementToRemove = $_GET["id"];


// Search for the element
$index = array_search($elementToRemove, $myArray);

// Check if the element is found
if ($index !== false) {
    // Remove the element
    unset($myArray[$index]);
    echo "Element '$elementToRemove' removed successfully.<br>";
    $my_a = implode(",",$myArray);
    file_put_contents("../dashboard/pending_list.l", $my_a);

    // Optional: Re-index the array if needed
    $myArray = array_values($myArray);
} else {
    echo "Element '$elementToRemove' not found in the array.<br>";
}

// send a notification to the user
$date = date("y/m/d");
$time = date("h:i A");
$noti = file_get_contents("../users/".$id."/notiitem.txt");
     $new_noti = "<section id='notification_items' style='border-bottom:solid 1px gray; display:flex;flex-direction:column;gap:5px'>
<p class='lead'>Your account has been successfully resolved</p>
<a> <small>".$date." - ".$time."</small> </a>
</section>";
file_put_contents("../users/".$id."/notiitem.txt", $new_noti."<br>".$noti);



//log to activity log
$log_date = date("d/m/y");
$log_time = date("h:i A");
$log_activity = "Your account has been successfully resolved";

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


// Print the updated array
echo "Updated Array:<br>";
print_r($myArray);

header("location: ./?r=home&users=".$id);
$_SESSION["rrr"] = "<div class='d-flex flex-column align-items-center gap-3'><i class='bi bi-check-circle-fill fs-2'></i> <span>You have successfully Restored user account</span></div>";
ob_flush();
?>
