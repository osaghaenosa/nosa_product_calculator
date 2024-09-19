<section style="position: fixed; width:100%; height:100%; top: 0; left:0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0.5)">
    <div style="width:400px; height: initial; padding: 10px 10px 10px 10px; overflow: hidden; gap: 2rem" class="rounded bg-white d-flex flex-column">
        <div class="w-100 bg-success py-3">
            <h2 style="font-size: 15px; text-align: center; color: white">GIFTCARD Information</h2>
        </div>
        <?php
        if(isset($_POST["item_update"])){
            if($_POST["item_update"] != ""){
                //change the amount
                file_put_contents("../dashboard/order/giftcard/g_infotxt", $_POST["item_update"]);
                echo "<p class='bg-success w-100 text-center py-3 text-white'>Update Successfull</p>";
            }
            else{
                echo "<p class='bg-danger w-100 text-center py-3 text-white'>Please Input Something !!!</p>";
            }
        }
         ?>
        <div class="d-flex flex-column gap-2">
            <label></label>
            
        </div>
        <form class="d-flex flex-column gap-3" method="post" action="?r=services&d=edit_giftcard">
        <div>
        
            <label></label>
            <textarea style="width:100%; height:350px" name="item_update" ><?php echo file_get_contents('../dashboard/order/giftcard/g_infotxt'); ?></textarea>
        </div>
        <div class="d-flex flex-row gap-2 justify-content-between">
            <a class="btn btn-secondary px-2" type="btn" href="?r=services">Cancel</a>
            <button class="btn btn-success px-2" type="submit">Update</button>
        </div>
        </form>
        

    </div>
</section>