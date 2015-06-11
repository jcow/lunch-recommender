<?php

class Default_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	protected function get_result($query){
		if ($query->num_rows() > 0) {
            return $query->row();
        } 
        else {
			return null;
        }
	}

	protected function get_results($query){
		if ($query->num_rows() > 0) {
            $ret = array();
            foreach($query->result() as $row){
            	$ret[] = $row;
            }
            return $ret;
        } 
        else {
            return array();
        }
	}
}