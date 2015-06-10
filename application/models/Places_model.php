<?php

class Places_model extends CI_Model {

        public static $TABLE_NAME = 'places';

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function insert_all($places){
                $data = array();
                foreach($places as $place) {
                        echo '<pre>';
                        
                        $row = array(
                                'google_id' => $place['place_id'],
                                'name' => $place['name'],
                                'vicinity' => $place['vicinity']
                        );

                        $data[] = $row;
                }

                // delete previous data
                $this->db->empty_table(self::$TABLE_NAME);

                // insert all new data
                $this->db->insert_batch(self::$TABLE_NAME, $data);
        }

}