<?php
	/**
	* 
	*/
	class StagesController extends AppController
	{
		$connection = null;

		//$projectCollection = null;
		$stageCollection = null;

		public function beforeFilter()
		{
			$this->checkSession();

			$this->connection = new Mongo();
			//$this->projectCollection = $this->connection->moiter->projects;
			$this->stageCollection = $this->connection->moiter->stages;

		}
		public function afterFilter()
		{
			$this->connection->close();
		}

		public function index($project_id)
		{
			$stageData = $this->projectCollection->find(array('project_id'=>$project_id));

		}

		public function create($project_id)
		{
			$user =$this->Session->read('User');
			$stage_id = $user."".time();

			$this->stageCollection->insert(array('_id'=>$stage_id,
												 'user_id'=>$user['user_id'],
												 'project_id'=>$project_id,
												 'startTime'=>$_POST['startTime'],
												 'endTime'=>$_POST['endTime'],
												 'status'=>$_POST['status'],
												 'summary'=>$_POST['summary'],
												 'task'=>new array()));

		}

		public function delete($stage_id)
		{
			$this->stageCollection->remove(array('_id'=>$stage_id));
		}

		public function edit($stage_id)
		{
			$oldStage = $this->stageCollection->findOne(array('_id'=>$stage_id));
			$newStage = array(
				'project_id' => $oldStage['project_id'],
				'user_id' => $oldStage['user_id'],
				);
		}	
	}
?>	