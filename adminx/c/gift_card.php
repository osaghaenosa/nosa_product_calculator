<section style="position: fixed; width:100%; height:100%; top: 0; left:0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0.5)">
    <div style="width:500px; height: initial; padding: 10px 10px 10px 10px; overflow: hidden; gap: 2rem; overflow-y: scroll; height:500px" class="rounded bg-white d-flex flex-column">
        <div class="w-100 bg-success py-3">
            <h2 style="font-size: 15px; text-align: center; color: white">Giftcard Settings</h2>
        </div>
        <div class="d-flex flex-column gap-2">
            <label>List of Gift cards and their rates</label>
            
        </div>
        <?php
        $cards = file_get_contents("../dashboard/order/giftcard/cards.json");
        $countries = file_get_contents("../dashboard/order/giftcard/countries.json");

        $cards_decode = json_decode($cards,true);
        $countries_decode = json_decode($countries, true);

        if(isset($_POST["update_price"])){
            for($x=0; $x<count($countries_decode); $x++){
                $arrayx = $_POST[$countries_decode[$x]];
                // print_r($arrayx);
                //update the price
                //convert the price to array
                $cfd = $cards_decode[0][$countries_decode[$x]];
                $pxc = explode(",", $cfd);
                for($y =0; $y<count($pxc); $y++){
                    $r_pc = explode(":", $pxc[$y]);
                    $r_pc[1] = $arrayx[$y];
                    $pxc[$y]  = implode(":",$r_pc);
                    //print_r($arrayx);
                }
                $cfd  = implode(",",$pxc);
                $cards_decode[0][$countries_decode[$x]] = $cfd;
            }
            $encode_file = json_encode($cards_decode, JSON_PRETTY_PRINT);
            file_put_contents("../dashboard/order/giftcard/cards.json", $encode_file);
            echo "You Have Successfully Updated giftcard values";
        }
       

        // $d_plans_array_mtn = explode(",", $d_plans_decode[0]["mtn"]);
        // $d_plans_array_airtel = explode(",", $d_plans_decode[0]["airtel"]);
        // $d_plans_array_glo = explode(",", $d_plans_decode[0]["glo"]);
        // $d_plans_array_etisalat = explode(",", $d_plans_decode[0]["etisalat"]);

        // //all the price for MTN
        // //$d_plans_m = [];
        // // for($i=0; $i<count($d_plans_array_mtn); $i++){
        // //     $d_plans_m[] = $d_plans_array_mtn[i];
        // // }
        

        // //get the form submitted

        // if(isset($_POST["update_price"])){
        //     //mtn
        //     for($i=0; $i<count($d_plans_array_mtn); $i++){
        //         $mtn_price =explode(",",$d_price_decode[0]["mtn"][$d_plans_array_mtn[$i]]);
        //         $mtn_price[1] = $_POST[''.$d_plans_array_mtn[$i]];
        //         $updated_mtn_price = implode(",", $mtn_price);
        //         //update to main
        //         $d_price_decode[0]["mtn"][$d_plans_array_mtn[$i]] = $updated_mtn_price;
        //         //$d_price_decode[0]["mtn"] = $d_price_decode[0]["mtn"][$d_plans_array_mtn[$i]];

        //     }
        //     //airtel
        //     for($i=0; $i<count($d_plans_array_airtel); $i++){
        //         $airtel_price =explode(",",$d_price_decode[0]["airtel"][$d_plans_array_airtel[$i]]);
        //         $airtel_price[1] = $_POST[''.$d_plans_array_airtel[$i]];
        //         $updated_airtel_price = implode(",", $airtel_price);
        //         //update to main
        //         $d_price_decode[0]["airtel"][$d_plans_array_airtel[$i]] = $updated_airtel_price;
        //         //$d_price_decode[0]["airtel"] = $d_price_decode[0]["airtel"][$d_plans_array_airtel[$i]];
        //     }
        //     //glo
        //     for($i=0; $i<count($d_plans_array_glo); $i++){
        //         $glo_price =explode(",",$d_price_decode[0]["glo"][$d_plans_array_glo[$i]]);
        //         $glo_price[1] = $_POST[''.$d_plans_array_glo[$i]];
        //         $updated_glo_price = implode(",", $glo_price);
        //         //update to main
        //         $d_price_decode[0]["glo"][$d_plans_array_glo[$i]] = $updated_glo_price;
        //         //$d_price_decode[0]["glo"] = $d_price_decode[0]["glo"][$d_plans_array_glo[$i]];
        //     }
        //     //etisalat
        //     for($i=0; $i<count($d_plans_array_etisalat); $i++){
        //         $etisalat_price =explode(",",$d_price_decode[0]["etisalat"][$d_plans_array_etisalat[$i]]);
        //         $etisalat_price[1] = $_POST[''.$d_plans_array_etisalat[$i]];
        //         $updated_etisalat_price = implode(",", $etisalat_price);
        //         //update to main
        //         $d_price_decode[0]["etisalat"][$d_plans_array_etisalat[$i]] = $updated_etisalat_price;
        //         //$d_price_decode[0]["etisalat"] = $d_price_decode[0]["etisalat"][$d_plans_array_etisalat[$i]];
        //     }

        //     //print_r($d_price_decode[0]["mtn"]);
        //     $updated_prices = json_encode($d_price_decode, JSON_PRETTY_PRINT);

        //     //print_r($d_price_decode);
        //     echo "Data Plans Updated Successfully!!!";

        //     file_put_contents("../dashboard/order/giftcard/countries.json", $updated_prices);
            
            
        //  }
        ?>
        <form class="d-flex flex-column gap-3" method="post" action="?r=settings&c=gift_card">
            <!-- <label class="fw-bold d-flex flex-row gap-1" style="font-size: 12px"><span class="border rounded border-1 border-secondary px-5 py-2 mtn_button active" style="cursor: pointer">MTN</span> <span class="border rounded border-1 border-secondary px-4 py-2 airtel_button" style="cursor: pointer">AIRTEL</span> <span class="border rounded border-1 border-secondary px-5 py-2 glo_button" style="cursor: pointer">GLO</span> <span class="border rounded border-1 border-secondary px-4 py-2 nine_mobile_button" style="cursor: pointer">9 Mobile</span></label> -->
            <label class="fw-bold d-flex flex-row gap-1" id="countries_block" style="font-size: 12px; overflow-x: scroll">
                <?php
                   foreach($countries_decode as $ct){
                    echo "<span class=\"border rounded border-1 border-secondary px-5 py-2 country_x active\" style=\"cursor: pointer\">".$ct."</span>";
                   }
                ?>
            </label>

        <div id="cards_show" style="height:400px; overflow-y: scroll">
        
            <br>
            <?php
                $cd = $cards_decode[0];
                   for($key=0; $key<count($cd); $key++){
                    //get their values seprately
                    $main_card = explode(",",$cards_decode[0][$countries_decode[$key]]);
                    
                    echo "<div class=\"flex-column gap-3 giftcard_x\">";
                    for($j=0; $j<count($main_card); $j++){
                        $main_card_value = explode(":", $main_card[$j]);
                        
                        echo "<div class='d-flex gap-3'><label>".$main_card_value[0]."</label><input type='text' name='".$countries_decode[$key]."[]' width='100px' height='60px' value='".$main_card_value[1]."' style='font-size: 20px; font-weight: bold; border: solid 1px seagreen'/></div>";
                    
                    }
                    echo "</div>";
                    
                    
                   }
                ?>
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
    .countries_x{
        background:red;
    }

</style>
<script defer>
    var countries_block = document.querySelector("#countries_block");
var cards_show = document.querySelector("#cards_show");

var country_x = document.querySelectorAll(".country_x");
var giftcard_x = document.querySelectorAll(".giftcard_x");

for(var j =0; j<giftcard_x.length; j++){
    giftcard_x[j].style.display = "none";
}
var z=0;
for(let i =0; i<country_x.length; i++){
    
    country_x[i].onclick = function(){
        for(var j =0; j<giftcard_x.length; j++){
    giftcard_x[j].style.display = "none";
}
        
            giftcard_x[i].style.display = "flex";
        
    }
}
    
</script>