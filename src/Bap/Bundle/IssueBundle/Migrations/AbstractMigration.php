<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 22.01.15
 * Time: 5:33
 */

namespace Bap\Bundle\IssueBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

/**
 * Class AbstractMigration
 *
 * @package Bap\Bundle\IssueBundle\Migrations
 */
abstract class AbstractMigration implements MigrationInterface
{
    /**
     * @var Schema
     */
    protected $schema;

    /**
     * @var Table
     */
    protected $table;

    /**
     * @param Schema $schema
     */
    public function __construct(Schema $schema)
    {
        $tableName    = $this->getTableName();

        $this->schema = $schema;
        $this->table  = $schema->createTable($tableName);
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function addForeignKeys(Table $table)
    {
        return $table;
    }

    /**
     * @return null
     */
    public function createRelationTables()
    {
        return null;
    }

    /**
     * @return Table
     */
    final public function setup()
    {
        if ($this->schema->hasTable($this->getTableName())) {
            $this->schema->dropTable($this->getTableName());
        }

        $this->createRelationTables();

        return $this->addForeignKeys(
            $this->addIndexKeys(
                $this->addColumns($this->table)
            )
        );
    }

    /**
     * @param Schema $schema
     * @return AbstractMigration
     */
    public function setSchema(Schema $schema)
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * @return Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @return Table
     */
    public function getTargetTable()
    {
        return $this->table;
    }

    /**
     * @param Table $table
     * @return AbstractMigration
     */
    public function setTargetTable(Table $table)
    {
        $this->table = $table;

        return $this;
    }
}