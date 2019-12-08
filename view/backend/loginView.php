<h2>Connexion au Dashboard</h2>

<form method="post">
	<label for="username">Identifiant :</label>
	<br/>
	<input type="text" name="username"/>
	<br/>
	<label for="mdp">Mot-de-passe :</label>
	<br/>
	<input type="password" name="mdp"/>
	<br/>
<?php
		if($_SESSION['error_login'] != "")
		{
?>			
			<p style="color: red"><?php echo $_SESSION['error_login']; ?></p>
<?php			
			$_SESSION['error_login'] = "";
		}
 ?>				
	<input type="submit" name="btn_login"/>
</form>