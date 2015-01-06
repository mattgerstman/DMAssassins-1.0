<?php

session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<meta name = "viewport" content = "width = device-width"/>
<title>Login</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'/>
</head>
<body>

<div align="center">
<img src="assassins.png" width="200" height="106" />
<br />
Login<br />
<br />
<form action="process_login.php" method="post">
<table>
<tr><td>Username:</td><td> <input type="text" name="username" /></td>
</tr>
<tr>
<td>Password:</td><td><input type="password" name="password" /></td>
</tr>
</table>

<br />
<input type="submit" value="Login" /><br />
</form>
<br />
<a href="forgotPassword.php">Forgot Password?</a> <!--&nbsp;|&nbsp; <a href="signup.php">Sign Up</a>-->


<?php

echo($_SESSION['DM1-status']);
unset($_SESSION['DM1-status']);
?>

</div>
</body>
</html>
