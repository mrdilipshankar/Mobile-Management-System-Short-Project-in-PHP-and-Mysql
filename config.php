<?php
session_start();
$conn = mysqli_connect("localhost","root","","mobilereg");

if(isset($_POST['loginhere']))
{
	$user_email = $_POST['loginName'];
	$user_pass = $_POST['loginPassword'];
	$sqldata = "SELECT * FROM admin_login WHERE login_email ='$user_email' AND login_pass = '$user_pass'";

	$result = mysqli_query($conn,$sqldata);
	$rows = mysqli_fetch_assoc($result);
	if($rows == true)
	{
		$_SESSION["email"]=$rows['login_email'];
		header("Location:dashboard.php");

	}
	else
	{
		header("Location:index.php");
		$_SESSION['message'] = "Sorry, Credentials Don't Match";
	}
}

?>