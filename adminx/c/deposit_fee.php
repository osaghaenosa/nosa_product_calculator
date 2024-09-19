<?php
$deposit_file = file_get_contents("../dashboard/deposit_fee.txt");
$deposit_file_array = explode(",", $deposit_file);

$percentage = $deposit_file_array[0];
$cap = $deposit_file_array[1];
?>
<section style="position: fixed; width:100%; height:100%; top: 0; left:0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0.5)">
    <div style="width:300px; height: initial; padding: 10px 10px 10px 10px; overflow: hidden; gap: 2rem" class="rounded bg-white d-flex flex-column">
        <div class="w-100 bg-success py-3">
            <h2 style="font-size: 15px; text-align: center; color: white">Change Deposit Fee</h2>
        </div>
        <?php
        if(isset($_POST["new_percentage"]) || isset($_POST["new_cap"])){
            if($_POST["new_percentage"] != "" && $_POST["new_cap"] != ""){
                //change the amount
                $d_fee = file_get_contents("../dashboard/deposit_fee.txt");
                $d_fee_arr = explode(",",$d_fee);
                $d_fee_arr[0] = $_POST["new_percentage"];
                $d_fee_arr[1] = $_POST["new_cap"];
                $updated_fee = implode(",", $d_fee_arr);
                file_put_contents("../dashboard/deposit_fee.txt",  $updated_fee);
                echo "<p class='bg-success w-100 text-center py-3 text-white'>Update Successfull</p>";
            }
            else{
                echo "<p class='bg-danger w-100 text-center py-3 text-white'>Please Input Something !!!</p>";
            }
        }
         ?>
        <div class="d-flex flex-column gap-2">
            <label>OLD Percentage</label>
            <label class="mx-3 fw-bold lead"> <?php echo $percentage ?> %</label>
            <label>Capped At</label>
            <label class="mx-3 fw-bold lead">N <?php echo $cap ?> </label>
        </div>
        <form class="d-flex flex-column gap-3" method="post" action="?r=settings&c=deposit_fee">
        <div>
        
            <label>NEW Percentage(%)</label>
            <input type="number" name="new_percentage" width="200px" max="100" min="0" height="60px" style="font-size: 20px; font-weight: bold; border: solid 1px seagreen"/>
            <break>
            <label>Capped At</label>
            <input type="number" name="new_cap" width="200px" min="0" max="10000" height="60px" style="font-size: 20px; font-weight: bold; border: solid 1px seagreen"/>
        </div>
        <div class="d-flex flex-row gap-2 justify-content-between">
            <a class="btn btn-secondary px-2" type="btn" href="?r=settings">Cancel</a>
            <button class="btn btn-success px-2" type="submit">Update Price</button>
        </div>
        </form>
        

    </div>
</section>