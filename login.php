<?php

$dbserv = "localhost";
$dbuser = "kwitter";
$dbpass = "kwitterikwitt";
$dbdb   = "kwitter";

if(posted($_POST['username']) && posted($_POST['password'])) {
    
    $db = @mysql_connect($dbserv,$dbuser,$dbpass);
    mysql_select_db($dbdb,$db);
    
    if(posted($_POST['password2'])) {
        if($_POST['password'] != $_POST['password2']) {
            sign_up(false,true);
        } else {
            $q = sprintf("SELECT * FROM users WHERE username='%s'",
                mysql_real_escape_string($_POST['username']));
            $res = mysql_query($q,$db);
            if(mysql_num_rows($res) > 0) {
               sign_up(true,false);
            } else {
                $q2 = sprintf("INSERT INTO users VALUES('%s','%s')",
                    mysql_real_escape_string($_POST['username']),
                    md5($_POST['password']));
                mysql_query($q2,$db);
                setcookie("aura",$_POST['username'],time()+3600);
                header('Location: index.php');
            }
        }
    } else {
        $q = sprintf("SELECT * FROM users WHERE username='%s' AND password='%s'",
            mysql_real_escape_string($_POST['username'])
           ,md5($_POST['password']));
        $res = mysql_query($q,$db);
        if(mysql_num_rows($res) == 1) {
            setcookie("aura",$_POST['username'],time()+3600);
            mysql_close($db);
            header('Location: index.php');
        } else {
            mysql_close($db);
            login_page();
        }
    }
} else if(isset($_GET['signup'])) {
    sign_up(false,false);
} else if(isset($_GET['logout'])) {
    setcookie("aura","",time() - 3600);
    login_page();
} else if(isset($_GET['delete'])) {
    if($_GET['delete'] != "true") {
        delete_page();
    } else {
        $db = @mysql_connect($dbserv,$dbuser,$dbpass);
        mysql_select_db($dbdb,$db);
        $q = sprintf("DELETE FROM users WHERE username='%s'",
            mysql_real_escape_string($_COOKIE['aura']));
        mysql_query($q,$db);
        mysql_close($db);

        setcookie("aura","",time() - 3600);
        login_page();
    }
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
 <title>Kwitter</title>
 <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="main">
<form action="login.php" method="post">
Please log in<br />
Username:<input type="text" name="username" /><br />
Password:<input type="password" name="password" /><br />
<input type="submit" />
</form>
Don't have an account yet? <a href="login.php?signup">Sign Up!</a>
</div>
</body>
</html>
<?php
}

function delete_page() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Kwitter</title>
 <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="main">
Are you sure? <br />
<a href="login.php?delete=true">Yes</a> |
<a href="index.php">No</a>
</div>
</body>
</html>
<?php
}

function sign_up($busy,$mismatch) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Kwitter</title>
 <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="main">
<form action="login.php" method="post">
<?php if($busy) echo "Username busy<br />"; ?>
<?php if($mismatch) echo "The passwords supplied doesn't match<br />"; ?>
Username: <input type="text" name="username" /><br />
Password: <input type="password" name="password" /><br />
Retype Password: <input type="password" name="password2" /><br />
<input type="submit" value="Sign Up!" />
</form>
</div>
</body>
</html>
<?php
}
?>
