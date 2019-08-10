
<?php
/*
 * File:NewProd.php
 * Created by Ian Topper, FlynnTopperLe
 * Date:3/24/2019
 * a form for creating new products.
*/
session_start();
if ($_SESSION['userInfo']['rolename'] != 'Admin'){
    header('refresh: 2; URL=dronehome.php');
    echo '<h2>S⚙rry, y⚙u are n⚙t auth⚙rized t⚙ view this page.</h2>';
    die();   
}

require_once ('../FootNHead.php');
require_once ("SQLFunctions.php");

$prodNewPK = Date('dis').rand(0,99);
displayAdminPageHeader(": Add New Product");
?>    <center>  
    <h3>Enter New Product</h3> </center>     
	 <h5>  <section>            
     <fieldset id="CreateProd">
         <img src="../concept.jpg" id ="imgFloat" alt="Picture Not Available" width="40%" float="right">           
         
     <form action="CreateProd.php" method = "post" name="createActor" id="createActor"> 
      <input type="hidden" name="prodPK" id ="prodPK" maxlength="30" minlength = "2" 
           value="<?php echo $prodNewPK;?>" /> 
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
      <h6> <label for="cat"> Category ID: </label> </h6>
     </p>
       <label for="cat">Tiny Whoop</label>
      <input type="radio" name="cat" id ="cat" maxlength="30" value="123" checked/>
        <label for="cat">Racing</label>
      <input type="radio" name="cat" id ="cat" maxlength="30" value="321"/>
       <label for="cat">Camera</label>
      <input type="radio" name="cat" id ="cat" maxlength="30" value="213"/>
      <br/><br/>
         <input id=pad2 type="submit" value="Create Product" name="search" />
         <br/><br/> <p><h2><a href="Admin.php">Cancel</a></h2>
      </p>
     </form> 
      </fieldset>
          </section></h5>
    </body>
<?php
displayPageFooter();
?>
