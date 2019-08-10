<?php

/* 
 File: SQLFunctions
Created By: Ian Topper, Ryan Flynn and Minh Le
3/10/2019
 * Most SQL queries are built here and sent to the data base
 */
require_once '../Link.php';


/*
 * Ian's Functions
 * 
 * 
 */
function updateOrderStats($OrdPK, $date, $status){
     $query = <<<STR
    update worksorder
    set shipdate = '$date', orderstatus = '$status'
             where orderpk = '$OrdPK' and orderstatus = 'Order Received';
STR;

    return executeQuery($query);    
 
    
}

function getUser($userLogin, $userPassword){
    $query = <<<STR
Select userpk, firstname, rolename, address, city,state,zip,country
From worksuser inner join userrole
on rolefk = userrolepk
Where login = '$userLogin'
and password = '$userPassword'
STR;

    return executeQuery($query);
}


function getProducts(){
    $query = <<<STR
Select Type, TotalStock, ProdPK, ProdName, ProdDescribe, ProdPrice, ImageName, CatFK
From Products inner join Category
on Catfk = Catpk
Order by ProdName       
STR;
    return executeQuery($query);
}

function getProd($PKProd){
       $query = <<<STR
Select prodpk, prodname, proddescribe, prodprice, imagename, catfk, totalstock
From products
Where prodpk like '$PKProd'
STR;
    return executeQuery($query);
}

function editProd($prodname, $proddescribe,$imagename,$prodpk, 
         $prodprice, $totalstock, $catfk){
    $prodname = str_replace('\'', '\'\'', trim($prodname));
    $proddescribe = str_replace('\'', '\'\'', trim($proddescribe));
    $imagename = str_replace('\'', '\'\'',trim($imagename));
    $prodpk = str_replace('\'', '\'\'',trim($prodpk));
   $prodprice = str_replace('\'', '\'\'',trim($prodprice));
    $totalstock = str_replace('\'', '\'\'',trim($totalstock));
    $catfk = str_replace('\'', '\'\'',trim($catfk));
    
    $query = <<<STR
            
Update products
Set prodname = '$prodname', proddescribe = '$proddescribe', 
        imagename = '$imagename', prodprice = '$prodprice', 
        totalstock = '$totalstock', catfk = '$catfk'
            Where prodpk like '$prodpk';

STR;
 
    return executeQuery($query);

}
function newProd($prodname, $proddescribe,$imagename,$prodpk, 
         $prodprice, $totalstock, $catfk){
  
    $query = <<<STR
    Insert into products(prodname, prodpk, proddescribe, 
                         imagename, prodprice, totalstock, catfk) 
       Values('$prodname','$prodpk', '$proddescribe','$imagename', 
              '$prodprice', '$totalstock', '$catfk')
            
STR;

    return executeQuery($query);
}
function getProductInCart($prodPKs){

    $query = <<<STR
Select prodpk, prodname, prodprice
From products
Where prodpk in ($prodPKs)
STR;

    return executeQuery($query);
}
function insertOrder($pk, $userFK, $add, $city, $state, $zip,$country,$date){

    $query = <<<STR
            
Insert into worksorder(orderpk, userfk, orderdate, shipaddress, shipcity,shipstate, shipzip,shipcountry, orderstatus)
Values ('$pk', '$userFK','$date', '$add', '$city', '$state', '$zip','$country', 'Order Received');
Select SCOPE_IDENTITY() As orderpk;
STR;

    return executeQuery($query);
}
function getQty($prodpk){
    $query = <<<STR
    Select totalstock 
    from products
    where prodpk like '$prodpk'
STR;
    
return executeQuery($query);
    
}
function updateQty($stock,$prodpk){
    $query = <<<STR
    Update products
    set totalstock = '$stock'
    where prodpk like '$prodpk';
STR;
    
return executeQuery($query);
    
}
function insertOrderItem($orderfk, $prodfk, $qty){
    $pk = Date('is').rand(0,999);
    $query = <<<STR
Insert into orderitem( orderfk, prodfk, quantity)
Values ( $orderfk, $prodfk, $qty);
       
STR;

    executeQuery($query);
}
/*
 * End Ian's Functions
 * 
 * 
 * 
 * Start Ryan's Functions
 */
function getProductByName($prodname, $pricemax, $category){
    $query = <<<STR
Select Type, TotalStock,ProdPK, ProdName, ProdDescribe, ProdPrice, ImageName, CatFK
From Products inner join Category
on Catfk = Catpk
Where 0=0 
STR;
    if($prodname !=""){
$query .= <<<STR
and ProdName like '%$prodname%'        
STR;
    }
        if($pricemax !=""){
     $query .= <<<STR
           and ProdPrice <= $pricemax  
STR;
        }
       if($category !=""){
     $query .= <<<STR
           and Type = '$category'  
STR;
    }
   
    return executeQuery($query);
}

function getProductDetails($prodpk)
{
    $query = <<<STR
Select ProdPK, ProdName, ProdDescribe, ProdPrice, ImageName, catFK, TotalStock
From Products
Where ProdPK = $prodpk
STR;
    return executeQuery($query);
}


/*
 * 
 * End Ryan's Functions
 */

/*
 * Start Minh's Function *
 */
function getUserName($username){
        $query = <<<STR
Select Login
From WorksUser 
Where Login = '$username'
STR;
    return executeQuery($query);
}

function getUserInfoByPK($UserPK){
        $query = <<<STR
Select FirstName, LastName, Address, City, State, Zip, Country, Email, Phone, Login, Password, Login 
From WorksUser 
Where UserPK = $UserPK
STR;
    return executeQuery($query);
}

function insertUserInfo($UserPK,$firstname, $lastname, $address, $city, $state, $zip, $country, $email, $phone, $username, $password){
    $query = <<<STR
    Insert into WorksUser(UserPK, FirstName, LastName, Address, City, State, Zip, Country, Email, Phone, Login, Password, RoleFK) 
    Values('$UserPK','$firstname','$lastname', '$address','$city', '$state', '$zip', '$country', '$email', '$phone', '$username', '$password', 7879)          
STR;

    return executeQuery($query);
}

function updateUserInfo($UserPK,$firstname, $lastname, $address, $city, $state, $zip, $country, $email, $phone, $username, $password)
{
    $query = <<<STR
    Update WorksUser
    Set FirstName = '$firstname', LastName = '$lastname', Address = '$address', City = '$city', State = '$state', Zip = $zip, Country = '$country', Email = '$email', Phone = '$phone', Login = '$username', Password = '$password'
    Where UserPK = $UserPK
STR;
    //Set FirstName = '$firstname', LastName = '$lastname', Address = $address, City = '$city', State = '$state', Zip = $zip, Country = '$country', Email = '$email', Phone = '$phone', Login = '$username', Password = '$password'
    executeQuery($query);
}

function getOrderDetailByUserPk($userPK){
    $query = <<<STR
        SELECT OrderPK, OrderDate, UserPK, FirstName, LastName, Address, City, State, Zip, Country, Email, Phone, ProdName, Quantity, ProdPrice
        FROM OrderItem inner join WorksOrder on OrderPK = OrderFK
        inner join WorksUser on UserPK = UserFK   
        inner join Products on ProdPK = ProdFK 
        where UserPK = $userPK
STR;
    return executeQuery($query);
}

function getOrderTableByUserPK($userPK){
    $query = <<<STR
        SELECT *
        FROM WorksOrder
        where UserFK = $userPK
STR;
    return executeQuery($query);
}

function getOrderDetailByOrderPK($orderPK){
    $query = <<<STR
        SELECT *
        FROM OrderItem inner join WorksOrder on OrderPK = OrderFK
        inner join WorksUser on UserPK = UserFK   
        inner join Products on ProdPK = ProdFK 
        where OrderPK = $orderPK
STR;
    return executeQuery($query);
}

function deleteOrderByOrderPKinOrderItem($OrderPK){
    $query = <<<STR
        DELETE
        FROM OrderItem
        where OrderFK = $OrderPK
STR;
    executeQuery($query);
}
function deleteOrderByOrderPKinWorksOrder($OrderPK){
    $query = <<<STR
        DELETE
        FROM WorksOrder
        where OrderPK = $OrderPK
STR;
    executeQuery($query);
}




// * End Minh's Functions *


?>