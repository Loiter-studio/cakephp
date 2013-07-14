<?php
	/**
	* 
	*/
	class StagesController extends AppController
	{
		private $connection = null;

		//$projectCollection = null;
		private $stageCollection = null;

		public function beforeFilter()
		{
			// $this->checkSession();
			parent::beforeFilter();
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

		public function delete($stage_id)
		{
			$this->stageCollection->remove(array('_id'=>$stage_id));
			$tmp = $this->stageCollection->findOne( array('_id'=>$stage_id ));
			$code = true;
			if($tmp)
			{
				$code = false;
			}
			echo json_decode($code);
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