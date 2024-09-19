<?php
function message_list($user_name, $image_link, $last_message, $id){
    //chec if the messages has been unread
    //check the unread messages .unread file
    $unread_message_file = "../users/".$_SESSION["id"]."/messages/chats/msg/".$id.".unread";
    $unread_message = "";
    $message_counter = "";
    // if the file exists
    if(!file_exists($unread_message_file)){
        fopen($unread_message_file,"a+");
        $unread_message = file_get_contents($unread_message_file);
    }
    else{
        $unread_message = file_get_contents($unread_message_file);
    }
    if($unread_message == ""){
        $message_counter = "";
    }
    else{
        $message_counter = "<div class=\"message_amount\">
        <span class=\"small_circle\"><span>".$unread_message."</span></span>
    </div>";
    }
    echo "<a href='?message_id=$id' class=\"chat_list\">
                    
    <div class=\"img_section\">
        <img src=\"".$image_link."\" alt=\"Image of Someone\">
    </div>
    <div class=\"text_section\">
        <span class=\"user_name\">
            <p class=\"h5 fw-bold text-success\">".$user_name."</p>
        </span>
        <span class=\"user_messages\">
            <p class=\"text-muted\">".$last_message."</p>
            
        </span>
    </div>
    ".$message_counter."
</a>";
}
?>