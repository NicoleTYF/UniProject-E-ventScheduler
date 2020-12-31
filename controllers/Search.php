<?php

/**
*   A CONTROLLER HANDLING FUNCTIONS IN THE "BROWSE" PAGE
*/
  class Search extends CI_Controller {
	
	/**
	*  BY DEFAULT, PAGE SHOULD LOAD THE BROWSE PAGE
	*/
	public function index() {
		$autoload['helper'] = array('url','form');
		$this->load->model('VEvent_model');
		$this->load->model('Schedule_model');
		$this->load->view("Browse");
	}
	
	/**
	*  DISPLAY EACH EVENT'S DETAILS IN A PAGE
	*  @param $eid: event's ID to be displayed
	*/
	public function display($id) {
		$data['eventId'] = $id;
		$this->load->model('VEvent_model');
		$this->load->view("EventDetails", $data);
	}
	
	/**
	*  ADD EVENT TO SCHEDULE WHEN USER CLICK ADD BUTTON 
	*  @param $eid: new event's ID to be added 
	*/
	public function addEvent($eid){
		$this->load->model('VEvent_model');
		$this->load->model('Schedule_model');
		$results = $this->VEvent_model->getAll();
		
		// Loop through the table until there is a matching event id
		// If match, retreive all data from the row
		foreach ($results as $result){ 
			if($eid==$result->{"vEventID"}){
				$addEvent_data = array(
					'userId'      => $_SESSION["userdata"]["userId"],
					'eventId'     => $result->{"vEventID"},
					'ename'       => $result->{"vEname"},
					'place'       => $result->{"vEplace"},
					'time'        => $result->{"vEdate"},
					'desc'        => $result->{"vEdesc"},
					'duration'    => $result->{"vEduration"}, 
					'longtitude'  => $result->{"longtitude"}, 
					'latitude'    => $result->{"latitude"}, 
					'isAttending' => 1
				);	
				$this->Schedule_model->insert_To_Calendar($addEvent_data);

				// TODO: WILL SIMPLIFY THIS PROCESS IN MILESTONE 3
				// Set data for updating isAttending column of Schedule table
				$scData = array(
					'vEventID'    => $eid,
					'ScheduleID'  => $_SESSION["userData"]["userId"]
				);	
				// Set data for updating isAttending column of eVents table
				$vevData = array('vEventID'=> $eid);
				$this->Schedule_model->modifyAttend($scData, $vevData, 1);
			} 
		}	
	}
	
	/**
	*  REMOVE EVENT FROM SCHEDULER.
	*  TODO: MOVE THIS FUNCTION TO SCHEDULER.PHP
	*  @param $eid: (event) record's ID to be removed
	*/
	public function removeEvent($eid){
		$this->load->model('VEvent_model');
		$this->load->model('Schedule_model');
		$scData = array(
			'ScheduleID'  => $_SESSION["userData"]["userId"],
			'vEventID'    => $eid
		);	
		$vevData = array(
			'vEventID'    => $eid
		);
		
		$this->Schedule_model->modifyAttend($scData, $vevData, 0);
		$this->Schedule_model->remove_from_Calendar($vevData);
	}
	
	/**
	*  "FAVOURITE" EVENT WHEN USER CLICK ADD BUTTON 
	*  @param $eid: new event's ID to be faved 
	*/
	public function favEvent($eid){
		$this->load->model('VEvent_model');
		$favData = array('vEventID' => $eid);
		
		$this->VEvent_model->modifyFav($favData, 1);
	}
	
	/**
	*  UNFAV EVENT 
	*  @param $eid: (event) record's ID to be removed
	*/
	public function unfavEvent($eid){
		$this->load->model('VEvent_model');
		$favData = array('vEventID' => $eid);
		
		$this->VEvent_model->modifyFav($favData, 0);
	}

  }

?>