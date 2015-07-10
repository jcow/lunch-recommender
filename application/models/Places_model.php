<?php

require_once("Default_model.php");
require_once("Users_to_places_model.php");

class Places_model extends Default_model {

        public static $TABLE_NAME = 'places';

        public function __construct()
        {
                parent::__construct();
        }

        public function get_next_place_for_user_to_rate($user_id, $options = array()){
                $limit = array_key_exists('limit', $options) ? $options['limit'] : 1;
                $offset = array_key_exists('offset', $options) ? $options['offset'] : 0;

                $query = $this->db->query("
                        SELECT * FROM places WHERE place_id NOT IN (
                                SELECT places.place_id FROM places
                                INNER JOIN users_to_places ON places.place_id = users_to_places.place_id
                                WHERE users_to_places.user_id = ?
                        )
                        ORDER BY distance
                        LIMIT ?
                        OFFSET ?
                ",
                array(
                        $user_id,
                        $limit, 
                        $offset
                ));

                return $query->result();
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