<?php
require_once("config.php");
require_once('controller/PostController.php');
require_once('controller/DashboardController.php');

	if (isset($_GET['action']))
	{
		switch ($_GET['action'])
		{			
			case 'dashboard':
				$dashboardController = new \Projet\DashboardController\DashboardController();
				$dashboardController->dashboard();
				break;
			case 'disconnection':
				$dashboardController = new \Projet\DashboardController\DashboardController();
				$dashboardController->disconnection();
				break;
			case 'deleteReport':
				$dashboardController = new \Projet\DashboardController\DashboardController();
				$dashboardController->removeReport();
				break;
			case 'deleteComment':
				$dashboardController = new \Projet\DashboardController\DashboardController();
				$dashboardController->removeComment();
				break;
			case 'addPost':
				$dashboardController = new \Projet\DashboardController\DashboardController();
				$dashboardController->addPost();
				break;
			case 'modifyPost':
				$dashboardController = new \Projet\DashboardController\DashboardController();
				$dashboardController->modifyPost();
				break;	
			case 'deletePost':
				$dashboardController = new \Projet\DashboardController\DashboardController();
				$dashboardController->removePost();
				break;
			case 'post':
				$postController = new \Projet\PostController\PostController();
				$postController->post();
				break;
			case 'reportComment':
				$postController = new \Projet\PostController\PostController();
				$postController->reportComment();
				break;
		}
	}
	else
	{
		$postController = new \Projet\PostController\PostController();
		$postController->listPosts();
	}	