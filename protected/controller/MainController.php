<?php

class MainController extends DooController{

   	private $mongo;
	private $db;
	
	function __construct()
	{
		$this->mongo = new MongoClient("mongodb://75.80.144.58");
		$this->db = $this->mongo->selectDB("locationstories");
	}

    public function index(){
		//Just replace these
		Doo::loadCore('app/DooSiteMagic');
		DooSiteMagic::displayHome();
    }
	
	public function allurl(){	
		Doo::loadCore('app/DooSiteMagic');
		DooSiteMagic::showAllUrl();	
	}
	
    public function debug(){
		Doo::loadCore('app/DooSiteMagic');
		DooSiteMagic::showDebug($this->params['filename']);
    }
	
	public function gen_sitemap_controller(){
		//This will replace the routes.conf.php file
		Doo::loadCore('app/DooSiteMagic');
		DooSiteMagic::buildSitemap(true);		
		DooSiteMagic::buildSite();
	}
	
	public function gen_sitemap(){
		//This will write a new file,  routes2.conf.php file
		Doo::loadCore('app/DooSiteMagic');
		DooSiteMagic::buildSitemap();		
	}
	
	public function gen_site(){
		Doo::loadCore('app/DooSiteMagic');
		DooSiteMagic::buildSite();
	}
	
    public function gen_model(){
        Doo::loadCore('db/DooModelGen');
        DooModelGen::genMySQL();
    }
	
	public function login()
	{
		session_start();
		if(isset($_SESSION['userid']))
		{
			$data['userid'] = $_SESSION['userid'];
			$this->renderc('Home', $data);
		}
		else 
		{
			$categories = $this->db->businesstypes->find();
			$categoryNames= array();
			$categoryIds = array();
			foreach($categories as $category)
			{
				array_push($categoryNames, $category['Name']);
				array_push($categoryIds, $category['_id']);
			}
			$data['categoryNames'] = $categoryNames;
			$data['categoryIds'] = $categoryIds;
			$this->renderc('Login', $data);	
		}
	}
	
	public function home()
	{
		session_start();
		if(isset($_SESSION['userid']))
		{
			$data['userid'] = $_SESSION['userid'];
			$this->renderc('Home', $data);
		}
		else {
			$categories = $this->db->businesstypes->find();
			$categoryNames= array();
			$categoryIds = array();
			foreach($categories as $category)
			{
				array_push($categoryNames, $category['Name']);
				array_push($categoryIds, $category['_id']);
			}
			$data['categoryNames'] = $categoryNames;
			$data['categoryIds'] = $categoryIds;
			$this->renderc('Login', $data);
		}
	}
	
	public function init_session()
	{
		session_start();
		if(isset($_POST['userid']))
		{
			$_SESSION['userid'] = $_POST['userid'];
		}
	}
	
	public function logout()
	{
		session_start();
		session_destroy();
		$this->login();
	}
	
	public function register()
	{
		$this->renderc('Register');
	}
	
	public function registration()
	{
		$this->renderc('Registration');
	}
	
	public function individualinfo()
	{
		$this->renderc('IndividualInfo');
	}
	
	public function businessinfo()
	{
		$categories = $this->db->businesstypes->find();
		$categoryNames= array();
		$categoryIds = array();
		foreach($categories as $category)
		{
			array_push($categoryNames, $category['Name']);
			array_push($categoryIds, $category['_id']);
		}
		$data['categoryNames'] = $categoryNames;
		$data['categoryIds'] = $categoryIds;
		$this->renderc('BusinessInfo', $data);
	}
	
	public function addressinfo()
	{
		$this->renderc('AddressInfo');
	}
	
	public function accounttype()
	{
		$this->renderc('AccountType');
	}
	
	public function confirmation()
	{
		
		$this->renderc('Confirmation');
	}
	
	public function failed()
	{
		
		$this->renderc('Failed');
	}
	
    }	
?>