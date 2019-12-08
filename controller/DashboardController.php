<?php
namespace Projet\DashboardController;
session_start();

require('model/DashboardManager.php');

class DashboardController
{
	public function dashboard()
	{	
		if (isset($_SESSION['id']))
		{	
			$dashboardManager = new \Projet\Model\DashboardManager();
			$posts = $dashboardManager->getPosts();
			$comments = $dashboardManager->getCommentsReports();
				
			require('view/sampleViewTop.php');
			require('view/backend/dashboardView.php');
		}
		else
		{
			if(isset($_POST['btn_login'])) 
			{
				if((!empty($_POST['username'])) && (!empty($_POST['mdp'])))	
				{
					$user= $_POST['username'];
					$mdp = $_POST['mdp'];
					$dashboardManager = new \Projet\Model\DashboardManager();
					$log = $dashboardManager->login($user, $mdp);

					if(isset($log['id']))
					{
						$_SESSION['id'] = $log['id'];	
						header('Location:http://blog.nexus-archeage.fr?action=dashboard');
					}	
					else
					{
						$_SESSION['error_login'] = "L'identifiant et le mot-de-passe ne correspondent pas.";
					}
					
				}
				else
				{
					$_SESSION['error_login'] = "L'identifiant et le mot-de-passe ne correspondent pas.";
				}	
			}
			require('view/sampleViewTop.php');
			require('view/backend/loginView.php');
		}	
		require('view/sampleViewBot.php');		
	}
	
	public function disconnection()
	{
		header('Location:http://blog.nexus-archeage.fr');
		session_destroy();
		exit();
	}

	public function addPost()
	{
		if(isset($_POST['submit_post'])) 
		{
			if((!empty($_POST['title_post'])) && (!empty($_POST['text_post'])))	
			{	
				$title_post= $_POST['title_post'];
				$text_post = $_POST['text_post'];
				$dashboardManager = new \Projet\Model\DashboardManager();
				$addPost = $dashboardManager->insertPost($title_post, $text_post);
				$id_post = $addPost;
				if(isset($_FILES['add_file']) AND $_FILES['add_file']['error'] == 0)
				{
					//Si le fichier est inférieure à...
					if ($_FILES['add_file']['size'] <= 1000000)
					{
						$image_size = getimagesize($_FILES['add_file']['tmp_name']);
						if ($image_size[0] <= '1200' OR $image_size[1] <= '2000')
						{
							$infos_files = pathinfo($_FILES['add_file']['name']);
							$extension = $infos_files['extension'];
							$extentions_valid = array('png', 'jpeg', 'jpg');

							if (in_array($extension, $extentions_valid))
							{
								move_uploaded_file($_FILES['add_file']['tmp_name'], 'files/' .$id_post.'.jpg');
								$imagePost = $dashboardManager->imagePost($id_post);
							}
						}
					}
				}
				header('Location:http://blog.nexus-archeage.fr?action=dashboard');
			}
			else
			{
				$_SESSION['error_post'] = "Les champs ne sont pas tous remplis.";
			}	
		}
		require('view/sampleViewTop.php');
		require('view/backend/add_postView.php');
		require('view/sampleViewBot.php');
	}
	
	public function modifyPost()
	{ 
		$id_post= $_GET['id'];
		$dashboardManager = new \Projet\Model\DashboardManager();
		$getPost = $dashboardManager->getPost($id_post);
		$post = $getPost->fetch();
		
		if(isset($_POST['submit_post'])) 
		{
			if((!empty($_POST['title_post'])) && (!empty($_POST['text_post'])))	
			{
				$title_post= $_POST['title_post'];
				$text_post = $_POST['text_post'];
				$dashboardManager = new \Projet\Model\DashboardManager();
				$updatePost = $dashboardManager->updatePost($title_post, $text_post, $id_post);
				
				if(isset($_FILES['add_file']) AND $_FILES['add_file']['error'] == 0)
				{
					//Si le fichier est inférieure à...
					if ($_FILES['add_file']['size'] <= 1000000)
					{
						$image_size = getimagesize($_FILES['add_file']['tmp_name']);
						if ($image_size[0] <= '1200' OR $image_size[1] <= '2000')
						{
							$infos_files = pathinfo($_FILES['add_file']['name']);
							$extension = $infos_files['extension'];
							$extentions_valid = array('png', 'jpeg', 'jpg');

							if (in_array($extension, $extentions_valid))
							{
								move_uploaded_file($_FILES['add_file']['tmp_name'], 'files/' .$id_post.'.'.$extension);
								$imagePost = $dashboardManager->imagePost($id_post);
							}
						}
					}
				}	
				header('Location:http://blog.nexus-archeage.fr?action=dashboard');
			}
		}
		require('view/sampleViewTop.php');
		require('view/backend/post_editView.php');
		require('view/sampleViewBot.php');
	}
	
	public function removePost()
	{
		$id_post= $_GET['id'];
		$dashboardManager = new \Projet\Model\DashboardManager();
		$removePost = $dashboardManager->deletePost($id_post);
		$removeCommentsPost = $dashboardManager->deleteComments($id_post);
		
		header('Location:http://blog.nexus-archeage.fr?action=dashboard');
	}
	
	public function removeReport()
	{
		require('model/PostManager.php');
		$id_comment= $_GET['id'];
		$dashboardManager = new \Projet\Model\DashboardManager();
		$postManager = new \Projet\Model\PostManager();
		$removeReport = $dashboardManager->deleteReport($id_comment);
		$countReports = $postManager->countReports($id_comment);
		$count = $countReports->fetch();
		$updateReport = $postManager->updateCount($id_comment, $count);
		
		header('Location:http://blog.nexus-archeage.fr?action=dashboard');
	}
	
	public function removeComment()
	{
		$id_comment= $_GET['id'];
		$dashboardManager = new \Projet\Model\DashboardManager();
		$removeComment = $dashboardManager->deleteComment($id_comment);
		
		header('Location:http://blog.nexus-archeage.fr?action=dashboard');
	}
}	