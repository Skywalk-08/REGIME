<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateObjectivesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'auto_increment' => true],
            'user_id'      => ['type' => 'INT'],
            'type'         => ['type' => 'ENUM', 'constraint' => ['gain_weight', 'lose_weight', 'ideal_imc']],
            'target_value' => ['type' => 'DECIMAL', 'constraint' => [5, 2], 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
        ]);

        $this->forge->addKey('id', false, true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addUniqueKey(['user_id', 'type'], 'unique_user_objective');
        $this->forge->createTable('objectives', true);
    }

    public function down()
    {
        $this->forge->dropTable('objectives', true);
    }
}
