<?php
session_start();
ob_Start();
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
$url = "https://";
else
$url = "http://";
// Append the host(domain name, ip) to the URL.
$url.= $_SERVER['HTTP_HOST'];
// Append the requested resource location to the URL
$url.= $_SERVER['REQUEST_URI'];
//echo $url;

if($url == "http://localhost/precious/dashboard/"){
header("location: home");

}

ob_flush();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="../assets/css/cards2.css">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="./transactions.css">
            <link rel="stylesheet" href="./wallet.css">
            <link rel="stylesheet" href="../assets/css/dash.css">
        </head>
        
        <body>
            <div class="entire-grid" style="overflow:hidden">
            <div >
                    <nav class="d-flex justify-content-between w-100" style="background:#F5F7FC;position:absolute; top:0px; left:0px;">
                    <div style="width:50px; height:50px; border:solid 1px green; display:flex; align-items:center;justify-content:center;margin-top:0.5rem;margin-left:0.5rem;" class="toggle_menu"><i class="bi bi-list"></i></div>    
                    <!-- <img class="dashboard-img" src="../assets/images/mercelinous-logo-3.PNG" alt="" style="width:initial; height: 40px;opacity:0"> -->
                        
                        
                        <ul class="un-ordered-class un-ordered">
                            <li class="notification-links px-2">
                                <a class="notification-anchor text-dark fw-bold " data-bs-toggle="offcanvas" href="#notifications" role="button" aria-controls="notifications"><i class="bi bi-bell position-absolute"></i></a>
                            </li>
                            <li class="notification-links px-2">
                                <a class="notification-anchor text-dark fw-bold" href='chat'><i class="bi bi-chat-square-dots position-absolute"></i></a>
                            </li>
                            <li>
                                <div class="dropdown mt-2" style="">
                                    <a class="btn  dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="../assets/images/dummy.jpeg" class="rounded-circle" style="width:30px; height: 30px; background: red;">
                                    </a>
                                    <ul class="dropdown-menu">
                                        
                                        <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                                        
                                    </ul>
                                </div>
                            </li>
                            
                            
                        </ul>
                    </nav>
                </div>
                <div class=" d-none d-lg-block">
                    <div id="mySidebar" class="sidebar">
                        <img class="dashboard-img" src="../assets/images/mercelinous-logo-3.PNG" alt="" style="padding-bottom: 20px">
                        <!-- <img class="dashboard-img" src="../assets/images/mercelinous-logo-3.PNG" alt=""> -->
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                        <a  class="show <?php if(isset($_GET['r']) && $_GET['r'] == "home"){echo('sel');}else{echo('');} ?>" aria-flowto="" href="./home" onclick="loadPages('initial.html')">
                            <svg
                                class="bi bi-house home-svg"
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                                </svg>
                            Dashboard</a>
                            <a  class="show <?php if(isset($_GET['r']) && $_GET['r'] == "users"){echo('sel');}else{echo('');} ?>"  href="./users" onclick="loadPages('users.html')">
                            <svg class="bi bi-person-fill home-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>Users</a>
                                        <a onclick="loadPages('controls.html')" href="./controls" class="show  <?php if(isset($_GET['r']) && $_GET['r'] == "controls"){echo('sel');}else{echo('');} ?>">
                                            <svg
                                                class="bi bi-wallet2 home-svg"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                fill="currentColor"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                                                </svg>Controls</a>
                                                
                                                        <a onclick="loadPages('setting.html')" href="./settings" class="show <?php if(isset($_GET['r']) && $_GET['r'] == "settings"){echo('sel');}else{echo('');} ?>">
                                                            <svg
                                                                class="bi bi-gear home-svg"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="16"
                                                                height="16"
                                                                fill="currentColor"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                                                    <path
                                                                        d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                                                    </svg>Settings</a>
                                                                    
                                                                            </div>
                                                                            <div id="main">
                                                                                <button class="openbtn" onclick="openNav()">☰
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- second grid section -->
                                                                        <!-- second grid section -->
                                                                        <div class="first-grid-div">
                                                                            <?php
                                                                            // include("../widgets/info.widget");
                                                                            
                                                                            // if(isset($_SESSION['info_widget'])){
                                                                            // showInfo($_SESSION['info_widget']);
                                                                            // //unset($_SESSION['info_widget']);
                                                                            // }
                                                                            // if(is_file("../users/".$_SESSION['id']."/transactions/security/secretpin.pin")){
                                                                            //     if(file_get_contents("../users/".$_SESSION['id']."/transactions/security/secretpin.pin") != ""){
                                                                            //         unset($_SESSION["info_widget"]);
                                                                            //     }
                                                                            // }
                                                                            ?>
                                                                            
                                                                            <div class="pages" style="padding-top: 80px;">
                                                                                <!-- This will contain all the pages that we would load on this website -->
                                                                                <?php
                                                                                /*the php pagee*/
                                                                                if(isset($_GET['order'])){
                                                                                // for the orders
                                                                                if(isset($_GET['order'])){
                                                                                
                                                                                include("order/".$_GET["order"].".php");
                                                                                
                                                                                
                                                                                }
                                                                                }
                                                                                else{
                                                                                if(isset($_GET["r"])){
                                                                                if($_GET["r"] == "home"){
                                                                                include("initial.html");
                                                                                }
                                                                                else if($_GET["r"] == "users"){
                                                                                include("users.html");
                                                                                }
                                                                                else if($_GET["r"] == "controls"){
                                                                                include("controls.html");
                                                                                }
                                                                                
                                                                                else if($_GET["r"] == "settings"){
                                                                                include("setting.html");
                                                                                }
                                                                                
                                                                                else if($_GET["r"] == ""){
                                                                                header("location: /home");
                                                                                }
                                                                                
                                                                                }
                                                                                else{
                                                                                header("location ../dashboard/home");
                                                                                }
                                                                                
                                                                                }
                                                                                
                                                                                
                                                                                ?>
                                                                            </div>
                                                                            <div class="d-flex shadow-lg bg-success text-light text-center" onclick="toggleChat()" style="width:50px; height:50px; position:fixed; bottom:5px; right:5px; border-radius: 30px;font-size: 2rem;">
                                                                                <i class="bi bi-chat-right-dots-fill text-center px-2"></i>
                                                                            </div>
                                                                            <div class="px-3 py-5 bg-light rounded shadow-lg" style="width: 300px; height: 500px; position: fixed; right: 5px; bottom: 60px;" id="chat_popup">
                                                                                <h3>Chat</h3>
                                                                                <p>Chat</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- For the notification Off Canvas -->
                                                                <div class="offcanvas offcanvas-end" tabindex="-1" id="notifications" aria-labelledby="notil">
                                                                    <div class="offcanvas-header">
                                                                        <h5 class="offcanvas-title" id="notil">Notifications</h5>
                                                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="offcanvas-body">
                                                                        <div>
                                                                            <?php
                                                                            $noti = file_get_contents("../users/".$_SESSION["id"]."/notiitem.txt");
                                                                            if(empty($noti)){
                                                                            echo "<p class='lead text-secondary text-center'><i class='bi bi-bell' style='font-size:3rem'></i><br>No Notifications Yet!</p>";
                                                                            }
                                                                            else{
                                                                            echo $noti;
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class = 'd-none align-items-center justify-content-center'><img src='../assets/images/loading(1).png' style = 'animation: spin 1.0s linear infinite' alt='non' width='50px' height='50px' ></div>
                                                                <script src="../assets//js/cards.js"></script>
                                                                <script>
                                                                var pages = document.querySelector(".pages");
                                                                //first start, load the initial page
                                                                //loadPages("initial.html");
                                                                //the load pages code
                                                                function loadPages(content) {
                                                                // using Ajax Library
                                                                let request = new XMLHttpRequest();
                                                                if (request) {
                                                                //load the external file
                                                                request.onreadystatechange = function () {
                                                                if (this.readyState === 4 && this.status == 200) {
                                                                //pages.innerHTML = this.responseText;
                                                                }
                                                                };
                                                                pages.innerHTML = "<div class = 'd-flex align-items-center justify-content-center'><img src='../assets/images/loading(1).png' style = 'animation: spin 1.0s linear infinite' alt='non' width='50px' height='50px' ></div>";
                                                                request.open("GET", `${content}`, true);
                                                                request.send();
                                                                }
                                                                }
                                                                function loadDummyPages(content, callback) {
                                                                // using Ajax Library
                                                                let request = new XMLHttpRequest();
                                                                if (request) {
                                                                //load the external file
                                                                pages.innerHTML = "Loading...";
                                                                request.open("GET", `${content}`, true);
                                                                request.onreadystatechange = function () {
                                                                if (this.readyState === 4 && this.status == 200) {
                                                                callback.call(this, this.response);
                                                                }
                                                                };
                                                                
                                                                
                                                                request.send();
                                                                }
                                                                }
                                                                // window.addEventListener("popstate", function(data){
                                                                //     loadDummyPages(this.window.location.pathname, function(data){
                                                                //         pages.innerHTML = data;
                                                                //     });
                                                                // })
                                                                </script>
                                                                <script>
                                                                var chat_popup = document.querySelector("#chat_popup");
                                                                var chat_toggle =0;
                                                                chat_popup.style.display = 'none';
                                                                chat_popup.style.opacity = '0';
                                                                function toggleChat(){
                                                                chat_toggle++;
                                                                if(chat_toggle == 1){
                                                                chat_popup.style.display = 'block';
                                                                chat_popup.classList.add("animate_card_popup");
                                                                chat_popup.style.opacity = '1';
                                                                }
                                                                else {
                                                                chat_popup.style.display = 'none';
                                                                chat_popup.classList.remove("animate_card_popup");
                                                                }
                                                                }
                                                                setInterval(function(){
                                                                if(chat_toggle >1){
                                                                chat_toggle =0;
                                                                }
                                                                }, 10);
                                                                
                                                                </script>
                                                                <style type="text/css">
                                                                @keyframes spin{
                                                                from{
                                                                transform: rotate(0deg);
                                                                }
                                                                to{
                                                                transform: rotate(360deg);
                                                                }
                                                                }
                                                                .animate_card_popup{
                                                                opacity: 1;
                                                                animation: pop 0.4s linear 0.3s;
                                                                }
                                                                @keyframes pop{
                                                                from{
                                                                opacity: 0;
                                                                transform: scale(0);
                                                                }
                                                                to{
                                                                opacity: 1;
                                                                transform: scale(1.0);
                                                                }
                                                                }
                                                                input[type="number"] {
                                                                -moz-appearance: textfield;
                                                                }
                                                                input[type="number"]::-webkit-inner-spin-button,
                                                                input[type="number"]::-webkit-outer-spin-button {
                                                                -webkit-appearance: none;
                                                                margin: 0;
                                                                }
                                                                </style>
                                                            </body>
                                                        </html>