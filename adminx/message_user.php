<section class="user-chat-body" style="height: 100%">
<?php
//read the message
$my_unread_message = "messages/chats/msg/".$_GET["message"].".unread";
file_put_contents($my_unread_message,"");
// if the message file exists
$m_out_file = "messages/chats/msg/".$_GET["message"].".php";
$other_out_msg_file = "../users/".$_GET['message']."/messages/chats/msg/admin.php";
if(!file_exists($m_out_file)){
    fopen($m_out_file,"a+");
    fopen($other_out_msg_file, "a+");
}
else{
    //include("../users/".$_SESSION["id"]."/messages/chats/msg/".$_GET["message_id"].".php");
}

?>
</section>
<a class="bg-success text-white px-2 py-1 position-fixed" id="user_active"></a>
<iframe id="chat_msg_frman" name="chat_msg_frmafn" class="d-none"></iframe>
<form target="chat_msg_frman" action="user_chat_send.php?message=<?php echo $_GET['message']; ?>" enctype="multipart/form-data" method="post">
    <section class="user_chat-bottom py-2 position-fixed pb-3 mw-100 d-flex align-items-center responsive_chat_bottom" style="width:500px;height:50px; bottom: 20px;">
        <div class="add_items" style="width:30px; height: 30px; overflow:hidden"><i class="bi bi-plus"></i></div>
        <div class="input-group-text py-1 mx-1" style="width:calc(100% - 90px)">
            <textarea placeholder="Your Messages Here ..." type="text" id="mxtx" class="w-100 border-0" style="width:400px" name="my_messagesa"></textarea>
            <textarea placeholder="Your Messages Here ..." type="text" id="mxtxa" style="display:none" class="w-100 border-0" name="my_messages"></textarea>
        </div>
        <div>
            <button type="submit" id = "bxtxb" onclick="c_submit()" class="bxtx px-3 py-3 border-0 text-success"> <i class="bi bi-send"></i></button>
        </div>
    </section>
</form>
<style>
    .user_chat_bottom{
        width:100%;
    }
</style>

<script>
    var user_chat_body = document.querySelector(".user-chat-body");

    var bxtxb = document.querySelector("#bxtxb");
    var mxtx = document.querySelector("#mxtx");
    var mxtxa = document.querySelector("#mxtxa");
    var cdd =0;
    
    setInterval(() => {
        if(mxtx.value !=""){
            mxtxa.value = mxtx.value;
        }
    }, 10);
    bxtxb.onclick = function(){
        mxtx.value = "";
        cdd=0;
            //chat_section.scrollTo(0, chat_section.scrollHeight);
            user_chat_body.innerHTML += "<div class='chat-me'><p>"+mxtxa.value+"<br><a style='font-size:10px'>Sending...<a></p></div>";
            chat_section.scrollTo(0, chat_section.scrollHeight);
        
    }

    var chat_section = document.querySelector(".chat_section");
    var user_active = document.querySelector("#user_active");
        //chat_section.scrollTo(0, chat_section.scrollHeight);
        //alert(chat_section.scrollHeight);
        

    var user_msg_request = new XMLHttpRequest();
    var user_msg_alert_request = new XMLHttpRequest();
    var user_active = new XMLHttpRequest();
    var cdd =0;
    var m_interval = 10;
    
    //the submit button
    function c_submit(){
        user_chat_body.innerHTML = "<div class='chat-me'><p>"+mxtxa.value+"</p></div>";
              
        loadUserMessages();
    }
    
    
   // Function to handle loading user messages
function loadUserMessages() {
    if (user_msg_request) {
        user_msg_request.open("GET", '<?php echo "messages/chats/msg/".$_GET["message"].".php"; ?>', true);
        user_msg_request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status == 200) {
                cdd++;

                if (cdd == 4) {
                    chat_section.scrollTo(0, chat_section.scrollHeight);
                    cdd = 5;
                }

                m_interval=0.5;

                user_chat_body.innerHTML = this.responseText;
            }
            else{
                m_interval = 100;
                
            }
           
            //user_chat_body.innerHTML = "<div class = 'd-flex align-items-center justify-content-center' style='height:90vh'><img src='../assets/images/loading(1).png' style = 'animation: spin 1.0s linear infinite' alt='non' width='50px' height='50px' ></div>";
                
        };
        user_msg_request.send();
    }
}

// Function to handle checking user activity
function checkUserActivity() {
    if (user_active) {
        user_active.open("GET", '<?php echo "?message=".$_GET["message"]; ?>', true);
        user_active.onreadystatechange = function () {
            if (user_active.readyState === 4 && user_active.status == 200) {
                // Handle user activity response if needed
                user_active.textContent = "Active";
                
            }
            else{
               
            }
        };
        user_active.send();
    }
}

// Function to periodically execute tasks
function periodicTasks() {
    loadUserMessages();
    checkUserActivity();
    // Add more tasks if needed
}

// Execute tasks periodically using setInterval
setInterval(periodicTasks, m_interval);


        
        
        
</script>