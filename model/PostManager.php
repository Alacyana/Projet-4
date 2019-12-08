<?php

namespace Projet\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT title, text, id FROM posts ORDER BY creation_date DESC');
		$request->execute(array());
		return $request;
	}
	
	public function getPost($id_post)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT id, title, text, image FROM posts WHERE id = :id');
		$request->execute(array(
		'id'=> $id_post));
		return $request;
	}
	
	public function getComments($id_post, $ip)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('
		SELECT c.id, c.author, c.message, r.id AS id_report, DATE_FORMAT(c.date_creation, "le %d/%m/%Y à %H:%i:%S") AS date_creation
		FROM comments AS c
		LEFT JOIN report AS r
		ON c.id = r.id_comment AND r.ip_author = :ip
		WHERE c.id_post = :id
		ORDER BY date_creation
		');
		$request->execute(array(
		'id'=> $id_post,
		'ip' => $ip));
		return $request;
	}
	
	public function insertComment($author_comment, $text_comment, $id_post)
	{
		$dates = $this->datesZone();
		$db = $this->dbConnect();
		$request = $db->prepare('INSERT INTO comments SET id_post = :id_post, author = :author, message = :message, date_creation = :dates');
		$request->execute(array(
		'id_post'=> $id_post,
		'author'=> $author_comment,
		'message'=> $text_comment,
		'dates'=> $dates));
	}
	
	public function controlIp($id_comment, $ip)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT id FROM report WHERE id_comment = :id_comment AND ip_author = :ip');
		$request->execute(array(
		'id_comment'=> $id_comment,
		'ip'=> $ip));
		return $request;
	}
	
	public function insertNewIp($id_comment, $ip)
	{
		$dates = $this->datesZone();
		$db = $this->dbConnect();
		$request = $db->prepare('INSERT INTO report SET id_comment = :id_comment, ip_author = :ip, date_creation = :dates');
		$request->execute(array(
		'id_comment'=> $id_comment,
		'ip'=> $ip,
		'dates'=> $dates));
	}
	
	public function deleteReport($id_comment, $ip)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('DELETE FROM report WHERE id_comment = :id_comment AND ip_author = :ip');
		$request->execute(array(
		'id_comment'=> $id_comment,
		'ip'=> $ip));
	}
	
	public function countReports($id_comment)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT COUNT(*) AS nbReports FROM report WHERE id_comment = :id_comment');
		$request->execute(array(
		'id_comment'=> $id_comment));
		return $request;
	}
	
	public function updateCount($id_comment, $count)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE comments SET report_comment = :report_comment WHERE id = :id_comment');
		$request->execute(array(
		'report_comment'=> $count['nbReports'],
		'id_comment'=> $id_comment));
	}
}	
