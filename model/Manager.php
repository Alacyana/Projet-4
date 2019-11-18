<?php

namespace Projet\Model;

require("Projet-4/config.php");

class Manager
{
	protected function dbConnect()
	{
		$request = new PDO('mysql:host=DB_HOST;dbname=DB_NAME;charset=utf8','DB_USERNAME','DB_MDP');
		return $request;
	}
}