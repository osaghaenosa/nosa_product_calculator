<section style="position: fixed; width:100%; height:100%; top: 0; left:0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0.5)">
    <div style="width:500px; height: initial; padding: 10px 10px 10px 10px; overflow: hidden; gap: 2rem; overflow-y: scroll; height:500px" class="rounded bg-white d-flex flex-column">
        <div class="w-100 bg-success py-3">
            <h2 style="font-size: 15px; text-align: center; color: white">Data Plans Transaction</h2>
        </div>
        <div class="d-flex flex-column gap-2">
            <label>List of Data plans and their prices</label>
            
        </div>
        <p style="display: none">
        <?php
        $d_price = file_get_contents("../dashboard/order/utility/data_price.json");
        $d_plans = file_get_contents("../dashboard/order/utility/data_plans.json");

        $d_price_decode = json_decode($d_price,true);
        $d_plans_decode = json_decode($d_plans, true);

        $d_plans_array_mtn = explode(",", $d_plans_decode[0]["MTN"]);
        $d_plans_array_airtel = explode(",", $d_plans_decode[0]["AIRTEL"]);
        $d_plans_array_glo = explode(",", $d_plans_decode[0]["GLO"]);
        $d_plans_array_etisalat = explode(",", $d_plans_decode[0]["9MOBILE"]);

        //all the price for MTN
        //$d_plans_m = [];
        // for($i=0; $i<count($d_plans_array_mtn); $i++){
        //     $d_plans_m[] = $d_plans_array_mtn[i];
        // }
        

        //get the form submitted

        if(isset($_POST["update_price"])){
            //mtn
            for($i=0; $i<count($d_plans_array_mtn); $i++){
                $mtn_price =explode(",",$d_price_decode[0]["MTN"][$d_plans_array_mtn[$i]]);
                $mtn_price[1] = $_POST[''.$d_plans_array_mtn[$i]];
                $updated_mtn_price = implode(",", $mtn_price);
                //update to main
                $d_price_decode[0]["MTN"][$d_plans_array_mtn[$i]] = $updated_mtn_price;
                //$d_price_decode[0]["mtn"] = $d_price_decode[0]["mtn"][$d_plans_array_mtn[$i]];

            }
            //airtel
            for($i=0; $i<count($d_plans_array_airtel); $i++){
                $airtel_price =explode(",",$d_price_decode[0]["AIRTEL"][$d_plans_array_airtel[$i]]);
                $airtel_price[1] = $_POST[''.$d_plans_array_airtel[$i]];
                $updated_airtel_price = implode(",", $airtel_price);
                //update to main
                $d_price_decode[0]["AIRTEL"][$d_plans_array_airtel[$i]] = $updated_airtel_price;
                //$d_price_decode[0]["airtel"] = $d_price_decode[0]["airtel"][$d_plans_array_airtel[$i]];
            }
            //glo
            for($i=0; $i<count($d_plans_array_glo); $i++){
                $glo_price =explode(",",$d_price_decode[0]["GLO"][$d_plans_array_glo[$i]]);
                $glo_price[1] = $_POST[''.$d_plans_array_glo[$i]];
                $updated_glo_price = implode(",", $glo_price);
                //update to main
                $d_price_decode[0]["GLO"][$d_plans_array_glo[$i]] = $updated_glo_price;
                //$d_price_decode[0]["glo"] = $d_price_decode[0]["glo"][$d_plans_array_glo[$i]];
            }
            //etisalat
            for($g=0; $g<count($d_plans_array_etisalat); $g++){
                $etisalat_price = explode(",",$d_price_decode[0]["9MOBILE"][$d_plans_array_etisalat[$g]]);
                $etisalat_price[1] = $_POST[''.$d_plans_array_etisalat[$g]];
                $updated_etisalat_price = implode(",", $etisalat_price);
                //update to main
                $d_price_decode[0]["9MOBILE"][$d_plans_array_etisalat[$g]] = $updated_etisalat_price;
                //$d_price_decode[0]["etisalat"] = $d_price_decode[0]["etisalat"][$d_plans_array_etisalat[$i]];
            }

            //print_r($d_price_decode[0]["mtn"]);
            $updated_prices = json_encode($d_price_decode, JSON_PRETTY_PRINT);

            //print_r($d_price_decode);
            $alert = "Data Plans Updated Successfully!!!";

            file_put_contents("../dashboard/order/utility/data_price.json", $updated_prices);
            
            
        }
        ?>
        </p>
        <?php if(isset($alert)){echo '<div class="bg-success w-100 p-2 text-white">'.$alert.'</div>';} ?>
        
        <form class="d-flex flex-column gap-3" method="post" action="?r=settings&c=data_plans">
            <label class="fw-bold d-flex flex-row gap-1" style="font-size: 12px"><span class="border rounded border-1 border-secondary px-5 py-2 mtn_button active" style="cursor: pointer">MTN</span> <span class="border rounded border-1 border-secondary px-4 py-2 airtel_button" style="cursor: pointer">AIRTEL</span> <span class="border rounded border-1 border-secondary px-5 py-2 glo_button" style="cursor: pointer">GLO</span> <span class="border rounded border-1 border-secondary px-4 py-2 nine_mobile_button" style="cursor: pointer">9 Mobile</span></label>
        <div style="height:400px; overflow-y: scroll">
        
            
            <br>
            <div class="flex-column gap-3 mtn">
            </div>

            <div class="flex-column gap-3 airtel">
            </div>

            <div class="flex-column gap-3 glo">
            </div>

            <div class="flex-column gap-3 nine_mobile">
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
    
    .airtel{
        display: none;
    }
    .glo{
        display: none;
    }
    .nine_mobile{
        display: none;
    }

</style>
<script>
    var mtn_button = document.querySelector(".mtn_button");
    var airtel_button = document.querySelector(".airtel_button");
    var glo_button = document.querySelector(".glo_button");
    var nine_mobile_button = document.querySelector(".nine_mobile_button");

    var mtn = document.querySelector(".mtn");
    var airtel = document.querySelector(".airtel");
    var glo = document.querySelector(".glo");
    var nine_mobile = document.querySelector(".nine_mobile");

    mtn.style.display = "flex";
    airtel.style.display = "none";
    glo.style.display = "none";
    nine_mobile.style.display = "none";

        
    mtn_button.onclick = function(){
        mtn.style.display = "flex";
        airtel.style.display = "none";
        glo.style.display = "none";
        nine_mobile.style.display = "none";

        mtn_button.classList.add("active");
        airtel_button.classList.remove("active");
        glo_button.classList.remove("active");
        nine_mobile_button.classList.remove("active");


    }
    airtel_button.onclick = function(){
        mtn.style.display = "none";
        airtel.style.display = "flex";
        glo.style.display = "none";
        nine_mobile.style.display = "none";

        mtn_button.classList.remove("active");
        airtel_button.classList.add("active");
        glo_button.classList.remove("active");
        nine_mobile_button.classList.remove("active");


    }
    glo_button.onclick = function(){
        mtn.style.display = "none";
        airtel.style.display = "none";
        glo.style.display = "flex";
        nine_mobile.style.display = "none";

        mtn_button.classList.remove("active");
        airtel_button.classList.remove("active");
        glo_button.classList.add("active");
        nine_mobile_button.classList.remove("active");


    }
    nine_mobile_button.onclick = function(){
        mtn.style.display = "none";
        airtel.style.display = "none";
        glo.style.display = "none";
        nine_mobile.style.display = "flex";

        mtn_button.classList.remove("active");
        airtel_button.classList.remove("active");
        glo_button.classList.remove("active");
        nine_mobile_button.classList.add("active");


    }

    var data_plans = <?php include("../dashboard/order/utility/data_plans.json"); ?>;
    var data_price = <?php include("../dashboard/order/utility/data_price.json"); ?>;

	

    var mtn_plans = data_plans[0]["MTN"].split(",");
    
    for(let c=0; c< mtn_plans.length; c++){
       // mtn.innerHTML=data_price[0]["mtn"][mtn_plans[i]];
       mtn_a = data_price[0]["MTN"][mtn_plans[c]].split(",");
       
       mtn.innerHTML += "<label>"+mtn_a[0]+"</label><input type='number' name='"+mtn_plans[c]+"' width='100px' height='60px' value='"+mtn_a[1]+"' style='font-size: 20px; font-weight: bold; border: solid 1px seagreen'/>"
    }

    var airtel_plans = data_plans[0]["AIRTEL"].split(",");
    
    for(let c=0; c< airtel_plans.length; c++){
       // mtn.innerHTML=data_price[0]["mtn"][mtn_plans[i]];
       airtel_a = data_price[0]["AIRTEL"][airtel_plans[c]].split(",");
       
       airtel.innerHTML += "<label>"+airtel_a[0]+"</label><input type='number' name='"+airtel_plans[c]+"' width='100px' height='60px' value='"+airtel_a[1]+"' style='font-size: 20px; font-weight: bold; border: solid 1px seagreen'/>"
    }

    var glo_plans = data_plans[0]["GLO"].split(",");
    
    for(let c=0; c< glo_plans.length; c++){
       // mtn.innerHTML=data_price[0]["mtn"][mtn_plans[i]];
       glo_a = data_price[0]["GLO"][glo_plans[c]].split(",");
       
       glo.innerHTML += "<label>"+glo_a[0]+"</label><input type='number' name='"+glo_plans[c]+"' width='100px' height='60px' value='"+glo_a[1]+"' style='font-size: 20px; font-weight: bold; border: solid 1px seagreen'/>"
    }

    var nine_mobile_plans = data_plans[0]["9MOBILE"].split(",");
    
    for(let c=0; c< nine_mobile_plans.length; c++){
       // mtn.innerHTML=data_price[0]["mtn"][mtn_plans[i]];
       nine_mobile_a = data_price[0]["9MOBILE"][nine_mobile_plans[c]].split(",");
       
       nine_mobile.innerHTML += "<label>"+nine_mobile_a[0]+"</label><input type='number' name='"+nine_mobile_plans[c]+"' width='100px' height='60px' value='"+nine_mobile_a[1]+"' style='font-size: 20px; font-weight: bold; border: solid 1px seagreen'/>"
    }
</script>