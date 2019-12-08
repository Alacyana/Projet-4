<form method="post" enctype="multipart/form-data">
	<label for="title_post">Titre du sujet :</label>
	<input tye="text" name="title_post" value="<?php echo $post['title']; ?>"/>
	<textarea name="text_post"><?php echo $post['text']; ?></textarea><br/>
	<label for="add_file">Ajoutez une image (Max 1mo - 1200 x 2000px) :</label><br/>
	<input type="file" name="add_file"/><br/>
	<input type="submit" name="submit_post"/>
</form>
	