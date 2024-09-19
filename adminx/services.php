<?php
if(isset($_GET["d"])){
  if($_GET["d"] == "edit_giftcard"){
    include("d/edit_giftcard.php");
  }
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Services</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard / Services</li>
        </ol>

        <div>
            <a href="?r=services&d=edit_giftcard">Edit Gift Card Information</a>
        </div>
    </div>
</main>