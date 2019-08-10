<?php
/*
    Author: Minh Le, FlynnTopperLe
    Date: 03/18/2019
    Files: Register 1
 */

require_once ("../FootNHead.php");
displayPageHeader(": Registration");
echo "<body><section>";
 ?>   
<?php
    
?>
<form name ="addUserForm" id="addUserForm" action="register1.php" method="post">
   <label for="userlogin">Username:</label>
   <br />
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo (isset($_POST['userlogin'])) ? trim($_POST['userlogin']) : '' ?>" class="ten" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br />
   <label for="userpassword">Password:</label> 
   <br />
   <input type="password" name="userpassword" id="userpassword" value="<?php echo (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : ''?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br />
   <label for="firstname">First Name:</label>
   <br />
   <input type="text" name="firstname" id ="firstname" value="<?php echo (isset($_POST['firstname'])) ? trim($_POST['firstname']) : ''?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="First Name has invalid characters" /><br />
   <label for="lastname">Last Name:</label>
   <br />
   <input type="text" name="lastname" id ="lastname" value="<?php echo (isset($_POST['lastname'])) ? trim($_POST['lastname']) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Last Name has invalid characters" /><br />
   <label for="address">Address:</label>
   <br />
   <input type="text" name="address" id ="address" value="<?php echo (isset($_POST['address'])) ? trim($_POST['address']) : ''?>" maxlength="30" class="twenty" required="required" pattern="^[a-zA-Z0-9][\w\s\.]*[a-zA-Z0-9\.]$" title="Address has invalid characters" /><br />      
   <label for="city">City:</label>
   <br />
   <input type="text" name="city" id ="city" value="<?php echo (isset($_POST['city'])) ? trim($_POST['city']) : ''?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="City has invalid characters" /><br />
   <label for="state">State:</label>
   <br />
   <input type="text" name="state" id ="state" value="<?php echo (isset($_POST['state'])) ? trim($_POST['state']) : ''?>" maxlength="2" required="required" pattern="^[a-zA-Z]{2}$" title="Enter a valid state" /><br />
   <label for="zip">Zip:</label>
   <br />
   <input type="text" name="zip" id ="zip" value="<?php echo (isset($_POST['zip'])) ? trim($_POST['zip']) : '' ?>" maxlength="10" class="ten" required="required" pattern="^\d{5}(-\d{4})?$" title="Enter a valid 5 or 9 digit zip code" /><br />   
   <label for="country">Country:</label>
   <br />
   <input type="text" name="country" id ="country" value="<?php echo (isset($_POST['country'])) ? trim($_POST['country']) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="Country has invalid characters" /><br />    
   <label for="email">Email:</label>
   <br />
   <input type="text" name="email" id ="email" value="<?php echo (isset($_POST['email'])) ? trim($_POST['email']) : '' ?>" maxlength="50" class="twenty" required="required" pattern="^([\w-\.]+)@([\w]+)\.([a-zA-Z]{2,4})$" title="Enter a valid email" /> <br />
   <label for="phone">Telephone:</label>
   <br />
   <input type="text" name="phone" id ="phone" value="<?php echo (isset($_POST['phone'])) ? trim($_POST['phone']) : ''?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Enter a valid phone number" /><br />
   <br />
   <p>
      <input type="submit" value="Register" name="register" /> <br />
   </p>
</form>
</section>

<?php
// call the displayPageFooter method in siteCommon2.php
    require ('SQLFunctions.php');
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
    
    $testusername = getUserName($userLogin);
    $countUserName = count($testusername);
    if($countUserName != 0){
        echo "<h1>$userLogin is already taken. Please choose different username.</h1>";
    }
    else{
        $userPK = Date('dis').rand(0,99);
        insertUserInfo($userPK, $firstName, $lastName, $address, $city, $state, $zip, $country, $eMail, $phone, $userLogin, $userPassword);
        //echo "<h1>Register Successfully</h1>";
        echo "<h1>Register Successfully</h1>";
        header('refresh: 5; URL=LoginForm.php');
    }
?>

</body>
<?php
displayPageFooter();
?>