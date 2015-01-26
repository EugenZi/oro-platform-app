<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/23/15
 * Time: 12:24 PM
 */
namespace Bap\Bundle\IssueBundle\Migrations\Issue;

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
     * @return Table
     */
    public function addColumns();

    /**
     * @return Table
     */
    public function addIndexKeys();

    /**
     * @return Table
     */
    public function addForeignKeys();

    /**
     * @return mixed
     */
    public function setup();
}
