<?php

ob_start();

include("widgets/alert.widget");
include("widgets/loading2.widget");
include("widgets/general_popup.widget");
include("widgets/general_popup2.widget");
include("widgets/info.widget");

template_include("home.html", CREATE_PRODUCT);

if(isset($_SESSION["alert"])){
    showAlert($_SESSION["alert"]);
    unset($_SESSION["alert"]);
}

if(isset($_POST["product"]) && $_POST["product"]!=""){
    $pdm = file_get_contents("dbase/products.csv");
     $pd_arrm = explode(",",$pd);

     $imp = $_POST["product"].",".$pdm;

     file_put_contents("dbase/products.csv",$imp);
     $_SESSION["alert"] = "You have successfully added a product.";


     header("location: create_product");
}
else{
    $_SESSION["alert"] = "Please Input something.";

}

ob_end_flush();
?>

