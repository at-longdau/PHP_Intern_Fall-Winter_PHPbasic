<?php
//Su dung file connect.php
require_once("connect.php");
//Lay thong tin
if (isset($_POST["btn"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	//Check loi cac truong
	if ($username == "" || $password =="") {
		$err = "Username hoac password khong duoc bo trong";
	}else{
		//Truy van lay ra username va password 
		$sql = "SELECT * FROM member where username = '$username' and password = '$password' ";
		$query = $conn->prepare($sql);
		$query->execute();
		//Neu da ton tai thi hien thi loi
		if ($query->rowCount() == 0) {
			$err = "Username hoac password dien vao khong chinh xac";
		}else{
			//Khoi tao session luu thong tin dang nhap
			session_start();
			$_SESSION['username'] = $username;
			//Dieu huong sang trang list
			header("Refresh: 1; url=list.php");
		}
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
</head>
<body>
<div style="margin-left: 400px">
		<h2>Sign In</h2>
		<!-- Hien thi loi ra phan tu html -->
		<p style="color: red"><?php echo isset($err) ? $err : ''; ?></p>
	<form action="" method="post">
		Username:<br> <input type="text" name="username"><br><br>

		Password:<br> <input type="password" name="password"><br><br>

		<input type="submit" value="Login" name="btn" class="btn btn-success">

		<a href="logout.php" class="btn btn-danger">Logout</a>
	</form>
</div>
</body>
</html>
