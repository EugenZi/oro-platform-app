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

interface MigrationInterface
{
    /**
     * @return Schema
     */
    function getSchema();

    /**
     * @param Schema $schema
     * @return MigrationInterface
     */
    function setSchema(Schema $schema);

    /**
     * @return Table
     */
    function getTargetTable();

    /**
     * @param Table $table
     * @return MigrationInterface
     */
    function setTargetTable(Table $table);

    /**
     * @return string
     */
    function getTableName();

    /**
     * @param Table $table
     * @return Table
     */
    function addColumns(Table $table);

    /**
     * @return null
     */
    function createRelationTables();

    /**
     * @param Table $table
     * @return Table
     */
    function addIndexKeys(Table $table);

    /**
     * @param Table $table
     * @return Table
     */
    function addForeignKeys(Table $table);

    /**
     * @return mixed
     */
    function setup();
}