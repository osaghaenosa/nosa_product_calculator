<?php

ob_start();

include("widgets/alert.widget");
include("widgets/loading2.widget");
include("widgets/general_popup.widget");
include("widgets/general_popup2.widget");
include("widgets/info.widget");

template_include("home.html", RECORD);

if(isset($_SESSION["alert"])){
    showAlert($_SESSION["alert"]);
    unset($_SESSION["alert"]);
}

if(isset($_GET["add"])){
    if (isset($_POST["name"]) && isset($_POST["product"]) && isset($_POST["price"]) && isset($_POST["quantity"])) {
        // Open sales.json file
        $d_sales = file_get_contents("dbase/sales.json");
        $d_sales_array = json_decode($d_sales, true);
    
        $m_name = $_POST["name"];
        $m_product = $_POST["product"];
        $m_price = $_POST["price"];
        $m_quantity = $_POST["quantity"];
        
        $m_date = $_GET["date"];
    
        $list_v = [
            "name" => $m_name,
            "product" => $m_product,
            "price" => $m_price,
            "quantity" => $m_quantity,
            "s_quantity" => "0",
            "date" => $m_date,
            "expenses" => "0"
        ];
    
        $exists = false;
        foreach ($d_sales_array as $ds => $dax) {
            if ($dax == $list_v) {
                $exists = true;
                break;
            }
        }
    
        if (!$exists) {
            array_unshift($d_sales_array, $list_v);
            $new_json = json_encode($d_sales_array, JSON_PRETTY_PRINT);
            file_put_contents("dbase/sales.json", $new_json);
            $_SESSION["alert"] = "Record added successfully.";
            header("location: record?date=".$_GET["date"]);
        } else {
            $_SESSION["alert"] = "Info has already been used for today.";
            header("location: record?date=".$_GET["date"]);
        }
    }
    
}
if(isset($_GET["edit"])){
    
    if (isset($_POST["name"]) && isset($_POST["product"]) && isset($_POST["price"]) && isset($_POST["quantity"]) && isset($_POST["s_quantity"]) && isset($_POST["expenses"])) {
        // Open sales.json file
        $d_sales = file_get_contents("dbase/sales.json");
        $d_sales_array = json_decode($d_sales, true);
    
        $m_name = $_POST["name"];
        $m_product = $_POST["product"];
        $m_price = $_POST["price"];
        $m_quantity = $_POST["quantity"];
        $s_quantity = $_POST["s_quantity"];
        $m_expenses = $_POST["expenses"];

        $edit = $_GET["edit"];

        if(!isset($_GET["date"])){
            $m_date = date("d/m/y");
        }
        else{
            $m_date = $_GET["date"];
        }
    
        $list_v = [
            "name" => $m_name,
            "product" => $m_product,
            "price" => $m_price,
            "quantity" => $m_quantity,
            "s_quantity" => "".$s_quantity,
            "date" => $m_date,
            "expenses" => "".$m_expenses
        ];
        
    
        $exists = false;
        
    
        
            // array_unshift($d_sales_array, $list_v);
            $d_sales_array[$edit] = $list_v;
            $new_json = json_encode($d_sales_array, JSON_PRETTY_PRINT);
            file_put_contents("dbase/sales.json", $new_json);
            $_SESSION["alert"] = "Record successfully updated.";
            header("location: record?date=".$_GET["date"]);
        
    }
    
}
ob_end_flush();
?>

