<?php
class LocationController extends DooController
{
	private $mongo;
	private $db;
	
	function __construct()
	{
		$this->mongo = new MongoClient("mongodb://essargeo.com");
		$this->db = $this->mongo->selectDB("locationstories");
	}
	
	public function update_location()
	{
		$users = $this->db->users;
		$userid = new MongoId($_GET["user_id"]);
		$latitude = $_GET["latitude"];
		$longitude = $_GET["longitude"];
		$location= array();
		if($latitude != "" && $longitude != "")
		{
			$location['type'] = "Point";
			$location['coordinates'] = array(floatval($longitude),floatval($latitude));
		}
		$users->update(array("_id"=>$userid),array('$set'=>array("location"=>$location)));
		echo "Success:Location Updated";
	}
}
?>