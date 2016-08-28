<?php 
	$link = mysqli_connect('localhost','root','', 'school');
	session_start();
	
	$username = $_POST['username'];
	$password = bcrypt($_POST['password']);
	$_SESSION['username'] = Auth::user()->name;

	
	if(($username == NULL || $username == '') && ($password == NULL || $password == ''))
	{
		header('location:adminHome.php?error=Username and Password Must Be Filled');
	}
	else if($username == NULL || $username == '')
	{
		header('location:adminHome.php?error=Username Must Be Filled');
	}
	else if($password == NULL || $password == '')
	{
		header('location:adminHome.php?error=Password Must Be Filled');
	}
	else
	{
		$check_user = mysqli_query($link, "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."' AND role = 'admin'");
		
		if(mysqli_num_rows($check_user) > 0)
		{
			$_SESSION['username'] = $username;
			header('location:adminHome.php?error=Success');
		}
		else{
			header('location:adminHome.php?error=Wrong ID/Password');
		}
	}