<?php
ob_start();
session_start();
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

$user_folder_path = '../users/'.$_GET["id"]."/";
$user_info = file_get_contents($user_folder_path."/info.inf");

//remove the user info from the database
$g_db_file = "../dbase/db.db";
$g_db = file_get_contents($g_db_file);

$replaced_db = str_replace($user_info, "", $g_db);
file_put_contents($g_db_file, $replaced_db);

deleteFolder($user_folder_path);

header("location: ../adminx/?r=home");
$_SESSION["rrr"] = "You have successfully Deleted a users account";
ob_flush();
?>