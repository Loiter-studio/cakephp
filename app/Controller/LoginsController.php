<?php

	/**
	* 
	*/
	class LoginsController extends AppController
	{
		
		private $userCursor = null;
		private $connection = null;

		public function beforeFilter()
		{
			$this->connection = new Mongo();
			$this->userCursor = $this->connection->moiter->users;

		}
		public function index()
		{
			$this->layout = "login";
			$this->set('error', false);

			if(!empty($_POST["userName"]))
			{
				$someOne = $this->userCursor->findOne(array('name' => $_POST['userName']));
				
				if(!empty($someOne['password']) && $someOne['password'] == md5($_POST['password']))
				{
					$this->Session->write('User',array('user_id'=>$someOne['_id'],'userName'=>$someOne['name'],'pic_url'=>$someOne['pic_url'],'email'=>$someOne['email']));

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
	}
?>