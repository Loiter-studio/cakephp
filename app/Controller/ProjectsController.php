<?php
	
	/**
	* 
	*/
	 class ProjectsController extends AppController
	{
		
		public $projectCollection= null;
		public $companyCollection = null;
		public $userCollection = null;
		public $connection = null;

		//public $admin = null;
		
		public function beforeFilter(){
			$this->checkSession();

			//$admin = 

			$this->connection = new Mongo();
			$this->projectCollection = $this->connection->moiter->projects;
			$this->companyCollection = $this->connection->moiter->companies;
			$this->userCollection = $this->connection->moiter->users;
		}
		public function afterFilter(){
			$this->connection->close();
		}

		public function index()
		{
			/*
			$admin = $this->Session->read('User');
		
			$userData = $this->userCollection->findOne(array('name' => $admin['userName']));
			$projectData = array();
			

			foreach($userData['project_id'] as $project_id){
				$project = $this->projectCollection->findOne(array('_id' => $project_id));
				$projectData[]=$project;
	
			}
			*/
			$projectData = array();
			$cursor = $this->projectCollection->find();		
			while($cursor->hasNext())
			{
	
				$projectData[] =  $cursor->getNext();
				
			}
			echo json_encode($projectData);
			//$this->set('poejects',$projectData);
		}

		public function create()
		{

			$this->projectCollection->insert(array('_id'=> '12', 
											 'name'=>$_POST['name'],
											 'startTime'=>$_POST['startTime'],
											 'endTime'=>$_POST['status'],
											 'summary'=>$_POST));
		}

		public function delete($project_id)
		{
			$project_id = null;
			$this->projectCollection->remove(array('_id' => $project_id));
			//$this->companyCollection->update(array('_id' => $ ))

		}

		public function edit()
		{
			$project_id;
			$this->projectCollection->update(array('_id'=> $project_id),
											 array('_id'=> $project_id, 
											 'name'=>$_POST['name'],
											 'startTime'=>$_POST['startTime'],
											 'endTime'=>$_POST['status'],
											 'summary'=>$_POST['summary']));
		}

		public function ajax(){
			$this->authRender = false;
			$arr = array();
			$arr['msg'] = "zhihuadashabi";
			echo json_encode($arr);
		}
	}
?>