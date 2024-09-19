<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/chat.css">
    <div class="pages mx-3">
        <div class="quick-div-a">
            <?php
            

        if(isset($_GET["message"]) && !empty($_GET["message"])){
                        echo "<a href=\"chat\" class=\"d-flex gap-3 text-decoration-none text-dark lead\"><i class=\"bi bi-chevron-left\"></i> <span>Back</span></a><br>";
                    }
                    ?>
            
            <h5 >
                <?php
                    if(isset($_GET["message"]) && !empty($_GET["message"])){
                        //lookup details from db
            $db=fopen("../dbase/db.db", "a+");
        $in=0;
        $line=[];
        $lpos=0;
        while (!feof($db)) {
            $in++;
            $line[]=fgets($db);
        }
    
        //now that we have gotten each id of the user, then we would use the id to look for their details in the database
        for ($p=0; $p < $in; $p++) { 
            $linedata=explode("&,", $line[$p]);
            for ($j=0; $j <= 10; $j++) { 
                if($linedata[8]==$_GET['message']){
                    //get the other info's in the database
                    $_SESSION["lnumbera"]=$j;
                    $_SESSION["cnumbera"]=$p;
                }
            }
        }
        $linedata=explode("&,", $line[$_SESSION["cnumbera"]]);
        $nickname = $linedata[0];
        $username = $linedata[1];
                        echo "<span class=\"name-h5\">Messages (@".$username.")</span>";
                    }
                    else{
                        $chat_number = file_get_contents("messages/chats/list.l");
                        $uctext ="";
                        if(strpos(",",$chat_number) !== FALSE){
                            $ucta = "1";
                        }
                        else{
                            $uclarray=explode(",",$chat_number); 
                            $uctext = count($uclarray);
                        }
                        echo "<span class=\"name-h5\">Chat <span>($uctext)</span></span>";
                    }
                ?>
            
            </h5>
        </div>
        <div class="ctnx d-flex gap-2">
            <!-- This would contain the list of available chats -->
            <section class="chat_section" style="height:60vh">
                <hr>
                

                <?php
                if(isset($_GET["message"]) && !empty($_GET["message"])){
                    include("message_user.php");
                }
                else{
                    include("chatlist.php");
                }
                
                ?>
               
            </section>
            
            <section class="messages_section" style="display:none">
                <div>
                    <h3>Messages</h3>
                    <div>
                        <p class="text-muted">Click on any Chat to view Messages</p>
                    </div>
                </div>
            </section>
        </div>
        <style type="text/css">
            .user_messages p{
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 200px;
                font-style: italic;
            }
        </style>
    </div>
    <script>
        
    </script>