
<section style="padding-top:20px; position: fixed; left:0px;top:0px; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display:flex; flex-direction: column; align-items: center; ">
    <?php
                        if(isset($_POST["nickname"]) && isset($_POST["username"]) && isset($_POST["myemail"]) && isset($_POST["phone"])){
                          

    //for the other details
    $mnickname = $_POST["nickname"];
    $musername = $_POST["username"];
    $memail = $_POST["myemail"];
    $mphone = $_POST["phone"];

    $db_dir = "../dbase/db.db";
    $info_dir = "../users/".$_GET["users"]."/info.inf";

    $info_dirb = "../users/".$_GET["users"]."/other_info.db";

    $db_contents = file_get_contents($db_dir);
    $info_contents = file_get_contents($info_dir);
    $info_contentsb = file_get_contents($info_dirb);

    $mc = $info_contents;

    $info_contents_array = explode("&,",$info_contents);

    if(!empty($mnickname) && !empty($musername) && !empty($memail) && !empty($mphone)){
      if($musername == $username){
        $info_contents_array[0] = $mnickname;
        $info_contents_array[1] = $musername;
        $info_contents_arrayb[0] = $mmiddle_name;

        $info_contents_array[2] = $memail;
        $info_contents_array[4] = $mphone;
        $r_infos = implode("&,", $info_contents_array);
        $r_infosb = implode("&,", $info_contents_arrayb);

      $replaced_info = str_replace($mc, $r_infos, $db_contents);
      $replaced_infob = str_replace($mc, $r_infos, $info_contents);
      $replaced_infobo = str_replace($mc, $r_infosb, $info_contentsb);

      file_put_contents($db_dir, $replaced_info);
      file_put_contents($info_dir, $replaced_infob);
      //change the sessions
      
      $success_upload = "true";
      }
      else{
        if(strpos($db_contents, "&,".$musername."&,") !== false){
      echo "Username Already Exists";
    }
    else{
        $info_contents_array[0] = $mnickname;
        $info_contents_array[1] = $musername;
        $info_contents_arrayb[0] = $mmiddle_name;

        $info_contents_array[2] = $memail;
        $info_contents_array[4] = $mphone;
        $r_infos = implode("&,", $info_contents_array);
        $r_infosb = implode("&,", $info_contents_arrayb);


      $replaced_info = str_replace($mc, $r_infos, $db_contents);
      $replaced_infob = str_replace($mc, $r_infos, $info_contents);
      $replaced_infobo = str_replace($mc, $r_infosb, $info_contentsb);

      file_put_contents($db_dir, $replaced_info);
      file_put_contents($info_dir, $replaced_infob);
      //change the sessions
      
        
      $success_upload = "true";

      //log to activity log
		 $log_date = date("d/m/y");
		 $log_time = date("h:i A");
		 $log_activity = "Your account info was edited";

		 $activity_log_file = "../users/".$_GET["users"]."/activity_log.json";
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
      

    }
    else{
      echo "Please Input something";
    }
                        }
                        else{
                          echo "You can update your info";
                        }
                      ?>

    <div class="rounded bg-white text-dark my-5" style=" width:400px; height:500px; overflow: scroll">
        <h1 class="text-center w-100 bg-success text-white px-4 py-2">Edit User Details</h1>
        <div class="py-3 px-3">
            <form method="post" action="" style="<?php if(isset($success_upload)){echo 'display: none';}else{echo 'display: block';} ?>">
                <div class="d-flex flex-column ">
                    <label>Name</label>
                    <input type="text" name="nickname" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $name; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $middle_name; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Username</label>
                    <input type="text" name="username" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $username; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Email</label>
                    <input type="text" name="myemail" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $email; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Gender</label>
                    <input type="text" name="gender" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $gender; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Marital Status</label>
                    <input type="text" name="marital_status" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $marital_status; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Country Code</label>
                    <input type="number" name="country_code" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $country_code; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Zip Code</label>
                    <input type="text" name="zip_code" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $zip_code; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>House Address</label>
                    <input type="text" name="house_address" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $house_address; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Occupation</label>
                    <input type="text" name="occupation" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $occupation; ?>">
                </div>
                <br>
                <div class="d-flex flex-column ">
                    <label>Phone Number</label>
                    <input type="number" name="phone" class="border border-1 border-success rounded shadow lead p-2 fw-bold" style="width:300px; height:initial" value="<?php echo $phone_number; ?>">
                </div>
                <br>
                
                
                <br>
                <div class="d-flex flex-row-reverse justify-content-between">
                    <button class="btn btn-success btn-lg">Save Changes</button>
                    <a <?php echo "href='?r=home&users=".$_GET["users"]."'"; ?> class="btn btn-dark btn-lg">Cancel</a>
                </div>
            </form>
            <section style="position: relative; top:0px; left:0px; width:100%; height: 100%; background: white;<?php if(isset($success_upload)){echo 'display: block';}else{echo 'display: none';} ?>">
                          <div style="display: flex;flex-direction: column; align-items: center; justify-content: space-between; width: initial; gap: 3rem" class="px-3 py-3">
                            <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                            <p class="display-5">Profile Edit Successfull</p>
                          </div>

                          <br>
                <div class="d-flex flex-row-reverse justify-content-between">
                    
                    <a <?php echo "href='?r=home&users=".$_GET["users"]."'"; ?> class="btn btn-dark btn-lg">Cancel</a>
                </div>
                    </section>
        </div>
    </div>
</section>
<style>
    body{
        overflow-y: hidden;
        height:100vh;
    }
</style>