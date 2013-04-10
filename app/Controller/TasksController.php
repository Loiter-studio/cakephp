<?php
	/**
	* 
	*/
	class TasksController extends AnotherClass
	{
		$connection = null;
		$stageCollection = null;
		$userCollection = null;
		public function beforeFilter()
		{
			$this->checkSession();
			$this->connection = new Mongo();

			$this->stageCollection = $this->connection->moiter->stages;
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
		public function create($stage_id)
		{
			$user = $this->Session->read('User');
			$task = array(
				'task_id'=>time(),
				'user_id'=>$user['user_id'],
				'conntent'=>$_POST['content'],
				'status'=>$_POST['status'],
				'deadline'=>$_POST['deadline']);
			$this->stageCollection->update(array('_id'=>$stage_id),
										   array('$push'=>array('task'=>$task)));
			$stage = $this->stageCollection->findOne(array('_id'=>$stage_id));

			$this->userCollection->update(array('_id'=>$user['user_id']),array('$addToSet'=>array('project_task_id'=>$stage['project_id']."#".$task['task_id'])));


		}
		public function delete($stage_id,$task_id)
		{
			$user = $this->Session->read('User');
			$this->stageCollection->update(array('_id'=>$stage_id),
										   array('$pull'=>array('task'=>array('time'=>$task_id,$user['user_id']))));

		}

		public function edit($stage_id, $task_id)
		{
			$user = $this->Session->read('User');
			$newTask = array(
				'task_id'=>$timestamp;
				'user_id'=>$user['user_id'];
				'cnotent'=>$_POST['content'],
				'status'=>$_POST['status'],
				'deadline'=>$_POST['deadline']);
			$this->stageCollection->update(array('_id'=>$stage_id),
										   array('$pull'=>array('task_id'=>$timestamp)));
			$this->stageCollection->update(array('_id'=>$stage_id),
										   array('$push'=>array('task'=>$newTask)));

		}
	}
?>