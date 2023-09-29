<?php	
	class Employees extends CI_Controller{

		public function index(){
			#cssfilename  stored on array
			$file = array('file' => "signup" );
			$this->load->view('partials/SignupHeader', $file);
			# render signup page 
			$this->load->view('signup');
		
			$post = $this->input->post();
			// var_dump($post);
		}
        # Add employee 
        public function create(){
			# initializing model
            $this->load->model("Employee");
			#cssfilename  stored on array
			$file = array('file' => "signup" );
			$this->load->view('partials/SignupHeader', $file);
			#post data
			$post = $this->input->post();
			# checking post event
			if(isset($post['post']) == "signup"){
				# fetching validation result
				$validating['data'] = $this->validateSignup($post);
				# user previous inputs
				$validating['input'] = $_SESSION['inputs'];
				$this->load->view('signup', $validating);
			}
			if(!isset($_SESSION['errors'])){
				$dbResponse = $this->Employee->addEmp($post);
				$this->validateSignup($post);
			}
			unset($_SESSION['errors']);
		}

		# validation for signup method
		public function validateSignup($arr){
			# initialize variable
			$chkBday = $this->checkDate($arr['birthdate']);

			# assigning post value into a session
			foreach ($arr as $key => $value) {
				$_SESSION['inputs'][$key] = $value;
			}
			#fist name validation
			if(trim($arr['fname'] == "") || ($this->checknum($arr['fname']))){
				$_SESSION['errors'][] =  "first name cannot be empty or contain numbers.";
			}
			else if(strlen($arr['fname']) < 2){
				$_SESSION['errors'][] =  "First name must have at least 2 characters.";
			}
			else if((!ctype_upper($arr['fname'][0])) || (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $arr['fname']))){
				$_SESSION['errors'][] =  "Invalid First Name Format";
			}
			#last name validation
			if(trim($arr['lname'] == "") || ($this->checknum($arr['lname']))){
				$_SESSION['errors'][] =  "Last name cannot be empty or contain numbers.";
			}
			else if(strlen($arr['lname']) < 2){
				$_SESSION['errors'][] =  "Last name must have at least 2 characters.";
			}
			else if((!ctype_upper($arr['lname'][0])) || (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $arr['lname']))){
				$_SESSION['errors'][] =  "Invalid Last Name Format";
			}
			#age validation
			if((trim($arr['age']) == "") || (!is_numeric($arr['age']))){
				$_SESSION['errors'][] =  "Age cannot be empty or contain non-numerical characters.";
			}
			# birth date validation
			if($chkBday == False){
				$_SESSION['errors'][] =  "Invalid date.";
			}
			//password Validation
			if(trim($arr['pw'] == "") || (strlen($arr['pw']) < 8)){
				$_SESSION['errors'][] =  "Password cannot be empty && must be least 8 characters long";
			}
			if($arr['pw'] != $arr['cpw']){
				$_SESSION['errors'][] =  "Password mismatch!";
			}
			# Check if some error occur
			if(isset($_SESSION['errors']) && (count($_SESSION['errors']) >= 0)){
				# Error occur
				return $this->notify();
			}
			else{
				header("Location: login");
            	$_SESSION['successMsg'] = $arr['fname'];
				return $this->notify();
			}
		}
		# method for checking date
		public function checkDate($date, $format = 'Y-m-d'){
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}
		#name validator
		public function checkNUm($x){
			for($c=0;$c<strlen($x);$c++){
				if(is_numeric($x[$c])){
					return true;
				}
			}
		}
		# method for home
		public function homeMethod(){
            $this->load->model("Employee");
			$arr['data'] = $this->Employee->empList();
			$file = array('file' => "style" );
			$this->load->view('partials/Header', $file);
			$this->load->view('home/home', $arr);
			// return $this->checkSes();
		}

		
		# throw some satatus	
		public function notify(){
			# check for errors
			if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
				// $prevInputs  = $_SESSION['inputs'];
				$errors = $_SESSION['errors'];
				//creating error message
				$msgBox = "    <div class='errorField'>"."\r\n";
				foreach($errors as $key ){
					$msgBox .= "      <p>"."* ".$key."</p>"."\r\n";
				}
				$msgBox .= '    </div>'."\r\n";
				return $msgBox;
			}
			if(isset($_SESSION['successMsg'])){
				$msgBox = "    <div class='successMsg'>"."\r\n";
				$msgBox .= "      <p>Thanks! " .$_SESSION['successMsg']. " you are successfully signed up!</p>"."\r\n";
				$msgBox .= '    </div>'."\r\n";
				unset($_SESSION);
				$posts = $this->input->post();
				unset($posts['post']);
				return $msgBox;
			}
		}
		# Check Session Status and detials  
		public function checkSes(){
			$loggedInStatus = $_SESSION['loggedIn'];
			if(isset($loggedInStatus) &&  $loggedInStatus == True){
				header("Location: home");
			}
			else{
				return $this->logout();
			}
		}
		# Logout method
		public function logout(){
			unset(
				$_SESSION['email'],
				$_SESSION['role'],
				$_SESSION['loggedIn'],
				$_SESSION['inputs']
			);
			header("Location: login");
		}
    }
?>
