<?php
namespace Projet\PostController;
session_start();

require('model/PostManager.php');

class PostController
{
	public function listPosts()
	{
		$postManager = new \Projet\Model\PostManager();
		$posts = $postManager->getPosts();
		
		require('view/sampleViewTop.php');
		require('view/frontend/listPostsView.php');
		require('view/sampleViewBot.php');
	}

	public function post()
	{
		$id_post = $_GET['id'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$postManager = new \Projet\Model\PostManager();
		$getPost = $postManager->getPost($id_post);
		$getComments = $postManager->getComments($id_post, $ip);
		$post = $getPost->fetch();
	
		if(isset($_POST['submit_comment'])) 
		{
			if(!empty($_POST['text_comment']))	
			{
				if(!empty($_POST['author_comment']))	
				{
					$author_comment= $_POST['author_comment'];
				}
				else
				{
					$author_comment= "Anonyme";
				}
				$text_comment = $_POST['text_comment'];
				$postManager = new \Projet\Model\PostManager();
				$addComment = $postManager->insertComment($author_comment, $text_comment, $id_post);
				
				header('Location:http://blog.nexus-archeage.fr?action=post&id='.$id_post);
			}
			else
			{
				$_SESSION['error_comment'] = "Vous devez écrire un message pour l'envoyer.";
			}
		}
		require('view/sampleViewTop.php');
		require('view/frontend/postView.php');
		require('view/sampleViewBot.php');
	}
	
	public function reportComment()
	{
		$id_comment = $_GET['id'];
		$id_post = $_GET['post'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$postManager = new \Projet\Model\PostManager();
		$controlIp = $postManager->controlIp($id_comment, $ip);
		$returnIp = $controlIp->fetch();

		if(!isset($returnIp['id']))
		{
			$postManager = new \Projet\Model\PostManager();
			$newIp = $postManager->insertNewIp($id_comment, $ip);
			$countReports = $postManager->countReports($id_comment);
			$count = $countReports->fetch();
			$updateCount = $postManager->updateCount($id_comment, $count);
		}
		else
		{
			$postManager = new \Projet\Model\PostManager();
			$deleteReport = $postManager->deleteReport($id_comment, $ip);
			$countReports = $postManager->countReports($id_comment);
			$count = $countReports->fetch();
			$updateCount = $postManager->updateCount($id_comment, $count);
		}
		
		header('Location:http://blog.nexus-archeage.fr?action=post&id='.$id_post);
	}	
}