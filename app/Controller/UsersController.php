<?php
	
	/**
	* 
	*/
	class UsersController extends AppController
	{
		private $userCursor = null;
		private $connection = null;
		private $projectCollection = null;
		
		public function beforeFilter()
		{
			$this->connection = new Mongo();
			$this->userCursor = $this->connection->moiter->users;
			$this->projectCollection = $this->connection->moiter->projects;
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
			
			$projects = array();
			foreach($userData['project_task_id'] as $project_task_id)
			{
				$project_id = explode("#",$project_task_id);
				$project = $this->projectCollection->findOne(array('_id'=>$project_id[0]));
				$projects[$project_id[0]] = $project;
			}
			$this->set('projects',$projects);
		}
		public function login()
		{
			$this->layout = "login";
			$this->set('error', false);

			if(!empty($_POST["userName"]))
			{
				$someOne = $this->userCursor->findOne(array('name' => $_POST['userName']));
				
				if(!empty($someOne['password']) && $someOne['password'] == $_POST['password'])
				{
					$this->Session->write('User',array('user_id'=>$someOne['_id'],'userName'=>$someOne['name']));

					$this->redirect('/projects/index');
				}
				else
				{
					$this->set('error',true);
				}
			}
	
		}
		public function register()
		{
			$newUser = $_POST;
			$newUser['pic_url'] = "";
			$newUser['project_task_id']=array();
			$newUser['_id'] = md5($_POST['name']."".time());
			$newUser['password'] = md5($_POST['password']);
			$this->userCursor->insert($newUser);
			$tmp = $this->userCursor->findOne($newUser);
			$code = 0;
			if(isset($tmp))
			{
				$code = 1;
				$this->Session->write('User',array('user_id'=>$newUser['_id'],'userName'=>$newUser['name']));
				$this->redirect('/projects/index');	
			}
			$this->set('code',$code);
			
		}
		public function edit()
		{

		}
		public function logout()
		{			
			$this->Session->delete('User');
			$this->redirect('/users/login');			
		}

	}
?>