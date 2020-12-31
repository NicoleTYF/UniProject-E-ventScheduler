<?php

/**
*   CONTROLLER WITH FUNCTIONS INSERT/UPDATE/RESTORE USER'S DATA 
*/
class Users extends CI_Controller{
	
	// AT THE START, RETREIVE USERNAME AND PASSWORD TO LOGIN
	public function index() {
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$isRmbd   = $this->input->post("rmbdMe");

		$this->login($username, $password, $isRmbd);
	}
	
	// USER LOGIN & STORE USERDATA INTO NEW SESSION
	public function login($name, $pswd, $isRmbd){
			
		$this->load->model('Welcome_model');
		$results = $this->Welcome_model->first_query();  
		$name = urldecode($name); // Remove the %20 whitespaces of the url
		
		// Loop until there is a record with the same username and password
		// TODO: Will change to use query in Milestone 3
		$userId=null;
		$isMatch=false;
		foreach ($results as $result){ 
			if($name==$result->{"Username"}){
				 if($pswd==$result->{"Password"}){
					 $isMatch=true;
					 $userId=$result->{"UserID"};
				 } // end if Password match
			} // end if Username match 
		} // end foreach
		
		// If match then retrieve that row of data
		if ($isMatch==true) {
			$dataRow = $results[$userId];  
			$user_data = array(
				'userId'   => $userId, 
				'username' => $dataRow->{"Username"},
				'password' => $dataRow->{"Password"},
				'email'    => $dataRow->{"Email"}, 
				'image'    => $dataRow->{"Img"}, 
				'SQ1'      => $dataRow->{"SecretQuestion"}, 
				'SA1'      => $dataRow->{"SecretAnswer"},
				'SQ2'      => $dataRow->{"SecretQuestion2"},
				'SA2'      => $dataRow->{"SecretAnswer2"},
				'active'   => 1
			);
			
			// Set that row's data into the session 
			$_SESSION["userdata"] = $user_data;
			$this->session->set_userdata("userdata", $user_data);
			
			$this->load->helper('cookie');
			if ($isRmbd) {
				$this->input->set_cookie('username', $user_data["username"], 86500); 
                $this->input->set_cookie('password', $user_data["password"], 86500); 
				echo "<script>alert('Login Success! Welcome ".$user_data["username"]."');</script>";
			} else {
				delete_cookie('username'); 
                delete_cookie('password');
				echo "<script>alert('Login successfully without create cookies..!!');</script>";
			}
			
			// and load user profile page
			$this->load->view('UserProfile/User_Profile', $user_data);
			
		}else{
			// If not match, go back to login page 
			$this->load->helper('url');
			$site_url = site_url();
			echo "<script>alert('Wrong username or Password');window.location='".$site_url."index.php'</script>";
		}
	}
	
	/** 
	*  Redirect user to profile page
	*/
	public function redirectProfile() {
		$this->load->view('UserProfile/User_Profile', $_SESSION["userdata"]);
	}
	
	// ACTIVATE ACCOUNT AFTER MATCHING EMAIL WITH VERIFY CODE
	public function activate() {
		$email = $this->input->post("veriEmail"); 
		$code = $this->input->post("veriCode"); 
		
		$this->load->model('Welcome_model');
		$results = $this->Welcome_model->first_query();  
		
		// Loop until there is a record with the same email and verify code.
		// If match, retrieve the row's username and password to login.
		$isCorrect=false;
		$username=null;
		$password=null;
		foreach ($results as $result){ 
			if($email==$result->{"Email"}){
				 if($code==$result->{"VerifyCode"}){
					 $isCorrect=true;
					 $username=$result->{"Username"};
					 $password=$result->{"Password"};		 
				 } // end if Code match
			} // end if Email match 
		} // end foreach
		
		// If not match load a page with a go back link 
		if($isCorrect==false) {
			echo "wrong, please try again ";
			echo "<a href='javascript:history.back();
			javascript:history.back()'>Go Back</a>";
		} else {
			// If match, login
			$this->login($username, $password, false);
		}
	}
	
	// RESTORE FORGOT PASSWORD BY ANSWERING 2 SECRET QUESTIONS 
	public function forgotPswdGen(){
		$this->fpName = $this->input->post("username");
		
		$this->load->model('Welcome_model');
		$results = $this->Welcome_model->first_query();  
		
		// Loop until there is a record same as the entered username 
		// TODO: Will change to use query in Milestone 3
		$isMatch=false;
		foreach ($results as $result){ 
			if($this->fpName==$result->{"Username"}){
				$isMatch=true;
				$data = array(
					'fpName' => $this->fpName, 
					'fpSQ1'  => $result->{"SecretQuestion"}, 
					'fpSQ2'  => $result->{"SecretQuestion2"} 
				);
				
				$this->load->view("secretQuestions", $data);
			}
		}
	}
	// VALIDATE 2 SECRET QUESTIONS, IF NOT MATCH, GO BACK TO FORGOT PASSWORD PAGE
	public function forgotPswdVer($fpName){ 
		$fpSA1 = $this->input->post("fpSA1"); 
		$fpSA2 = $this->input->post("fpSA2");  
		$fpName = urldecode($fpName);
		
		$this->load->model('Welcome_model');
		$results = $this->Welcome_model->first_query();  
		
		$isMatch=false;
		foreach ($results as $result){ 
			if($fpName==$result->{"Username"}){
				 if($fpSA1==$result->{"SecretAnswer"} && 
					$fpSA2==$result->{"SecretAnswer2"}){
					 $isMatch=true;
					 $password=$result->{"Password"};
				 } 
			} 
		}
		
		if($isMatch==true) {
			login($username, $password, false);
		} else {
			echo "wrong, please try again ";
			echo "<a href='javascript:history.back();
			javascript:history.back()'>Go Back</a>";
		}
	}
	
	// LOG OUT 
	public function logout(){
		// Unset user data
		$this->session->unset_userdata('userId');   
		$this->session->unset_userdata('username');  
		$this->session->unset_userdata('password');  
		$this->session->unset_userdata('email');     
		$this->session->unset_userdata('image');     
		$this->session->unset_userdata('SQ1');       
		$this->session->unset_userdata('SA1');       
		$this->session->unset_userdata('SQ2');       
        $this->session->unset_userdata('SA2');       
        $this->session->unset_userdata('active');    
									   
		// Set message
		$this->session->set_flashdata('user_loggedout', 'You are now logged out');
	
		$this->load->helper('url');
		header("Location: ".site_url()."ESController");
	}
	
	// ENTER EDIT MODE OF THE USER PROFILE
	public function redirectEdit() {
		$this->load->view('UserProfile/User_Profile_edit');
	}
	
	// SAVE CHANGES OF USER PROFILE EDITING, 
	// THEN GO BACK TO USER PROFILE PAGE
	public function save() {
		$this->load->model('Welcome_model');
		$results = $this->Welcome_model->first_query();
		$fileUploaded = $_FILES['fileToUpload']['tmp_name']; 
		
		if(!empty($fileUploaded)) {
			$this->uploadFile();
			$img = file_get_contents($fileUploaded); 
		} else {
			$img = $_SESSION["userdata"]["image"]; 	
		}

		$new_user_data = array(
				'userId'   => $_SESSION["userdata"]["userId"], 
				'username' => $this->input->post("editUsername"), 
				'password' => $this->input->post("editPassword"), 
				'email'    => $this->input->post("editEmail"),  
				'image'    => $img,  
				'SQ1'      => $this->input->post("editSQ1"),
				'SA1'      => $this->input->post("editSA1"),
				'SQ2'      => $this->input->post("editSQ2"),
				'SA2'      => $this->input->post("editSA2"),
		);
	
		$_SESSION["userdata"] = $new_user_data;
		$this->Welcome_model->update_info($_SESSION["userdata"]["userId"], 
			$new_user_data);
		$this->load->view('UserProfile/User_Profile', $_SESSION["userdata"]);
	}
	
	// UPLOAD & RESIZE PROFILE PICTURE 
	public function uploadFile() {
		$config['upload_path'] = './uploads/';
		$config['overwrite'] = TRUE;
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload',$config);
		
		if (!$this->upload->do_upload("fileToUpload")) {
            $error = array('error' => $this->upload->display_errors());
			print_r($error); 
			print_r($_FILES);
        } else {
			$image_path = $this->upload->data();
			// for resizng image
			$this->load->library('image_lib');
			$configImg['image_library'] = 'gd2';
			$configImg['maintain_ratio'] = TRUE;
			$configImg['width']  = 130;
			$configImg['height'] = 130;	
			$configImg['source_image'] = $image_path['full_path']; 
			
			$this->image_lib->clear();
			$this->image_lib->initialize($configImg);
			$this->image_lib->resize();
        }
	}
	
}

	