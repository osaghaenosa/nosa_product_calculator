<?php
session_start();

include_once("variables.php");

//get the pages with the _GET and relocate the user to the desired location
if(null !== request("page") && isset($_REQUEST["page"])){
    switch (request("page")){
        case DASHBOARD:
            app_include("views.php",DASHBOARD);
            return 0;
        case LOGIN:
            app_include("views.php",LOGIN);
            return 0;
        case SIGNUP:
            app_include("views.php",SIGNUP);
            return 0;
        
        case PRODUCTS:
            app_include("views.php",PRODUCTS);
            return 0;
        case CREATE_PRODUCT:
            app_include("views.php",CREATE_PRODUCT);
            return 0;
        case RECORD:
            app_include("views.php",RECORD);
            return 0;
        case REPORT:
            app_include("views.php",REPORT);
            return 0;
        
        default:
        include(CORE."/views.php");
    }
        
    
}
else{
    include(CORE."/views.php");

}

?>