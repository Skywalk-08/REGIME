<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCodesPortefeuilleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'auto_increment' => true],
            'code'            => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'montant'         => ['type' => 'DECIMAL', 'constraint' => [10, 2]],
            'is_used'         => ['type' => 'BOOLEAN', 'default' => false],
            'utilisateur_id'  => ['type' => 'INT', 'null' => true],
            'used_at'         => ['type' => 'DATETIME', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
        ]);

        $this->forge->addKey('id', false, true);
        $this->forge->addForeignKey('utilisateur_id', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addKey('is_used');
        $this->forge->createTable('codes_portefeuille', true);
    }

    public function down()
    {
        $this->forge->dropTable('codes_portefeuille', true);
    }
}
