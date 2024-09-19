<section style="position: fixed; width:100%; height:100%; top: 0; left:0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0.5)">
    <div style="width:300px; height: initial; padding: 10px 10px 10px 10px; overflow: hidden; gap: 2rem" class="rounded bg-white d-flex flex-column">
        <div class="w-100 bg-success py-3">
            <h2 style="font-size: 15px; text-align: center; color: white">Change GCE Scratch Card Fee</h2>
        </div>
        <?php
        if(isset($_POST["new_price"])){
            if($_POST["new_price"] != ""){
                //change the amount
                file_put_contents("../dashboard/gce_price.txt", $_POST["new_price"]);
                echo "<p class='bg-success w-100 text-center py-3 text-white'>Update Successfull</p>";
            }
            else{
                echo "<p class='bg-danger w-100 text-center py-3 text-white'>Please Input Something !!!</p>";
            }
        }
         ?>
        <div class="d-flex flex-column gap-2">
            <label>OLD Price</label>
            <label class="mx-3 fw-bold lead"> <?php echo file_get_contents("../dashboard/gce_price.txt"); ?> </label>
        </div>
        <form class="d-flex flex-column gap-3" method="post" action="?r=settings&c=gce">
        <div>
        
            <label>NEW Price(N)</label>
            <input type="number" name="new_price" width="200px" height="60px" style="font-size: 20px; font-weight: bold; border: solid 1px seagreen"/>
        </div>
        <div class="d-flex flex-row gap-2 justify-content-between">
            <a class="btn btn-secondary px-2" type="btn" href="?r=settings">Cancel</a>
            <button class="btn btn-success px-2" type="submit">Update Price</button>
        </div>
        </form>
        

    </div>
</section>