<form method="post" enctype="multipart/form-data">
	<label for="title_post">Titre du sujet :</label>
	<input tye="text" name="title_post"/>
	<textarea name="text_post"></textarea>
	<label for="add_file">Ajoutez une image :</label>
	<input type="file" name="add_file"/>
<?php
		if($_SESSION['error_post'] != "")
		{
?>			
			<p style="color: red"><?php echo $_SESSION['error_post']; ?></p>
<?php			
			$_SESSION['error_post'] = "";
		}
 ?>			
	<input type="submit" name="submit_post"/>
</form>
	