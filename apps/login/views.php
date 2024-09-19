<?php
//we are going to be doing a cross-call
//for the start, include base.html

template_include("home.html",LOGIN);

if(isset($_SESSION["errl"])){

  if($_SESSION["errl"]!=""){

    showAlert($_SESSION["errl"]);

    $_SESSION["errl"]="";

  }


}
?>