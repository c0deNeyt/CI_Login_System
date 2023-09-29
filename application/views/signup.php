	<body>
		<div class="wrapper">
			<h5 class="card-title">Create Account</h5>
<?php
	if(isset($data)){
			echo $data;
	}
?>
			<form  enctype="multipart/form-data"  autocomplete="off" class="form"  action="create" method="post">
				<input type="hidden" name="post" value="signup"/>
				<label>First Name:
					<input value="<?= isset($input)? htmlspecialchars($input['fname'], ENT_QUOTES) : 'Morning';?>" type="text" name="fname" placeholder="First Name"/>
				</label>
				<label>Last Name:
					<input value="<?= isset($input)? htmlspecialchars($input['lname'], ENT_QUOTES) : 'Start'; ?>" type="text" name="lname" placeholder="LastName"/>
				</label>
				<label>Age:
					<input value="<?= isset($input)? htmlspecialchars($input['age'], ENT_QUOTES) : '13'; ?>" type="number" name="age" placeholder="Age"/>
				</label>
				<label>Birth Date:
					<input value="<?= isset($input)? htmlspecialchars($input['birthdate'], ENT_QUOTES) : '9999-12-12'; ?>" id="datepicker" type="text" name="birthdate" placeholder="Birth Date"/>
				</label>
				<label>Job Title:
					<input value="<?= isset($input)? htmlspecialchars($input['jobtitle'], ENT_QUOTES) : 'Prince Of Hell'; ?>" type="text" name="jobtitle" placeholder="Job Tittle"/>
				</label>
				<label>Email:
					<input value="<?= isset($input)? htmlspecialchars($input['email'], ENT_QUOTES) : '@email.com'; ?>" type="text" name="email" placeholder="Email"/>
				</label>
				<label class="password">Password:
					<input value="<?= isset($input)? htmlspecialchars($input['pw'], ENT_QUOTES) : 'test1234'; ?>" type="password" name="pw" placeholder="Password"/>
				</label>
				<label class="password">Confirm Password:
					<input value="<?= isset($input)? htmlspecialchars($input['cpw'], ENT_QUOTES) : 'test1234'; ?>" type="password" name="cpw" placeholder="Confirm Password"/>
				</label>
				<input type="submit" class="registerBtn" value="Sign Up"/>
			</form>
		</div>
	</body>
</html>

