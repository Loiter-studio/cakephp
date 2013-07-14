<?php
	/**
	* 
	*/
	class TasksController extends AppController
	{

		private $connection = null;
		private $stageCollection = null;
		private $projectCollection = null;
		private $userCollection = null;
		public function beforeFilter()
		{
			// $this->checkSession();
			parent::beforeFilter();
			$this->connection = new Mongo();

			$this->stageCollection = $this->connection->moiter->stages;
			$this->projectCollection = $this->connection->moiter->projects;
			$this->userCollection = $this->connection->moiter->users;
		}
		public function afterFilter()
		{
			$this->connection->close();
		}

		public function index($stage_id)
		{
			$stage = $this->stageCollection->find(array('_id'=>$stage_id));
		    echo json_encode($stage['task']);

		}
		public function create()
		{
			$user = $this->Session->read('User');
			$task = array(
				'task_id'=>md5($user['userName']."".time()),
				'user_id'=>$user['user_id'],
				'content'=>$_POST['content'],
				'leader'=>$_POST['leader'],
				'status'=>1,
				'priority'=>$_POST['priority'],
				'deadline'=>$_POST['deadline']);
			$this->stageCollection->update(array('_id'=>$_POST['stage_id']),
										   array('$push'=>array('task'=>$task)));
			$stage = $this->stageCollection->findOne(array('_id'=>$_POST['stage_id']));
			$project = $this->projectCollection->findOne(array('_id'=>$stage['project_id']));

			$this->userCollection->update(array('_id'=>$user['user_id']),array('$push'=>array('project_task_id'=>$project['name']."#".$stage['project_id']."#".$task['task_id'])));

			$this->set('project_id',$project['_id']);

		}
		public function delete($stage_id,$task_id)
		{
			$user = $this->Session->read('User');
			$this->stageCollection->update(array('_id'=>$stage_id),
										   array('$pull'=>array('task'=>array('task_id'=>$task_id,$user['user_id']))));

		}

		public function edit($stage_id, $task_id)
		{
			$user = $this->Session->read('User');
			$newTask = array(
				'task_id'=>$timestamp,
				'user_id'=>$user['user_id'],
				'cnotent'=>$_POST['content'],
				'status'=>'Unfinished',
				'priority'=>$_POST['priority'],
				'deadline'=>$_POST['deadline']);
			$this->stageCollection->update(array('_id'=>$stage_id),
										   array('$pull'=>array('task'=>array('task_id'=>$task_id))));
			$this->stageCollection->update(array('_id'=>$stage_id),
										   array('$push'=>array('task'=>$newTask)));

		}
		public function modifyPriority($stage_id , $task_id)
		{
			$tmpTask = $this->stageCollection->find(array('_id' => $stage_id), array('task'=>array('$elemMatch'=>array('task_id'=>$task_id))));
			$newTask = $tmpTask->getNext();
			pr($newTask['task'][0]);
			$this->stageCollection->update(array('_id'=> $stage_id),array('$pull'=>array('task'=>array('task_id'=>$task_id))));
			$tmpTask = $this->stageCollection->find(array('_id' => $stage_id), array('task'=>array('$elemMatch'=>array('task_id'=>$task_id))));
			$test = $tmpTask->getNext();
			if(isset($test))
			{
				$code = false;
			}
			else
			{
				$newTask['task'][0]['priority'] = time(); // $_POST['priority']
				$this->stageCollection->update(array('_id'=>$stage_id),
											   array('$push'=>array('task'=>$newTask['task'][0])));
				$code = true;

			}
		}
	}
?>