<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_places extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'place_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'external_reference_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                                'NULL' => true
                        ),
                        'distance' => array(
                                'type'=>'DECIMAL',
                                'constraint' => '10,2'
                        )

                ));
                $this->dbforge->add_key('place_id', TRUE);
                $this->dbforge->create_table('places');
        }

        public function down()
        {
                $this->dbforge->drop_table('places');
        }
}