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
	}
?>