<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users_to_places extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE
                        ),
                        'place_id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE
                        ),
                        'rating' => array(
                                'type' => 'INT',
                        )
                ));
                
                $this->dbforge->create_table('users_to_places');

                $this->db->query("
                        ALTER TABLE users_to_places
                        ADD FOREIGN KEY (user_id)
                        REFERENCES users(user_id)
                ");

                $this->db->query("
                        ALTER TABLE users_to_places
                        ADD FOREIGN KEY (place_id)
                        REFERENCES places(place_id)
                ");

        }

        public function down()
        {
                $this->dbforge->drop_table('users_to_places');
        }
}