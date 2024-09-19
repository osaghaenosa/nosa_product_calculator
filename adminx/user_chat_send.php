<?php
session_start();
$m_id = "admin";

if(isset($_POST["my_messages"]) && isset($_GET["message"])){
    $other_id = $_GET["message"];
    if(!empty($_POST["my_messages"])){
        //get the message fiile from me
        $msg_file = "messages/chats/msg/$other_id.php";
        //get the message fiile from the reciepient
        $other_msg_file = "../users/".$other_id."/messages/chats/msg/$m_id.php";
        // if message files exists
        if(!file_exists($msg_file) || !file_exists($other_msg_file)){
            fopen($msg_file,"a+");
            fopen($other_msg_file,"a+");
            echo "file does not exist";
            //my mmessages
            $messages_d = file_get_contents($msg_file);
            //reciepients messages
            $other_messages_d = file_get_contents($other_msg_file);
            $current_time = date("h:i A");
        }
        else{
            //my mmessages
            $messages_d = file_get_contents($msg_file);
            //reciepients messages
            $other_messages_d = file_get_contents($other_msg_file);
            $current_time = date("h:i A");

            //filter the message to plain text
        $u_msg = filter_var($_POST["my_messages"], FILTER_SANITIZE_STRING);

        $star_seen = "<"."?php if(file_get_contents(\"../../../../".$other_id."/messages/chats/msg/admin.unread\") == ''){echo \"<i class='bi bi-star-fill'></i>\";}else{echo \"<i class='bi bi-star'></i>\";} ?".">";

        //design the message output for me
        $output = "<div class=\"chat-me\">
        <p>$u_msg <br><a class='text-dark text-decoration-none' style='font-size:10px;display:flex;flex-direction:row-reverse;gap:0.5rem'>$star_seen<span>$current_time</span></a></p>
    </div>"; 
        //design the message output for reciepient
        $output_other = "<div class=\"chat-other\">
            <p>$u_msg <br><a class='text-light text-decoration-none' style='font-size:10px;display:flex;flex-direction:row-reverse'><span>$current_time</span></a></p>
        </div>"; 

        //update the messages
        file_put_contents($msg_file,$messages_d."\n".$output);
        file_put_contents($other_msg_file,$other_messages_d."\n".$output_other);

        //update my message list
        $my_message_list_file = "messages/chats/list.l";
        //check if the list file exists
        if(!is_file($my_message_list_file)){
            fopen($my_message_list_file, "a+");
        }
        else{
            $my_message_list = file_get_contents($my_message_list_file);
            $my_replaced_msg_list = "";
            $my_updated_msg_list = "";
            //check if the id of the reciepient exists in my list.l file
            if(strpos($my_message_list,$other_id) !== FALSE){
                //if the list file content is an array?
                if(strpos($my_message_list,",") !== FALSE){
                     //replace the id with empty

                     //if there is comma(,) at the left, replace both the comma and the id with ""
                     if(strpos($my_message_list,",".$other_id) !== FALSE){
                        $my_replaced_msg_list = str_replace(",".$other_id,"",$my_message_list);
                        $my_updated_msg_list = $other_id.",".$my_replaced_msg_list;
                        echo "comma at the left";
                     }
                     //if there is comma(,) at the right, replace both the comma and the id with ""
                     else if(strpos($my_message_list,$other_id.",") !== FALSE){
                        $my_replaced_msg_list = str_replace($other_id.",","",$my_message_list);
                        $my_updated_msg_list = $other_id.",".$my_replaced_msg_list;
                        echo "comma at the right";
                     }
                     else{
                        $my_replaced_msg_list = str_replace($other_id,"",$my_message_list);
                        $my_updated_msg_list = $other_id;
                     }
                    
                    //update the list
                    //$my_updated_msg_list = $other_id;
                }
                else{
                    //if it is not an array
                    $my_updated_msg_list = $other_id;
                    echo "list_a";
                    //check if thesame file exists
                    // if(strpos($my_message_list,$other_id) !== FALSE){

                    // }
                    // else{
                    //     $my_updated_msg_list = $other_id.",".$my_message_list;
                    // }
                    
                    
                }
                
            }
            else{
                //if it cannot find the id
                //if the list file content is an array?
                echo "a";
                if(!strpos($my_message_list,",") !== FALSE){
                    $my_updated_msg_list = $other_id.",".$my_message_list;
                }
                else{
                    $my_updated_msg_list = $other_id;
                }
                
            }
            //update the list.l file
            file_put_contents($my_message_list_file,$my_updated_msg_list);
        }


        //update reciepients message list
        $other_message_list_file = "../users/".$other_id."/messages/chats/list.l";
        //check if the list file exists
        if(!is_file($other_message_list_file)){
            fopen($other_message_list_file, "a+");
        }
        else{
            $other_message_list = file_get_contents($other_message_list_file);
            $other_replaced_msg_list = "";
            $other_updated_msg_list = "";
            //check if my id exists in reciepient's list.l file
            if(strpos($other_message_list,$m_id) !== FALSE){
                //if the list file content is an array?
                if(strpos($other_message_list,",") !== FALSE){
                     //replace the id with empty

                     //if there is comma(,) at the left, replace both the comma and the id with ""
                     if(strpos($other_message_list,",".$m_id) !== FALSE){
                        $other_replaced_msg_list = str_replace(",".$m_id,"",$other_message_list);
                        $other_updated_msg_list = $m_id.",".$other_replaced_msg_list;
                        echo "comma at the left";
                     }
                     //if there is comma(,) at the right, replace both the comma and the id with ""
                     else if(strpos($other_message_list,$m_id.",") !== FALSE){
                        $other_replaced_msg_list = str_replace($m_id.",","",$other_message_list);
                        $other_updated_msg_list = $m_id.",".$other_replaced_msg_list;
                        echo "comma at the right";
                     }
                     else{
                        $other_replaced_msg_list = str_replace($m_id,"",$other_message_list);
                        $other_updated_msg_list = $m_id;
                     }
                    
                    //update the list
                    //$my_updated_msg_list = $other_id;
                }
                else{
                    //if it is not an array
                    
                    $other_updated_msg_list = $m_id;
                }
                
            }
            else{
                //if the id is not found
                //if the list file content is an array?
                if(strpos($other_message_list,",") !== FALSE){
                    $other_updated_msg_list = $m_id.",".$other_message_list;
                }
                else{
                    $other_updated_msg_list = $m_id;
                }
                
            }
            //update the list.l file
            file_put_contents($other_message_list_file,$other_updated_msg_list);
        }

        //send the message as last message to the last message file
        
        $me_last_message = "messages/chats/last_messages/".$other_id.".l";
        $other_last_message = "../users/".$other_id."/messages/chats/last_messages/".$m_id.".l";
        if(!file_exists($me_last_message) || !file_exists($other_last_message)){
            fopen($me_last_message,"a+");
            fopen($other_last_message,"a+");
            file_put_contents($me_last_message,$u_msg);
            file_put_contents($other_last_message,$u_msg);
        }
        else{
            file_put_contents($me_last_message,$u_msg);
            file_put_contents($other_last_message,$u_msg);
        }

        //update the unread message of the reciepient
        $other_unread_message = "../users/".$other_id."/messages/chats/msg/".$_SESSION["id"].".unread";
        $unread_o = "";
        //if file_exists
        if(!file_exists($other_unread_message)){
            fopen($other_unread_message,"a+");
            $unread_o = file_get_contents($other_unread_message);
        }
        else{
            $unread_o = file_get_contents($other_unread_message);
        }
        if(!empty($unread_o)){
            $unread_o +=1;
        }
        else{
            $unread_o = 1;
        }
        file_put_contents($other_unread_message,$unread_o);
        
        echo "successfull";
        }
        
    }
}
else{
    echo "Please Type Something";
}
?>