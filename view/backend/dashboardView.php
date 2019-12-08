<h2>Bienvenue sur le Dashboard</h2>

<div id="dashboard_comments">
<h3>Commentaires signalés</h3>
<?php
	while ($datas = $comments->fetch())
	{
		?>
		<div class="box_comment">
			<p>
				Le commentaire de l'auteur <span><?php echo htmlspecialchars($datas['author']); ?></span> du sujet <a class="link_post_dashboard" href="http://blog.nexus-archeage.fr?action=post&id=<?php echo $datas['id_post']; ?>">[ <?php echo $datas['id_post']; ?> ]</a> écrit <span><?php echo $datas['date_creation']; ?></span> a été signalé <span><?php echo $datas['report_comment']; ?></span> fois :
				<br />
				<span class="message_comment">" <?php echo htmlspecialchars($datas['message']); ?> "</span>
			</p>
			<a class="button-dashboard" href="http://blog.nexus-archeage.fr?action=deleteReport&id=<?php echo $datas['id']; ?>">Autoriser</a>
			<a class="button-dashboard" href="http://blog.nexus-archeage.fr?action=deleteComment&id=<?php echo $datas['id']; ?>">Supprimer</a>		
		</div>
		<?php
	}	
?>
</div>

<div id="dashboard_posts">
<h3>Liste des sujets</h3>
<a class="button-dashboard" href="http://blog.nexus-archeage.fr?action=addPost">Ajouter un sujet</a>
<?php
	while ($datas = $posts->fetch())
	{
		?>
		<div class="box_posts">
			<p>[ <span><?php echo $datas['id']; ?></span> ] Billet simple pour l'Alaska : <span><?php echo htmlspecialchars($datas['title']); ?></</span></p>
			<a class="button-dashboard" href="http://blog.nexus-archeage.fr?action=modifyPost&id=<?php echo $datas['id']; ?>">Modifier</a>
			<a class="button-dashboard" href="http://blog.nexus-archeage.fr?action=deletePost&id=<?php echo $datas['id']; ?>">Supprimer</a>
		</div>
		<?php
	}	
?>
</div>