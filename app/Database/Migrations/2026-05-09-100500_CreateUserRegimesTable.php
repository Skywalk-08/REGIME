<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserRegimesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'auto_increment' => true],
            'user_id'       => ['type' => 'INT'],
            'regime_id'     => ['type' => 'INT'],
            'date_debut'    => ['type' => 'DATETIME'],
            'date_fin'      => ['type' => 'DATETIME'],
            'prix_paye'     => ['type' => 'DECIMAL', 'constraint' => [10, 2]],
            'statut'        => ['type' => 'ENUM', 'constraint' => ['actif', 'termine', 'annule'], 'default' => 'actif'],
            'created_at'    => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
        ]);

        $this->forge->addKey('id', false, true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('regime_id', 'regimes', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addKey('user_id');
        $this->forge->addKey('regime_id');
        $this->forge->createTable('user_regimes', true);
    }

    public function down()
    {
        $this->forge->dropTable('user_regimes', true);
    }
}
