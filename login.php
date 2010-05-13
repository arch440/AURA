<?php

$dbserv = "localhost";
$dbuser = "kwitter";
$dbpass = "kwitterikwitt";
$dbdb   = "kwitter";

if(posted($_POST['username']) && posted($_POST['password'])) {
    
    $db = @mysql_connect($dbserv,$dbuser,$dbpass);
    mysql_select_db($dbdb,$db);
    $q = sprintf("SELECT * FROM users WHERE username='%s' AND password='%s'",
        mysql_real_escape_string($_POST['username'])
       ,mysql_real_escape_string($_POST['password']));
    $res = mysql_query($q,$db);
    if(mysql_num_rows($res) == 1) {
        setcookie("aura",$_POST['username'],0);
        mysql_close($db);
        header('Location: index.php');
    } else {
        mysql_close($db);
        login_page();
    }
} else if(isset($_GET['logout'])) {
    setcookie("aura","",time() - 3600);
    login_page();
}

function posted($var) {
    return isset($var) && !empty($var);
}

function logged_in() {
    return isset($_COOKIE['aura']);
}

function login_page() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Supercommunity</title>
 <link rel="stylesheet" type="text/css" href="style.css"/>

</head>
<body>
<div id="main">
<form action="login.php" method="post">
Username:<input type="text" name="username" /><br />
Password:<input type="password" name="password" /><br />
<input type="submit" />
</form>
</div>
</body>
</html>
<?php
}
?>
