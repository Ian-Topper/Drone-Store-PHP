<?php

session_start();
/* 
Created By: Ian Topper, FlynnTopperLe
3/10/2019
 File:Admin.php
 * Displays all products and allows delete and edits
*/
if ($_SESSION['userInfo']['rolename'] != 'Admin'){
    header('refresh: 2; URL=dronehome.php');
    echo '<h2>S⚙rry, y⚙u are n⚙t auth⚙rized t⚙ view this page.</h2>';
    die();   
}
require_once ("../FootNHead.php");
$bob = ": Admin View";
displayAdminPageHeader($bob);
?>  <body>
    <section><center>
   <h3>Welcome back <?php echo $_SESSION['userInfo']['firstname'] ?> </h3>
        </center></section>
        <?php
        include trim(("../Link.php"));
include trim(("SQLFunctions.php"));
          $products = getProducts();        
extract($products);
     foreach ($products as $product){  
        extract($product);
        $prodNum ++;
        $output .= <<<ABC
            <fieldset>    
                <img id="imgFloat" src="../$ImageName" alt="Picture Not Available" width="50%">             
           
   <h4> Category:</h4> $Type 
         
        <br /><h4> Product Name: </h4>$ProdName 
           <br /> <br /><h4> Price:</h4> $$ProdPrice
   <br /> <br /> <h4> Qty: </h5>$TotalStock             
   <br /> <br /> <h4>Description:</h4> $ProdDescribe 
               
              <center> <br/> <br/> <a href="EditProduct.php?prodpk=$ProdPK"><h2>Edit Product</h2></a> 
           <br/> <a href="DeleteProduct.php?prodpk=$ProdPK"><h2>Delete Product From Inventory</h2></a></center>
              <br/>
                
ABC;
       $output .= "</fieldset>";
    } 
    echo $output;
displayPageFooter();
?>
