<?php
include("chatlist_style.php");
//this would be the code that would convert the array of user chat

//get the array of the users list.l file
$user_chat_list = file_get_contents("messages/chats/list.l");
//check if there is anything in the file
if(!empty($user_chat_list)){
//convert to array
//firstly check if it is an array
if(!strpos($user_chat_list,",") !== FALSE){
    //if it is a string, then ...
    $db=fopen("../dbase/db.db", "a+");
        $in=0;
        $line=[];
        $lpos=0;
        while (!feof($db)) {
            $in++;
            $line[]=fgets($db);
        }
    
        //now that we have gotten each id of the user, then we would use the id to look for their details in the database
        for ($p=0; $p < $in; $p++) { 
            $linedata=explode("&,", $line[$p]);
            for ($j=0; $j <= 10; $j++) { 
                if($linedata[8]==$user_chat_list){
                    //get the other info's in the database
                    $_SESSION["lnumbera"]=$j;
		            $_SESSION["cnumbera"]=$p;
                }
            }
        }
        $linedata=explode("&,", $line[$_SESSION["cnumbera"]]);
        $nickname = $linedata[0];
        $username = $linedata[1];
        $image_link = "../users/".$linedata[8]."/images/avatar.jpg";
        $last_message = "";
        // check if the last message file is present, else create a new one
        $last_message_file = "../users/".$linedata[8]."/messages/chats/last_messages/".$_SESSION["id"].".l";
        if(!is_file($last_message_file)){
            fopen($last_message_file,"a+");
            $last_message = file_get_contents($last_message_file);
        }
        else{
            $last_message = file_get_contents($last_message_file);
        }

        $user_id = $linedata[8];
        
         
        message_list($username,$image_link,$last_message,$user_id);
}
else{
    //then it is an array
    $user_chat_list_arraya = explode(",",$user_chat_list);
    $user_chat_list_array = array_unique($user_chat_list_arraya);
    //loop through the array
    $db=fopen("../dbase/db.db", "a+");
        $in=0;
        $line=[];
        $lpos=0;
        while (!feof($db)) {
            $in++;
            $line[]=fgets($db);
        }
    for($i=0; $i<count($user_chat_list_array); $i++){
        //now that we have gotten each id of the user, then we would use the id to look for their details in the database
        for ($p=0; $p < $in; $p++) { 
            $linedata=explode("&,", $line[$p]);
            for ($j=0; $j <= 10; $j++) { 
                if($linedata[8]==$user_chat_list_array[$i]){
                    //get the other info's in the database
                    $_SESSION["lnumbera"]=$j;
		            $_SESSION["cnumbera"]=$p;
                }
            }
        }
        $linedata=explode("&,", $line[$_SESSION["cnumbera"]]);
        $nickname = $linedata[0];
        $username = $linedata[1];
        $image_link = "../users/".$linedata[8]."/images/avatar.jpg";
        // check if the last message file is present, else create a new one
        $last_message_file = "messages/chats/last_messages/".$_SESSION["id"].".l";
        if(!is_file($last_message_file)){
            fopen($last_message_file,"a+");
            $last_message = file_get_contents($last_message_file);
        }
        else{
            $last_message = file_get_contents($last_message_file);
        }

        $user_id = $linedata[8];
         
        message_list($username,$image_link,$last_message,$user_id);
        
    }
}
}
else{
    echo "Chat List is Empty!!!";
}
?>