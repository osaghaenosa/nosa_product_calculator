<link rel="stylesheet" href="../assets/css/chat.css">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Customer Care Chat</h1>
        <ol class="breadcrumb mb-4">
            <a class="breadcrumb-item active">.. / Customer care Chat</a>
        </ol>

        <div>
            <?php
            $message_list = file_get_contents("messages/messages.list"); 
            //convert to array
            $message_list_array = explode(",", $message_list);

            //loop through
            for($i=0; $i<count($message_list_array); $i++){
                $image_file = "../users/".$message_list_array[$i]."/images/avatar.jpg";
                $user_info_file = "../users/".$message_list_array[$i]."/info.inf";
                $user_info_file_array = explode("&,", file_get_contents($user_info_file));
                $user_name = $user_info_file_array[1];
                $full_name = $user_info_file_array[0];
                $r_id = $message_list_array[$i];
                $missed_message = file_get_contents("messages/".$r_id."-missed.m");
                if($missed_message != 0){
                    $missed_message_output = "<div style='width:20px; height:20px; border-radius:50%; background-color:red; font-size:10px; display: flex; justify-content: center; align-items: center; color: white'><span>$missed_message</span></div>";
                }
                else{
                    $missed_message_output = "";
                }

                $message_design = "<a href='?r=customer_care_chat&id=$r_id  ' >
                <div class=\"d-flex gap-5 align-items-center\">
                <div class=\"d-flex gap-3 align-items-center justify-content-between\">
                    <div class=\"rounded-circle border border-1 overflow-hidden \" style=\"width:100px; height:100px\">
                        <img src=\"".$image_file."\" style=\"width:100%; height:initial\">
                    </div>
                    <div class=\"d-flex flex-column \">
                        <label class=\"lead\">$full_name</label>
                        <a style=\"font-style: italic;\" class=\"text-muted text-decoration-none\">$user_name/ $r_id</a>
                    </div>
                </div>
                $missed_message_output
                </div>
            </a>
            ";

            echo $message_design;
                
            }

            //the messageing of the user aspect
            if(isset($_REQUEST["id"])){
                include("customer_care_chat_user.php");
            }
            ?>
        </div>

    </div>

</main>