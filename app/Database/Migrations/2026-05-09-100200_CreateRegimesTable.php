<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRegimesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                      => ['type' => 'INT', 'auto_increment' => true],
            'nom'                     => ['type' => 'VARCHAR', 'constraint' => 150],
            'description'             => ['type' => 'TEXT', 'null' => true],
            'pourcentage_viande'      => ['type' => 'INT', 'comment' => 'en %'],
            'pourcentage_poisson'     => ['type' => 'INT', 'comment' => 'en %'],
            'pourcentage_volaille'    => ['type' => 'INT', 'comment' => 'en %'],
            'prix_base'               => ['type' => 'DECIMAL', 'constraint' => [10, 2]],
            'duree_jours'             => ['type' => 'INT'],
            'poids_variation_min'     => ['type' => 'DECIMAL', 'constraint' => [5, 2], 'null' => true],
            'poids_variation_max'     => ['type' => 'DECIMAL', 'constraint' => [5, 2], 'null' => true],
            'created_at'              => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
            'updated_at'              => ['type' => 'DATETIME', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
            'deleted_at'              => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', false, true);
        $this->forge->createTable('regimes', true);
    }

    public function down()
    {
        $this->forge->dropTable('regimes', true);
    }
}
