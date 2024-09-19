<?php
if(isset($_GET["maintain"])){
    if(is_file("../dashboard/maintenance.txt")){
        file_put_contents("../dashboard/maintenance.txt", "on");
        $_SESSION['rrr'] = "<div class='d-flex flex-column align-items-center justify-content-center gap-3'><i class='bi bi-check-circle-fill' style='font-size: 30px'></i><p>Successfully Kept the website on Maintenance Mode</p></div>";
        header("location: ?r=maintenance");
    }
}
if(isset($_GET["demaintain"])){
    if(is_file("../dashboard/maintenance.txt")){
        file_put_contents("../dashboard/maintenance.txt", "off");
        $_SESSION['rrr'] = "<div class='d-flex flex-column align-items-center justify-content-center gap-3'><i class='bi bi-check-circle-fill' style='font-size: 30px'></i><p>Successfully Deactivated Maintenance Mode</p></div>";
        header("location: ?r=maintenance");
    }
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Maintenance Mode</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard / Maintenance</li>
        </ol>

        <div class="d-flex flex-column align-items-center justify-content-center">
            <img src="../assets/images/alert.png" style="width: 100px; height: initial">
            <br>
            <?php
            if(file_get_contents("../dashboard/maintenance.txt") == "off"){
                echo '<a href="?r=maintenance&maintain" class="btn btn-dark px-5 py-2">Activate Maintenance Mode</a>';
            }
            else{
                echo '<a href="?r=maintenance&demaintain" class="btn btn-dark px-5 py-2">Deactivate Maintenance Mode</a>';
            }
            ?>
            
        </div>
    </div>
</main>