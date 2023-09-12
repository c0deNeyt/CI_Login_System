<?php
	class Employees extends CI_Controller{

		public function index(){
			#cssfilename  stored on array
			$file = array('file' => "signin" );
			$this->load->view('partials/Header', $file);
			$this->load->view('signup');
			// print_r($_SESSION);	
		}
        # Add employee 
        public function create(){
            $this->load->model("Employee");
			$file = array('file' => "login" );
			$this->load->view('partials/Header', $file);
			$this->load->view('signup');
			$post = $this->input->post();
			return($this->Employee->addEmp($post));
		}

		# method for home
		public function homeMethod(){

            $this->load->model("Employee");
			$arr['data'] = $this->Employee->empList();
			$file = array('file' => "style" );
			$this->load->view('partials/Header', $file);
			$this->load->view('home/home', $arr);
		}

		# Validate User
		public function login(){
            $this->load->model("Employee");
			$file = array('file' => "login" );
			$this->load->view('partials/LoginHeader', $file);
			$this->load->view('login');
			$post = $this->input->post();
			$notif = $this->notify();
			echo $notif;
		
			#initializing session variable	
			$_SESSION['inputs']= array();
			$_SESSION['errors'] = array();
			foreach($post as $key => $value){
				$_SESSION['inputs'][$key] = $value;
			};
			if(isset($_POST['signEin']) == "signIn"){
				// print_r($_POST);

				//Contact Number Validation
				if(trim($post['email'] == "")){
					$_SESSION['errors'][] =  "Contact number cannot be empty!.";
				}
				//password Validation
				if(trim($post['pw'] == "")){
					$_SESSION['errors'][] =  "Password cannot be empty!";
				}

				//BEGIN CHECKING DATA FROM DATABASE
				$email= $this->db->escape_str($post['email']);
				$password = $this->db->escape_str($post['pw']);
				$user = $this->Employee->empCreds($post);
				
				if(!empty($user)){
					// $encryptedUserInput = md5($password . '' . $user['salt']);
					// if(($user['password'] == $password) && ($user['email'] == $email)){
					if($user[0]['password'] == $password){
						$_SESSION['role'] = $user[0]['access_level'];
						header("Location: home");
						die();
					}
					else{
						$_SESSION['errors'][] =  "Please provide registered password.";
					}
				}
				else{
					
					$_SESSION['errors'][] =  "Please provide registered email.";
				}
				header("Location: ../");
				die();
			}
		}
		
		# throw some satatus	
		public function notify(){

			if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
				// $prevInputs  = $_SESSION['inputs'];
				$errors = $_SESSION['errors'];
				//creating error message
				$msgBox = "    <div class='errorField'>"."\r\n";
				foreach($errors as $key ){
					$msgBox .= "      <p>"."* ".$key."</p>"."\r\n";
				}
				$msgBox .= '    </div>'."\r\n";
				unset($_SESSION['errors']);
				return $msgBox;
			}
			if(isset($_SESSION['successMsg'])){
				$msgBox = "    <div class='successMsg'>"."\r\n";
				$msgBox .= "      <p>Thanks! " .$_SESSION['successMsg']. " you are successfully signed up!</p>"."\r\n";
				$msgBox .= '    </div>'."\r\n";
				unset($_SESSION['successMsg']);
				unset($_POST);
				return $msgBox;
			}
		}

	
    }
?>
