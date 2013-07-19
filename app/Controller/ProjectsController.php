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
			// $this->checkSession();

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

			$projectData = array();
			$cursor = $this->projectCollection->find();		
			while($cursor->hasNext())
			{
				$projectData[] =  $cursor->getNext();
			}
			//echo json_encode($projectData);
			foreach ($projectData as &$p) {
				# code...
				$status_1 = 0;
				$status_2 = 0;
				$status_3 = 0;
				$stages = $this->stageCollection->find(array('project_id'=>$p['_id']),array('task'=>1));
				while($stages->hasNext()){
					$stage = $stages->getNext();
					// print_r($stage['task']);
					foreach ($stage['task'] as $task) {
						if($task['status'] == 1){
							$status_1 += 1;
						}
						else if( $task['status'] == 2){
							$status_2 += 1;
						}
						else if($task['status'] == 3)
							$status_3 += 1;
					}

				}
				$p['status_1'] = $status_1;
				$p['status_2'] = $status_2;
				$p['status_3'] = $status_3;

			}
			// print_r($projectData);
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

			$this->set('project_id',$project_id);
		}

		public function delete($project_id)
		{
			
			$this->projectCollection->remove(array('_id' => $project_id));
			//$this->companyCollection->update(array('_id' => $ ))
			$this->stageCollection->remove(array('project_id'=>$prject_id));

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