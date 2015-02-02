<?php 

require'model/userModel.php';
	//declare user
	$user = new UserModel();
	
	//user is connected
	if(isset($_SESSION['id']))
	{
		//select current user
		$user->getCurrentUser($_SESSION['id']);
		
		//include messages
		require 'model/messageModel.php';
		
		//include menu
		require'view/menu.php';
		
		//communication 
		require 'controller/SocialNetworkController.php';
		
		//default page
		//require 'controller/PublicationController.php';
	
	//user not connected
	}else{
		
		//user login?
		if(isset($_POST['connect']))
		{
			//select user by username and password
			$user->get($_POST);
			
			//user connected?
			if(isset($user->id) && $user->actived == 1)
			{
				//include messages
				require 'model/messageModel.php';
				
				//include menu
				require'view/menu.php';
				
				//communication 
				require 'controller/SocialNetworkController.php';
				
				//default page
				require 'model/accountModel.php';
				require 'controller/PublicationController.php';
			}
			else
			{
				if($user->actived == 0){
				$alerte = '<div><span class=" alert alert-danger">Votre compte n\'est pas actif</span></div>';
				}
				//not connected, include login page
				require 'view/page_home.php';
			}
			
		}elseif(isset($_POST['register']))//register
		{
			//email is already used
			if($user->getEmail($_POST['email']) == 1)
			{
				$Emailmessage = '<div><span class="alert-danger">Un compte utilise déjà cette adresse email</span></div>';
				
			}
			//error password matches
			if($_POST['password'] !== $_POST['passwordagain'])
			{
				$Passwordmatches = '<div><span class="alert-danger">Les mots de passe ne correspondent pas</span></div>';
			}
			//error password lenght
			if(strlen($_POST['password']) < 8 )
			{
				$Passwordlenght = '<div><span class="alert-danger">Le mot de passe doit contenir 8 caractères minimum</span></div>';
			}
			
			
			
			if(isset($Emailmessage) || isset($Passwordmatches) || isset($Passwordlenght))
			{
				require 'view/page_home.php';
			}else
			{
				$key = Config::randomKey(20);

				$param['password']    = md5($_POST['password']);
				$param['email']       = $_POST['email'];
				$param['datecreate'] = date('Y-m-d H:i:s');
				$param['lastconnect'] = date('Y-m-d H:i:s');
				$param['actived']     = '0';
				$param['keygen'] =  $key;

				try{
				//insert user
				$user->addUser($param);
				
				//send email
				Config::sendMail($param['email'], $key, $_POST['password']);
				}
				catch( Exception $e)
					{
						echo 'Erreur : ',  $e->getMessage(), "\n";
					}
				$alerte = '<div><span class=" alert alert-success">Votre compte a bien été crée. Un email de validation vous a été envoyé à l\'adresse: '.$param['email'].'</span></div>';
				require 'view/page_home.php';
			}

		}
		else
		{
			//not connected, include login page
			require 'view/page_home.php';
			
		}

	}

?>