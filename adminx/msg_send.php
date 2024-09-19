<?php
session_start();
if(isset($_SESSION["logged_in"])){
    if ($_SESSION["logged_in"] == "true") {
    
    }
    }
    else{
    header("location: ../login");
    $_SESSION['errl'] = "Invalid Request!";
    }
$m_id = $_SESSION["id"];
if(isset($_POST["my_messages"])){
    if(!empty($_POST["my_messages"])){
        //get the message fiile
        $msg_file = "../users/".$m_id."/messages/messages.m";
        $messages_d = file_get_contents($msg_file);
        $u_msg = $_POST["my_messages"];

        //design the message output
        $output = "<div class=\"chat-me\">
        <p>$u_msg</p>
    </div>"; 

        //update the messages
        file_put_contents($msg_file,$messages_d."\n".$output);
    }
}
?>