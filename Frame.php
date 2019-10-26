<?php
if ($_POST['username']!='admin' || $_POST['password']!='admin')
{
	echo "<script>alert('Incorrect Credentials')</script>";
	include('login1.html');
}
?>
<frameset cols="20,60,20">
	<frame src="dataframe1.php" style="border:1px solid;"/>
	<frame src="retrive.php" style="border:1px solid;"/>
	<frame src="dataframe.php" />
</frameset>
