<?php

/**
*	A MODEL FOR CRUD FUNCTIONS ON USER TABLE (tablename = main) 
*/
class Welcome_model extends CI_Model {

	/** 
	*  RETREIVE FULL TABLE 
	*/
	public function first_query() {
		$this->load->database();
		$query = $this->db->query('SELECT * FROM main');
		return $query->result();
	}
	
	/** 
	*  INSERT NEW USER INTO "MAIN" TABLE
	*  @param *: each row of "main" table  
	*/
	public function insert_info($userId, $username, $password, $email,  
		$verifyCode, $SQ1, $SA1, $SQ2, $SA2) {
		$this->load->database();
		
		// Insert a new user info
		$data = Array (
			"UserID"  => $userId, 
			'Username' => $username, 
			'Password' => $password,
			'Email' => $email,
			'VerifyCode' => $verifyCode, 
			'SecretQuestion' => $SQ1,
			'SecretAnswer' => $SA1,
			'SecretQuestion2' => $SQ2,
			'SecretAnswer2' => $SA2,
			'Img' => null
		);
		
		// insert("table in your database")
		$this->db->insert('main', $data);
	}
	
	/** 
	*  UPDATE USERS PROFILE CHANGES AFTER USER EDITS THEIR INFO
	*  @param $userId: The record's ID to be updated
	*  @param $data  : array storing all new user's updated 
	* 				   data taken from user's inputs
	*/
	public function update_info($userId, $data) {
		
		$newdata = Array (
			'Username'        => $data['username'], 
			'Password'        => $data['password'],
			'Email'           => $data['email'],
			'SecretQuestion'  => $data['SQ1'],
			'SecretAnswer'    => $data['SA1'],
			'SecretQuestion2' => $data['SQ2'],
			'SecretAnswer2'   => $data['SA2'],
			'Img'             => $data['image']
		);
		
		$this->load->database();
		$this->db->where('UserId', $userId);
		$this->db->update('main', $newdata);
	}

}

?>