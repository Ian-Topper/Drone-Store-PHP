<?php
/*
    FlynnTopperLe
 *  DroneCheckout.php
 * Date: 3/12/2019
 */ 

require_once ('DroneShopCart.php');
require_once ('../FootNHead.php');
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

// get a list of merchandiseIDs for the cart items

$merchandiseIDs = join(array_keys($_SESSION['aCart']->getCartItems()),',');
///These fix a bug that puts in too many commas and makes queries fail
$merchandiseIDs = trim($merchandiseIDs,",");
$merchandiseIDs = preg_replace('/,+/', ',', $merchandiseIDs);
//get merchandise details for the items in the cart

$cartList = getProductInCart($merchandiseIDs);

// get a count of the number of items in the cart

$cartItems = count($cartList);

$contactName = $_SESSION['userInfo']['firstname'];

require_once ('../link.php');

displayPageHeader(":Place Order");
// prepare the output using heredoc syntax

$output = <<<HTML
<body><br/>
  <center> <h3><section id=title>
Finalize Order</h3></center>
    </section><br/>
   <section>
<h5 style="text-align: center">$contactName, you have $cartItems product(s) in your cart</h5>
<br/><center>
<table>
    <tr>
           <th id="pay"><h4>Item Name<h4/></th>
        <th id="pay"><h4>Item Quantity<h4/></th>
        <th id="pay"><h4>Unit Price<h4/></th>
        <th id="pay"><h4>Extended price<h4/></th>
    </tr>
HTML;

foreach ($cartList as $aItem)
{
   extract($aItem);
    $prodqty = $_SESSION['aCart']->getQtyByMerchandiseID($prodpk);
    $extendedPrice = $prodqty * $prodprice;
    $totalPrice += $extendedPrice;
    $formattedExtendedPrice = number_format($extendedPrice, 2);
    $formattedPrice = number_format($prodprice, 2);
    $output .= <<<HTML
    <tr>
         <td id=pay>
            $prodname
        </td>
        <td id=pay style="text-align: right; font-style: normal">
            $prodqty
        </td>
        <td id=pay style="text-align: right">
            $$formattedPrice
        </td>
        <td id=pay style="text-align: right">
            $$formattedExtendedPrice
        </td>
    </tr>
HTML;
}
 
       $city = $_SESSION['userInfo']['city'];
        $state=$_SESSION['userInfo']['state'];
               $zip= $_SESSION['userInfo']['zip'];
        $country=$_SESSION['userInfo']['country'] ;
        $address=$_SESSION['userInfo']['address'] ;
        
$formattedTotalPrice = number_format($totalPrice,2);
$output .= <<<HTML
    <tr>
        <td colspan="4" style="text-align: center">
            <b>Order Total <h4>$$formattedTotalPrice</h4></b>
        </td>
        <td colspan="2" style="text-align: center">
        
 
        </td>
    </tr>
</table>
     
       <br/> <h3> Confirm/Update Mailing Address
        </h3></center> 
    <br/>    
        <section id="addy">
        <form action="DronePlaceOrder.php" method="post">
  <label for="address">Mailing Address:</label>
   
   <input type="text" name="address" id ="address" value="$address" maxlength="30" class="twenty" required="required" pattern="^[a-zA-Z0-9][\w\s\.]*[a-zA-Z0-9\.]$" title="Address has invalid characters" /><br />  <br />    
   
   <label for="city">City:</label>
 
   <input type="text" name="city" id ="city" value="$city" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="City has invalid characters" /><br /><br />
   <label for="state">State:</label>
   
   <input type="text" name="state" id ="state" value="$state" maxlength="2" required="required" pattern="^[a-zA-Z]{2}$" title="Enter a valid state" /><br /><br />
   <label for="zip">Zip:</label>
   
   <input type="text" name="zip" id ="zip" value="$zip" maxlength="10" class="ten" required="required" pattern="^\d{5}(-\d{4})?$" title="Enter a valid 5 or 9 digit zip code" /><br />  <br /> 
   <label for="country">Country:</label>   
   <input type="text" name="country" id ="country" value="$country" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="Country has invalid characters" /><br /> <br />   
    <label for="card">Credit Card Number:</label>   
   <input type="number" name="card" id ="card" value="" min="1000000000000000" max="9999999999999999" class="twenty" required="required" pattern="^[0-9]$" title="card has invalid characters" /><br /> <br />   
 </section> <center>
          <input id=pad2  type="submit" name="submit" value = "Place Order" />
        </center> <br/> </form>   
      </section>  
<p style="text-align: center"><center>
    <a href="DroneProductSearchPage.php"><h2>Continue shopping</h2></a>
</p></center>

HTML;

// display the output

echo $output;

displayPageFooter();

?>
