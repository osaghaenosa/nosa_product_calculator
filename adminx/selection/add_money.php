<?php

function update_deposit_history($username, $date, $time, $account_number, $amount, $service_charge, $bank, $reciepient_code, $account_name, $reference, $status, $reason,$id){
    $new_transaction_json = [
        "username"=> "".$username,
        "date"=> "".$date,
        "time"=> "".$time,
        "transaction"=> "deposit",
        "account_number"=> "".$account_number,
        "amount"=> "".$amount,
        "service_charge"=> $service_charge,
        "bank"=> "".$bank,
        "reciepient_code"=> "".$reciepient_code,
        "account_name"=> "".$account_name,
        "reference"=> "".$reference,
        "status"=> "".$status,
        "reason"=> "".$reason
    ];

    $t_history_page = "../users/".$id."/t_history.json";
    $wallets_history_page = "../users/".$id."/wallets/history.json";
    $thist = file_get_contents($t_history_page);
    $wallet_h = file_get_contents($wallets_history_page);


    $noti = file_get_contents("../users/".$id."/notiitem.txt");
     $new_noti = "<section id='notification_items' style='border-bottom:solid 1px gray; display:flex;flex-direction:column;gap:5px'>
<p class='lead'>Credit of $amount by ".$_POST["sender"]." from ".$_POST["bank"]." $status</p>

</section>";
    file_put_contents("../users/".$id."/notiitem.txt", $new_noti."<br>".$noti);

    if($thist != ""){
        $decoded_transaction = json_decode($thist);
        array_unshift($decoded_transaction, $new_transaction_json);
    }
    else{
        $decoded_transaction = [$new_transaction_json];
    }
    if($wallet_h != ""){
        $wallets_decoded_transaction = json_decode($wallet_h);
        array_unshift($wallets_decoded_transaction, $new_transaction_json);
    }
    else{
        $wallets_decoded_transaction = [$new_transaction_json];
    }
    
    $json_transaction_encode = json_encode($decoded_transaction, JSON_PRETTY_PRINT);
    $json_wallets_transaction_encode = json_encode($wallets_decoded_transaction, JSON_PRETTY_PRINT);
    $fp = fopen("../users/".$id."/t_history.json", 'w');
    fwrite($fp, $json_transaction_encode);
    $fpa = fopen("../users/".$id."/wallets/history.json", 'w');
    fwrite($fpa, $json_wallets_transaction_encode);
    fclose($fp);
    fclose($fpa);


}


if(isset($_POST["amount"])){
    if($_POST["amount"] != "" || $_POST["amount"] >0){
        //add the money
        //get the user wallet
        $user_wallet_file = "../users/".$_GET["users"]."/wallets/amount.x";
        $am = $_POST["amount"];
        $user_wallet = file_get_contents($user_wallet_file);
        
        file_put_contents($user_wallet_file, $user_wallet+$am);
        $_SESSION["rrr"] = "<div class='d-flex flex-column align-items-center gap-3'><i class='bi bi-check-circle-fill fs-2'></i> <span>You have Successfully Credited this user's wallet</span></div>";

        $date_t = date("d/m/y");
        $time_t = date("h:i A");
        $reference = (rand(1111111111,9876543210) +1);
        update_deposit_history($username, $date_t, $time_t, "".$_POST["acc_no"], $am, "0", $_POST["bank"], $_POST["acc_no"], $_POST["sender"], $reference, "success", "", $_GET["users"]);
        
        //log to activity log
		 $log_date = date("d/m/y");
		 $log_time = date("h:i A");
		 $log_activity = " Successfully Added N".$am." to Wallet";

		 $activity_log_file = "../users/".$_GET["users"]."/activity_log.json";
		 $activity_log = file_get_contents($activity_log_file);
		 $new_log = [
		   "date"=> "".$log_date,
		   "time"=> "".$log_time,
		   "activity"=> "".$log_activity

		 ];

		 if($activity_log != ""){
		   $decoded_activity_log = json_decode($activity_log,true);
		   array_unshift($decoded_activity_log, $new_log);
		   }
		   else{
			   $decoded_activity_log = [$new_log];
		   }

		   $json_activity_encode = json_encode($decoded_activity_log, JSON_PRETTY_PRINT);
		   // $file_activity = fopen($activity_log_file, 'w');
		   // fwrite($file_activity, $json_activity_encode);
		   file_put_contents($activity_log_file, $json_activity_encode);
		   //end

        header("location: ?r=home&users=".$_GET["users"]);
    }
    else{
        $_SESSION["rrr"] = "Please Enter a figure to add to the user's wallet";
        header("location: ?r=home&users=".$_GET["users"]."&selection=addmoney");
    }
}
?>
<section style="position: fixed; left:0px;top:0px; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display:flex; flex-direction: column; align-items: center; justify-content: center">
    <div class="rounded bg-white text-dark" style=" width:400px; overflow: hidden">
        <h1 class="text-center w-100 bg-primary text-white px-4 py-2">Add Money</h1>
        <div class="py-3 px-3">
            <form method="post" action="">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <label>Amount (N)</label>
                    <input required type="number" placeholder="0.00" name="amount" class="border border-1 border-primary rounded shadow lead p-2 fw-bold text-center" style="width:200px; height:initial">
                    <br>
                    <label>Sender Name</label>
                    <input required type="text" placeholder="Sender Name" name="sender" class="border border-1 border-primary rounded shadow lead p-2 fw-bold text-center" style="width:200px; height:initial">
                    <br>
                    <label>Sender Account Number</label>
                    <input required type="number" placeholder="Sender account Number" name="acc_no" class="border border-1 border-primary rounded shadow lead p-2 fw-bold text-center" style="width:200px; height:initial">
                    <br>
                    <label>Sender Bank</label>
                    <select required name="bank" class="text-black text-capitalize border border-1 px-2 py-4 border-primary form-select form-select-custom" type="text" >
                        
                        <option value="JPMorgan Chase & Co.">JPMorgan Chase & Co.</option>
                        <option value="Bank of America">Bank of America</option>
                        <option value="Wells Fargo">Wells Fargo</option>
                        <option value="Citigroup (Citi)">Citigroup (Citi)</option>
                        <option value="Goldman Sachs">Goldman Sachs</option>
                        <option value="Morgan Stanley">Morgan Stanley</option>
                        <option value="U.S. Bancorp (U.S. Bank)">U.S. Bancorp (U.S. Bank)</option>
                        <option value="PNC Financial Services">PNC Financial Services</option>
                        <option value="Truist Financial">Truist Financial</option>
                        <option value="Capital One">Capital One</option>
                        <option value="TD Bank (Toronto-Dominion Bank)">TD Bank (Toronto-Dominion Bank)</option>
                        <option value="BBVA USA (part of PNC Bank)">BBVA USA (part of PNC Bank)</option>
                        <option value="Fifth Third Bank">Fifth Third Bank</option>
                        <option value="KeyBank">KeyBank</option>
                        <option value="Citizens Bank">Citizens Bank</option>
                        <option value="Regions Bank">Regions Bank</option>
                        <option value="Huntington Bancshares">Huntington Bancshares</option>
                        <option value="First Republic Bank">First Republic Bank</option>
                        <option value="M&T Bank">M&T Bank</option>
                        <option value="Ally Bank">Ally Bank</option>
                        <option value="BMO Harris Bank">BMO Harris Bank</option>
                        <option value="HSBC Bank USA">HSBC Bank USA</option>
                        <option value="Charles Schwab Bank">Charles Schwab Bank</option>
                        <option value="Silicon Valley Bank (SVB)">Silicon Valley Bank (SVB)</option>
                        <option value="Synovus Bank">Synovus Bank</option>
                        <option value="New York Community Bank">New York Community Bank</option>
                        <option value="Comerica Bank">Comerica Bank</option>
                        <option value="Zions Bancorporation">Zions Bancorporation</option>
                        <option value="First Horizon Bank">First Horizon Bank</option>
                        <option value="BancorpSouth">BancorpSouth</option>
                        <option value="Bank of the West">Bank of the West</option>
                        <option value="East West Bank">East West Bank</option>
                        <option value="CIBC Bank USA">CIBC Bank USA</option>
                        <option value="Cullen/Frost Bankers">Cullen/Frost Bankers</option>
                        <option value="Old National Bank">Old National Bank</option>
                        <option value="UMB Financial Corporation">UMB Financial Corporation</option>
                        <option value="Valley National Bank">Valley National Bank</option>
                        <option value="Banner Bank">Banner Bank</option>
                        <option value="Pinnacle Financial Partners">Pinnacle Financial Partners</option>
                        <option value="First Citizens Bank">First Citizens Bank</option>
                        <option value="Webster Bank">Webster Bank</option>
                        <option value="Pacific Western Bank">Pacific Western Bank</option>
                        <option value="Associated Bank">Associated Bank</option>
                        <option value="South State Bank">South State Bank</option>
                        <option value="First Interstate Bank">First Interstate Bank</option>
                        <option value="United Bank">United Bank</option>
                        <option value="Western Alliance Bank">Western Alliance Bank</option>
                        <option value="Wintrust Financial Corporation">Wintrust Financial Corporation</option>
                        <option value="Cadence Bank">Cadence Bank</option>
                        <option value="Simmons Bank">Simmons Bank</option>
                        <option value="Berkshire Bank">Berkshire Bank</option>
                        <option value="Prosperity Bank">Prosperity Bank</option>
                        <option value="Glacier Bank">Glacier Bank</option>
                        <option value="Independent Bank">Independent Bank</option>
                        <option value="Hancock Whitney Bank">Hancock Whitney Bank</option>
                        <option value="NBT Bank">NBT Bank</option>
                        <option value="Ameris Bank">Ameris Bank</option>
                        <option value="MidFirst Bank">MidFirst Bank</option>
                        <option value="Peoples Bank">Peoples Bank</option>
                        <option value="Atlantic Union Bank">Atlantic Union Bank</option>
                        <option value="First Midwest Bank">First Midwest Bank</option>
                        <option value="Midland States Bank">Midland States Bank</option>
                        <option value="Flagstar Bank">Flagstar Bank</option>
                        <option value="Texas Capital Bank">Texas Capital Bank</option>
                        <option value="Commerce Bank">Commerce Bank</option>
                        <option value="First National Bank of Omaha">First National Bank of Omaha</option>
                        <option value="Great Western Bank">Great Western Bank</option>
                        <option value="Investors Bank">Investors Bank</option>
                        <option value="Trustmark National Bank">Trustmark National Bank</option>
                        <option value="Sterling National Bank">Sterling National Bank</option>
                        <option value="Cathay Bank">Cathay Bank</option>
                        <option value="FirstBank">FirstBank</option>
                        <option value="Seacoast National Bank">Seacoast National Bank</option>
                        <option value="TriState Capital Bank">TriState Capital Bank</option>
                        <option value="Bank of Hawaii">Bank of Hawaii</option>
                        <option value="Arvest Bank">Arvest Bank</option>
                        <option value="BankUnited">BankUnited</option>
                        <option value="First Hawaiian Bank">First Hawaiian Bank</option>
                        <option value="Popular Bank (Banco Popular)">Popular Bank (Banco Popular)</option>
                        <option value="PeoplesBank">PeoplesBank</option>
                        <option value="Columbia Bank">Columbia Bank</option>
                        <option value="City National Bank">City National Bank</option>
                        <option value="Great Southern Bank">Great Southern Bank</option>
                        <option value="Heritage Bank">Heritage Bank</option>
                        <option value="Mechanics Bank">Mechanics Bank</option>
                        <option value="Old Point National Bank">Old Point National Bank</option>
                        <option value="Pacific Premier Bank">Pacific Premier Bank</option>
                        <option value="Pinnacle Bank">Pinnacle Bank</option>
                        <option value="Renasant Bank">Renasant Bank</option>
                        <option value="Sandy Spring Bank">Sandy Spring Bank</option>
                        <option value="Southwest Bank">Southwest Bank</option>
                        <option value="Stock Yards Bank & Trust">Stock Yards Bank & Trust</option>
                        <option value="TowneBank">TowneBank</option>
                        <option value="UMB Bank">UMB Bank</option>
                        <option value="Union Bank (MUFG Union Bank)">Union Bank (MUFG Union Bank)</option>
                        <option value="Unity Bank">Unity Bank</option>
                        <option value="Washington Trust Bank">Washington Trust Bank</option>
                        <option value="Winona National Bank">Winona National Bank</option>
                        <option value="Woodforest National Bank">Woodforest National Bank</option>
                        <option value="WSFS Bank">WSFS Bank</option>
                    
                    
                </select>
                </div>
                <hr>
                <br>
                <div class="d-flex flex-row-reverse gap-2 justify-content-between">
                    <button class="btn btn-primary rounded-pill w-100">Add Money</button>
                    <a <?php echo "href='?r=home&users=".$_GET["users"]."'"; ?> class="btn btn-dark rounded-pill w-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
<style>
    body{
        overflow-y: hidden;
        height:100vh;
    }
</style>