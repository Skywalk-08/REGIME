<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivitesSportivesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'auto_increment' => true],
            'nom'               => ['type' => 'VARCHAR', 'constraint' => 150],
            'description'       => ['type' => 'TEXT', 'null' => true],
            'calories_brulees'  => ['type' => 'INT', 'null' => true, 'comment' => 'calories brûlées par heure'],
            'difficulte'        => ['type' => 'ENUM', 'constraint' => ['facile', 'moyen', 'difficile'], 'default' => 'moyen'],
            'created_at'        => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
            'updated_at'        => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
            'deleted_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', false, true);
        $this->forge->createTable('activites_sportives', true);
    }

    public function down()
    {
        $this->forge->dropTable('activites_sportives', true);
    }
}
