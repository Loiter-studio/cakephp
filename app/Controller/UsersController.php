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
				$project = $this->projectCollection->findOne(array('_id'=>$project_id[1]));
				$projects[$project_id[1]] = $project;
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
					$this->Session->write('User',array('user_id'=>$someOne['_id'],'userName'=>$someOne['name'],'pic_url'=>$someOne['pic_url']));

					$this->redirect('/projects/index');
				}
				else
				{
					$this->set('error',true);
				}
			}
	
		}
		public function avatar()
		{
			$this->set('code', 0);
		}
		public function register()
		{
			$newUser = array();
			$newUser['_id'] = md5($_POST['name']."".time());
			$newUser['name'] = $_POST['name'];
			$newUser['password'] = md5($_POST['password']);
			$newUser['email'] = $_POST['email'];
			$newUser['pic_url'] = "";
			$newUser['tel'] = "";
			$newUser['company'] = "";
			$newUser['position'] = "";
			$newUser['project_task_id']=array();
			$this->userCursor->insert($newUser);
			$tmp = $this->userCursor->findOne($newUser);
			$code = 0;
			if(isset($tmp))
			{
				$code = 1;
				$this->Session->write('User',array('user_id'=>$newUser['_id'],'userName'=>$newUser['name'],'pic_url'=>$tmp['pic_url']));
				$this->redirect('/projects/index');	
			}
			$this->set('code',$code);
			
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