<?php 
/**************************************************

UserModel contient la classe et toutes les méthodes possible pour un utilisateur

**************************************************/

class UserModel
{

/*
PreAddUser sers au pré enregistrement d'un utilisateur

$param contient username, email, password, datecréate, keygen
*/

	function PreAddUser($param)
	{
			//ouverture de la liaison avec la BDD
			$dbh = Connexion::openBdd();

		try
		{
			$stmt = $dbh->prepare("INSERT INTO user (username, password, email, datecreate, lastconnect, keygen) VALUES (:username, :password, :email, :datecreate, :lastconnect, :keygen)");
			$stmt->bindParam(':password',    	$param['password']);
			$stmt->bindParam(':email',          $param['email']);
			$stmt->bindParam(':datecreate',     $param['datecreate']);
			$stmt->bindParam(':lastconnect',  	$param['datecreate']);
			$stmt->bindParam(':keygen',  		$param['keygen']);
			$stmt->execute();  
		}
		catch( Exception $e)
		{
			echo 'Erreur : Impossible de créer l\'utilisateur: ',  $e->getMessage(), "\n";
		}
	}

/*
ValidAddUser sers au valider et finaliser l'enregistrement d'un utilisateur

Cette méthode est appelée lors du clic sur le lien du email

$param contient email, keygen
*/	

	function ValidAddUser($param)
	{
		//request
		$request = "SELECT * FROM user WHERE email= '".$param['email']."' and keygen= '".$param['keygen']."'";
			
		//result for request select
		$result = Connexion::select($request);
		
		if(!empty($result))
		{
		
			if($result[0]->actived ==1)
			{
				$message = "<div class='container'><div><span class='alert alert-danger'>Votre compte a deja été activé. <a href='index.php'>Retour</a></span></div></div>";
			}
			else
			{
				try
				{
					$dbh = Connexion::openBdd();
					$sql = "UPDATE user SET actived = 1 WHERE email = :email AND keygen= :keygen ";
					$Sql = $dbh->prepare($sql);                                  
					$Sql->bindParam(':email', $param['email']);		
					$Sql->bindParam(':keygen', $param['keygen']);
					$Sql->execute(); 
				}
				catch( Exception $e)
				{
					echo 'Erreur : Impossible de confirmer l\'utilisateur: ',  $e->getMessage(), "\n";
				}
					
				$message = "<div class='container'><div><span class='alert alert-success'>Votre compte a bien été activé. <a href='index.php'>Retour</a></span></div></div>";
			}
			
		}
		else
		{
			$message = "<div class='container'><div><span class='alert alert-danger'>Impossible de retrouver un compte utilisateur avec ces informations. <a href='index.php'>Retour</a></span></div></div>";
		}
		
		echo $message;
	}
	
/*
EditUser sers à éditer un user
$param contient iduser
*/
	function EditUser($param)
	{
	
	}
	
/*
ValidEditUser sers à valider les changements d'un utilisateur avec confirmation du MDP
$param contient iduser, password
*/	

	function ValidEditUser($param)
	{
	
	}


}
?>