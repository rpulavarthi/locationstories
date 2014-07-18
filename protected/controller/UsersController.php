<?php
class UsersController extends DooController
{
	private $mongo;
	private $db;
	
	function __construct()
	{
		$this->mongo = new MongoClient("mongodb://75.80.144.58");
		$this->db = $this->mongo->selectDB("locationstories");
	}
	
	public function create_user()
	{
		$usertype = $this->params['usertype'];
		$location= array();
		
		if($usertype == "individual")
		{
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$latitude = $_POST["latitude"];
			$longitude = $_POST["longitude"];
			if($latitude != "" && $longitude != "")
			{
				$location['type'] = "Point";
				$location['coordinates'] = array(floatval($longitude),floatval($latitude));
			}
		}
		else if($usertype == "business")
		{	
			$businessname = $_POST['businessname'];
			$categoryId = $_POST['categoryId'];
			$website = $_POST['website'];
			$locations = $_POST['locations'];
		}
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		date_default_timezone_set('America/Los_Angeles');
		$lastlogin = date('m/d/Y h:i:s a', time());
		$loginip =$_SERVER["REMOTE_ADDR"];
		$logintype = $this->params['logintype'];
		$users = $this->db->users;
		$logintype = $this->db->logintypes->findOne(array('name'=>$logintype));
		$usertype_obj = $this->db->usertypes->findOne(array('name'=>$usertype));
		$user_doc = array('username'=>$username,'logintype'=>$logintype['_id'],'usertype'=>$usertype_obj['_id']);
		$count = $users->count($user_doc);
		if($count==0)
		{
			$user_doc['password'] = $password;
			$user_doc['lastlogin'] = $lastlogin;
			$user_doc['loginip'] = $loginip;
			if($usertype == "individual")
			{
				$user_doc['firstname'] = $firstname;
				$user_doc['lastname'] = $lastname;
				$user_doc['location'] = $location;
			}
			elseif($usertype == "business")
			{
				$user_doc['businessname'] = $businessname;
				$user_doc['categoryId'] = new MongoId($categoryId);
				$user_doc['website'] = $website;
				$user_doc['locations'] = json_decode($locations);
			}
			$user_doc['email'] = $email;
			$users->insert($user_doc);
			echo "Success:Successfully created user - ".$username;
		}
		else {
			echo "Error:User already exits!";
		}
	}
 
   	public function login()
	{
		$logintype = $_GET["logintype"];
		if($logintype == "username")
		{
			$username = $_GET["username"];
			$password = $_GET["password"];
			$logintype = $this->db->logintypes->findOne(array('name'=>"username"));
			$logintype_id = new MongoId($logintype["_id"]);
			$query = array("logintype"=>$logintype_id,"username"=>$username,"password"=>$password);
			$count = $this->db->users->count($query);
			if($count > 0)
			{
				$user = $this->db->users->findOne($query,array("_id"=>1));
				$userid=$user["_id"];
				echo "Success:User Id-".$userid;
			}else
			{
				echo "Error: Invalid username/password";
			}
		}
		else
		{
			echo "Information: Not implemented yet";
		}
	}
	
	public function user_exists()
	{
		$username = $this->params['username'];
		$i = $this->db->users->count(array('username'=>$username));
		if($i == 0)
		{
			echo "no";
		}
		else
		{
			echo "yes";
		}
	}
}
?>