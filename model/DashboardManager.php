<?php
namespace Projet\Model;
session_start();
require_once("model/Manager.php");

class DashboardManager extends Manager
{
	public function login($user, $mdp)
	{
		$pass_hache = sha1('*@ufm_-+' . $mdp . '*-+blog°');
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM dashboard WHERE username = :user AND password = :mdp');
		$request->execute(array(
		'user' => $user,
		'mdp' => $pass_hache));
		$data_log = $request->fetch();
		return $data_log;
	}
	
	public function getPosts()
    {
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT title, text, id FROM posts ORDER BY creation_date DESC');
		$request->execute(array());
		return $request;
	}
 
	public function insertPost($title_post, $text_post)
	{
		$dates = $this->datesZone();
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO posts SET title = :title, text = :text, creation_date = :dates');
		$req->execute(array(
		'title'=> $title_post,
		'text'=> $text_post,
		'dates' => $dates));
		return $db->lastInsertId();
	}
	
	public function imagePost($id_post)
	{
		$dates = $this->datesZone();
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE posts SET image = :image WHERE id = :id');
		$request->execute(array(
		'image'=> '1',
		'id'=> $id_post));
	}
	
	public function getPost($id_post)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT title, text FROM posts WHERE id = :id');
		$request->execute(array(
		'id'=> $id_post));
		return $request;
	}

	public function updatePost($title_post, $text_post, $id_post)
	{
		$dates = $this->datesZone();
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE posts SET title = :title, text = :text, modification_date = :dates WHERE id = :id');
		$request->execute(array(
		'title'=> $title_post,
		'text'=> $text_post,
		'dates'=> $dates,
		'id'=> $id_post));
	}

	public function deletePost($id_post)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('DELETE FROM posts WHERE id = :id');
		$request->execute(array(
		'id'=> $id_post));
	}
	
	public function deleteComments($id_post)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('DELETE FROM comments WHERE id_post = :id');
		$request->execute(array(
		'id'=> $id_post));
	}
	
	public function getCommentsReports()
	{
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT id, id_post, author, message, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %H:%i:%S') AS date_creation, report_comment FROM comments WHERE report_comment > 0 ORDER BY report_comment DESC");
		$request->execute(array());
		return $request;
	}
	
	public function deleteReport($id_comment)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('DELETE FROM report WHERE id_comment = :id');
		$request->execute(array(
		'id'=> $id_comment));
	}
	
	public function deleteComment($id_comment)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('DELETE FROM comments WHERE id = :id');
		$request->execute(array(
		'id'=> $id_comment));
	}
}