<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/23/15
 * Time: 12:24 PM
 */
namespace Bap\Bundle\IssueBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

/**
 * Interface MigrationInterface
 *
 * @package Bap\Bundle\IssueBundle\Migrations
 */
interface MigrationInterface
{
    /**
     * @return Schema
     */
    public function getSchema();

    /**
     * @param Schema $schema
     * @return MigrationInterface
     */
    public function setSchema(Schema $schema);

    /**
     * @return Table
     */
    public function getTargetTable();

    /**
     * @param Table $table
     * @return MigrationInterface
     */
    public function setTargetTable(Table $table);

    /**
     * @return string
     */
    public function getTableName();

    /**
     * @param Table $table
     * @return Table
     */
    public function addColumns(Table $table);

    /**
     * @return null
     */
    public function createRelationTables();

    /**
     * @param Table $table
     * @return Table
     */
    public function addIndexKeys(Table $table);

    /**
     * @param Table $table
     * @return Table
     */
    public function addForeignKeys(Table $table);

    /**
     * @return mixed
     */
    public function setup();
}