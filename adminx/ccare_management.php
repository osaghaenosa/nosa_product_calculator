<?php
                        $t = 1711610014;
                        //echo date("Y-m-d", $t); 

                        //display all the users in the platform

                        $users_db_file = "../dbase/customer_care_db.db";
                        $user_db = fopen($users_db_file, "a+");

                        $in=0;
                        $line=[];
                        $lpos=0;
                        while (!feof($user_db)) {
                            $in++;
                            $line[]=fgets($user_db);
                            
                            
                            
                            //$idpos=strpos($line[$in],"nosa,1234");
                            
                        }

                        for ($i=0; $i < $in; $i++) { 
                            $linedata=explode("&,", $line[$i]);
                            
                                
                            //echo "<br><br>".count($linedata)."<br>";

                            
                            
                        }
                        if(isset($_GET["delete"]) && file_exists('../customer_care/users/'.$_GET["delete"]."/info.inf")){
                            function deleteFolder($folderPath) {
                                if (!is_dir($folderPath)) {
                                    return false; // Exit if not a directory
                                }
                            
                                $files = array_diff(scandir($folderPath), array('.', '..'));
                            
                                foreach ($files as $file) {
                                    $filePath = $folderPath . '/' . $file;
                                    
                                    if (is_dir($filePath)) {
                                        // Recursive call if the item is a directory
                                        deleteFolder($filePath);
                                    } else {
                                        // Delete the file
                                        unlink($filePath);
                                    }
                                }
                            
                                // Delete the folder
                                return rmdir($folderPath);
                            }
                            
                            //Delete the user's folder path
                            
                            $user_folder_path = '../customer_care/users/'.$_GET["delete"]."/";
                            $user_info = file_get_contents($user_folder_path."/info.inf");
                            
                            //remove the user info from the database
                            $g_db_file = "../dbase/customer_care_db.db";
                            $g_db = file_get_contents($g_db_file);
                            
                            $replaced_db = str_replace($user_info, "", $g_db);
                            file_put_contents($g_db_file, $replaced_db);
                            
                            deleteFolder($user_folder_path);
                            
                            header("location: ../adminx/?r=ccare_management");
                            $_SESSION["rrr"] = "You have successfully Deleted a users account";
                        }
                        ?>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        User Management Table
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    
                    <th>Action</th>
                    
                </tr>
            </tfoot>
            <tbody>
            <?php
            for ($i=0; $i < $in; $i++) { 
                $linedata=explode("&,", $line[$i]);
                
                    
                //echo "<br><br>".count($linedata)."<br>";

                
                if(isset($linedata[$i]) && $linedata[$i] != ""){
                    $users_full_name = $linedata[0];
                    $users_full_email = $linedata[2];
                   
                    $users_d = "<a href='?r=home&users=".$linedata[8]."'><tr>
                    <td><a href='?r=ccare_management&users=$linedata[8]'>$users_full_name</a></td>
                    <td><a href='?r=ccare_management&users=".$linedata[8]."'>$users_full_email</a></td>
                    
                    <td><a href='?r=ccare_management&delete=".$linedata[8]."' class='btn btn-danger'>Delete Account</a></td>
                                    </tr></a>
                                    ";
                    echo $users_d;
                }
                                
            }
            
            ?>

            </tbody>
        </table>
    </div>
</div>