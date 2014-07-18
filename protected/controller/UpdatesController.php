<?php
class UpdatesController extends DooController
{
	private $mongo;
	private $db;
	
	function __construct()
	{
		$this->mongo = new MongoClient("mongodb://75.80.144.58");
		$this->db = $this->mongo->selectDB("locationstories");
	}
	
	public function publish()
	{
		$user_id = new MongoId($_GET["user_id"]);
		date_default_timezone_set('America/Los_Angeles');
		$createdate = date('m/d/Y h:i:s a', time());
		$category_id = $_GET["category_id"];
		$subcategory = $_GET["subcategory"];
		$message = $_GET["message"];
		//also get an image
		$num_days = $_GET["num_days"];
		$update = array("category_id"=>$category_id,"create_date"=>$createdate,"subcategory"=>$subcategory,"num_days"=>$num_days);
		$this->db->users->update(array("_id"=>$user_id),array('$push'=>array("updates"=>$update)));
		echo "Success:Update published to profile";
	}
}
?>