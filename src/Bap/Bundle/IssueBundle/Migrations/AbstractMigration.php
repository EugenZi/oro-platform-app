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

abstract class AbstractMigration
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
    abstract protected function addColumns(Table $table);

    /**
     * @param Table $table
     * @return Table
     */
    abstract protected function addIndexKeys(Table $table);

    /**
     * @return string
     */
    abstract protected function getTableName();

    /**
     * @param Table $table
     * @return Table
     */
    protected function addForeignKeys(Table $table)
    {
        return $table;
    }

    /**
     * @return null
     */
    protected  function createRelationTables()
    {
        return null;
    }

    public final function setup()
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
}