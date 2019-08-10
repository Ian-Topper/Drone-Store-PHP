<?php
/* 
    Authors: FlynnTopperLe 
 *  File: DroneUpdateCart.php
    Date: 3/24/2019
*/

require_once ('DroneShopCart.php');

session_start();

if (isset($_POST['prodpk']))
{

    if (!isset($_SESSION['aCart']))
    {
        $_SESSION['aCart'] = new shopCart();
    }

    if (isset($_POST['prodqty']))
    {

        $_SESSION['aCart']->updateCartItem($_POST['prodpk'],$_POST['prodqty']);
    }
    else
    {
        // call the addCartItem method
        $_SESSION['aCart']->addCartItem($_POST['prodpk']);
    }
}

header('location:DroneViewcart.php');
exit();
?>
