
<?php 
//Su dung file connect.php
require_once('connect.php');
// Up anh
$target_dir = "image/";
$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//Lay thong tin
if(isset($_POST['btn'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$age = $_POST['age'];
	$hobby = $_POST['hobby'];
	//Kiem tra hop le cac truong
	if($username == '' || $password== '' || $email== '' || $age == ''|| $hobby == '' || $_FILES['avatar']['tmp_name']=='') {
		$err = 'Do not leave this field empty';
	}
	
	elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$err = "Invalid email format"; 
	}
	elseif (!is_numeric($_POST['age'])) {
		$err = "Only use integer";
	}
	elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		$err = "Invalid images format";
	}  
	else {
		//Truy van lay ra username trong CSDL
		$sql="SELECT * FROM member where username='$username'";
		$query = $conn->prepare($sql);
		$query->execute();
		//Neu lon hon 0 nghia la da ton tai thi dua ra thong bao
		if ($query->rowCount() > 0){ $err =" *Username has already been taken !";}
		else {
			//Sau khi bat tat ca cac loi thi thuc hien truy van insert de them CSDL vao bang
			move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
			$insert = "INSERT INTO `member`(`username`, `password`, `email`,`age`,`hobby`,`avatar`) VALUES ('$username','$password','$email',$age,'$hobby','$target_file')";
			$sqlInsert = $conn->prepare($insert);
			$sqlInsert->execute();
			//Dieu huong sang trang dang nhap
			header("Refresh: 1; url=signin.php");
		}
	}          

};

?>

<!DOCTYPE html>
<html>
<head>
	
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
<div style="margin-left: 400px">
	<h2>Register</h2>
	<!-- Hien thi ra thong bao loi -->
	<p style="color: red"><?php echo isset($err) ? $err : '* Require field'; ?></p>

	<form action="" method="post" enctype="multipart/form-data" />
</div>
</body>
</html>