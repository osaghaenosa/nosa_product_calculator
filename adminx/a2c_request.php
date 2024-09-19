<?php
if(isset($_REQUEST["v"])){
    if($_REQUEST["v"] == "cancel"){
        //cancel nin_upload
        $id = $_GET["id"];
        $reason = "Did not match";
        $package = $_GET["package"];
        $network = $_GET["network"];
        $amount = $_GET["amount"];
        $r_amount = $_GET["r_amount"];
        $number = $_GET["number"];
        $reference = $_GET["reference"];
        //add the users to the verification request list
        $cancel_request = file_get_contents("../dashboard/airtime_2cash/requests.php");

        $initial_content = $package.",".$network.",".$number.",".$amount.",".$r_amount.",".$id.",".$reference.",n";
        

        if(strpos($cancel_request, $initial_content) !== FALSE){
            //it has found the item
            //remove the item
            $updated_content = str_replace($initial_content,"",$cancel_request);
            // Remove empty spaces
            $updated_content = preg_replace('/^\s*[\r\n]/m', '', $updated_content);
            file_put_contents("../dashboard/airtime_2cash/requests.php", $updated_content);

        }

        // Change the a2c transaction history status for this item to failed
// A2C JSON file
$a2c_json = "../users/".$id."/a2c_history.json";
$a2c_json_file = file_get_contents($a2c_json);

$a2c_json_file_decode = json_decode($a2c_json_file, true);

// Find the reference in the JSON file
foreach($a2c_json_file_decode as $key => &$a2c_array) {
    if($a2c_array["reference"] === $reference) {
        $a2c_array["status"] = "failed";
        $a2c_array["message"] = $reason;

        // Encode the modified array back to JSON format
        $jsonData = json_encode($a2c_json_file_decode, JSON_PRETTY_PRINT);

        // Write the updated JSON data back to the file
        file_put_contents($a2c_json, $jsonData);
        break; // Break the loop once the reference is found and updated
    }
}


        

        header("location: ./?r=a2c_requst");
        $_SESSION["rrr"] = "You have successfully Cancelled the Request of a user!";

        //send notification to user
        $noti = file_get_contents("../users/".$id."/notiitem.txt");
        $new_noti = "<section id='notification_items' style='border-bottom:solid 1px gray; display:flex;flex-direction:column;gap:5px'>
                <p class='lead'>Your $network $package to cash request was Rejected by MerceliPay - $reason</p>
                
                </section>";
        file_put_contents("../users/".$id."/notiitem.txt", $new_noti."<br>".$noti);

        //update the log
        //log to activity log
		 $log_date = date("d/m/y");
		 $log_time = date("h:i A");
		 $log_activity = "Your $network $package to cash request was Rejected by MerceliPay - $reason ";

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
    }

    else if($_GET["v"] == "approve"){
         //approve request
         $id = $_GET["id"];
         $reason = "";
         $package = $_GET["package"];
         $network = $_GET["network"];
         $amount = $_GET["amount"];
         $r_amount = $_GET["r_amount"];
         $number = $_GET["number"];
         $reference = $_GET["reference"];
         //remove the users to the requests.php file
         $cancel_request = file_get_contents("../dashboard/airtime_2cash/requests.php");
 
         $initial_content = $package.",".$network.",".$number.",".$amount.",".$r_amount.",".$id.",".$reference.",n";
         
 
         if(strpos($cancel_request, $initial_content) !== FALSE){
             //it has found the item
             //remove the item
             $updated_content = str_replace($initial_content,"",$cancel_request);
             // Remove empty spaces
             $updated_content = preg_replace('/^\s*[\r\n]/m', '', $updated_content);
             file_put_contents("../dashboard/airtime_2cash/requests.php", $updated_content);
 
         }
 
         // Change the a2c transaction history status for this item to failed
 // A2C JSON file
 $a2c_json = "../users/".$id."/a2c_history.json";
 $a2c_json_file = file_get_contents($a2c_json);
 
 $a2c_json_file_decode = json_decode($a2c_json_file, true);
 
 // Find the reference in the JSON file
 foreach($a2c_json_file_decode as $key => &$a2c_array) {
     if($a2c_array["reference"] === $reference) {
         $a2c_array["status"] = "success";
         $a2c_array["message"] = $reason;
 
         // Encode the modified array back to JSON format
         $jsonData = json_encode($a2c_json_file_decode, JSON_PRETTY_PRINT);
 
         // Write the updated JSON data back to the file
         file_put_contents($a2c_json, $jsonData);
         break; // Break the loop once the reference is found and updated
     }
 }
 //add to the amount in the user wallet
 $u_wallet = "../users/".$id."/wallets/amount.x";
 $u_wallet_file = file_get_contents($u_wallet);

 //add thebalance
 $updated_amount = $u_wallet_file+$r_amount;
 file_put_contents($u_wallet,$updated_amount);
 
 
         
 
         header("location: ./?r=a2c_requst");
         $_SESSION["rrr"] = "You have successfully Approved the Request of a user!";
 
         //send notification to user
         $noti = file_get_contents("../users/".$id."/notiitem.txt");
         $new_noti = "<section id='notification_items' style='border-bottom:solid 1px gray; display:flex;flex-direction:column;gap:5px'>
                 <p class='lead'>Your $network $package to cash request was Approved by MerceliPay</p>
                 
                 </section>";
         file_put_contents("../users/".$id."/notiitem.txt", $new_noti."<br>".$noti);
 
         //update the log
         //log to activity log
          $log_date = date("d/m/y");
          $log_time = date("h:i A");
          $log_activity = "Your $network $package to cash request was Approved by MerceliPay";
 
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
    }
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><small>Dashboard</small> / Verifications</li>
        </ol>
        
        

        <div>
            <h2>All Airtime/ Data to Cash Requests</h2>
            <div class="my-5 px-4 py-2 shadow">
                <?php
        $all_req =  file_get_contents("../dashboard/airtime_2cash/requests.php");
        if($all_req == ""){
            echo "No Request yet";
        }
        else{
            $d_file = fopen("../dashboard/airtime_2cash/requests.php","r");
            $line = [];
            $line_count = 0;
            while(!feof($d_file)){
                $line[] = fgets($d_file);
                $line_count++;
            }

            
            for($x=0; $x<$line_count; $x++){
                $line_data = explode(",", $line[$x]);
                if(isset($line_data[$x])){
                    $pn = $x+1;
                    echo $pn."<br>";
                    
                
                //for($y=0; $y<=4; $y++){}
                   
                    
                    
                    $user_image_file = "../users/".$line_data[5]."/images/avatar.jpg";
                    $user_info_file = "../users/".$line_data[5]."/info.inf";

                    

                    //echo "<img src='".$user_image_file."'>";
                    
                    $user_details_file = file_get_contents($user_info_file);
                    //echo $user_details_file;
                    
                    if(file_exists($user_image_file)){
                       
                            
                $user_details = explode("&,", $user_details_file);
                    $full_name = $user_details[0];
                    $r_username = $user_details[1];
                    $r_id = $user_details[8];

                    $u_package = $line_data[0];
                    $u_network = $line_data[1];
                    $u_number = $line_data[2];
                    $u_amount = $line_data[3];
                    $u_ramount = $line_data[4];
                    $u_reference = $line_data[6];


                    $output = "<div class=\"d-flex justify-content-between gap-2 align-items-center\">
                        <div class=\"d-flex gap-3 align-items-center justify-content-between\">
                            <div class=\"rounded-circle border border-1 overflow-hidden \" style=\"width:100px; height:100px\">
                                <img src=\"".$user_image_file."\" style=\"width:100%; height:initial\">
                            </div>
                            <div class=\"d-flex flex-column \">
                                <label class=\"lead\">$full_name</label>
                                <a style=\"font-style: italic;\" class=\"text-muted text-decoration-none\">$r_username/ $r_id</a>
                            </div>
                        </div>
                        <div class=\"d-flex gap-3 align-items-center\">
                            <div class='d-flex flex-column gap-3'>
                                <p class=\"fw-bold\">Network</p>
                                <p>".$u_network."</p>
                            </div>
                            <div class='d-flex flex-column gap-3'>
                                <p class=\"fw-bold\">Package</p>
                                <p>".$u_package."</p>
                            </div>
                            <div class='d-flex flex-column gap-3'>
                                <p class=\"fw-bold\">Amount</p>
                                <p>".$u_amount."</p>
                            </div>
                            <div class='d-flex flex-column gap-3'>
                                <p class=\"fw-bold\">Sender No.</p>
                                <p>".$u_number."</p>
                            </div>
                            
                            
                        </div>
                        <div>
                            <a  onclick=\"cancel".$r_id."_v()\" class=\"btn btn-danger\">Decline</a>
                            <a onclick=\"approve".$r_id."_v()\"   class=\"btn btn-success\">Approve</a>
                        </div>
                    </div>
    
                    <section class=\"cancel".$r_id."_user_popup_bg\" style=\"position: fixed; left:0px;top:0px; width: 100%; height: 100%; background: rgba(0,0,0,0.5); flex-direction: column; align-items: center; justify-content: center\">
                        <div class=\"rounded bg-white text-dark\" style=\" width:400px; overflow: hidden\">
                            <h1 class=\"text-center w-100 bg-success text-white px-4 py-2\">Cancel User Request?</h1>
                            <div class=\"py-3 px-3\">
                               <p>Are you sure you want to Cancel this user's Request?</p>
                               <div>
                                
                            
                                <a onclick=\"cancel".$r_id."_no()\" class=\"btn btn-success px-4\">No</a>
                                <a href=\"?r=a2c_requst&v=cancel&id=$r_id&network=$u_network&package=$u_package&number=$u_number&amount=$u_amount&r_amount=$u_ramount&reference=$u_reference\" type=\"submit\" class=\"btn btn-danger px-4\">Yes</a>
                            
                                
                               </div>
                            </div>
                        </div>
                    </section>

                    <section class=\"approve".$r_id."_user_popup_bg\" style=\"position: fixed; left:0px;top:0px; width: 100%; height: 100%; background: rgba(0,0,0,0.5); flex-direction: column; align-items: center; justify-content: center\">
                        <div class=\"rounded bg-white text-dark\" style=\" width:400px; overflow: hidden\">
                            <h1 class=\"text-center w-100 bg-success text-white px-4 py-2\">Approve User Request?</h1>
                            <div class=\"py-3 px-3\">
                               <p>Are you sure you want to Approve this user's Request?</p>
                               <div>
                                
                            
                                <a onclick=\"approve".$r_id."_no()\" class=\"btn btn-success px-4\">No</a>
                                <a href=\"?r=a2c_requst&v=approve&id=$r_id&network=$u_network&package=$u_package&number=$u_number&amount=$u_amount&r_amount=$u_ramount&reference=$u_reference\" type=\"submit\" class=\"btn btn-danger px-4\">Yes</a>
                            
                                
                               </div>
                            </div>
                        </div>
                    </section>
    
                    <style>
                        .cancel".$r_id."_user_popup_bg{
                            display:none;
                        }
                        .approve".$r_id."_user_popup_bg{
                            display:none;
                        }
                    </style>
                    <script>
                        var cancel".$r_id."_user_popup_bg = document.querySelector(\".cancel".$r_id."_user_popup_bg\");
                        var approve".$r_id."_user_popup_bg = document.querySelector(\".approve".$r_id."_user_popup_bg\");
                        function cancel".$r_id."_v(){
                            cancel".$r_id."_user_popup_bg.style.display = 'flex';
                        }
                        function cancel".$r_id."_no(){
                            cancel".$r_id."_user_popup_bg.style.display = 'none';
                        }

                        function approve".$r_id."_v(){
                            approve".$r_id."_user_popup_bg.style.display = 'flex';
                        }
                        function approve".$r_id."_no(){
                            approve".$r_id."_user_popup_bg.style.display = 'none';
                        }
                    </script>
                    <hr>";


                        echo $output;
                        
                        
                    }
                    
                }
            }

            if(strpos($all_req, ",") !== FALSE){
                //it is an array
                // $all_req_array = explode(",", $all_req);

                // for($i=0; $i< count($all_req_array); $i++){
                //     $user_details_file = file_get_contents("../users/".$all_req_array[$i]."/info.inf");
                // $user_details = explode("&,", $user_details_file);
                //     $full_name = $user_details[0];
                //     $r_username = $user_details[1];
                //     $r_id = $user_details[8];
                    
                //     $user_image_file = "../users/".$all_req_array[$i]."/images/avatar.jpg";
    
                //     $output = "<div class=\"d-flex justify-content-between gap-2 align-items-center\">
                //         <div class=\"d-flex gap-3 align-items-center justify-content-between\">
                //             <div class=\"rounded-circle border border-1 overflow-hidden \" style=\"width:100px; height:100px\">
                //                 <img src=\"".$user_image_file."\" style=\"width:100%; height:initial\">
                //             </div>
                //             <div class=\"d-flex flex-column \">
                //                 <label class=\"lead\">$full_name</label>
                //                 <a style=\"font-style: italic;\" class=\"text-muted text-decoration-none\">$r_username/ $r_id</a>
                //             </div>
                //         </div>
                //         <div class=\"d-flex gap-3 align-items-center\">
                //             <div>
                //                 <p class=\"fw-bold\">$user_nin</p>
                //             </div>
                //             <div class=\"rounded border border-1 overflow-hidden \" style=\"width:100px; height:100px\">
                //                 <img src=\"$user_nin_image_file\" style=\"width:100%; height:initial\"></div>
                //         </div>
                //         <div>
                //             <a onclick=\"cancel".$r_id."_v()\" href=\"?r=verifications&v=cancel&id=$r_id\" class=\"btn btn-danger\">Cancel Verification</a>
                //             <a href=\"?r=verifications&v=verify&id=$r_id\" class=\"btn btn-success\">Verify User</a>
                //         </div>
                //     </div>
    
                //     <section class=\"cancel".$r_id."_user_popup_bg\" style=\"position: fixed; left:0px;top:0px; width: 100%; height: 100%; background: rgba(0,0,0,0.5); flex-direction: column; align-items: center; justify-content: center\">
                //         <div class=\"rounded bg-white text-dark\" style=\" width:400px; overflow: hidden\">
                //             <h1 class=\"text-center w-100 bg-success text-white px-4 py-2\">Cancel User NIN verification?</h1>
                //             <div class=\"py-3 px-3\">
                //                <p>Are you sure you want to Cancel this user's NIN verification?</p>
                //                <div>
                //                 <form method=\"post\" action=\"?r=verifications&v=cancel&id=$r_id\">
                //                     <textarea name=\"reason\" style=\"width: 90%; height: 100px\"></textarea>
                //                 <a onclick=\"cancel".$r_id."_no()\" class=\"btn btn-success px-4\">No</a>
                //                 <button type=\"submit\" class=\"btn btn-danger px-4\">Yes</button>
                //                 </form>
                                
                //                </div>
                //             </div>
                //         </div>
                //     </section>
    
                //     <style>
                //         .cancel".$r_id."_user_popup_bg{
                //             display:none;
                //         }
                //     </style>
                //     <script>
                //         var cancel".$r_id."_user_popup_bg = document.querySelector(\".cancel".$r_id."_user_popup_bg\");
                //         function cancel".$r_id."_v(){
                //             cancel".$r_id."_user_popup_bg.style.display = 'flex';
                //         }
                //         function cancel".$r_id."_no(){
                //             cancel".$r_id."_user_popup_bg.style.display = 'none';
                //         }
                //     </script>
                //     <hr>";
                //     echo $output;
                // }
            }
            else{
            //     $all_req_array = $all_req;
            //     $user_details_file = file_get_contents("../users/".$all_req_array."/info.inf");
            //     $user_details = explode("&,", $user_details_file);
            //         $full_name = $user_details[0];
            //         $r_username = $user_details[1];
            //         $r_id = $user_details[8];
            //         $user_nin = file_get_contents("../users/".$all_req_array."/transactions/security/nin");
            //         $user_nin_image_file = "../users/".$all_req_array."/transactions/security/nin_image.jpg";
            //         $user_image_file = "../users/".$all_req_array."/images/avatar.jpg";
    
            //         $output = "<div class=\"d-flex justify-content-between gap-2 align-items-center\">
            //             <div class=\"d-flex gap-3 align-items-center justify-content-between\">
            //                 <div class=\"rounded-circle border border-1 overflow-hidden \" style=\"width:100px; height:100px\">
            //                     <img src=\"".$user_image_file."\" style=\"width:100%; height:initial\">
            //                 </div>
            //                 <div class=\"d-flex flex-column \">
            //                     <label class=\"lead\">$full_name</label>
            //                     <a style=\"font-style: italic;\" class=\"text-muted text-decoration-none\">$r_username/ $r_id</a>
            //                 </div>
            //             </div>
            //             <div class=\"d-flex gap-3 align-items-center\">
            //                 <div>
            //                     <p class=\"fw-bold\">$user_nin</p>
            //                 </div>
            //                 <div class=\"rounded border border-1 overflow-hidden \" style=\"width:100px; height:100px\">
            //                     <img src=\"$user_nin_image_file\" style=\"width:100%; height:initial\"></div>
            //             </div>
            //             <div>
            //                 <a onclick=\"cancel".$r_id."_v()\" class=\"btn btn-danger\">Cancel Verification</a>
            //                 <a href=\"?r=verifications&v=verify&id=$r_id\" class=\"btn btn-success\">Verify User</a>
            //             </div>
            //         </div>
                    
            //         <section class=\"cancel".$r_id."_user_popup_bg\" style=\"position: fixed; left:0px;top:0px; width: 100%; height: 100%; background: rgba(0,0,0,0.5); flex-direction: column; align-items: center; justify-content: center\">
            //             <div class=\"rounded bg-white text-dark\" style=\" width:400px; overflow: hidden\">
            //                 <h1 class=\"text-center w-100 bg-success text-white px-4 py-2\">Cancel User NIN verification?</h1>
            //                 <div class=\"py-3 px-3\">
            //                    <p>Are you sure you want to Cancel this user's NIN verification?</p>
            //                    <div>
            //                     <form method=\"post\" action=\"?r=verifications&v=cancel&id=$r_id\">
            //                         <textarea name=\"reason\" style=\"width: 90%; height: 100px\"></textarea>
            //                     <a onclick=\"cancel".$r_id."_no()\" class=\"btn btn-success px-4\">No</a>
            //                     <button type=\"submit\" class=\"btn btn-danger px-4\">Yes</button>
            //                     </form>
                                
            //                    </div>
            //                 </div>
            //             </div>
            //         </section>
    
            //         <style>
            //             .cancel".$r_id."_user_popup_bg{
            //                 display:none;
            //             }
            //         </style>
            //         <script>
            //             var cancel".$r_id."_user_popup_bg = document.querySelector(\".cancel".$r_id."_user_popup_bg\");
            //             function cancel".$r_id."_v(){
            //                 cancel".$r_id."_user_popup_bg.style.display = 'flex';
            //             }
            //             function cancel".$r_id."_no(){
            //                 cancel".$r_id."_user_popup_bg.style.display = 'none';
            //             }
            //         </script>
            //         ";
            //         echo $output;
             }
        }
        
        ?>
            </div>
            
        </div>
        
        
        
        
    </div>
</main>