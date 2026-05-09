<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserActivitesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'auto_increment' => true],
            'user_id'       => ['type' => 'INT'],
            'activite_id'   => ['type' => 'INT'],
            'frequence'     => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true, 'comment' => 'ex: 3x par semaine'],
            'date_debut'    => ['type' => 'DATETIME'],
            'date_fin'      => ['type' => 'DATETIME', 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
        ]);

        $this->forge->addKey('id', false, true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('activite_id', 'activites_sportives', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addKey('user_id');
        $this->forge->createTable('user_activites', true);
    }

    public function down()
    {
        $this->forge->dropTable('user_activites', true);
    }
}
