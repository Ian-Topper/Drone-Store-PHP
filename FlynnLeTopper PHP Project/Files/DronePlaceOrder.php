<?php
/*
    FlynnLeTopper
    DronePlaceOrder.php
 *  Date:3/24/2019
*/

require_once ('DroneShopCart.php');

session_start();

// if the session variable is not set or is empty display appropriate message; otherwise display the items

if (!isset($_SESSION['aCart']) || count($_SESSION['aCart']->getCartItems()) === 0)
{
    header('Refresh: 5; URL=DroneProductSearchPage.php');
    echo '<h2>You shopping cart is empty <br /> You will be redirected to our store in 5 seconds.</h2>';
    echo '<h2>If you are not redirected, please <a href="DroneProductSearchPage.php">Click here to visit our Store</a>.</h2>';
    die();
}
if (!isset($_SESSION['userInfo']))
{
    header('Refresh: 2; URL=loginform.php?redirect=' . $_SERVER['PHP_SELF']);
    echo '<h2>You are being redirected to the login page...</h2>';
    die();
}

require_once ('SQLFunctions.php');

// call the insertOrder method; get the orderPK of the newly added order
$majicPK = Date('is').rand(0,999);
$address = (isset($_POST['address'])) ? trim($_POST['address']) : '';
    $city = (isset($_POST['city'])) ? trim($_POST['city']) : '';
    $state = (isset($_POST['state'])) ? trim($_POST['state']) : '';
    $zip = (isset($_POST['zip'])) ? trim($_POST['zip']) : '';
    $country = (isset($_POST['country'])) ? trim($_POST['country']) : '';


$date= date("Y-m-d H:i:s");
$orderIDResult = insertOrder( $majicPK,$_SESSION['userInfo']['userpk'],
        $address, $city,$state, $zip,$country, $date);

$newOrderID = $majicPK;

// for each item in the shopping cart, 
// insert a row into the merchandiseorderitems table

foreach($_SESSION['aCart']->getCartItems() as $aKey => $aValue)
{
    //updates qty and some other stuff
    $stocks =getQty($aKey);
    $stk=$stocks[0]['totalstock'];   
    $stocks = ("$stk" - "$aValue");
    updateQty($stocks,$aKey);
    insertOrderItem($newOrderID, $aKey, $aValue);
    // delete the item from the cart
    $_SESSION['aCart']->deleteCartItem($aKey);
}

require_once ('../FootNHead.php');
displayPageHeader(":Order Confirmation");

$output = <<<ABC
<section><br/>
<h3 style="text-align: center">Order Complete #$majicPK<br/><br/>Thank you for supporting Drone Works</h3>
<p style="text-align: center"><center><br/><br/>
    <a href="DroneProductSearchPage.php"><h2>Back to our store</h2></a>
</center></p><br/>
</section>
ABC;

// display the output

echo $output;

displayPageFooter();

?>
