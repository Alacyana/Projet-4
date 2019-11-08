<?php
require('controller/frontend.php');
require('controller/backend.php');

try
{
	if (isset($_GET['action']))
	{
		switch ($_GET['action'])
		{
			case 'listPosts':
				listPosts();
				break;
			case 'post':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{	
					posts();
				}
				else 
				{
					throw new Exception('Aucun identifiant de billet envoyé');
				}	
				break;
				case 'addComment':
					if (isset($_GET['id']) && $_GET['id'] > 0) 
					{
						if (!empty($_POST['author']) && !empty($_POST['comment'])) 
						{
							addComment($_GET['id'], $_POST['author'], $_POST['comment']);
						}
						else 
						{
							throw new Exception('Tous les champs ne sont pas remplis');
						}
					}
					else
					{
						throw new Exception('Aucun identifiant de billet envoyé');
					}
				case 'reportComment':
					if (isset($_GET['id']) && $_GET['id'] > 0)
					{
						reportComment();
					}
					else
					{
						throw new Exception('Aucun identifiant de commentaire');
					}
					break;	
				
			case 'dashboard':
				dashboard();
				break;		
			case 'modifyPost':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					modifyPost();
				}
				else
				{
					throw new Exception('Aucun identifiant de billet');
				}
			
			
		}
	}
	else
	{
		listPosts();
	}	
}
catch()
{
	
}