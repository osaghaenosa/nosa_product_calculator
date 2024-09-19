<?php
define("CORE", "core");
define("STATIC", "static");
define ("DATABASE", "dbase");
define("ADMIN", "adminx");
define("DASHBOARD", "dashboard");
define("PAGE", "page");
define("LOGIN", "login");
define("SIGNUP", "signup");

define("PRODUCTS", "products");
define("CREATE_PRODUCT", "create_product");

define("REPORT", "report");
define("RECORD", "record");



define("DEFAULT_THEME", "rgb(0,200,0)");

//set the device theme
function set_device_theme(){
    echo "<meta name='theme-content' content='".DEFAULT_THEME."'>";
}

//include files from template
function template_include($url,$base){
    //if we are not in the home page
    //the page would not be set
    //so
    if(isset($_GET[PAGE])) include("apps/".$base."/templates/".$url);
    else include(CORE."/templates/".$url);
}

function core_include($url){
    //if we are not in the home page
    //the page would not be set
    //so
    include("core/templates/".$url);
}

function app_include($url,$base){
    //if we are not in the home page
    //the page would not be set
    //so
    if(isset($_GET[PAGE])) include("apps/".$base."/".$url);
    
}

//function to redirect users
function redirect_client($location){
    header("location:".$location);
}


function request($v){
    if(null !== $v){
        if(isset($_REQUEST[$v])){
            return $_REQUEST[$v];
        }
        
    }
}
?>