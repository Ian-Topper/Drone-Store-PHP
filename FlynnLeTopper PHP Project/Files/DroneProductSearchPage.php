<?php
/*
 * DroneProductSearchPage.php
    FlynnTopperLe
 * Product Search Page
 * Uses SQLFunctions.php
 * Date: 3/24/2019
 * 
 */

require_once ("../FootNHead.php");
session_start();
displayPageHeader(": Products");

// if the form is submitted

if (isset($_POST['search'])) 
{
    $prodname =  trim($_POST['prodname']);
    $pricemax =  (trim($_POST['pricemax']));
    $category = (trim($_POST['category']));
    // cookies are set to expire 30 days from now (given in seconds)
    // store the search term as a cookie

    $expire = time() + (60 * 60 * 24 * 30);
    setcookie('lastsearch', $prodname, $expire, $category);
   // setcookie('lastsearch1',$pricemax,$expire);
}

// If a previous user is visting this page

elseif (isset($_COOKIE['lastsearch'])) 
{
    $prodname =  $_COOKIE['lastsearch'];
}

else 
{
    $prodname =  '';
    $pricemax = '';
    $category = '';
}

include_once ('SQLFunctions.php');

//sql calls link  include_once ('../link.php');

// get records that match the search term

if (isset($_POST['search']) || isset($_COOKIE['lastsearch']) )
{
    $results = getProductByName($prodname,$pricemax,$category);
    $resultsCount = count($results);
  
}

?>

<!-- display the search form -->
<section>

    <form id= pad1 action="DroneProductSearchPage.php" method = "post">
   <h3 style="text-align: center">Drone Works Product Search</h3>
   <br/>
   <img id="imgFloat1" src="../search.gif" alt="Picture Not Available" width="20%"> <br/>            
     
   <label for="prodname">Product name:</label>
      <input type="text" name="prodname" id ="prodName " maxlength="50" autofocus pattern="^[a-zA-Z\s]*$" title="Letters only"value="<?php echo $prodname ; ?>" />
      <p><br/>
          <label for="pricemax">Price maximum:</label>
      <input type="number" name="pricemax" id ="pricemax " maxlength="50" autofocus pattern="^[0-9]*$" title="Numbers only"value="<?php echo $pricemax ; ?>" />
      <p><br/>
      <label for="category"><strong>Category:</strong></label><br/>

      <label for="category">Camera</label>
      <input type=radio for="category" id="category" name="category" value="Camera"/><br/>
      <label for="category">Racing</label>
      <input type=radio for="category" id="category" name="category" value="Racing"/><br/>
      <label for="category">Tiny Whoop</label>
      <input type=radio for="category" id="category" name="category" value="Tiny Whoop"/><br/>
      <label for="category">All
      <input type=radio for="category" id="category" name="category" value="" checked="true"/><br/>
       
      <p><br/>
             
        &nbsp &nbsp <input  type="submit" value="Search" name="search" />
      </p>
</form>
    <center><br/><a href="DroneViewcart.php"><h2>View Cart</h2></center></a>
 <br/>
<?php
// if the form was submitted (for a new search) or a previous user is revisiting this page,
// display results for the current search or his/her last search

if ((isset($_POST['search']) || isset($_COOKIE['lastsearch'])) && $resultsCount > 0)
{
    $counter = 0;

    $output = <<<ABC
    <table id="products">
      
ABC;

    foreach ($results as $aResult) {
        extract($aResult);
       // $prodPrice = $prodPrice;
        $output .= <<<ABC
           <tr><td ><center><fieldset>
ABC;
        if ($ImageName != '') {
            $output .= <<<ABC
<img src='../$ImageName'alt="Picture Not Available"  width="50%"><br />
ABC;
        }
        $output .=<<<ABC
                <strong> <a href="DroneShopDetail.php?prodpk=$ProdPK"> $ProdName </a> </strong> <br />
                
                <i> \$$ProdPrice  </i> <br />
               
</td></fieldset></center>
ABC;
        $counter ++;
        if ($counter === $resultsCount) {
            $output .= <<<ABC
                </tr> </table>
ABC;
        }
        elseif ($counter % 2 == 0) {
            $output .= <<<ABC
                </tr><tr>
ABC;
        }
    }

    echo $output;
    echo "</section>";
}

displayPageFooter();

?>
