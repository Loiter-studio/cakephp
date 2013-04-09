<?php
	
	/**
	* 
	*/
	 class ProjectsController extends AppController
	{
		
		public $project = null;
		public $connection = null;
		
		public function beforeFilter(){
			$this->connection = new Mongo();
			$database =  $this->connection->selectDB('moiter');
		 	$this->company = $database->selectCollection('projects');
		}
		public function afterFilter(){
			$this->connection->close();
		}
	}
?>