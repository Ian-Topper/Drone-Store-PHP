<?php

/*
    FlynnLeTopper
 * DroneShopeDetail.php
 * 3/24/2019
 */

require_once ("../FootNHead.php");
session_start();

$listPage = 'DroneProductSearchPage.php';

// If merchandisepk is not passed with page request, redirect to Store Search Page
// Else, assign the URL parameter to a variable

if (!isset($_GET['prodpk']) || !is_numeric($_GET['prodpk']))
{
    header('Location:' . $listPage);
    exit();
}
else
{
    $ProdPk = (int) $_GET['prodpk'];
}

require_once ('SQLFunctions.php');

$merchList = getProductDetails($ProdPk);

if (count($merchList) != 1)
{
   header('Location:' . $listPage);
   exit();
}

extract($merchList[0]);

$formattedPrice = number_format($ProdPrice, 2,'.',',');

displayPageHeader(": Product Details");

$output = <<<ABC
<section id=pad1>
<br/>
<h3 style="text-align: center">$ProdName</h3><br/>
<form action="DroneUpdatecart.php" method = "post">
<input type="hidden" name="prodpk" value =$ProdPK />
ABC;

if ($ImageName !='')
{
    $output .= <<<DEF
<div style="text-align:center">
<img src="../$ImageName" alt="Picture Not Available" width="50%">
</div>
DEF;
}

$output .= <<<GHI
<dl><br/>
    <dt><h4>Description:</h4></dt>
        <dd>$ProdDescribe</dd><br />
    <dt><h4>Price:</h4></dt>
        <dd>$$formattedPrice</dd><br />
 <dt><h4>Product:</h4></dt>
        <dd>$ProdName</dd> <br />
        
   <dt><input id=pad2 name = "submit" type="submit" value="Add to Cart" /></dt>
</dl>
<center><h2><div>
<a href="droneViewcart.php">View Cart</a>
</div></h2></center>
<p style="text-align: center">
      <br/> <h2><center> <a href="$listPage">Back to Search Page</a></center></h2>
</p>
</form>
</section>
GHI;

echo $output;

 displayPageFooter();
 ?>