<?php
	
	/**
	* 
	*/
	 class ProjectsController extends AppController
	{
		
		public $projectCursor = null;
		public $companyCursor = null;


		public $connection = null;
		
		public function beforeFilter(){
			$this->connection = new Mongo();
			$database =  $this->connection->selectDB('moiter');
		 	$this->projectCursor = $database->selectCollection('projects');
		 	$this->companyCursor = $database->selectCollection('companies');
		}
		public function afterFilter(){
			$this->connection->close();
		}

		public function index($companyId)
		{
			//$companyId = '1213423';

			$companyData = $this->companyCursor->findOne(array('_id' => $companyId));
			print_r(sizeof($companyData['project_id']));




		}
	}
?>