<?php

	/**
	* Author: Manjeet Singh Bargoti
	*/

	class db {

		private static $_instance;		// The single instance
	    protected $db_conn;
	    public $db_user='root';
	    public $db_pass='';
	    public $db_host='localhost';
	    public $db_name='zen';


	    // Get an instance of the Database 
	    // @return  instance
	    public static function getInstance()
	    {
	    	if(!self::$_instance){
	    		// If no instance then make one
	    		self::$_instance = new self();
	    	}

	    	return self::$_instance;
	    }

 
 		// Connect to the Database
		public function connect() 
		{

		    try{
		        
		        $this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_pass);
		        $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        return $this->db_conn;

		    } catch (Exception $e){

		            return $e->getMessage();

		    }
		}
 
 		// Disconnect to the Database
		public function disconnect()
		{
		    
		    try{
		        
		        $this->db_conn=null;
		        return $this->db_conn;
		    
		    } catch (Exception $e){
		        
		        return $e->getMessage();
		    
		    }
		}
    }

?>