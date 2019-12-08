<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet">
		<link rel="stylesheet" href="public/css/bootstrap-grid.css" />
		<link rel="stylesheet" href="public/css/style.css" />
		<script src="https://cdn.tiny.cloud/1/75wdpvif0ytap3f1hbr8k24ms3x8fdli97j52q8g3ib7vzcb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script>tinymce.init({selector:'textarea'});</script>
		<title>Mes aventures autour du monde</title>
	</head>
	<body>
		<nav>
			<a href="http://blog.nexus-archeage.fr">
				<div id="title-site">
					<h1>Mes aventures autour du monde</h1>
				</div>
			</a>
			<div id="navigation">
				<a class="material-icons" id="link-dashboard" href="http://blog.nexus-archeage.fr?action=dashboard">dashboard</a>
				<?php 
				if (isset($_SESSION['id']))
				{
				?>
					<a class="material-icons" id="disconnection" href="http://blog.nexus-archeage.fr?action=disconnection">power_settings_new</a>
				<?php	
				}	
				?>
			</div>
		</nav>
		<div class="container">