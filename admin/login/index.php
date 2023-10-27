<?php
    require_once("../../connection/connectdb.php");
?>

<?php
    if(isset($_POST['login'])) {
        try {
            $sql = "select * from admin where adminID = ? and adminPass = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $_POST['adminID']);
            $stmt->bindParam(2, $_POST['adminPass']);
            $stmt->execute();
            $row = $stmt->fetch();
if($row == FALSE)
              echo "Wrong user name or password";
            else {
              session_start();
              $_SESSION['adminID'] = $row['adminID'];
              $_SESSION['adminEmail'] = $row['adminEmail'];
              $_SESSION['adminFullname'] = $row['adminFullname'];
              $_SESSION['adminPhoto'] = $row['adminPhoto'];
              header("Location: ../index.php");
            }
}catch(PDOException $ex) {
            echo 'Error: ' . $ex->getMessage();
        }
    }  
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Day 001 Login Form</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input" name="adminID">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password" name="adminPass">
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" name="login" onclick="return checkLogin();">
				</div>
				</form>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
				</div>
			</div>
			<div class="sign-up-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="pass" type="text" class="input">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- partial -->
  
</body>
</html>
