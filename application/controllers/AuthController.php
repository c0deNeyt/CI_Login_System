<?php
	class AuthController extends CI_Controller{

		# Validate User
		public function login(){
            $this->load->model("Employee");
			$file = array('file' => "login" );
			$this->load->view('partials/LoginHeader', $file);
			if(isset($_SESSION['errors'])){
				$_SESSION['status'] = $this->notify();
				unset($_SESSION['errors']);
				$this->load->view('login', $_SESSION['status']);
			}
			else{
				// $this->load->view('login');
				$this->load->view('login', $_SESSION['status']);
			}
			$post = $this->input->post();
			if(isset($_POST['signEin']) == "signIn"){

				//Contact Number Validation
				if(trim($post['email'] == "")){
					$_SESSION['errors'][] =  "Email cannot be empty!.";
				}
				//password Validation
				if(trim($post['pw'] == "")){
					$_SESSION['errors'][] =  "Password cannot be empty!";
				}

				//BEGIN CHECKING DATA FROM DATABASE
				$email= $this->db->escape_str($post['email']);
				$password = $this->db->escape_str($post['pw']);
				$user = $this->Employee->empCreds($post);
				// $this->notify();

				# Checking if something fetched from the database
				if(!empty($user)){
				// 	// $encryptedUserInput = md5($password . '' . $user['salt']);
					if($user[0]['password'] == $password){
						$userData = [
							'email' => $email,
							'role' =>	$user[0]['access_level'],
							'loggedIn' => True,
						];
						$this->session->set_userdata($userData);
						header("Location: home");
						die();
					}
					else{
						// $_SESSION['errors'][] =  "Please provide registered password.";
						header("Location: login");
						echo "Password ERROR!!! from controler";
					}
				}
				else{
					// $_SESSION['errors'][] =  "Please provide registered email.";
					header("Location: login");
					$_SESSION['status'] = $this->notify();
					// var_dump($_SESSION['status']);
					echo "User ERROR!!! from controller";
				}
			}
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
				unset($_SESSION['successMsg']);
				return $msgBox;
			}
		}
	}
?>
