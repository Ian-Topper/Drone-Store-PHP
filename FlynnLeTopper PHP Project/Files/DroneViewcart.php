<?php
/*
    FlynnTopperLe
    DroneViewCart.php
 *  Date 3/24/2019
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

require_once ('SQLFunctions.php');
require_once ('../FootNHead.php');
//require_once ('../link.php');

displayPageHeader(":Shopping Cart");
// get a list of merchandiseIDs for the cart items; string them together delimiting with a comma

$merchandiseIDs = join(array_keys($_SESSION['aCart']->getCartItems()),',');

///These fix a bug that puts in too many commas and makes queries fail
$merchandiseIDs = trim($merchandiseIDs,",");
$merchandiseIDs = preg_replace('/,+/', ',', $merchandiseIDs);
$cartList = getProductInCart($merchandiseIDs);

$cartItems = count($cartList);

$output = <<<HTML
<body><br/>
  <center> <h3><section id=title>
Cart Selections</h3></center>
    </section>
   
   <section> 
   <br/>
<h5 style="text-align: center">You have $cartItems product(s) in your cart</h5>
<center><br/>
<table id="pay">
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
        <td id=pay>
            <form action="droneupdatecart.php" method="post">
                <input type="hidden" name="prodpk" value="$prodpk" />
                <input type="number" name="prodqty" value="$prodqty" size="4" maxlength="4" required="required" min="0" max="20" />
                <input type="submit" name=submit" value="Update Quantity" />
            </form>
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
$formattedTotalPrice = number_format($totalPrice,2);
$output .= <<<HTML
    <tr>
        <td  colspan="4" style="text-align: center">
            <b>Order Total <h4>$$formattedTotalPrice</h4>
        </td>
   <tr/>
       <tr >
   <td id=pad colspan="4"  style="text-align: center">
       <form action="DroneCheckout.php" method="post">
            <input type="submit" name="submit" id=proceed value = "Proceed to Checkout" />
        </form>
        </td>
    </tr>
</table></center><br/><center>
<p style="text-align: center">
    <a href="DroneProductSearchPage.php"><h2>Continue shopping<h2/></a>
</p><center/><br/>
</section>
HTML;
echo $output;
displayPageFooter();

?>


