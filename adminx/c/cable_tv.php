<section style="position: fixed; width:100%; height:100%; top: 0; left:0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0.5)">
    <div style="width:500px; height: initial; padding: 10px 10px 10px 10px; overflow: hidden; gap: 2rem; overflow-y: scroll; height:500px" class="rounded bg-white d-flex flex-column">
        <div class="w-100 bg-success py-3">
            <h2 style="font-size: 15px; text-align: center; color: white">Cable TV Plans Transaction</h2>
        </div>
        <div class="d-flex flex-column gap-2">
            <label>List of Cable TV plans and their prices</label>
            
        </div>
        <?php
        $d_price = file_get_contents("../dashboard/order/utility/subscription_price.json");
        $d_plans = file_get_contents("../dashboard/order/utility/subscription_plans.json");

        $d_price_decode = json_decode($d_price,true);
        $d_plans_decode = json_decode($d_plans, true);

        $d_plans_array_dstv = explode(",", $d_plans_decode[0]["dstv"]);
        $d_plans_array_gotv = explode(",", $d_plans_decode[0]["gotv"]);
        $d_plans_array_startimes = explode(",", $d_plans_decode[0]["startimes"]);
        

        //all the price for dstv
        //$d_plans_m = [];
        // for($i=0; $i<count($d_plans_array_dstv); $i++){
        //     $d_plans_m[] = $d_plans_array_dstv[i];
        // }
        

        //get the form submitted

        if(isset($_POST["update_price"])){
            //dstv
            for($i=0; $i<count($d_plans_array_dstv); $i++){
                $dstv_price =explode(",",$d_price_decode[0]["dstv"][$d_plans_array_dstv[$i]]);
                $dstv_price[0] = $_POST[''.$d_plans_array_dstv[$i]];
                $updated_dstv_price = implode(",", $dstv_price);
                //update to main
                $d_price_decode[0]["dstv"][$d_plans_array_dstv[$i]] = $updated_dstv_price;
                //$d_price_decode[0]["dstv"] = $d_price_decode[0]["dstv"][$d_plans_array_dstv[$i]];

            }
            //gotv
            for($i=0; $i<count($d_plans_array_gotv); $i++){
                $gotv_price =explode(",",$d_price_decode[0]["gotv"][$d_plans_array_gotv[$i]]);
                $gotv_price[0] = $_POST[''.$d_plans_array_gotv[$i]];
                $updated_gotv_price = implode(",", $gotv_price);
                //update to main
                $d_price_decode[0]["gotv"][$d_plans_array_gotv[$i]] = $updated_gotv_price;
                //$d_price_decode[0]["gotv"] = $d_price_decode[0]["gotv"][$d_plans_array_gotv[$i]];
            }
            //startimes
            for($i=0; $i<count($d_plans_array_startimes); $i++){
                $startimes_price =explode(",",$d_price_decode[0]["startimes"][$d_plans_array_startimes[$i]]);
                $startimes_price[0] = $_POST[''.$d_plans_array_startimes[$i]];
                $updated_startimes_price = implode(",", $startimes_price);
                //update to main
                $d_price_decode[0]["startimes"][$d_plans_array_startimes[$i]] = $updated_startimes_price;
                //$d_price_decode[0]["startimes"] = $d_price_decode[0]["startimes"][$d_plans_array_startimes[$i]];
            }
           

            //print_r($d_price_decode[0]["dstv"]);
            $updated_prices = json_encode($d_price_decode, JSON_PRETTY_PRINT);

            //print_r($d_price_decode);
            echo "Subscription Plans Updated Successfully!!!";

            file_put_contents("../dashboard/order/utility/subscription_price.json", $updated_prices);
            
            
        }
        ?>
        <form class="d-flex flex-column gap-3" method="post" action="?r=settings&c=cable_tv">
            <label class="fw-bold d-flex flex-row gap-1" style="font-size: 12px"><span class="border rounded border-1 border-secondary px-5 py-2 dstv_button active" style="cursor: pointer">DSTV</span> <span class="border rounded border-1 border-secondary px-4 py-2 gotv_button" style="cursor: pointer">GOTV</span> <span class="border rounded border-1 border-secondary px-5 py-2 startimes_button" style="cursor: pointer">STARTIMES</span> </label>
        <div style="height:400px; overflow-y: scroll">
        
            
            <br>
            <div class="flex-column gap-3 dstv">
            </div>

            <div class="flex-column gap-3 gotv">
            </div>

            <div class="flex-column gap-3 startimes">
            </div>
            
        </div>
        <div class=" flex-row gap-2 justify-content-between">
            <a class="btn btn-secondary px-2" type="button" href="?r=settings">Cancel</a>
            <button class="btn btn-success px-2" type="submit" name="update_price">Update Price</button>
        </div>
        </form>
        

    </div>
</section>
<style>
    .active{
        background-color: seagreen;
        color: white;
        border: none !important;
    }
    
    .gotv{
        display: none;
    }
    .startimes{
        display: none;
    }
    

</style>
<script>
    var dstv_button = document.querySelector(".dstv_button");
    var gotv_button = document.querySelector(".gotv_button");
    var startimes_button = document.querySelector(".startimes_button");
    

    var dstv = document.querySelector(".dstv");
    var gotv = document.querySelector(".gotv");
    var startimes = document.querySelector(".startimes");
    

    dstv.style.display = "flex";
    gotv.style.display = "none";
    startimes.style.display = "none";
    

        
    dstv_button.onclick = function(){
        dstv.style.display = "flex";
        gotv.style.display = "none";
        startimes.style.display = "none";
        

        dstv_button.classList.add("active");
        gotv_button.classList.remove("active");
        startimes_button.classList.remove("active");
       


    }
    gotv_button.onclick = function(){
        dstv.style.display = "none";
        gotv.style.display = "flex";
        startimes.style.display = "none";
        

        dstv_button.classList.remove("active");
        gotv_button.classList.add("active");
        startimes_button.classList.remove("active");
        


    }
    startimes_button.onclick = function(){
        dstv.style.display = "none";
        gotv.style.display = "none";
        startimes.style.display = "flex";
        

        dstv_button.classList.remove("active");
        gotv_button.classList.remove("active");
        startimes_button.classList.add("active");
        


    }
    
    var subscription_plans = <?php include("../dashboard/order/utility/subscription_plans.json"); ?>;
    var subscription_price = <?php include("../dashboard/order/utility/subscription_price.json"); ?>;

	

    var dstv_plans = subscription_plans[0]["dstv"].split(",");
    
    for(let c=0; c< dstv_plans.length; c++){
       // dstv.innerHTML=subscription_price[0]["dstv"][dstv_plans[i]];
       dstv_a = subscription_price[0]["dstv"][dstv_plans[c]].split(",");
       
       dstv.innerHTML += "<label>"+dstv_a[1]+"</label><input type='number' name='"+dstv_plans[c]+"' width='100px' height='60px' value='"+dstv_a[0]+"' style='font-size: 20px; font-weight: bold; border: solid 1px seagreen'/>"
    }

    var gotv_plans = subscription_plans[0]["gotv"].split(",");
    
    for(let c=0; c< gotv_plans.length; c++){
       // dstv.innerHTML=subscription_price[0]["dstv"][dstv_plans[i]];
       gotv_a = subscription_price[0]["gotv"][gotv_plans[c]].split(",");
       
       gotv.innerHTML += "<label>"+gotv_a[1]+"</label><input type='number' name='"+gotv_plans[c]+"' width='100px' height='60px' value='"+gotv_a[0]+"' style='font-size: 20px; font-weight: bold; border: solid 1px seagreen'/>"
    }

    var startimes_plans = subscription_plans[0]["startimes"].split(",");
    
    for(let c=0; c< startimes_plans.length; c++){
       // dstv.innerHTML=subscription_price[0]["dstv"][dstv_plans[i]];
       startimes_a = subscription_price[0]["startimes"][startimes_plans[c]].split(",");
       
       startimes.innerHTML += "<label>"+startimes_a[1]+"</label><input type='number' name='"+startimes_plans[c]+"' width='100px' height='60px' value='"+startimes_a[0]+"' style='font-size: 20px; font-weight: bold; border: solid 1px seagreen'/>"
    }

    
</script>