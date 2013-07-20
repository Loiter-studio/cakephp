<?php
	/**
	* 
	*/
	class StagesController extends AppController
	{
		private $connection = null;

		//$projectCollection = null;
		private $stageCollection = null;
		private $userCollection = null;
		public function beforeFilter()
		{
			// $this->checkSession();
			parent::beforeFilter();
			$this->connection = new Mongo();
			$this->projectCollection = $this->connection->moiter->projects;
			$this->stageCollection = $this->connection->moiter->stages;
			$this->userCollection = $this->connection->moiter->users;

		}
		public function afterFilter()
		{
			$this->connection->close();
		}

		public function index($project_id)
		{
			$stageCursor = $this->projectCollection->find(array('project_id'=>$project_id));
			$stageData = array();
			while($data = $stageCursor->getNext())
			{
				$stageData = $data;
			}
			// pr($stageData);
			$this->set('stages',$stageData);

		}

		public function create()
		{
			$user =$this->Session->read('User');
			$stage_id = md5($user['userName']."".time());
			$this->stageCollection->insert(array('_id'=>$stage_id,
												 'user_id'=>$user['user_id'],
												 'project_id'=>$_POST['project_id'],
												 'leader'=>$_POST['leader'],
												 'startTime'=>$_POST['startTime'],
												 'endTime'=>$_POST['endTime'],
												 'status'=>'Unfinished',
												 'index'=>$_POST['index'],
												 'summary'=>$_POST['summary'],
												 'task'=>array()));
			$tmp = $this->stageCollection->findOne(array('_id'=>$stage_id));
			$this->set('project_id',$_POST['project_id']);
		}

		public function delete($project_id,$stage_id)
		{
			$project = $this->projectCollection->findOne(array('_id'=>$project_id),array('name'=>1));
			$oldStage = $this->stageCollection->findOne(array('_id'=>$stage_id),array('task'=>1));
			foreach ($oldStage['task'] as $task) {
				# code...
				$tmp = $project['name']."#".$project_id."#".$task['task_id'];
				$this->userCollection->update(array('_id'=>$task['user_id']),array('$pull'=>array('project_task_id'=>$tmp)));
			}
			$this->stageCollection->remove(array('_id'=>$stage_id));
			$temp = $this->stageCollection->findOne( array('_id'=>$stage_id ));
			
			if(isset($temp))
			{
				$this->set('code',0);
			}
			else
			{
				$this->set('code',1);
			}
			$this->set('project_id',$project_id);			
		}

		public function edit($stage_id)
		{
			$this->stageCollection->update(array('_id' => $stage_id ), 
											array('$set'=> array('startTime' => $_POST['startTime'],
																 'endTime' => $_POST['endTime'],
																 'status' => $_POST['status'],
																 'summary' => $_POST['summary'])));

			$tmp = $this->stageCollection->findOne(array('_id'=>$stage_id,
														 'startTime' => $_POST['startTime'],
														 'endTime' => $_POST['endTime'],
														 'status' => $_POST['status'],
														 'summary' => $_POST['summary']));
			$code = false;
			if($tmp)
			{
				$code = true; 
			}
			echo json_decode($code);
		}	
	}
?>