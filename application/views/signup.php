	<body>
		<div class="wrapper">
			<h5 class="card-title">Create Account</h5>
			<form  enctype="multipart/form-data"  autocomplete="off" class="form"  action="create" method="post">
				<div>
					<input type="hidden" name="hideMe" value="signIn"/>
					<label>First Name:
						<input type="text" name="fname" placeholder="First Name"/>
					</label>
					<label>Last Name:
						<input type="text" name="lname" placeholder="LastName"/>
					</label>
					<label>Age:
						<input type="text" name="age" placeholder="Age"/>
					</label>
					<label>Birth Date:
						<input type="text" name="birthdate" placeholder="Birth Date"/>
					</label>
					<label>Job Title:
						<input type="text" name="jobtitle" placeholder="Job Tittle"/>
					</label>
					<label>Access Level:
						<select name="roles" >
							<option value="Admin">Admin</option>
							<option value="User">User</option>
						</select>
					</label>
				</div>
				<label>Email:
					<input type="text" name="email" placeholder="Email"/>
				</label>
				<label class="password">Password:
					<input type="password" name="pw" placeholder="Password"/>
				</label>
			  <input type="submit" class="registerBtn" value="Sign Up"/>
			</form>
		</div>
	</body>
</html>

