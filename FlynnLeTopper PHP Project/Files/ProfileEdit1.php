<?php
/*
    Author: Minh Le, FlynnTopperLe
    Date: 03/18/2019
    Files: Profile Edit 1
 */
session_start();
require ('SQLFunctions.php');
require_once ("../FootNHead.php");
displayPageHeader(": My Account");
echo "<body><section>";
echo "<h1>Account Summary</h1>";

 ?>   
<?php
    $UserPK = $_SESSION['userInfo']['userpk'];
    echo "<br>";
    $userInfo = getUserInfoByPK($UserPK);
    foreach($userInfo as $user){
        extract($user);
        $UserName_F = $Login;
        $Password_F = $Password;
        $FirstName_F = $FirstName;
        $LastName_F = $LastName;
        $Address_F = $Address;
        $City_F = $City;
        $State_F = $State;
        $Zip_F = $Zip;
        $Country_F = $Country;
        $Email_F = $Email;
        $Phone_F = $Phone;
    }    
    
    
?>
<h3>Your information has been Updated: Redirecting to your login page in 5 seconds</h3>
<br/>
<form name ="editUserForm" id="editUserForm" action="ProfileEdit1.php" method="post">
   <label for="userlogin">Username:</label>
   
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo isset($UserName_F) ? trim($UserName_F) : '' ?>" class="ten" maxlength="50" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br />
   <label for="userpassword">Password:</label> 
  
   <input type="password" name="userpassword" id="userpassword" value="<?php echo isset($Password_F) ? trim($Password_F) : '' ?>" class="ten" maxlength="50" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br />
   <label for="firstname">First Name:</label>
   
   <input type="text" name="firstname" id ="firstname" value="<?php echo isset($FirstName_F) ? trim($FirstName_F) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="First Name has invalid characters" /><br />
   <label for="lastname">Last Name:</label>
  
   <input type="text" name="lastname" id ="lastname" value="<?php echo isset($LastName_F) ? trim($LastName_F) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Last Name has invalid characters" /><br />
   <label for="address">Address:</label>
   
   <input type="text" name="address" id ="address" value="<?php echo isset($Address_F) ? trim($Address_F) : '' ?>" maxlength="30" class="twenty" required="required" pattern="^[a-zA-Z0-9][\w\s\.]*[a-zA-Z0-9\.]$" title="Address has invalid characters" /><br />      
   <label for="city">City:</label>
  
   <input type="text" name="city" id ="city" value="<?php echo isset($City_F) ? trim($City_F) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="City has invalid characters" /><br />
   <label for="state">State:</label>
   
   <input type="text" name="state" id ="state" value="<?php echo isset($State_F) ? trim($State_F) : '' ?>" maxlength="2" required="required" pattern="^[a-zA-Z]{2}$" title="Enter a valid state" /><br />
   <label for="zip">Zip:</label>
   
   <input type="text" name="zip" id ="zip" value="<?php echo isset($Zip_F) ? trim($Zip_F) : '' ?>" maxlength="10" class="ten" required="required" pattern="^\d{5}(-\d{4})?$" title="Enter a valid 5 or 9 digit zip code" /><br />   
   <label for="country">Country:</label>
   
   <input type="text" name="country" id ="country" value="<?php echo isset($Country_F) ? trim($Country_F) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="Country has invalid characters" /><br />    
   <label for="email">Email:</label>
   
   <input type="text" name="email" id ="email" value="<?php echo isset($Email_F) ? trim($Email_F) : '' ?>" maxlength="50" class="twenty" required="required" pattern="^([\w-\.]+)@([\w]+)\.([a-zA-Z]{2,4})$" title="Enter a valid email" /> <br />
   <label for="phone">Telephone:</label>
  
   <input type="text" name="phone" id ="phone" value="<?php echo isset($Phone_F) ? trim($Phone_F) : '' ?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Enter a valid phone number" /><br />
 
   <p>
      <input type="submit" value="Update" name="Update" /> <br />
   </p>
</form>
</section>

<?php
    $userLogin = (isset($_POST['userlogin'])) ? trim($_POST['userlogin']) : '';
    $userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';
    $firstName = (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
    $lastName = (isset($_POST['lastname'])) ? trim($_POST['lastname']) : '';
    $address = (isset($_POST['address'])) ? trim($_POST['address']) : '';
    $city = (isset($_POST['city'])) ? trim($_POST['city']) : '';
    $state = (isset($_POST['state'])) ? trim($_POST['state']) : '';
    $zip = (isset($_POST['zip'])) ? trim($_POST['zip']) : '';
    $country = (isset($_POST['country'])) ? trim($_POST['country']) : '';
    $eMail = (isset($_POST['email'])) ? trim($_POST['email']) : '';
    $phone = (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
    updateUserInfo($UserPK, $firstName, $lastName, $address, $city, $state, $zip, $country, $eMail, $phone, $userLogin, $userPassword);
    //updateUserInfo($UserPK, $country);
    
    header('refresh: 5; URL=LoginForm.php');
?>

<?php
displayPageFooter();
?>