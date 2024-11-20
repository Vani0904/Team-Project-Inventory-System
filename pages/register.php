<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="mobile.css" />
        <link rel="stylesheet" media="only screen and (min-device-width: 737px)" href="../styles/mobile.css"  />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    
    <div class="main-container">
        <form class ="user-form" action="register.php" method="post">
        <h3>Sign Up</h3>
           <input class="control" type="text" name="firstname" required placeholder="First Name" maxlength='30'>
           <input class="control" type="text" name="middlename" placeholder="Middle Name" maxlength='30'>
           <input class="control" type="text" name="surname" required placeholder="Surname" maxlength='30'>
           <input class="control" type="username" name="username" required placeholder="Username">
           <input class="control" type="password" name="userpassword" required placeholder="Password" maxlength='12'>
           <input class="control" type="password" name="cpassword" required placeholder="Confirm password" maxlength='12'>
  <h4 class="t&cs">By signing up you agree to the <a href="">terms & conditions</a>.</h4>
           <input type="submit" name="submit" value="Sign Up" class="form-btn">
           <p>or <a href="login.php">Login</a></p>
        </form>
     
     </div>

</body>
</html>