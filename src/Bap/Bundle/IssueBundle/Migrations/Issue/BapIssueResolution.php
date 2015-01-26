<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:03 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Bap\Bundle\IssueBundle\Entity\IssueResolution;

/**
 * Class BapIssueResolution
 *
 * @package Bap\Bundle\IssueBundle\Migrations\Issue
 */
class BapIssueResolution extends AbstractMigration
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return IssueResolution::TABLE_NAME;
    }

    /**
     * @return Table
     */
    public function addColumns()
    {
        $table = $this->getTable();

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('value', 'string', ['length' => 32]);

        $table->setPrimaryKey(['id']);

        return $table;
    }

    /**
     * @return Table
     */
    public function addIndexes()
    {
        $table = $this->getTable();

        $table->addUniqueIndex(['value'], 'BAP_ISSUE_RESOLUTION_VALUE_UNIQUE_INDEX');

        return $table;
    }
}