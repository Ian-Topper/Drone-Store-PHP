<?php
/*
    Author: Minh Le, FlynnTopperLe
    Date: 03/22/2019
    Files: Order Cancel
 */
session_start();
require ('SQLFunctions.php');
require_once ("../FootNHead.php");
displayPageHeader(": My Order");
echo "<body>";
echo "<h1>Order Summary</h1>";

?>  

<?php
    $timezone = date_default_timezone_get();
    //echo "The current server timezone is: " . $timezone;
    date_default_timezone_set("America/Denver");
    $current_date_time = date("Y-m-d H:i:s");
    echo "<p>Time : $current_date_time</p>";
    echo "<hr>";
    $userPK = $_SESSION['userInfo']['userpk'];
    $userInfo = getUserInfoByPK($userPK);
    
    foreach($userInfo as $user){
        extract($user);
        $UserName_F = $Login;
        $Password_F = $Password;
        $FirstName_F = $FirstName;
        $LastName_F = $LastName;
        $Address_F = $Address;
        $City_F = $City;
        $State_F = $State;
        $Zip_F = $Zip;
        $Country_F = $Country;
        $Email_F = $Email;
        $Phone_F = $Phone;
    }    
       // echo "User PK: " . $userPK;
    $editmode = false;
    
    $orderlist = getOrderDetailByUserPk($userPK);
    $OrderPKList = getOrderTableByUserPK($userPK);
    $product_price_array = array();
    
    echo "<br>";
    $arrayProductPKByOrderPK = array();
    $arrayQuantityByOrderPK = array();
    $arrayUniqueOrderPK = array();
    $arrayShipAddress = array();
    $arrayOrderDate = array();
    $arrayOrderStatus = array();
    foreach($OrderPKList as $uniqueOrder){
        extract($uniqueOrder);
        $ship_address = $ShipAddress . ", ". $ShipCity . ", ".$ShipState . " ".$ShipZip .", ". $ShipCountry;
        array_push($arrayUniqueOrderPK, $OrderPK);
        array_push($arrayShipAddress, $ship_address);
        array_push($arrayOrderDate, $OrderDate);
        array_push($arrayOrderStatus, $OrderStatus);
    }
    
    for($i=0; $i<count($arrayUniqueOrderPK); ++$i){
        $shipname = $FirstName_F . " " . $LastName_F;
        echo "<table id=\"OrderDetail\">";
            echo "<tr>";
            echo "<th>Order No</th>"."<td colspan=\"4\">$arrayUniqueOrderPK[$i]</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<th>Ordered By</th>"."<td colspan=\"4\">$shipname</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<th>Shipping Address</th>"."<td colspan=\"4\">$arrayShipAddress[$i]</td>";
            echo "</tr>";
            
            echo "<tr>";
            $order_date = date_create(substr($arrayOrderDate[$i],0, 19),timezone_open("America/Denver"));
            $order_date_convert = date_format($order_date,"Y-m-d H:i:s");
            echo "<th>Order Date</th>"."<td colspan=\"4\">".$order_date_convert."</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<th>Order Status</th>"."<td colspan=\"4\">$arrayOrderStatus[$i]</td>";
            echo "</tr>";
            
            
            $orderListByOrderPK = getOrderDetailByOrderPK($arrayUniqueOrderPK[$i]);
            $countrow = count($orderListByOrderPK) + 1;
            echo "<tr>";
            echo "<th rowspan=\"$countrow\">Order Details </th>";
            echo "<th>Product Name </th>";
            echo "<th>Quantity </th>";
            echo "<th>Price Per Unit </th>";
            echo "<th>Total </th>";
            echo "</tr>";
            foreach($orderListByOrderPK as $orderByOrderPk){
                extract($orderByOrderPk);
                echo "<tr>";
                echo "<td class=\"orderdetailextra\">$ProdName</td>";
                echo "<td>$Quantity</td>";
                echo "<td>$$ProdPrice</td>";
                $total = $Quantity * $ProdPrice;
                echo "<td>$$total</td>";
                echo "</tr>";
                $paymentreceived += $total;
            }
            echo "<tr>";
            /*
             * Customer can cancel their order within 24 hour
             * 
             */
            $start_date = new DateTime($order_date_convert);//start time
            $end_date = new DateTime($current_date_time);//end time
            $interval = $end_date->diff($start_date);
            $datediff =  $interval->format('%d days %s seconds');
            $array_split_string = explode(" ", $datediff);
            $num_day_differnce = number_format($array_split_string[0]);
            $num_second_difference = number_format($array_split_string[2]);
            if($num_day_differnce < 1){
               
                echo "<th rowspan=\"2\">Total</th>";
                echo "<td colspan=\"4\">$$paymentreceived</td>";
                echo "</tr>";
                echo "<tr><td colspan =\"4\"><a href=\"OrderCancel.php?orderPK=$arrayUniqueOrderPK[$i]\">[Cancel Order]</a> </td></tr>";
             
                }
            else{
               $date= date("Y-m-d H:i:s");      
               $stats = "Order Shipped";       
               updateOrderStats($OrderPK,$date,$stats);
            
                echo "<th>Total</th>";
                echo "<td colspan=\"4\">$$paymentreceived</td>";
                echo "</tr>";
            }
            
        echo "</table>";
        
        echo "<hr>";
        $paymentreceived = 0;
    }
    //echo (int)$_GET['orderPK'];
    
    if ((isset($_GET['orderPK'])) && (is_numeric($_GET['orderPK'])))
    {
        $orderPK_get = $_GET['orderPK'];
        $orderDetail = getOrderDetailByOrderPK($orderPK_get);
        for($i = 0; $i < count($orderDetail); ++$i){
            foreach($orderDetail as $detail){
                extract($detail);
                $productPK = $ProdPK;
                $orderquantity = (int)$Quantity;
                $productStockUpdate = (int)$TotalStock + $orderquantity;
                updateQty($productStockUpdate, $productPK);
               
            }
        }
        echo $orderPK_get;
        deleteOrderByOrderPKinOrderItem((int)$_GET['orderPK']);
        deleteOrderByOrderPKinWorksOrder((int)$_GET['orderPK']);
   }

   header("Location: Order.php");
    
?>

<?php
echo "</body>";
displayPageFooter();
?>