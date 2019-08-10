<?php

   /* 
    File: FootNHead.php
    * Created By: Ian Topper, FlynnTopperLe 
    3/10/2019
    * Header and footer varient header for admin can also be found here.
     */
        
function displayPageHeader($pageTitle){
   $output = <<<ABC
<!DOCTYPE html>
            <link rel="stylesheet" href="../Style.css" type="text/css" />
            <link rel="stylesheet" href="../Style2.css" type="text/css" />
           <header>
         <h1>&nbsp &nbsp Dr⚙ne W⚙rks$pageTitle </h1>
        <nav>
            <ul>
                <li><a href="DroneHome.php">H⚙me</a></li>
                
                <li><a href="DroneProductSearchPage.php">St⚙re Search</a></li>
    
   
ABC;
// the session array element "userInfo" will be set (see loginform.php) if the user has been authenticated

$logStatus = (isset($_SESSION['userInfo']));   

// if the user is authenticated, display "Log Out", else Log In"

    if ($logStatus){
        $output .= '<li><a href="ProfileEdit.php">My Profile</a></li>&nbsp '
                .'<li><a href="Order.php">My Order</a></li>&nbsp '
                . '<li><a href="logout.php">L⚙g ⚙ut</a></li>';
    }
    else{
        $output .= '<li><a href="loginform.php">L⚙g In</a></li>';
    }
  
    $output .= "</ul></nav> </header>";

   echo $output;
} 
  function displayAdminPageHeader($pageTitle){
   $output = <<<ABC
<!DOCTYPE html>
            <link rel="stylesheet" href="../style.css" type="text/css" />
           <link rel="stylesheet" href="../style2.css" type="text/css" />
           <header>
         <h1>&nbsp &nbsp Dr⚙ne W⚙rks$pageTitle </h1>
        <nav>
            <ul>
                <li><a href="DroneHome.php">Exit Admin View</a></li>
           <li><a href="NewProd.php">Add New Item</a></li>
          <li><a href="Admin.php">Edit/Delete Items</a></li>
                         
ABC;

// the session array element "userInfo" will be set (see loginform.php) if the user has been authenticated

$logStatus = (isset($_SESSION['userInfo']));   

// if the user is authenticated, display "Log Out", else Log In"

    if ($logStatus){
        $output .= '<li><a href="logout.php">L⚙g ⚙ut</a></li>';
    }
    else{
        $output .= '<li><a href="loginform.php">L⚙g In</a></li>';
    }
  
    $output .= "</ul></nav> </header>";

   echo $output;
} 
function displayPageFooter(){
   $year = "2019";
   $output = <<<ABC
   </body>
       <footer>
      <address>
         &copy $year Drone Works<br/><br/>
      </address>
   </footer>   
 
</html>
ABC;
   echo $output;
}
?>