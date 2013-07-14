<?php
	
	/**
	* 
	*/
	 class ProjectsController extends AppController
	{
		
		private $projectCollection= null;
		private $companyCollection = null;
		private $stageCollection = null;
		private $userCollection = null;

		private $connection = null;

		//public $admin = null;
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->checkSession();

			//$admin = 

			$this->connection = new Mongo();
			$this->projectCollection = $this->connection->moiter->projects;
			$this->companyCollection = $this->connection->moiter->companies;
			$this->stageCollection = $this->connection->moiter->stages;
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
			//echo json_encode($projectData);
			$this->set('projects',$projectData);
		}

		public function view($project_id)
		{
			$stageCursor = $this->stageCollection->find(array('project_id'=>$project_id))->sort(array('index'=>1));
			$projectData = $this->projectCollection->findOne(array('_id'=>$project_id));
			$stageData = array();
			while($data = $stageCursor->getNext())
			{
				$stageData[] = $data;
			}

			// print_r($stageData);
			$stages =  array();
			foreach ($stageData as &$stage) {
				# code...

				foreach ($stage['task'] as &$task) {
					# code...
					$aUser = $this->userCollection->findOne(array('_id'=>$task['user_id']));
					$task['user_name'] = $aUser['name'];
					$task['pic_url'] = $aUser['pic_url'];
					// print_r($aUser['name']);
				}
			}
			// print_r ($stageData);
			$this->set('project' , $projectData);
			$this->set('stages' ,$stageData);
	
		}
		
		public function create()
		{
		
			$user = $this->Session->read('User');

			$project_id = md5($user['userName']."".time());
			$this->projectCollection->insert(array('_id'=> $project_id, 
											 'name'=>$_POST['name'],
											 'leader'=>$_POST['leader'],
											 'startTime'=>$_POST['startTime'],
											 'endTime'=>$_POST['endTime'],
											 'status'=>'Unfinished',
											 'summary'=>$_POST['summary']));
			$tmp = $this->projectCollection->findOne(array('_id'=>$project_id));
		}

		public function delete($project_id)
		{
			$project_id = null;
			$this->projectCollection->remove(array('_id' => $project_id));
			//$this->companyCollection->update(array('_id' => $ ))
			$tmp = $this->projectCollection->findOne(array('_id'=>$project_id));
			$code = true;
			if($tmp)
			{
				$code = false;
			}
			echo json_decode($code);

		}

		public function edit($project_id)
		{
			
			$this->projectCollection->update(array('_id'=> $project_id),
											 array('$set'=> array('name'=>$_POST['name'],
											       'startTime'=>$_POST['startTime'],
											       'endTime'=>$_POST['status'],
											       'summary'=>$_POST['summary'])));
			$tmp = $this->projectCollection->findOne(array('_id'=>$project_id,
														   'name'=>$_POST['name'],
											       		   'startTime'=>$_POST['startTime'],
											               'endTime'=>$_POST['status'],
											               'summary'=>$_POST['summary']));
			$code = true;
			if(!$tmp)
			{
				$code = false;
			}
			echo json_decode($code);
		}

		public function ajax(){
			$this->authRender = false;
			$arr = array();
			$arr['msg'] = "zhihuadashabi";
			echo json_encode($arr);
		}
	}
?>