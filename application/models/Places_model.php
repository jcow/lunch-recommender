<?php

require("Default_model.php");

class Places_model extends Default_model {

        public static $TABLE_NAME = 'places';

        public function __construct()
        {
                parent::__construct();
        }

        public function insert_batch($places) {
                $inserted_count = 0;
                foreach($places as $place) {
                        $external_reference_id = $place['id'];
                        $distance = $place['distance'];
                        $exists_in_db = $this->get_by_external_reference_id($external_reference_id);
                        if(!$exists_in_db){
                                $this->db->insert(self::$TABLE_NAME, array(
                                        'external_reference_id'=>$external_reference_id,
                                        'distance'=>$distance
                                ));
                                $inserted_count++;
                        }
                }
                return $inserted_count;
        }

        public function get_by_external_reference_id($external_reference_id){
                $query = $this->db->get_where(
                        self::$TABLE_NAME,
                        array('external_reference_id'=> $external_reference_id)
                );

                return $this->get_result($query);
        }

}