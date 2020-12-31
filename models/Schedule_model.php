<?php

/**
*   A MODEL HANDLING CRUD FUNCTIONS OF THE "SCHEDULE" TABLE
*/
class Schedule_model extends CI_Model {

	/**
	* RETRIEVE FULL TABLE
	*/
	public function getAll() {
		$this->load->database();
		$query = $this->db->query('SELECT * FROM schedule');
		return $query->result();
	}
	
	/**
	* CHANGE isAttending COLUMN ACCORDING TO TABLE AND IT'S BOOLEAN VALUE 
	* TODO: WILL SIMPLIFY IT IN MILESTONE 3
	* @param $scData      : array of user ID and event ID for the where function     
	* @param $scData      : array of event ID for the where function  
	* @param $addOrRemove : if add the attendance => 1, if remove => 0
	*/
	public function modifyAttend($scData, $vevData, $addOrRemove) {
		$this->load->database();
		
		if($addOrRemove == 1) {
			$data = Array (
				'isAttending' => 1
			);  
		} else {
			$data = Array (
				'isAttending' => 0
			);  
		}
		$this->db->where($vevData);
		$this->db->update('vevent', $data);
		$this->db->where($scData);
		$this->db->update('schedule', $data);
	}
	
	/** 
	*  INSERT THE EVENT INTO THE "SCHEDULE" TABLE
	*  @param $data: an array containing each row in 
	*				 schedule table scheduled event's data
	*/
	public function insert_To_Calendar($data) {
		$this->load->database();
		$data = Array (
			'ScheduleID'  => $data['userId'], 
			"vEventID"    => $data['eventId'],
			'sName'       => $data['ename'],
			'sDate'       => $data['time'],
			'sPlace'      => $data['place'],
			'sDesc'       => $data['desc'],
			'sDuration'   => $data['duration'],
			'longtitude'  => $data['longtitude'],
			'latitude'    => $data['latitude'], 
			'isAttending' => 1
		);                  
		
		$this->db->insert('schedule', $data);
	}
	
	/**
	*  REMOVE FROM SCHEDULE
	*  @param $data: an array containing each row in 
	*				 schedule table scheduled event's data
	*/
	public function remove_from_Calendar($data) {
		$this->load->database();
		$this->db->where($data);
		$this->db->delete('schedule');
	}

}

?>