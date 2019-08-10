<?php
/*
    Author: Minh Le,FlynnTopperLe
    Date: 03/18/2019
 *  Files: Register 1
 
 */




require_once ("../FootNHead.php");
displayPageHeader(": Registration");
echo "<body><section>";
echo "<h1>Registration</h1>";
echo "<br />";
 ?>   
<form name ="addUserForm" id="addUserForm" action="register1.php" method="post">
   <label for="userlogin">Username:</label>
   <br />
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo isset($userLogin) ? trim($userLogin) : '' ?>" class="ten" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br />
   <label for="userpassword">Password:</label> 
   <br />
   <input type="password" name="userpassword" id="userpassword" value="<?php echo isset($userPassword) ? trim($userPassword) : '' ?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br />
   <label for="firstname">First Name:</label>
   <br />
   <input type="text" name="firstname" id ="firstname" value="<?php echo isset($firstName) ? trim($firstName) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="First Name has invalid characters" /><br />
   <label for="lastname">Last Name:</label>
   <br />
   <input type="text" name="lastname" id ="lastname" value="<?php echo isset($lastName) ? trim($lastName) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Last Name has invalid characters" /><br />
   <label for="address">Address:</label>
   <br />
   <input type="text" name="address" id ="address" value="<?php echo isset($address) ? trim($address) : '' ?>" maxlength="30" class="twenty" required="required" pattern="^[a-zA-Z0-9][\w\s\.]*[a-zA-Z0-9\.]$" title="Address has invalid characters" /><br />      
   <label for="city">City:</label>
   <br />
   <input type="text" name="city" id ="city" value="<?php echo isset($city) ? trim($city) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="City has invalid characters" /><br />
   <label for="state">State:</label>
   <br />
   <input type="text" name="state" id ="state" value="<?php echo isset($state) ? trim($state) : '' ?>" maxlength="2" required="required" pattern="^[a-zA-Z]{2}$" title="Enter a valid state" /><br />
   <label for="zip">Zip:</label>
   <br />
   <input type="text" name="zip" id ="zip" value="<?php echo isset($zip) ? trim($zip) : '' ?>" maxlength="10" class="ten" required="required" pattern="^\d{5}(-\d{4})?$" title="Enter a valid 5 or 9 digit zip code" /><br />   
   <label for="country">Country:</label>
   <br />
   <input type="text" name="country" id ="country" value="<?php echo isset($country) ? trim($country) : '' ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="Country has invalid characters" /><br />    
   <label for="email">Email:</label>
   <br />
   <input type="text" name="email" id ="email" value="<?php echo isset($eMail) ? trim($eMail) : '' ?>" maxlength="50" class="twenty" required="required" pattern="^([\w-\.]+)@([\w]+)\.([a-zA-Z]{2,4})$" title="Enter a valid email" /> <br />
   <label for="phone">Telephone:</label>
   <br />
   <input type="text" name="phone" id ="phone" value="<?php echo isset($phone) ? trim($phone) : '' ?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Enter a valid phone number" /><br />
   <br />
   <p>
      <input type="submit" value="Register" name="register" /> <br />
   </p>
</form>
</section>
</body>
<?php
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();

?>