<?php
ob_start();
session_start();



if(isset($_POST["email"])){
if(isset($_POST["passcode"]) && isset($_POST["email"])){
	if($_POST["passcode"]=="" || $_POST["email"]==""){
		$_SESSION["errl"]="Please Input Something";
		
		
		
		//header("location: top_popup.php");
		header("location: ../login");
		
	}

else{

$db=fopen("../../dbase/admin.db", "a+");
$in=0;
$line=[];
$lpos=0;
while (!feof($db)) {
	$in++;
	$line[]=fgets($db);
	
	
	
	//$idpos=strpos($line[$in],"nosa,1234");
	
}



for ($i=0; $i < $in; $i++) { 
$linedata=explode("&,", $line[$i]);
$linedataee=explode("&,", $line[$i]);
$linedatarefer=explode("&,", $line[$i]);
for ($j=0; $j <= 10; $j++) { 
	if($linedata[1]==$_POST["email"]&& $_POST["passcode"] == $linedataee[3]){

		
		
		$_SESSION["lnumber"]=$j;
		$_SESSION["cnumber"]=$i;
		#working
		//echo $i;
			$_SESSION["errl"]="";
			
			 $_SESSION["alogin_success"]="ss";
         header("location: ../?r=home");

        
         $_SESSION["alogged_in"]="true";

		 
		
	}
}
$linedata=explode("&,", $line[$_SESSION["cnumber"]]);
	//echo($linedata[0]);
	//echo " ".$i;
	/*if($linedata[$i]=="nosa"){
		echo($linedata[$i]);
	}*/
	}
	if($_POST["passcode"] != $linedata[3]){
		//echo $linedata[3];
		$_SESSION["errl"]="Invalid Password Info".$linedata[3]; 
		//header("location: top_popup.php");
	header("location: ../login");
	}
   



fclose($db);

}
}
}

ob_flush();
?>
