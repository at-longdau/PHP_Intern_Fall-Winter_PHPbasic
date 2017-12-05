<?php

require_once("connect.php");

if (isset($_POST["btn"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	if ($username == "" || $password =="") {
		$err = "Username hoac password khong duoc bo trong";
	}else{
		$sql = "SELECT * FROM member where username = '$username' and password = '$password' ";
		$query = $conn->prepare($sql);
		$query->execute();
		
		if ($query->rowCount() == 0) {
			$err = "Username hoac password dien vao khong chinh xac";
		}else{
			session_start();
			$_SESSION['username'] = $username;

		}
	}
}
?>

<div style="margin-left: 400px">
		<h2>Sign In</h2>
		<p style="color: red"><?php echo isset($err) ? $err : ''; ?></p>

	<form action="" method="post">
		Username:<br> <input type="text" name="username"><br><br>

		Password:<br> <input type="password" name="password"><br><br>

		<input type="submit" value="Login" name="btn">

		<a href="logout.php">Logout</a>
	</form>
	<?php if ($_SESSION['username']) : ?>
		<?php 
		$sql="SELECT * FROM member where username='$username'";
		$query = $conn->prepare($sql);
		$query->execute();
		$row = $query->fetch();
		?>
		<hr>
		<h2>Login successfully !</h2>
		<p>Username : <?php echo $row['username']; ?></p>
		<p>Email : <?php echo $row['email']; ?></p>
		<p>Age : <?php echo $row['age']; ?></p>
		<p>Hobby : <?php echo $row['hobby']; ?></p>
		<p>Avatar</p>
		<img style="width: 200px; height: 200px" src="<?php echo $row['avatar']; ?>" alt="">
	<?php endif; ?>
</div>

s