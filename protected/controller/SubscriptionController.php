<?php
class SubscriptionController extends DooController
{
	private $mongo;
	private $db;
	
	function __construct()
	{
		$this->mongo = new MongoClient("mongodb://75.80.144.58");
		$this->db = $this->mongo->selectDB("locationstories");
	}
	
	public function subscribe()
	{
		$user_id = new MongoId($_GET["user_id"]);
		$subscriber_id = new MongoId($_GET["subscriber_id"]);
		$proximity = $_GET["proximity"];
		$units = $_GET["units"];
		$users =$this->db->users;
		$query = array("subscribers._id"=>$subscriber_id,"_id"=>$user_id);
		$count = $users->count($query);
		if($count == 0)
		{
			$subscriber = array();
			$subscriber["_id"] = $subscriber_id;
			$subscriber["proximity"] = $proximity;
			$$subscriber["units"] = $units;
			$this->db->users->update(array("_id"=>$user_id),array('$push'=>array("subscribers"=>$subscriber)));
			echo "Success:Subscription Added";
		}
		else {
			echo "Error:Subscription already exists";
		}
		
	}
	
	public function remove_subscription()
	{
		$user_id = new MongoId($_GET["user_id"]);
		$subscriber_id = new MongoId($_GET["subscriber_id"]);
		$query = array("subscribers._id"=>$subscriber_id,"_id"=>$user_id);
		$count = $users->count($query);
		if($count == 0)
		{
			echo "Error:Subscription does not exist";
		}
		else
		{
			$this->db->users->update(array("_id"=>$user_id),array('$pull'=>array("subscribers"=>array("_id"=>$subscriber_id))));
			echo "Success:Subscription removed";
		}
	}
	
	public function subscriptions()
	{
		$keywords = $_GET["keywords"];
		$keywords_query = array('businessname'=>array('$regex'=>"$keywords", '$options'=>'-i'));
		$outfields = array("businessname"=>1);
		$results = $this->db->users->find($keywords_query,$outfields);
		$docs = array();
		foreach($results as $doc)
		{
			array_push($docs,$doc);
		}
		echo json_encode($docs);
	}
}
?>