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
     * @return Table
     */
    public function addColumns()
    {
        $table = $this->getTable();

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 32]);
        $table->addColumn('value', 'integer', ['length' => 3]);

        $table->setPrimaryKey(['id']);

        return $table;
    }

    /**
     * @return Table
     */
    public function addIndexes()
    {
        $table = $this->getTable();

        $table->addUniqueIndex(['name'], 'BAP_ISSUE_PRIORITY_NAME_FIELD_UNIQUE_INDEX');
        $table->addIndex(['name'], 'BAP_ISSUE_PRIORITY_NAME_FIELD_INDEX');
        $table->addIndex(['value'], 'BAP_ISSUE_PRIORITY_VALUE_FIELD_INDEX');

        return $table;
    }
}