<?php

/**
*  CONTROLLER FOR FIRST-TIME SIGN UP, LOGIN & FORGOT PASSWORD PAGE
*/
class ESController extends CI_Controller {
	
    /**
    *  BY DEFAULT, THE LOGIN PAGE & MODEL IS LOADED
	*/
	public function index() {
		$autoload['helper'] = array('url','form','cookie');
		$this->load->model('Welcome_model');
		$this->load->view('loginForm');
	
	}
	
	/**
	*  REDIRECT USER TO SIGN UP DPAGE
	*/
	public function redirectSignUp() {
		$this->load->view("SignUp");
	}
	
	/**
	*  REDIRECT USER TO FORGOT PASSWORD DPAGE
	*/
	public function redirectFpPage() {
		$this->load->view("Forgot_Password");
	}
	
	/**
	*  USER SIGN UP (WITH EMAIL VERIFICATION) 
	*/
	public function signUp() {
		$newName = $this->input->post("newName");
		$newPswd = $this->input->post("newPswd");
		$newEmail = $this->input->post("newEmail");
		$newSQ1 = $this->input->post("newSQ1");
		$newSA1 = $this->input->post("newSA1");
		$newSQ2 = $this->input->post("newSQ2");
		$newSA2 = $this->input->post("newSA2");
		
		$this->load->model('Welcome_model');
		$results = $this->Welcome_model->first_query();  
		$newName = urldecode($newName);
		
		// Loop until there is a matching username and password
		// TODO: Will use query in MILESTONE 3
		$isUnique=true;
		foreach ($results as $result){ 
			if($newName==$result->{"Username"} 
				|| $newPswd==$result->{"Password"}){
				$isUnique=false;
				echo "Unique False";
			}
		} 
		if ($isUnique!=false) { 
			$verifyCode = mt_rand(100000, 999999);
			$newUserId = sizeof($results);
			$this->Welcome_model->
			insert_info($newUserId, $newName, $newPswd, $newEmail, $verifyCode, 
			$newSQ1, $newSA1, $newSQ2, $newSA2);
						
			// $this->load->library('email');   	
			$config = Array(
				'protocol'     => 'smtp', 
				'smtp_host'    => 'mailhub.eait.uq.edu.au', 
				'smtp_port'    =>  25, 	     	
				'mailtype'     => 'html', 
				'charset'      => 'iso-8859-1',
				'wordwrap'     => TRUE,
				'newline'      => "\r\n"
			);

			$this->load->library('email', $config);
			$this->email->initialize($config);
			
			$this->email->from('noreply@infs3202-22e5e8eb.uqcloud.net', 'E-Vent Scheduler');
			$this->email->to($newEmail); 
			$this->email->subject('Verification Code from E-Vent Scheduler ');
			$this->email->message("
				Thanks for signing up E-Vent Scheduler! <br>
Your account has been created, you can login with the following credentials. <br><br>
 
------------------------ <br>
Username: ".$newName." <br>
Password: ".$newPswd." <br>
Verification Code: ".$verifyCode." <br>
------------------------ <br><br><br>


");

			$this->email->send();
			$this->load->view('Verify');
		}
	}
}

?>