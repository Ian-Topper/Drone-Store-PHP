<?php
/*
  File: UpdateProd.php
Author: Ian Topper, FlynnTopperLe
Date: 3/15/2019
Editprod form is validated here and is sent on to sql functions returns results.
 */
session_start();
if ($_SESSION['userInfo']['rolename'] != 'Admin'){
    header('refresh: 2; URL=dronehome.php');
    echo '<h2>S⚙rry, y⚙u are n⚙t auth⚙rized t⚙ view this page.</h2>';
    die();   
}

require_once trim(("SQLFunctions.php"));
require_once ("../FootNHead.php");

displayAdminPageHeader("Updated");
 
$prodname = trim ($_POST['prodName']);
 $proddescribe = trim($_POST['prodDescribe']);
 $imagename = trim($_POST['imageName']);
 $prodpk = trim($_POST['prodPK']);
 $prodprice = trim($_POST["prodPrice"]);
 $totalstock = trim($_POST["totalStock"]);
 $catfk = trim($_POST["cat"]);

  $prodname1 = preg_replace("/[^a-zA-Z-0-9\s]/", '', $prodname);
 
  $proddescribe1 = preg_replace("/[^a-zA-Z-0-9\s\(\)\,\-\?\.\;\!\:\,\'\$]/", '', $proddescribe);

 $imagename1 = preg_replace("/[^a-zA-Z-0-9\s\.]/", '', $imagename);

 $prodprice1 = preg_replace("/[^0-9\.]/", '', $prodprice);

 $totalstock1 = preg_replace("/[^0-9]/", '', $totalstock);

 $catfk1 = preg_replace("/[^0-9]/", '', $catfk);


  if($prodname==$prodname1 and $prodname!="" and $proddescribe == $proddescribe1 
         and $proddescribe!="" and $imagename1 == $imagename and $imagename!="" 
          and $prodprice1 == $prodprice and $prodprice!="" and $totalstock1 == $totalstock 
          and $totalstock!="" and $catfk1 == $catfk and $catfk!=""){
   $prod = editProd($prodname, $proddescribe,$imagename,$prodpk, 
         $prodprice, $totalstock, $catfk);
   

    if ($prod == null){
        echo "<br/><center><h3>Product has been updated!!!</h3></center>";
        $output = <<<ABC
            
        <p4 style="text-align: center"><br/>
            <h2><a href="admin.php">Return</a></h2>
        </p4><br/>
        <input type="hidden">
       
ABC;
   }
    }else{
        
$error = "<section id=pad1>"; 
    if($prodname != $prodname1||$prodname==""){
            $error .= ' <br/>Invalid entry for Product Name. ex: Tiny Whoop Racer';
            }
      if($proddescribe != $proddescribe1||$proddescribe=="" ){
           $error .= ' <br/>Invalid entry for Product Description. Special Characters not allowed. ';
            } 
      if($imagename != $imagename1||$imagename=="" ){
             $error .= ' <br/>Invalid entry for Image Name: <br/> ex: drone.jpg';
            } 
      if($prodprice != $prodprice1||$prodprice=="" ){
             $error .= ' <br/>Invalid entry for Price: ex: 24.34';
            }
      if($totalstock != $totalstock1 || $totalstock==""){
            $error .= ' <br/>Invalid entry for total stock ex: 1500';
            }
      if($catfk != $catfk1 || $catfk==""){
             $error .= ' <br/>Invalid entry for category ex: Check Tiny whoop radio button';
            }   
         echo $error . "</section>"; 
         
    $output = <<<ABC
      <section >  <br/>
     <p4 style="text-align: center">
        <h2> <a href="Admin.php">Error Return</a></h2>
     </p4><br/>
   </section>
ABC;
}
echo $output;
 displayPageFooter();

?>