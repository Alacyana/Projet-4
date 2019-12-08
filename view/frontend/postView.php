<div class="row" id="post">
	<div class="col-12">
		<h2>Billet simple pour l'Alaska</h2>
		<h3><?php echo htmlspecialchars($post['title']); ?></h3>
		<div id="img_post">
		<?php
		if($post['image'] == 1)
		{
		?>
			<img src="http://blog.nexus-archeage.fr/files/<?php echo $post['id']; ?>.jpg">
		<?php
		}
		?>
		</div>
		<p><?php  echo $post['text']; ?></p>
	</div>
</div>
<div class="row" id="comments">
	<div class="col-12">
		<h2>Commentaires</h2>
		<h3>Ajouter un commentaire</h3>
		<form method="post">
			<label for="author_comment">Pseudonyme :</label><br/>
			<input id="author_comment" type="text" name="author_comment" placeholder="Anonyme"/><br/>
			<input id="text_comment" type="text" name="text_comment" placeholder="Message"/><br/>
<?php
		if($_SESSION['error_comment'] != "")
		{
?>			
			<p style="color: red"><?php echo $_SESSION['error_comment']; ?></p>
<?php			
			$_SESSION['error_comment'] = "";
		}
 ?>			
			<input id="submit_comment" type="submit" name="submit_comment"/>
		</form>
		<hr/>
	<?php
		while ($datas_comm = $getComments->fetch())
		{
			$id_report = $datas_comm['id_report'];
			if(isset($id_report))
			{
				$message = "Ne plus signaler";
			}
			else
			{
				$message = "Signaler";
			}	
	?>
			<div class="box_comment">
				<p class="author_comments"><?php echo htmlspecialchars($datas_comm['author']); ?> :</p>
				<p class="text_comments">" <?php echo htmlspecialchars($datas_comm['message']); ?> "<br/><span class="date_comments"><?php echo $datas_comm['date_creation']; ?></span></p>
				<a href="http://blog.nexus-archeage.fr?action=reportComment&id=<?php echo $datas_comm['id'];
				?>&post=<?php echo $id_post; ?>"><?php echo $message; ?></a>
			</div>
	<?php		
		}
	?>
	</div>
</div>	