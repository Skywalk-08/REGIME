<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type' => 'INT', 'auto_increment' => true],
            'nom'                   => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'                 => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'genre'                 => ['type' => 'ENUM', 'constraint' => ['M', 'F']],
            'taille'                => ['type' => 'INT', 'comment' => 'en cm'],
            'poids'                 => ['type' => 'DECIMAL', 'constraint' => [5, 2]],
            'imc'                   => ['type' => 'DECIMAL', 'constraint' => [5, 2], 'null' => true],
            'password'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_gold'               => ['type' => 'BOOLEAN', 'default' => false],
            'gold_purchased_at'     => ['type' => 'DATETIME', 'null' => true],
            'wallet_balance'        => ['type' => 'DECIMAL', 'constraint' => [10, 2], 'default' => 0],
            'profile_completed'     => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'            => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
            'deleted_at'            => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', false, true);
        $this->forge->addKey('is_gold');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
