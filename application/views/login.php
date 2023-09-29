  	<body>
		<div class="wrapper">
			<h5 class="card-title">LOGIN ACCOUNT</h5>
<?php
	if(isset($_SESSION['status'])){
			echo $_SESSION['status'];
	}
?>
			<form enctype="multipart/form-data"  autocomplete="off" class="form" action="login" method="post">
				<input type="hidden" name="signEin" value="signIn">
				<label>Email:
					<input value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>" type="text" name="email" placeholder="Email">
				</label>
				<label class="password">Password:
					<input value="<?= isset($_POST['pw']) ? htmlspecialchars($_POST['pw'], ENT_QUOTES) : ''; ?>" type="password" name="pw" placeholder="Password">
				</label>
				<a class="resetPass signUp" href="#">Forgot Password</a>
				<a class="signUp" href="signup">Signup</a>
				<input type="submit" class="registerBtn" value="Login">
			</form>
		</div>
  </body>
</html>

