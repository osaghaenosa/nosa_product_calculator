<?php
if(isset($_POST["text"]) || isset($_FILES["image_upload"])){
    if(!empty($_FILES["image_upload"])){
        $m_id = $_GET["id"];
        //upload file as message
        $uploadFile_p = "../users/".$m_id."/images/customer_care";
        if(!is_dir($uploadFile_p)){
            mkdir($uploadFile);
        }
        $img_file = $_FILES["image_upload"];
        $fileName = $_FILES["image_upload"]["name"];
        $fileTmpName = $_FILES["image_upload"]["tmp_name"];
        $fileType = $img_file["type"];
        $fileSize = $img_file["size"];
        $fileError = $img_file["error"];
        if ($fileError === UPLOAD_ERR_OK) {
        //check if it is an image
        $check = getimagesize($_FILES["image_upload"]["tmp_name"]);
        if($check === false) {
            echo "Error: File is not an image.";
            exit();
        }
        
        
        $uploadFile = $uploadFile_p."/".time();
        fopen($uploadFile,"a+");

        if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $uploadFile)) {
            $msg_file = "../users/".$m_id."/messages/messages.php";
            $admin_msg_file = "../adminx/messages/".$m_id.".m";

            $messages_d = file_get_contents($msg_file);
            $admin_messages_d = file_get_contents($admin_msg_file);

            $user_missed_message = "../users/".$m_id."/messages/customer_care_new.m";

            file_put_contents($user_missed_message, "1");

            $u_msg = $_POST["text"];
    
            //design the message output
            $output = "<div class=\"chat-other\">
            <div class='dc_img'>
            <img src='".$uploadFile."' >
            <span>$u_msg</span>
            </div>
            
            </div>"; 

            $output_admin = "<div class=\"chat-me\">
            <div class='dc_img'>
            <img src='".$uploadFile."' >
            <span>$u_msg</span>
            </div>
            
            </div>"; 
            

    echo "image uploaded";
            //update the messages
            file_put_contents($msg_file,$messages_d."\n".$output);
            file_put_contents($admin_msg_file,$admin_messages_d."\n".$output_admin);
            header("location: ?r=customer_care_chat&id=$m_id");
        }
    }
    }
    if(!empty($_POST["text"]) && $_FILES["image_upload"]["name"] == ""){
        $m_id = $_GET["id"];
        $msg_file = "../users/".$m_id."/messages/messages.php";
            $admin_msg_file = "../adminx/messages/".$m_id.".m";

            $messages_d = file_get_contents($msg_file);
            $admin_messages_d = file_get_contents($admin_msg_file);

            $user_missed_message = "../users/".$m_id."/messages/customer_care_new.m";

            file_put_contents($user_missed_message, "1");

            $u_msg = $_POST["text"];
    
            //design the message output
            $output = "<div class=\"chat-other\">
            <p>$u_msg</p>
            </div>"; 

            $output_admin = "<div class=\"chat-me\">
            <p>$u_msg</p>
        </div>"; 

    echo "text uploaded";
            //update the messages
            file_put_contents($msg_file,$messages_d."\n".$output);
            file_put_contents($admin_msg_file,$admin_messages_d."\n".$output_admin);
            header("location: ?r=customer_care_chat&id=$m_id");
    }
}
//view the message
// clear the missed message file
$missed = "messages/".$_GET["id"]."-missed.m";
file_put_contents($missed, "0");

$user_unread_message = file_get_contents("../users/".$_GET["id"]."/messages/customer_care_new.m");

?>
<div class="unity_popup_bgx">
                <div class="unity_popup">
                    <?php $user_array = explode("&,", file_get_contents("../users/".$_GET["id"]."/info.inf"));  ?>
                   <h5> You are Chatting with @<?php echo $user_array[0]; ?> </h5>
                    <section class="b_section" style="max-height:400px; overflow-y: scroll">
                        <?php
                        $user_msg_file = "messages/".$_GET["id"].".m"; 
                        include ($user_msg_file);
                        ?>
                        <div style="width:100%; height:initial; position:relative; top:-50px">
                            <i <?php if($user_unread_message == ""){echo "class=\"bi bi-star-fill lead\"";}else{echo "class=\"bi bi-star lead\"";} ?>  style="margin-left:100px; position:relative"></i>
                        </div>
                    </section>
                    
                    <div id="img_upload_box" class="py-3 bg-white" style="position:relative; bottom:10px; height:80px; width:100%; border: solid 1px black;display:flex; justify-content: center; align-items: center; gap:2rem; display:none">
                        <img id="uploadedImage" src="" alt="uploaded image" style="width:60px; height:60px; border: solid 1px black">
                        <button class="btn btn-close border border-1" id="close_img_upload"></button>
                    </div>
                    <form enctype="multipart/form-data" class="d-flex justify-content-center align-items-center gap-3 overflow-hidden" method="post" action="?r=customer_care_chat&id=<?php echo $_REQUEST['id']; ?>">
                        <button type="button" class="btn btn-ssecondary-outline overflow-hidden" style="width:50px"><i class="bi bi-image-fill fs-2"></i><input type="file" accept="images/*" style="position:relative; width:100%; height:100%;margin-top:-20px; opacity:0" name="image_upload" id="img_ix"></button>
                        <textarea name="text"></textarea>
                        <button class="btn btn-success">Submit</button>
                    </form>
                     
                    <div class="d-flex justify-content-between flex-row-reverse">
                        <button class="btn btn-secondary px-4 xclosex">Close</button>
                    </div>
                </div>
            </div>

            <style>
                .unity_popup_bgx{
                    position: fixed;
                    left:0;
                    top:0;
                    width:100%;
                    height:100%;
                    z-index:1;
                    display: none;
                    justify-content: center;
                    align-items: center;
                    background-color: rgba(0,0,0,0.5);
                    
                }
                .unity_popup_bgx .unity_popup{
                    background-color: white;
                    color: black;
                    width:400px;
                    height: initial;
                    padding: 10px 20px 10px 20px;
                    border-radius: 1rem;
                    animation: message 0.5s linear 0.3s;
                    transition: all 0.5s ease-in;
                }
                @keyframes message{
                    from{
                        transform: translateY(-50px);
                    }
                    to{
                        transform: translateY(0px);
                    }
                }

                .chat-other{
                    display: flex;

                }
                .chat-other p{
                    background: seagreen;
                    border: none;
                    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
                    border-radius: 16px;
                    border-top-left-radius: 0px;
                    color: white;
                    padding: 10px 5px 10px 5px;
                    max-width:190px;
                    word-wrap: break-word;
                }
                .chat-me{
                    display: flex;
                    flex-direction: row-reverse;
                }
                .chat-me p{
                    background: ;
                    border: none;
                    box-shadow: -2px 2px 10px rgba(0, 0, 0, 0.3);
                    border-radius: 16px;
                    border-top-right-radius: 0px;
                    padding: 10px 5px 10px 5px;
                    max-width:190px;
                    word-wrap: break-word;
                    overflow:hidden
                }
                .chat-me .dc_img{
                    display: flex;
                    flex-direction: column;
                    gap:2;
                    background: ;
                    border: none;
                    box-shadow: -2px 2px 10px rgba(0, 0, 0, 0.3);
                    border-radius: 16px;
                    border-top-right-radius: 0px;
                    padding: 10px 5px 10px 5px;
                }
                .chat-me .dc_img img{
                    max-width:200px;
                    height:initial;
                    
                    
                    word-wrap: break-word;
                    overflow:hidden
                    
                }
                .chat-other .dc_img{
                    display: flex;
                    flex-direction: column;
                    gap:2;
                    background: ;
                    border: none;
                    box-shadow: -2px 2px 10px rgba(0, 0, 0, 0.3);
                    border-radius: 16px;
                    border-top-right-radius: 0px;
                    padding: 10px 5px 10px 5px;
                }
                .chat-other .dc_img img{
                    max-width:200px;
                    height:initial;
                    
                    
                    word-wrap: break-word;
                    overflow:hidden
                    
                }

            </style>

            <script>
                var popup_unityx = document.querySelector(".unity_popup_bgx");
                var xclosex = document.querySelector(".xclosex");
                window.addEventListener("load",function(){
                    var tin = 0;
                    var itxx = setInterval(function(){
                        tin++;
                        if(tin>100){
                            popup_unityx.style.display="flex";
                            clearInterval(itxx);
                        }
                    })
                    
                });
                xclosex.onclick=function(){
                    popup_unityx.style.display = "none";
                }
                var b_section = document.querySelector(".b_section");
                b_section.scrollTo(0, b_section.innerHeight);

                var img_ix = document.querySelector("#img_ix");
                var close_img_upload = document.querySelector("#close_img_upload");
                var img_upload_box = document.querySelector("#img_upload_box");

                close_img_upload.onclick = function(){
                    img_ix.value = "";
                    img_upload_box.style.display = "none";
                }
                img_ix.onchange = function(event){
                    img_upload_box.style.display = "flex";
                    var input = event.target;
                    var reader = new FileReader();
                    reader.onload = function(){
                        var dataURL = reader.result;
                        var img = document.getElementById('uploadedImage');
                        img.src = dataURL;
                       
                        img.style.display = 'block'; // Show the image
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            </script>