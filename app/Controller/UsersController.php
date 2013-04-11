<?php
	
	/**
	* 
	*/
	class UsersController extends AppController
	{
		private $userCursor = null;
		private $connection = null;
		
		
		public function beforeFilter()
		{
			$this->connection = new Mongo();
			$this->userCursor = $this->connection->moiter->users;
		}
		public function afterFilter()
		{
			$this->connection->close();
		}

		public function index()
		{
			//$this->checkSession();
			$cursor = $this->userCursor->find();
			$users = array();
			while($data = $cursor->getNext())
			{
				$users[] = $data;
			}
			//echo json_encode($users);
			$this->set('users',$users);

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
		public function logout()
		{
			
			$this->Session->delete('User');
			$this->redirect('/users/login');
			
		}

	}
?>