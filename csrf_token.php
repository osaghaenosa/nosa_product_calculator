<?php
//create a csrf token
function csrf_token_input(){
    $random_csrf_token = password_hash('boy', PASSWORD_DEFAULT);
    //create the input field
    $input_field = "
    <input type='text' visibility='hidden' style='display:none' value='".$random_csrf_token."' name='csrf_token'>
    ";
    echo $input_field;
}
function csrf_token_verify($redirect){
    if(isset($_POST["csrf_token"]) && !empty($_POST["csrf_token"])){
        //check if the csrf_token is correct
        $verified_token = password_verify("boy", $_POST["csrf_token"]);
        if($verified_token !== true){
            //redirect
            exit(1);
            header("location: $redirect");
        }
    }
}
?>