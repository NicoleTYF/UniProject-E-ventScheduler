<?php

/**
*   A MODEL HANDLING CRUD FUNCTIONS OF THE "VEVENT" TABLE
*/
class VEvent_model extends CI_Model {

	// RETRIEVE FULL TABLE
	public function getAll() {
		$this->load->database();
		$query = $this->db->query('SELECT * FROM vevent');
		return $query->result();
	}
	
	// RETRIEVE FULL TABLE
	public function getFav() {
		$this->load->database();
		$query = $this->db->query('SELECT * FROM vevent WHERE isFav = 1');
		return $query->result();
	}
	
	/** 
	* "FAVOURITE"/UN"FAVOURITE" AN EVENT 
	* CHANGE isFav COLUMN ACCORDING TO TABLE AND IT'S BOOLEAN VALUE   
	* @param $favData      : array of event ID for the where function  
	* @param $favOrUnfav : if add the attendance => 1, if remove => 0
	*/
	public function modifyFav($favData, $favOrUnfav) {
		$this->load->database();
		
		if($favOrUnfav == 1) {
			$data = Array ('isFav' => 1);  
		} else {
			$data = Array ('isFav' => 0);  
		}
		$this->db->where($favData);
		$this->db->update('vevent', $data);
	}
	
	public function getLatLong($eventId) {
		$query = $this->db->query('SELECT latitude, longtitude FROM vevent WHERE vEventID = '.$eventId);
		return $query->result();
	}
	
	/**
	* http://www.geodatasource.com/developers/php
	**/
	public function distance($lat1, $lon1, $lat2, $lon2) {
	  if (($lat1 == $lat2) && ($lon1 == $lon2)) {return 0;}
	  else {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  
				cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * 
				cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$kilometers = round(($dist * 60 * 1.1515) * 1.609344);

		return $kilometers;
	  }
	}
	
}

?>