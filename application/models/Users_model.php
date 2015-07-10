<?php

require_once("Default_model.php");

class Users_model extends Default_model {

	public static $TABLE_NAME = 'users';

	public function __construct()
    {
        parent::__construct();
    }

    public function does_user_exist($username){
        $row = $this->get_by_username($username);
        return $row == NULL ? false : true;
    }

    public function add_user($username) {
    	$user = $this->get_by_username($username);
    	if(!$user) {
    		$this->db->insert(self::$TABLE_NAME, array(
	    		'username' => $username
	    	));		
	    	return true;
    	}

    	return false;
    }

    public function get_all(){
        $query = $this->db->get(self::$TABLE_NAME);
        return $this->get_results($query);
    }

    public function get_by_username($username){
    	$query = $this->db->get_where(
            self::$TABLE_NAME,
            array('username'=> $username)
        );

        return $this->get_result($query);
    }

    public function get_by_user_id($user_id){
    	$query = $this->db->get_where(
            self::$TABLE_NAME,
            array('user_id'=> $user_id)
        );

        return $this->get_result($query);
    }

}