<?php
	
	/**
	* 
	*/
	class UsersController extends AppController
	{
		private $userCursor = null;
		private $connection = null;
		public $layout = "login";	
		
		public function beforeFilter(){
			
			$this->connection = new Mongo();
			$this->userCursor = $this->connection->moiter->users;
		}
		public function afterFilter(){
			$this->connection->close();
		}

		public function login()
		{
			
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
		public function logout()
		{
			
			$this->Session->delete('User');
			$this->redirect('/users/login');
			
		}

	}
?>