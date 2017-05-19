<?php

/*
	This class acts as the super for other module handlers.
	When defined in the __MODULE_CONFIG file the resulting json 
	should provide the propper information for it to be implemented
	propperly
*/

class Module{
	
	public $MODULEName;
	public $MODULESrc;
	
	protected $MEMORY = 0;
	
	function __construct($MODULEName, $MODULESrc){
		$this->MODULEName = $MODULEName;
		$this->MODULESrc = $MODULESrc;
	}
	
	
	// Loads the designated script
	public function Load(){
		$this->MEMORY = memory_get_usage();
		require_once($this->MODULESrc);
		$this->MEMORY = memory_get_usage()-$this->MEMORY;
		__APPEND_LOG("Module loaded: ".$this->MODULEName);
		__APPEND_LOG("Base memory usage: ".($this->MEMORY/1024)."KB");
	}
	
	// Checkes to see if module script exists
	public function isValid(){
		return file_exists($this->MODULESrc);
	}
	
	// Used so that other modules can create objects native to this module
	public function create($create, $args=array()){}
}


?>