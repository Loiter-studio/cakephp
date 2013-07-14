<?php
	
	/**
	* 
	*/
	class UsersController extends AppController
	{
		private $userCursor = null;
		private $connection = null;
		private $projectCollection = null;
		private $stageCollection = null;
		public function beforeFilter()
		{
			parent::beforeFilter();
			$this->connection = new Mongo();
			$this->userCursor = $this->connection->moiter->users;
			$this->projectCollection = $this->connection->moiter->projects;
			$this->stageCollection = $this->connection->moiter->stages;
		}
		public function afterFilter()
		{
			$this->connection->close();
		}

		public function index()
		{
			$this->checkSession();
			$cursor = $this->userCursor->find();
			$users = array();
			while($data = $cursor->getNext())
			{
				$users[] = $data;
			}
			$this->set('users',$users);
		}
		public function view($user_id)
		{
			$this->checkSession();
			$userData = $this->userCursor->findOne(array('_id'=>$user_id));
			$this->set('user',$userData);
			
			$projects_id = array();
			$tasks_id = array();
			$projects_name = array();
			foreach($userData['project_task_id'] as $project_task_id)
			{
				$idSplit = explode("#",$project_task_id);
				// $project = $this->projectCollection->findOne(array('_id'=>$idSplit[1]));
				$projects_id[$idSplit[1]] = $idSplit[1];
				$projects_name[$idSplit[1]] = $idSplit[0];
				$tasks_id[$idSplit[1]][] = $idSplit[2];

			}
			// print_r($tasks_id);
			// $tmpTask = $this->stageCollection->find(array('_id' => $stage_id), array('task'=>array('$elemMatch'=>array('task_id'=>$task_id))));
			$tasks = array();
			foreach ($projects_id as $p_id) {

				$cursor = $this->stageCollection->find(array('project_id'=>$p_id),array('task'=>1));
				while($cursor->hasNext())
				{
					$stage = $cursor->getNext();

					foreach ($stage['task'] as $atask) {
						# code...

						foreach ($tasks_id[$p_id] as $t_id) {
							# code...
	
							if($atask['task_id'] == $t_id){
								$atask['name'] = $projects_name[$p_id];
								// print_r($atask);
								$tasks[] = $atask;
							}
						}
					}

				}

			}

			$this->set('tasks',$tasks);
		}
		public function login()
		{
			$this->layout = "login";
			$this->set('error', false);

			if(!empty($_POST["userName"]))
			{
				$someOne = $this->userCursor->findOne(array('name' => $_POST['userName']));
				
				if(!empty($someOne['password']) && $someOne['password'] == md5($_POST['password']))
				{
					$this->Session->write('User',array('user_id'=>$someOne['_id'],'userName'=>$someOne['name'],'pic_url'=>$someOne['pic_url'],'email'=>$someOne['email']));

					$this->redirect('/projects/index/../..');
				}
				else
				{
					$this->set('error',true);
				}
			}
	
		}

		public function register()
		{
			$newUser = array();
			$newUser['_id'] = md5($_POST['name']."".time());
			$newUser['name'] = $_POST['name'];
			$newUser['password'] = md5($_POST['password']);
			$newUser['email'] = $_POST['email'];
			$newUser['pic_url'] ="upload/default-avatar.png";
			$newUser['tel'] = "";
			$newUser['company'] = "";
			$newUser['position'] = "";
			$newUser['project_task_id']=array();

			$this->set('validation',1);
			$this->set('code',2);
			$checking = $this->userCursor->findOne(array('email'=>$newUser['email']));
			if(isset($checking))
			{
				$this->set('validation',0);
			}
			else{

				$this->userCursor->insert($newUser);
				$tmp = $this->userCursor->findOne($newUser);
				$this->set('code',0);

				if(isset($tmp))
				{
					$this->set('code',1);
					$this->Session->write('User',array('user_id'=>$newUser['_id'],'userName'=>$newUser['name'],'pic_url'=>$tmp['pic_url'],'email'=>$tmp['email']));
					$this->redirect('/projects/index');	
				}
			}
			
			
		}
		public function getEditUser()
		{
			$user = $this->Session->read('User');
			$userData = $this->userCursor->findOne(array('_id'=>$user['user_id']));
			$back  = array('name'=>$userData['name'],'tel'=>$userData['tel'],'email'=>$userData['email'],'company'=>$userData['company'],'position'=>$userData['position']);
			return $back;
				//$this->set('back',$back);
		}
		public function edit()
		{
			$this->checkSession();
			$this->set('back',$this->getEditUser());
			$this->set('update',false);
			if(!empty($_POST))
			{
				
				$user = $this->Session->read('User');
				$this->userCursor->update(array('_id'=>$user['user_id']),array('$set'=>$_POST));
				$tmp = $this->userCursor->findOne(array('_id'=>$user['user_id'],'name'=>$_POST['name'],'tel'=>$_POST['tel'],'email'=>$_POST['email'],'company'=>$_POST['company'],'position'=>$_POST['position']));
				if(isset($tmp))
				{
					$this->set('update',true);
					$this->set('back',$tmp);				
				}
			}
		}
		public function logout()
		{			
			$this->Session->delete('User');
			$this->redirect('/users/login');			
		}

		public function username(){
			echo $this->Session->read('User');
		}
	}
?>