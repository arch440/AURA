<?php
@session_start();
require_once('login.php');

if(!logged_in()) {
    login_page();
} else {

if(posted($_POST['status'])) {
    $db = @mysql_connect($dbserv,$dbuser,$dbpass);
    mysql_select_db($dbdb,$db);
    $status = $_POST['status'];
    $user = $_SESSION['logged_in'];
    $q = "INSERT INTO kweets VALUES('$status','$user','0')";
    mysql_query($q,$db);
    mysql_close($db);
}

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
<h2>Kwitter</h2>
What are you up to?
<form action="index.php" method="post">
<textarea name="status" id="status" rows="3" cols="80">
</textarea><br />
<input type="submit" id="submit" value="Update" />
</form>

<h3>Lastest News:</h3>
<?php
    $db = @mysql_connect("localhost","kwitter","kwitterikwitt");
    mysql_select_db("kwitter",$db);
    $query = "SELECT * FROM kweets ORDER BY id DESC";
    $result = mysql_query($query,$db);
    if(mysql_num_rows($result) != 0) 
    {
        while($row = mysql_fetch_assoc($result)) 
        {
            $user = $row['user'];
            $status = $row['status'];
            echo "<b>$user</b> says: <i>$status</i><br /> \n";
        }
    }
?>
</div>
</body>
</html>
<?php
}
b
?>
