<div class="row" id="presentation">
	<div class="col-12 col-sm-3 col-lg-3">
		<img src="public/images/forteroche.jpg" alt="author photo"/>
	</div>
	<p class="col-12 col-sm-9 col-lg-9">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut hendrerit quam, quis commodo nisi. Sed quis massa consequat sem convallis consectetur quis accumsan mauris. Nulla tincidunt at dolor quis condimentum. Mauris imperdiet sit amet leo sit amet rhoncus. Maecenas ut sem ut libero bibendum semper. Curabitur semper consectetur eros non tincidunt. Pellentesque vel congue magna. Cras in pellentesque tellus, nec tincidunt velit. Cras iaculis dolor non felis egestas consectetur.
	</p>
</div>
<?php
	while ($datas = $posts->fetch())
	{
		$text = $datas['text'];
		$text = strip_tags($text);
		$text = substr_replace($text, "...", 300, strlen($text));
		
		
		?>
		<div class="row links-posts">
			<a class="col-12 col-sm-12 col-lg-12" href="http://blog.nexus-archeage.fr?action=post&id=<?php echo $datas['id']; ?>">
				<h2>Billet simple pour l'Alaska</h2>
				<h3><?php echo htmlspecialchars($datas['title']); ?></h3>
				<p style="font-style:italic">"<?php  echo $text; ?>"</p>
			</a>
		</div>
		<?php
	}	
?>

