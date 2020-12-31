<?php

/**
*	A CONTROLLER MANAGING FUNCTIONS OF "MY SCHEDULE" PAGE
*/
  class Schedule extends CI_Controller {
	
	// BY DEFAULT, THE SCHEDULE DATABASE AND VIEW ARE LOADED
	public function index() {
		$autoload['helper'] = array('url','form');
		$this->load->model('Schedule_model');
		$this->load->model('VEvent_model');
		$this->load->view("MySchedule");
	}
  }

?>