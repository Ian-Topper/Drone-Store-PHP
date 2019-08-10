<?php

/*File:LoginForm.php
 * Created By: Ian Topper, FlynnTopperLe 
3/10/2019
 The form is used for users to log in
 *  */

session_start();

require_once ("SQLFunctions.php");

// Set local variables to $_POST array elements (userlogin and userpassword) or empty strings

 $userLogin = (isset($_POST['userlogin'])) ? trim($_POST['userlogin']) : '';
 $userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';


if (isset($_POST['login'])){
    $userList = getUser($userLogin, $userPassword);
    if (count($userList)===1){
       extract($userList[0]);
        $userInfo = array('userpk'=>$userpk, 'firstname'=>$firstname, 'rolename'=>$rolename, 'address'=>$address,
            'city'=>$city, 'state'=>$state, 'zip'=>$zip, 'country'=>$country);       
        $_SESSION['userInfo'] = $userInfo;
        session_write_close(); //typically not required; ensures that the session data is stored
        // redirect the user
if($rolename === 'Admin'){
        header('location:' . 'Admin.php');
        die();
}
else{
    header('location:' . 'DroneHome.php'); 
    die();
}
    }
    else {
        $error = 'Invalid login credentials<br />Please try again';
    }
}
require_once ("../FootNHead.php");
displayPageHeader(": Log Into Account");
echo "<section>";
if (isset($error)){
    echo '<div id="error">' . $error . '</div>';
}
?>
    <body>  
   <br/>
        <h3>&nbsp &nbsp &nbsp &nbsp Login/Register</h3>
  
    <img id="imgFloat" src="../login.png" alt="Picture Not Available" width="50%">             
           
        <form action="loginform.php" name="loginForm" id="loginForm" method="post">
   <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
  <br/> &nbsp &nbsp<label for="userlogin">Username:</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="User Name has invalid characters" /> <br /> <br />
   &nbsp &nbsp<label for="userpassword">Password:</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="10" required="required" pattern="^[\w@\.-\!]+$" title="Password has invalid characters" />
      <p>
       <br/>&nbsp &nbsp &nbsp &nbsp  <input type="submit" value="Login" name="login" /> <br /> <br />
       &nbsp &nbsp New customer?<h2> <br/> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <a href="register.php">Register Here </h2></a><br/> 
      </p>
</form>
</section>

    </body>
    
 <?php
 displayPageFooter();
?>
