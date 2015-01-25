<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:02 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;
use Bap\Bundle\IssueBundle\Migrations\AbstractMigration;

/**
 * Class BapIssuePriority
 *
 * @package Bap\Bundle\IssueBundle\Migrations\Issue
 */
class BapIssuePriority extends AbstractMigration
{

    /**
     * @return string
     */
    public function getTableName()
    {
        return IssuePriority::TABLE_NAME;
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function addColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 32]);
        $table->addColumn('priority', 'integer', ['length' => 3]);

        return $table;
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function addIndexKeys(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['priority'], 'BAP_ISSUE_PRIORITY_FIELD_UNIQUE_IDX');

        return $table;
    }
}