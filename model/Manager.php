<?php

namespace Projet\Model;

require("Projet-4/config.php");

class Manager
{
	protected function dbConnect()
	{
		$request = new PDO('mysql:host=;dbname=;charset=utf8','');
		return $request;
	}
}