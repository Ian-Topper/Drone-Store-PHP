
<?php
/*
File:DeleteProduct.php
Author: Ian Topper, FlynnTopperLe
Date: 3/12/2019
 * This is a stand alone query that deletes the product chosen for deletion.
*/

include_once ("../Link.php");

if ((isset($_GET['prodpk'])) && (is_numeric($_GET['prodpk'])))
{
    $clasAct = ((int)$_GET['prodpk']);
    echo "<br/>" . $classAct;
     $queryD = <<<STR
Delete
From products
Where prodpk like $clasAct
STR;
echo  $queryD;
   executeQuery($queryD);
}

header("Location: Admin.php");
exit;
?>
