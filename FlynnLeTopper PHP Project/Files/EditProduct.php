

<?php
/*
File:EditProduct.php
Created By: Ian Topper, FlynnTopperLe
3/10/2019
This is the edit product form
 */
session_start();
if ($_SESSION['userInfo']['rolename'] != 'Admin'){
    header('refresh: 2; URL=dronehome.php');
    echo '<h2>S⚙rry, y⚙u are n⚙t auth⚙rized t⚙ view this page.</h2>';
    die();   
}
require_once ('../FootNHead.php');
require_once ("SQLFunctions.php");

 $ProdPK=$_GET['prodpk'];
// if a numeric filmid was passed through the URL
if ((isset($_GET['prodpk'])) && (is_numeric($_GET['prodpk']))){    
    $productDetails = getProd((int)$_GET['prodpk']);

}
   extract($productDetails[0]);
   
   displayAdminPageHeader(": Edit Product");
   ?><center>
<h3>Product Editor</h3>
   </center>
       <fieldset id="getProduct">
          <?php
          $DisplayForm = true;
          if(!isset($_GET['prodpk'])){
          $DisplayForm = False;
          }
          if($DisplayForm){
              ?>   <img src="../<?php echo $imagename ?>" id ="imgFloat" alt="Picture Not Available" width="40%" float="right">           
         <h5>      
           <form  action="UpdateProd.php" method = "post" name="updateProd" id="updateProd"> 
        <label for="prodName"> Product PK:</label>
        <input type="text"  name="prodPK" id ="prodPK" maxlength="30" minlength = "2" 
           value="<?php echo $prodpk;?>" readonly/> <br/><br/>
    <label for="prodName"> Product Name:</label>
    <input required type="text" name="prodName" id ="prodName" maxlength="30" minlength = "2" 
           value="<?php echo $prodname;?>" /> <br/><br/>
         <label for="prodDescribe">Description:</label>
         <input   required textarea rows="40" cols="50" name="prodDescribe" id ="prodDescribe" maxlength="10000" minlength = "2"
              value="<?php echo $proddescribe ?>" /> <br/><br/>
       <label for="prodPrice"> Product Price:</label>
      <input  required type="text" name="prodPrice" id ="prodPrice" maxlength="30" minlength = "1" 
              value="<?php echo $prodprice ?>" /> <br/> <br/>
     <label for="imageName">Image Name:</label>
      <input  required type="text" name="imageName" id ="imageName" maxlength="30" minlength = "1" 
              value="<?php echo $imagename ?>" /> <br/><br/>
      <label for="TotalStock"> Total Stock:</label>
      <input  required type="text" name="totalStock" id ="totalStock" maxlength="30" minlength = "1" 
              value="<?php echo $totalstock ?>" /> <br/> <br/>
      <label for="cat"><h6> Category ID: </h6></label> 
     </p>
      <?php
      if($catfk==321){
      echo '<label for="cat">Racing</label><input type="radio" name="cat" id ="cat" maxlength="30" value="321" checked/>';
      }
      else echo '<label for="cat">Racing</label><input type="radio" name="cat" id ="cat" maxlength="30" value="321"/>';
      
       if($catfk==213){
      echo '<label for="cat">Camera</label>
      <input type="radio" name="cat" id ="cat" maxlength="30" value="213" checked/>';
      }
      else echo '<label for="cat">Camera</label>
      <input type="radio" name="cat" id ="cat" maxlength="30" value="213"/>';
      
       if($catfk==123){
      echo '<label for="cat">Tiny Whoop</label>
      <input type="radio" name="cat" id ="cat" maxlength="30" value="123" checked/>';
      }
      else echo '<label for="cat">Tiny Whoop</label>
      <input type="radio" name="cat" id ="cat" maxlength="30" value="123"/>';
      ?>
              </h5> 
           <p>
        <br/><input id="pad2" type="submit" value="Update Product" name="search" /> </p>
      <br/> <a href="Admin.php"><h2>Cancel</h2></a></form></fieldset>
      <?php
          displayPageFooter();}   
      ?>