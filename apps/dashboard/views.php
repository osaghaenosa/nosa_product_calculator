<?php

ob_start();

include("widgets/alert.widget");
include("widgets/loading2.widget");
include("widgets/general_popup.widget");
include("widgets/general_popup2.widget");
include("widgets/info.widget");

template_include("home.html", DASHBOARD);


// if(isset($_SESSION['err_info'])){
//     showPopup($_SESSION['err_info']);
//     unset($_SESSION['err_info']);
// }


// if(isset($_SESSION["logged_in"])){
//     if ($_SESSION["logged_in"] == "true") {
    
//     }
//     if(strpos(file_get_contents("disabled_list.l"),  $_SESSION["id"]) !== FALSE){
//         header("location: login");
//     $_SESSION['errl'] = "<div class='d-flex flex-column align-items-center justify-content-center gap-2'><img src='../assets/images/alert.png' style='width: 150px; height: initial'><span class='fw-bold text-dark'>Sorry, Your account has been disabled.<br> Please contact our customer care service to rectify your account.!</span></div>";
//     unset($_SESSION["logged_in"]);
//     }

//     if(file_get_contents("maintenance.txt") == "on"){
//         header("location: login");
//     $_SESSION['errl'] = "<div class='d-flex flex-column align-items-center justify-content-center gap-2'><img src='../assets/images/alert.png' style='width: 150px; height: initial'><br><span class='fw-bold text-dark'>Sorry, Our Website is on Maintenance Mode.<br> Please try again later.!</span></div>";
//     unset($_SESSION["logged_in"]);
//     }

//     // if(strpos(file_get_contents("pending_list.l"),  $_SESSION["id"]) !== FALSE){
//     //     //if the user is on the pending list, the user would be able to login but not use any services unless he is grated permission from the admin
//     // $msg_p = "<div class='bg-primary shadow text-dark d-flex align-items-center p-2' style='position: absolute; top:150px; right: 0px; width:200px; height: 50px; border-top-left-radius: 16px; border-bottom-left-radius: 16px '><p>Your account is Pending.</p></div> <span class='bg-primary-subtle shadow text-dark d-flex flex-column px-2 py-2 align-items-center' style='font-size:10px; position: absolute; top:210px; right: 0px; width:200px; height: initial; border-top-left-radius: 16px; border-bottom-left-radius: 16px'><a>Please contact our customer care service to rectify this issue</a></span></div>";
//     // echo $msg_p;
//     // }
    
//     if(!file_exists("../users/".$_SESSION["id"])){
//         header("location: login");
//     $_SESSION['errl'] = "<i class='bi bi-exclamation-triangle-fill text-danger text-center' style='font-size: 50px'></i> <br> <br> <span class='text-center'>Sorry, Your account has been Totally Deleted from our database!</span>";
//     unset($_SESSION["logged_in"]);
//     }
//     }
//     else{
//     header("location: login");
//     $_SESSION['errl'] = "<i class='bi bi-x-circle-fill text-danger text-center' style='font-size: 50px'></i><br><br><span class='text-center'>You have to login to see your Dashboard!</span>";
//     }
//     if(isset($_SESSION['xp_noti'])){
//         showAlert($_SESSION['xp_noti']);
//         unset($_SESSION['xp_noti']);
//     }
    
//     //set the cookie if successfully logged in
//     $d_set = "device_set".$_SESSION["id"];
//     setcookie($d_set,"true",time() + (86400 * 30), "/");
    
    



// //if the ext of kins details is not filled, then popup this
// //by default, it would be empty so that they can fill it
// if(isset($_SESSION["next_of_kins_name"])){
//     if($_SESSION["next_of_kins_name"] == ""){
//         include("templates/setup/setup_details.html");
//     }
//     else{
//         if(isset($_GET["r"])){
//             include("templates/base.html");
//         }
//         else{
//             include("templates/base.html");
//         }
//     }
// }
    
ob_end_flush();
?>

