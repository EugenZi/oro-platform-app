<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 22.01.15
 * Time: 5:33
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

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
        $tableName = $this->getTableName();

        if ($schema->hasTable($tableName)) {
            $schema->dropTable($tableName);
        }

        $this->schema = $schema;
        $this->table  = $schema->createTable($tableName);
    }

    /**
     * @return Table
     */
    public function addForeignKeys()
    {
        return $this->getTable();
    }

    /**
     * @return Table
     */
    final public function setup()
    {
        $this->addColumns($this->table);
        $this->addIndexes($this->table);
        $this->addForeignKeys($this->table);

        return $this->table;
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
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param Table $table
     * @return AbstractMigration
     */
    public function setTable(Table $table)
    {
        $this->table = $table;

        return $this;
    }
}
